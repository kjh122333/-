package net.idsan.idoitnong;

import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import net.idsan.idoitnong.market.MarketListAdapter;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
import org.xml.sax.InputSource;

import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;


public class MarketActivity extends AppCompatActivity {
    String[] productList = {"폼목을 선택해주세요[필수]","가지","풋고추","부추","호박","오이","피망","딸기","방울토마토","참외","토마토"};
    String[] marketList  = {"시장을 선택해주세요[필수]","강릉도매시장","광주각화도매시장","광주서부도매시장","구리도매시장","구미도매시장","대구북부도매시장","대전노은도매시장","대전오정도매시장",
            "부산반여도매시장","부산엄궁도매시장","서울가락도매시장","서울강서도매시장","수원도매시장","순천도매시장","안동도매시장","안산도매시장","안양도매시장",
            "울산도매시장","원주도매시장","익산도매시장","인천구월도매시장","인천삼산도매시장","전주도매시장","정읍도매시장","진주도매시장","창원내서도매시장",
            "창원팔용도매시장","천안도매시장","청주도매시장","춘천도매시장","충주도매시장"};
    Spinner spnProduct, spnMarket;
    TextView tv_date;
    TextView tv_product;
    TextView tv_product_kind;
    TextView tv_product_weight;
    TextView tv_standard;
    TextView tv_product_gard;
    TextView tv_price;
    ListView list_Result;
    MarketListAdapter adapter;
    private ProgressDialog pdStatus;

    Button btnStart;

    String productNumber, marketNumber;

    ImageView marketback;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_market);

        this.setTitle("실시간 경락가");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        //리스트 뷰 어택터 생성
        adapter = new MarketListAdapter();
        list_Result = (ListView) findViewById(R.id.list_view);
        list_Result.setAdapter(adapter);
        //결과가 없을때
        list_Result.setEmptyView(findViewById(R.id.emptyElement));

        spnProduct = findViewById(R.id.spnProduct);
        spnMarket  = findViewById(R.id.spnMarket);

        tv_date = findViewById(R.id.tv_date);
        tv_product=findViewById(R.id.tv_product);
        tv_product_kind = findViewById(R.id.tv_product_kind);
        tv_product_weight = findViewById(R.id.tv_product_weight); // 텍스트뷰의 아이디값을 가져옴
        tv_standard =findViewById(R.id.tv_standard);
        tv_product_gard = findViewById(R.id.tv_product_grad);
        tv_price = findViewById(R.id.tv_price);


        btnStart   = findViewById(R.id.btnStart);

        ArrayAdapter<String> spnProductAdapter = new ArrayAdapter<String>(this, R.layout.spinner_item, productList); //(파라미터)android.R은안드로이드에서제공하는리소스를쓰겠다.
        ArrayAdapter<String> spnMarketAdapter  = new ArrayAdapter<String>(this, R.layout.spinner_item, marketList);

        spnProduct.setAdapter(spnProductAdapter);
        spnMarket.setAdapter(spnMarketAdapter);

        spnProduct.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                switch (spnProduct.getSelectedItem().toString()) {
                    case "가지":
                        productNumber = "0903";
                        break;
                    case "풋고추":
                        productNumber = "1205";
                        break;
                    case "부추":
                        productNumber = "1010";
                        break;
                    case ("호박"):
                        productNumber = "0902";
                        break;
                    case ("오이"):
                        productNumber = "0901";
                        break;
                    case ("피망"):
                        productNumber = "1302";
                        break;
                    case ("딸기"):
                        productNumber = "0804";
                        break;
                    case ("방울토마토"):
                        productNumber = "0806";
                        break;
                    case ("참외"):
                        productNumber = "0802";
                        break;
                    case ("토마토"):
                        productNumber = "0803";
                        break;
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) { }
        });


        spnMarket.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                switch (spnMarket.getSelectedItem().toString()) {
                    case "강릉도매시장":
                        marketNumber = "380303";
                        break;
                    case "광주각화도매시장":
                        marketNumber = "240001";
                        break;
                    case "광주서부도매시장":
                        marketNumber = "240004";
                        break;
                    case "구리도매시장":
                        marketNumber = "311201";
                        break;
                    case "구미도매시장":
                        marketNumber = "371501";
                        break;
                    case "대구북부도매시장":
                        marketNumber = "220001";
                        break;
                    case "대전노은도매시장":
                        marketNumber = "250003";
                        break;
                    case "대전오정도매시장":
                        marketNumber = "250001";
                        break;
                    case "부산반여도매시장":
                        marketNumber = "210009";
                        break;
                    case "부산엄궁도매시장":
                        marketNumber = "210001";
                        break;
                    case "서울가락도매시장":
                        marketNumber = "110001";
                        break;
                    case "서울강서도매시장":
                        marketNumber = "110008";
                        break;
                    case "수원도매시장":
                        marketNumber = "310101";
                        break;
                    case "순천도매시장":
                        marketNumber = "360301";
                        break;
                    case "안동도매시장":
                        marketNumber = "380303";
                        break;
                    case "안산도매시장":
                        marketNumber = "310901";
                        break;
                    case "안양도매시장":
                        marketNumber = "310401";
                        break;
                    case "울산도매시장":
                        marketNumber = "380201";
                        break;
                    case "원주도매시장":
                        marketNumber = "320201";
                        break;
                    case "익산도매시장":
                        marketNumber = "350301";
                        break;

                    case "인천구월도매시장":
                        marketNumber = "230001";
                        break;
                    case "인천삼산도매시장":
                        marketNumber = "230003";
                        break;
                    case "전주도매시장":
                        marketNumber = "350101";
                        break;
                    case "정읍도매시장":
                        marketNumber = "350402";
                        break;
                    case "진주도매시장":
                        marketNumber = "380401";
                        break;
                    case "창원내서도매시장":
                        marketNumber = "380303";
                        break;
                    case "창원팔용도매시장":
                        marketNumber = "380101";
                        break;
                    case "천안도매시장":
                        marketNumber = "340101";
                        break;
                    case "청주도매시장":
                        marketNumber = "330101";
                        break;
                    case "춘천도매시장":
                        marketNumber = "320101";
                        break;
                    case "충주도매시장":
                        marketNumber = "330201";
                        break;

                }


            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) { }
        });

        btnStart.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new GetXMLTask().execute();

                pdStatus = new ProgressDialog(MarketActivity.this);
                pdStatus.setMessage("잠시만 기다려주세요.");
                pdStatus.setCancelable(false); //화면 터치해도 다이얼로그 안꺼지게
                pdStatus.setIndeterminate(true); //계속 뺑뺑이돌리기
                pdStatus.show(); //보이기
            }


        });

    }

    ///////////////////////////파싱하는 부분 /////////////////////////////////////////////////////
    private class GetXMLTask extends AsyncTask<String, Void, Document> {
        @Override
        protected Document doInBackground(String... urls) {
            //Progress Dialog

            String today = new SimpleDateFormat("yyyyMMdd", Locale.KOREA).format(new Date());
            Document doc = null;

            try {
                //이게 진짜
                URL url = new URL("http://211.237.50.150:7080/openapi/5dfed8106b4ebcba5fb576137dcf4f39881ede8f74fb33d278ce5a5e8907b42c/xml/Grid_20180118000000000580_1/1/100?DELNG_DE=" + today + "&PBLMNG_WHSAL_MRKT_CD=" + marketNumber + "&PRDLST_CD=" + productNumber);

                DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
                DocumentBuilder db = dbf.newDocumentBuilder();
                doc = db.parse(new InputSource(url.openStream()));
                doc.getDocumentElement().normalize();
            } catch (Exception e) {
                Toast.makeText(getBaseContext(), "Parsing Error", Toast.LENGTH_SHORT).show();
            }

            return doc;
        }

        @Override
        protected void onPostExecute(Document doc) {
            StringBuffer tv_date_result = new StringBuffer();
            StringBuffer tv_product_result = new StringBuffer();
            StringBuffer tv_product_kind_result = new StringBuffer();
            StringBuffer tv_product_weight_result = new StringBuffer();
            StringBuffer tv_standard_result = new StringBuffer();
            StringBuffer tv_prorduct_gard_result = new StringBuffer();
            StringBuffer tv_price_result = new StringBuffer();

            NodeList nodeList = doc.getElementsByTagName("row");

            adapter.clearList();//초기화 코드 adapter클래스에서 함수 만들어서 사용

            for(int i = 0; i< nodeList.getLength(); i++){
                Node node = nodeList.item(i);
                Element fstElmnt = (Element)node;


                String date = fstElmnt.getElementsByTagName("DELNG_DE").item(0).getChildNodes().item(0).getNodeValue();//날짜
                String product_name = fstElmnt.getElementsByTagName("PRDLST_NM").item(0).getChildNodes().item(0).getNodeValue();//품목명
                String product_didale= fstElmnt.getElementsByTagName("SPCIES_NM").item(0).getChildNodes().item(0).getNodeValue();//품종
                String product_grad= fstElmnt.getElementsByTagName("GRAD").item(0).getChildNodes().item(0).getNodeValue();//등급
                String product_weight  = fstElmnt.getElementsByTagName("DELNGBUNDLE_QY").item(0).getChildNodes().item(0).getNodeValue();//거래단량
                String standard  = fstElmnt.getElementsByTagName("STNDRD").item(0).getChildNodes().item(0).getNodeValue();//규격
                String price   = fstElmnt.getElementsByTagName("PRICE").item(0).getChildNodes().item(0).getNodeValue();//경락가

                tv_date_result.append(date);
                tv_product_result.append(product_name);
                tv_product_kind_result.append(product_didale);
                tv_product_weight_result.append(product_weight);
                tv_standard_result.append(standard);
                tv_prorduct_gard_result.append(product_grad);
                tv_price_result.append(price);

                //어탬터 아이템추가 하는곳//
                adapter.addItem(date,product_name,product_didale,product_weight,standard,product_grad,price);
            }

            //중요 온크리레이트 다음에 쓰기 위해서 아래 같은 것을 쓴다//중요
            adapter.notifyDataSetChanged();


            //
            pdStatus.dismiss(); //끄기
            super.onPostExecute(doc);
//
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