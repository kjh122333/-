<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <form>
      <select name="marketname" onchange="sel(marketname);"  >
        <option value="volvo">지역 선택</option>
      </select>

      <select name="detaile_name">
        <option value="volvo">품종 선택</option>
      </select>

      <select name="grade">
        <option value="volvo">등급 선택</option>
      </select>
    </form>
  </body>
  <script>
    $('#join').click(function() {
      $.ajax({
          url:'/idoitnong/join',
          dataType:'json',
          type:'post',
          data:$('form').serialize(),
          success:function(data){
            if(!data['ok']) {
              alert('회원가입에 실패 하였습니다.' + data['msg']);
            } else {
              alert("회원가입에 성공 하였습니다.");
              location.href = './login.php';
            }
          }
      })
    });
    $( document ).ready(function() {
      $.ajax({
        url:'/seungKyuFoler/info/market.php',
        dataType:'json',
        type:'post',
        data: {
          'command': 'getMarketName'
        },
        success:function(data) {
          if(data['ok']) {
            alert('dd');
          }
        }
      })
    });
  </script>
</html>
