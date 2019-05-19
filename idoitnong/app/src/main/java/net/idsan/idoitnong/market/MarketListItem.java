package net.idsan.idoitnong.market;

/**
 * Created by BIT on 2018-08-21.
 * 커스텀 리스트뷰 부분이용
 */

public class MarketListItem {

    private String dateStr ;
    private String productStr ;
    private String product_kindStr ;
    private String product_weightStr ;
    private String standardStr ;
    private String product_gradStr;
    private String priceStr ;

    public void setdate(String date) {
        dateStr = date ;
    }
    public void setproduct(String product) {
        productStr = product ;
    }
    public void setproduct_kind(String product_kind) {product_kindStr = product_kind ;}
    public void setproduct_weight(String product_weight) {product_weightStr = product_weight ;}
    public void setstandard(String standard) {standardStr = standard ;}
    public void setproduct_gard(String product_gard){product_gradStr = product_gard;}
    public void setprice(String price) {
        priceStr = price;
    }


    public String getdate() {
        return this.dateStr;
    }
    public String getproduct() {
        return this.productStr;
    }
    public String getproduct_kind() {
        return this.product_kindStr;
    }
    public String getproduct_weight() {
        return this.product_weightStr;
    }
    public String getstandard() {return this.standardStr;}
    public String getProduct_grad() {
        return this.product_gradStr;
    }
    public String getprice() {
        return this.priceStr;
    }

}