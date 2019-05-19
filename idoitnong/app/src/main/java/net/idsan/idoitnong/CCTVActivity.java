package net.idsan.idoitnong;

import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.MenuItem;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import org.jsoup.Jsoup;

import java.io.IOException;

import io.github.controlwear.virtual.joystick.android.JoystickView;

public class CCTVActivity extends AppCompatActivity {
    private WebView webView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cctv);

        this.setTitle("CCTV");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        webView = findViewById(R.id.webView);
        webView.setWebViewClient(new WebViewClient());
        webView.setBackgroundColor(0);
        webView.getSettings().setBuiltInZoomControls(true);
        webView.setInitialScale(1);
        webView.getSettings().setLoadWithOverviewMode(true);
        webView.getSettings().setUseWideViewPort(true);
        webView.getSettings().setDisplayZoomControls(false);
        webView.loadUrl("http://192.168.0.6:8080/video");

        JoystickView joystick = findViewById(R.id.joystickView);

        joystick.setOnMoveListener(new JoystickView.OnMoveListener() {
            private int direction = JoystickDirection.NONE;

            @Override
            public void onMove(int angle, int strength) {
                if(strength < 40) return; //끌어당기는 힘이 40미만일경우 동작하지 않게 설정

                direction = JoystickDirection.get4Direction(angle);

                switch(direction) {
                    case JoystickDirection.LEFT:
                        new JsoupAsyncTask("http://192.168.0.5:8000/servocontrol/left/").execute();
                        break;
                    case JoystickDirection.UP:
                        new JsoupAsyncTask("http://192.168.0.5:8000/servocontrol/up/").execute();
                        break;
                    case JoystickDirection.RIGHT:
                        new JsoupAsyncTask("http://192.168.0.5:8000/servocontrol/right/").execute();
                        break;
                    case JoystickDirection.DOWN:
                        new JsoupAsyncTask("http://192.168.0.5:8000/servocontrol/down/").execute();
                        break;
                }
            }
        }, 80);
    }

    private class JsoupAsyncTask extends AsyncTask<Void, Void, Void> {
        String url;

        public JsoupAsyncTask(String url) {
            this.url = url;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... params) {
            try {
                Jsoup.connect(url).get();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case android.R.id.home:{ //toolbar의 back키 눌렀을 때 동작
                finish();
                return true;
            }
        }
        return super.onOptionsItemSelected(item);
    }
}
