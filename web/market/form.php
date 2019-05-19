<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    loadData('marketname', $('[name="marketname"]'))
  });

  function changeEventHandler(event) {
    let t = event.target;

    switch(t.name) {

    case "marketname":
      loadData('detail_name', $('[name="detail_name"]'))
      break;
    case "detail_name":
      loadData('grade', $('[name="grade"]'))
      break;
    case "grade":
      loadData('m_standard', $('[name="m_standard"]'))
      break;
    default:
      //alert("잘못 된 접근 입니다.");
    }
  }

  function loadData(command, target) {
    $('[name="command"]').val(command);

    $.ajax({
      url:'./market_list.php',
      dataType:'json',
      type:'post',
      data:$('form').serialize(),
      success:function(response){
        let txt = "";

        if(response['ok']) {
          for(x in response.data) {
            txt += "<option>" + response.data[x].res
          }
          $(target).html(txt);
        } else {
        }
      }
    });
  }
</script>
</head>
<body>
<form>
시장
<br>
<select name="marketname" onChange='changeEventHandler(event)'><option>시장</option><option>시장</option></select>
<br>
품목
<br>
<select name="detail_name" onChange='changeEventHandler(event)'><option>품목</option><option>품목</option></select>
<br>
등급
<br>
<select name="grade" onChange='changeEventHandler(event)'><option>등급</option><option>등급</option></select>
<br>
무게
<br>
<select name="m_standard" onChange='changeEventHandler(event)'><option>무게</option><option>무게</option></select>
<br>
<input type="hidden" name="command">
</form>
</body>
</html>
