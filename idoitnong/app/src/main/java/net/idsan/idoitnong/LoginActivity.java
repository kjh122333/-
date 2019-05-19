package net.idsan.idoitnong;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.regex.Pattern;

import cz.msebera.android.httpclient.Header;

public class LoginActivity extends AppCompatActivity implements View.OnClickListener {
    private EditText txtUsername, txtPassword;
    private Button btnLogin;
    private TextView tvSignup, tvFindId, tvFindPw;
    private CheckBox chkSaveID, chkAutoLogin;
    private ProgressDialog pdStatus;
    private SharedPreferences appData;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        this.getSupportActionBar().hide();

        appData = getSharedPreferences("appData", MODE_PRIVATE);

        txtUsername  = findViewById(R.id.txtUsername);
        txtPassword  = findViewById(R.id.txtPassword);
        btnLogin     = findViewById(R.id.btnLogin);
        chkSaveID    = findViewById(R.id.chkSaveID);
        chkAutoLogin = findViewById(R.id.chkAutoLogin);
        tvSignup     = findViewById(R.id.tvSignup);
        tvFindId     = findViewById(R.id.tvFindId);
        tvFindPw     = findViewById(R.id.tvFindPw);

        btnLogin.setOnClickListener(this);
        tvSignup.setOnClickListener(this);
        tvFindId.setOnClickListener(this);
        tvFindPw.setOnClickListener(this);

        //SharedPreferences에서 아이디 저장, 자동 로그인 체크여부 받아오기
        boolean isSaveId    = appData.getBoolean("SAVE_ID", false);
        boolean isAutoLogin = appData.getBoolean("AUTO_LOGIN", false);

        //아이디 저장을 사용중이라면
        if(isSaveId) {
            chkSaveID.setChecked(isSaveId);
            txtUsername.setText(appData.getString("ID", ""));
            if(!isAutoLogin) txtPassword.requestFocus();
        }

        //자동 로그인을 사용중이라면
        if(isAutoLogin) {
            chkAutoLogin.setChecked(isAutoLogin);
            chkLogin(new RequestParams("auth_key", appData.getString("AUTH_KEY", "")));
        }
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLogin:
                RequestParams params = new RequestParams();

                params.put("username", txtUsername.getText().toString());
                params.put("password", txtPassword.getText().toString());

                if(validate())
                    chkLogin(params);

                break;
            case R.id.tvSignup:
                //startActivity(new Intent(this, SignupActivity.class));
                break;
            case R.id.tvFindId:
                Toast.makeText(getApplicationContext(), "미구현..", Toast.LENGTH_SHORT).show();
                break;
            case R.id.tvFindPw:
                Toast.makeText(getApplicationContext(), "미구현..", Toast.LENGTH_SHORT).show();
                break;
        }
    }

    private boolean validate() {
        if(txtUsername.getText().toString().isEmpty()) {
            Toast.makeText(this, "아이디를 입력해주세요", Toast.LENGTH_SHORT).show();
            txtUsername.requestFocus();
            return false;
        }

        if(!Pattern.compile("(^[0-9a-z_-]{4,12}$)").matcher(txtUsername.getText().toString()).find()) {
            Toast.makeText(this, "아이디의 형식이 올바르지 않습니다.", Toast.LENGTH_SHORT).show();
            txtUsername.requestFocus();
            return false;
        }

        if(txtPassword.getText().toString().isEmpty()) {
            Toast.makeText(this, "비밀번호를 입력해주세요", Toast.LENGTH_SHORT).show();
            txtPassword.requestFocus();
            return false;
        }

        if(!Pattern.compile("(^[0-9a-zA-Z~!@#$%^&*()-_=+\\|`]{6,24}$)").matcher(txtPassword.getText().toString()).find()) {
            Toast.makeText(this, "비밀번호의 형식이 올바르지 않습니다.", Toast.LENGTH_SHORT).show();
            txtPassword.requestFocus();
            return false;
        }

        return true;
    }

    private void chkLogin(RequestParams params) {
        IdoitnongRestClient.post("login", params, new JsonHttpResponseHandler() {
            @Override
            public void onStart() {
                pdStatus = new ProgressDialog(LoginActivity.this);
                pdStatus.setMessage("잠시만 기다려주세요.");
                pdStatus.setCancelable(false); //화면 터치해도 다이얼로그 안꺼지게
                pdStatus.setIndeterminate(true); //계속 뺑뺑이돌리기
                pdStatus.show();
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                try {
                    if(response.getBoolean("ok")) {
                        SharedPreferences.Editor editor = appData.edit();

                        editor.putBoolean("SAVE_ID", chkSaveID.isChecked());
                        editor.putBoolean("AUTO_LOGIN", chkAutoLogin.isChecked());
                        editor.putString("ID", txtUsername.getText().toString());
                        editor.putString("AUTH_KEY", response.getString("key"));
                        editor.apply();

                        startActivity(new Intent(LoginActivity.this, MainActivity.class));
                        finish();
                    } else { //로그인에 실패할경우
                        Toast.makeText(LoginActivity.this, response.getString("msg"), Toast.LENGTH_SHORT).show();
                        setViewEnabled(true);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable throwable, JSONObject errorResponse) {
                Toast.makeText(getApplicationContext(), "알 수없는 오류 발생! 인터넷에 연결되어있는지 확인하여 주세요.", Toast.LENGTH_SHORT).show();
                setViewEnabled(true);
            }

            @Override
            public void onFinish() {
                pdStatus.dismiss();
            }
        });
    }


    private void setViewEnabled(boolean b) {
        txtUsername.setEnabled(b);
        txtPassword.setEnabled(b);
        btnLogin.setEnabled(b);
        chkAutoLogin.setEnabled(b);
        chkSaveID.setEnabled(b);
        tvSignup.setEnabled(b);
        tvFindId.setEnabled(b);
        tvFindPw.setEnabled(b);
    }
}