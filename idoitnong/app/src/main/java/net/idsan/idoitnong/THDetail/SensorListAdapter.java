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
 * Created by gy2 on 2018-08-22.
 */

public class SensorListAdapter extends BaseAdapter {

    private ArrayList<SensorListItem> sensoritemlist = new ArrayList<SensorListItem>();

    public void addItem(SensorListItem sensorlistitem) {
        sensoritemlist.add(sensorlistitem);
    }


    @Override
    public int getCount() {
        return sensoritemlist.size();
    }

    @Override
    public Object getItem(int position) {
        return sensoritemlist.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final int post = position;
        final Context context = parent.getContext();

        // sensorlist_item.xml   Layout 파일을 inflate하여 convertView 참조 획득.
        if(convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.sensorlist_item, parent, false);
        }

        // 화면에 표시될 View(Layout이 inflate된) 위젯으로부터 위젯에 대한 참조 획득
        TextView sensor_type = (TextView) convertView.findViewById(R.id.sensor_type);

        // Data Set에서 position에 위치한 데이터 참조 획득
        SensorListItem sensorlistitem = sensoritemlist.get(position);

        // 아이템 내 각 위젯에 데이터 반영
        sensor_type.setText(sensorlistitem.getSensor_type());

        return convertView;
    }
}
