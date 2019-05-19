package net.idsan.idoitnong;

import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.media.RingtoneManager;
import android.net.Uri;
import android.support.v4.app.NotificationCompat;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.loopj.android.http.JsonHttpResponseHandler;

import net.idsan.idoitnong.THDetail.SensorListActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.sql.Timestamp;
import java.text.ParseException;
import java.text.SimpleDateFormat;

import cz.msebera.android.httpclient.Header;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {
    private final long FINISH_INTERVAL_TIME = 2000;
    private long backPressedTime = 0;
    private SharedPreferences appData;
    private ProgressDialog pdStatus;
    private TextView tvOutTemp, tvInTemp, tvInTime, tvOutTime;
    public static String authKey;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        appData = getSharedPreferences("appData", MODE_PRIVATE);

        tvOutTemp = findViewById(R.id.tvOutTemp);
        tvInTemp  = findViewById(R.id.tvInTemp);
        tvOutTime = findViewById(R.id.tvOutTime);
        tvInTime  = findViewById(R.id.tvInTime);

        findViewById(R.id.menuHouse).setOnClickListener(this);
        findViewById(R.id.menuDelivery).setOnClickListener(this);
        findViewById(R.id.menuMarket).setOnClickListener(this);
        findViewById(R.id.menuCCTV).setOnClickListener(this);

        authKey = appData.getString("AUTH_KEY", "");

        loadSensorData(authKey);
    }


    @Override
    public void onBackPressed() {
        long tempTime = System.currentTimeMillis();
        long intervalTime = tempTime - backPressedTime;

        if(0 <= intervalTime && FINISH_INTERVAL_TIME >= intervalTime) {
            finishAffinity();
        } else {
            backPressedTime = tempTime;
            Toast.makeText(this, "뒤로 버튼을 한 번 더 누르면 앱이 종료됩니다.", Toast.LENGTH_SHORT).show();
        }
    }

    private void logout() {
        SharedPreferences.Editor editor = appData.edit();
        editor.putBoolean("SAVE_ID", false);
        editor.putBoolean("AUTO_LOGIN", false);
        editor.putString("ID", "");
        editor.putString("AUTH_KEY", "");
        editor.apply();
        startActivity(new Intent(MainActivity.this, LoginActivity.class));
        finish();
    }

    private double convertSensorData(String s) {
        return Double.parseDouble(s) / 100;
    }

    private void loadSensorData(String authKey) {
        IdoitnongRestClient.get(authKey + "/sensor/last/all", null, new JsonHttpResponseHandler() {

            @Override
            public void onStart() {
                pdStatus = new ProgressDialog(MainActivity.this);
                pdStatus.setMessage("잠시만 기다려주세요.");
                pdStatus.setCancelable(false); //화면 터치해도 다이얼로그 안꺼지게
                pdStatus.setIndeterminate(true); //계속 뺑뺑이돌리기
                pdStatus.show();
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                try {
                    if(response.getBoolean("ok")) {
                        JSONArray array = response.getJSONArray("data");

                        String sensorType;

                        for(int i = 0; i < array.length(); i++) {
                            sensorType = array.getJSONObject(i).getString("sensor_type");

                            if("temp01".equals(sensorType)) {
                                tvInTemp.setText(Double.toString(convertSensorData(array.getJSONObject(i).getString("sensor_value"))) + "℃");
                                tvInTime.setText(array.getJSONObject(i).getString("register_date") + " 기준");
                            }
                            if("temp02".equals(sensorType)) {
                                tvOutTemp.setText(Double.toString(convertSensorData(array.getJSONObject(i).getString("sensor_value"))) + "℃");
                                tvOutTime.setText(array.getJSONObject(i).getString("register_date") + " 기준");
                            }
                        }
                    } else { //데이터 가져오기에 실패할경우
                        Toast.makeText(MainActivity.this, response.getString("msg"), Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable throwable, JSONObject errorResponse) {
                Toast.makeText(getApplicationContext(), "알 수없는 오류 발생! 인터넷에 연결되어있는지 확인하여 주세요.", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFinish() {
                pdStatus.dismiss();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        this.getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.btnLogout:
                logout();
                return true;
            case R.id.btnRefresh:
                loadSensorData(authKey);
                Toast.makeText(this, "새로고침이 완료 되었습니다.", Toast.LENGTH_SHORT).show();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onClick(View v) {
        switch(v.getId()) {
            case R.id.menuDelivery:
                Toast.makeText(this, "미구현..", Toast.LENGTH_SHORT).show();
                break;
            case R.id.menuCCTV:
                startActivity(new Intent(this, CCTVActivity.class));
                break;
            case R.id.menuMarket:
                startActivity(new Intent(this, MarketActivity.class));
                break;
            case R.id.menuHouse:
                startActivity(new Intent(this, SensorListActivity.class));
                break;
        }
    }
}
