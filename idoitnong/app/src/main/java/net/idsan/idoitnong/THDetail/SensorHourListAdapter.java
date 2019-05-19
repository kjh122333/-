package net.idsan.idoitnong.THDetail;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import net.idsan.idoitnong.R;

import java.util.ArrayList;

/**
 * Created by gy2 on 2018-08-23.
 * 센서리스트에서 선택한 센서에 대한 최근 24시간동안의 데이터를 한시간 단위로 나누고, 각각의 평균과 데이터 개수를 DB에서 가져와 Adapter에 붙인다.
 */

public class SensorHourListAdapter extends BaseAdapter {

    private ArrayList<SensorHourListItem> sensorhouritem_list = new ArrayList<>();

    public void addItem(SensorHourListItem sensorhourlist_item) {
        sensorhouritem_list.add(sensorhourlist_item);
    }

    @Override
    public int getCount() {
        return sensorhouritem_list.size();
    }

    @Override
    public Object getItem(int position) {
        return sensorhouritem_list.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        final Context context = parent.getContext();

        if(convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.sensorhourlist_item, parent, false);
        }

        TextView sensorhour_ymdh = (TextView) convertView.findViewById(R.id.sensorhour_ymdh);
        TextView sensorhour_avg = (TextView) convertView.findViewById(R.id.sensorhour_avg);
        TextView sensorhour_cnt = (TextView) convertView.findViewById(R.id.sensorhour_cnt);

        SensorHourListItem sensorhourlist_item = sensorhouritem_list.get(position);
        sensorhour_ymdh.setText(sensorhourlist_item.getSensorhour_ymdh());
        sensorhour_avg.setText(sensorhourlist_item.getSnesorhour_avg());
        sensorhour_cnt.setText(sensorhourlist_item.getSensorhour_cnt());

        return convertView;
    }
}
