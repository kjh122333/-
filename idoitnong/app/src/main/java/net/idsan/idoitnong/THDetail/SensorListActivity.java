package net.idsan.idoitnong.THDetail;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.ListView;

import net.idsan.idoitnong.MainActivity;
import net.idsan.idoitnong.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.URL;

//import net.idsan.idoitnong.MainActivity;


public class SensorListActivity extends AppCompatActivity {

    SensorListAdapter sensor_adapter;

    ListView sensorlist;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sensor_list);

        this.setTitle("센서 리스트");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);


        sensorlist = findViewById(R.id.sensorlist);
        sensor_adapter = new SensorListAdapter();


        AsyncTask<String, Void, StringBuffer> bp = new SensorParser().execute("http://anonymous.godohosting.com/idoitnong/view/" + MainActivity.authKey + "/sensorlist/all");
        //sensorlist.setAdapter(sensor_adapter);

        sensorlist.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent = new Intent(SensorListActivity.this, SensorHourListActivity.class);
                intent.putExtra("sensor_type", ((SensorListItem)sensor_adapter.getItem(position)).getSensor_type());
                startActivity(intent);
            }
        });
    }

    public class SensorParser extends AsyncTask<String, Void, StringBuffer> {

        @Override
        protected void onPostExecute(StringBuffer buffer) {
            try {
                JSONArray array = new JSONObject(buffer.toString()).getJSONArray("data");
                for(int i=0; i<array.length(); i++) {
                    JSONObject obj = array.getJSONObject(i);
                    String sensor_type = obj.getString("sensor_type");


                    /*if(sensor_type.substring(0,3).equals("temp")) { // replace를 사용해서 다시 코딩  (넘길 때는 temp01 형태로 다시바꿔서) 안됨...
                        sensor_type = "온도센서" + sensor_type.substring(4,5);
                    } else if(sensor_type.substring(0,3).equals("humi")) {
                        sensor_type = "습도센서" + sensor_type.substring(4,5);
                    } else {
                        sensor_type = "출입문센서" + sensor_type.substring(4,5);
                    }*/


                    SensorListItem item = new SensorListItem();
                    item.setSensor_type(sensor_type);

                    sensor_adapter.addItem(item);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
            sensorlist.setAdapter(sensor_adapter);
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
