package net.idsan.idoitnong.THDetail;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import net.idsan.idoitnong.MainActivity;
import net.idsan.idoitnong.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URL;
import java.text.SimpleDateFormat;

public class SensorMinuteListActivity extends AppCompatActivity {

    SensorMinuteListAdapter sensorminute_adapter;

    ListView sensorminutelist;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sensor_minute_list);

        Intent intent = getIntent();
        String sensor_type = intent.getExtras().getString("sensor_type");
        String sensorhour_ymdh = intent.getExtras().getString("sensorhour_ymdh");

        //sensorhour_ymdh = sensorhour_ymdh.substring(0,4) + sensorhour_ymdh.substring(5,7) + sensorhour_ymdh.substring(8,10) + sensorhour_ymdh.substring(11,13);
        sensorhour_ymdh = sensorhour_ymdh.replace("-", "");
        sensorhour_ymdh = sensorhour_ymdh.replace(" ", "");
        Toast.makeText(this, sensor_type + " " + sensorhour_ymdh, Toast.LENGTH_SHORT).show();



        this.setTitle("분당 센서 데이터");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        sensorminutelist = findViewById(R.id.sensorminutelist);
        sensorminute_adapter = new SensorMinuteListAdapter();

        AsyncTask<String, Void, StringBuffer> bp = new SensorMinuteParser().execute("http://anonymous.godohosting.com/idoitnong/view/"  + MainActivity.authKey +  "/minute/" + sensor_type + "/" + sensorhour_ymdh);

    }

    public class SensorMinuteParser extends AsyncTask<String, Void, StringBuffer> {

        @Override
        protected void onPostExecute(StringBuffer buffer) {
            try {
                JSONArray array = new JSONObject(buffer.toString()).getJSONArray("data");
                for(int i=0; i<array.length(); i++) {
                    JSONObject obj = array.getJSONObject(i);
                    String sensorminute_ymdhm = new SimpleDateFormat("HH시 mm분").format(new SimpleDateFormat("yyyy-MM-dd HH:mm").parse(obj.getString("ymdh")));
                    String sensorminute_avg = obj.getString("avg");
                    String sensorminute_cnt = obj.getString("cnt");


                    SensorMinuteListItem item = new SensorMinuteListItem();
                    item.setSensorminute_ymdhm(sensorminute_ymdhm);
                    item.setSensorminute_avg(sensorminute_avg);
                    item.setSensorminute_cnt(sensorminute_cnt);

                    sensorminute_adapter.addItem(item);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            sensorminutelist.setAdapter(sensorminute_adapter);
            super.onPostExecute(buffer);
        }

        @Override
        protected StringBuffer doInBackground(String... urls) {
            try {
                URL url = new URL(urls[0]);
                InputStream is = url.openConnection().getInputStream();
                StringBuffer buffer = new StringBuffer();
                BufferedReader br = new BufferedReader(new InputStreamReader(is));
                String line;
                while((line = br.readLine()) != null) {
                    buffer.append(line + "\n");
                }
                return buffer;
            } catch (Exception e) {
                e.printStackTrace();
            }
            return null;
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
