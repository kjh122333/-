package net.idsan.idoitnong.THDetail;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
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

public class SensorHourListActivity extends AppCompatActivity {

    SensorHourListAdapter sensorhour_adapter;

    ListView sensorhourlist;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sensor_hour_list);

        Intent intent = getIntent();
        final String sensor_type = intent.getExtras().getString("sensor_type");
        Log.d("배아파",sensor_type);
        Toast.makeText(this, sensor_type, Toast.LENGTH_SHORT).show();

        this.setTitle("시간당 센서 데이터");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);



        sensorhourlist = findViewById(R.id.sensorhourlist);
        sensorhour_adapter = new SensorHourListAdapter();

        AsyncTask<String, Void, StringBuffer> bp = new SensorHourParser().execute("http://anonymous.godohosting.com/idoitnong/view/" + MainActivity.authKey + "/hour/" + sensor_type);


        sensorhourlist.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent1 = new Intent(SensorHourListActivity.this, SensorMinuteListActivity.class);
                intent1.putExtra("sensor_type", sensor_type);
                intent1.putExtra("sensorhour_ymdh", ((SensorHourListItem)sensorhour_adapter.getItem(position)).getSensorhour_ymdh());
                startActivity(intent1);
            }
        });
    }

    public class SensorHourParser extends AsyncTask<String, Void, StringBuffer> {

        @Override
        protected void onPostExecute(StringBuffer buffer) {
            try {
                JSONArray array = new JSONObject(buffer.toString()).getJSONArray("data");
                for(int i=0; i<array.length(); i++) {
                    JSONObject obj = array.getJSONObject(i);
                    String sensorhour_ymdh = obj.getString("ymdh");
                    String sensorhour_avg = obj.getString("avg");
                    String sensorhour_cnt = obj.getString("cnt");


                    SensorHourListItem item = new SensorHourListItem();
                    item.setSensorhour_ymdh(sensorhour_ymdh);
                    item.setSnesorhour_avg(sensorhour_avg);
                    item.setSensorhour_cnt(sensorhour_cnt);

                    sensorhour_adapter.addItem(item);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            sensorhourlist.setAdapter(sensorhour_adapter);
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