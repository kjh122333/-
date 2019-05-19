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
 * 시간당 센서리스트에서 커스텀리스트 뷰 항목을 선택하면
 * 해당 항목을 분단위로 나누어서 시간당 센서리스트와 같은 방식으로 분당 평균과 데이터 수를 DB에서 가져와 Adapter에 붙인다.
 */

public class SensorMinuteListAdapter extends BaseAdapter {

    private ArrayList<SensorMinuteListItem> sensorminuteitem_list = new ArrayList<>();

    public void addItem(SensorMinuteListItem sensorminutelist_item) {
        sensorminuteitem_list.add(sensorminutelist_item);
    }

    @Override
    public int getCount() {
        return sensorminuteitem_list.size();
    }

    @Override
    public Object getItem(int position) {
        return sensorminuteitem_list.get(position);
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
            convertView = inflater.inflate(R.layout.sensorminutelist_item, parent, false);
        }

        TextView sensorminute_ymdhm = convertView.findViewById(R.id.sensorminute_ymdhm);
        TextView sensorminute_avg = convertView.findViewById(R.id.sensorminute_avg);
        TextView sensorminute_cnt = convertView.findViewById(R.id.sensorminute_cnt);

        SensorMinuteListItem sensorminutelist_item = sensorminuteitem_list.get(position);
        sensorminute_ymdhm.setText(sensorminutelist_item.getSensorminute_ymdhm());
        sensorminute_avg.setText(sensorminutelist_item.getSensorminute_avg());
        sensorminute_cnt.setText(sensorminutelist_item.getSensorminute_cnt());

        return convertView;
    }
}
