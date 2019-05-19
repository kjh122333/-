package net.idsan.idoitnong.market;

/**
 * Created by BIT on 2018-08-21.
 */

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import net.idsan.idoitnong.R;

import java.util.ArrayList;

/**
 * Created by BIT on 2018-08-17.
 */

public class MarketListAdapter extends BaseAdapter {
    // Adapter에 추가된 데이터를 저장하기 위한 ArrayList
    private ArrayList<MarketListItem> listViewItemMarketList = new ArrayList<MarketListItem>() ;

    // ListViewAdapter의 생성자
    public MarketListAdapter() {

    }

    // Adapter에 사용되는 데이터의 개수를 리턴. : 필수 구현
    @Override
    public int getCount() {
        return listViewItemMarketList.size() ;
    }

    // position에 위치한 데이터를 화면에 출력하는데 사용될 View를 리턴. : 필수 구현
    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        final int pos = position;
        final Context context = parent.getContext();

        // "listview_item" Layout을 inflate하여 convertView 참조 획득.
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.market_list_item, parent, false);
        }

        // 화면에 표시될 View(Layout이 inflate된)으로부터 위젯에 대한 참조 획득
        TextView dateTextView = (TextView) convertView.findViewById(R.id.tv_date);
        TextView productTextView = (TextView) convertView.findViewById(R.id.tv_product);
        TextView product_kindTextView = (TextView) convertView.findViewById(R.id.tv_product_kind);
        TextView product_weightTextView = (TextView) convertView.findViewById(R.id.tv_product_weight);
        TextView standardTextView = (TextView) convertView.findViewById(R.id.tv_standard);
        TextView product_grad_TextView = (TextView) convertView.findViewById(R.id.tv_product_grad);
        TextView priceTextView = (TextView) convertView.findViewById(R.id.tv_price);

        // Data Set(listViewItemMarketList)에서 position에 위치한 데이터 참조 획득
        MarketListItem marketListItem = listViewItemMarketList.get(position);

        // 아이템 내 각 위젯에 데이터 반영
        dateTextView.setText(marketListItem.getdate());
        productTextView.setText(marketListItem.getproduct());
        product_kindTextView.setText(marketListItem.getproduct_kind());
        priceTextView.setText(marketListItem.getproduct_weight());
        product_weightTextView.setText(marketListItem.getproduct_weight());
        standardTextView.setText(marketListItem.getstandard());
        product_grad_TextView.setText(marketListItem.getProduct_grad());
        priceTextView.setText(marketListItem.getprice());

        return convertView;
    }

    // 지정한 위치(position)에 있는 데이터와 관계된 아이템(row)의 ID를 리턴. : 필수 구현
    @Override
    public long getItemId(int position) {
        return position ;
    }

    // 지정한 위치(position)에 있는 데이터 리턴 : 필수 구현
    @Override
    public Object getItem(int position) {
        return listViewItemMarketList.get(position) ;
    }

    // 아이템 데이터 추가를 위한 함수. 개발자가 원하는대로 작성 가능.
    public void addItem(String date, String product, String product_kind, String product_weight, String standard, String product_grad, String price) {
        MarketListItem item = new MarketListItem();

        item.setdate(date);
        item.setproduct(product);
        item.setproduct_kind(product_kind);
        item.setproduct_weight(product_weight);
        item.setstandard(standard);
        item.setproduct_gard(product_grad);
        item.setprice(price);

        listViewItemMarketList.add(item);
    }
    public void clearList(){
        listViewItemMarketList.clear();
    }
}
