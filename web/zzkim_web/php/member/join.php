<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>아두이농 - No.1 시설재배 관리 시스템</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/iconfonts/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/zzkim_web/dist/images/favicon.ico" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- 지역을 고르는 리스트박스에 대한 코드 -->
    <script>
      $(document).ready(function() {
        loadData('area1', $('[name="area1"]'))
      });

      function changeEventHandler(event) {
        let t = event.target;

        switch(t.name) {

        case "area1":
          loadData('area2', $('[name="area2"]'))
          break;
        case "area2":
          loadData('area3', $('[name="area_code"]'))
          break;
        default:
          //alert("잘못 된 접근 입니다.");
        }
      }

      function loadData(command, target) {
        $('[name="command"]').val(command);

        $.ajax({
          url:'../graph/area_list.php',
          dataType:'json',
          type:'post',
          data:$('form').serialize(),
          success:function(response){
            let txt = "<option>선택";

            if(response['ok']) {
              for(x in response.data) {
                if(command != "area3")
                  txt += "<option>" + response.data[x].res;
                else
                  txt += "<option value='" + response.data[x].area_code + "'>" + response.data[x].res;
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
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">가입하기</h2>
            <div class="auto-form-wrapper">
              <form role="form" name="joinform" method="POST">
                <div class="form-group">
                  <label class="label">아이디</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="아이디를 입력해주세요" name="username">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">비밀번호</label>
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="비밀번호를 입력해주세요" name="password">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">이름</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="이름을 입력해주세요" name="real_name">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">농장이름</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="농장이름을 입력해주세요" name="farm_name">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">지역</label>
                    <div class="row">
                      <div class="col">
                        <select class="form-control" name="area1" onchange='changeEventHandler(event)'>
                          <option>광역시·도</option>
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control" name="area2" onchange='changeEventHandler(event)'>
                          <option>시·군</option>
                        </select>
                      </div>
                      <div class="col">
                        <select class="form-control" name="area_code" onchange='changeEventHandler(event)'>
                          <option>동·면·읍·리</option>
                        </select>
                      </div>
                      <input type="hidden" name="command">
                    </div>
                </div>
                <div class="form-group">
                  <label class="label">전화번호</label>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="전화번호를 입력해주세요" name="phone_number">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> 위 조건에 동의합니다.
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="button" id="join" class="btn btn-primary submit-btn btn-block">회원가입</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">이미 아이디가 있다면 ?</span>
                  <a href="./login.php" class="text-black text-small">로그인</a>
                </div>
                <div class="text-block text-center my-3">
                  <a href="../home.php" class="text-black text-small">메인으로</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/misc.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

<!-- 회원가입 처리하는 자바스크립트 -->
<script>
  $('#join').click(function() {
    $.ajax({
        url:'/idoitnong/join',
        dataType:'json',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
          if(!data['ok']) {
            alert(data['msg']);
          } else {
            alert("회원가입에 성공 하였습니다.");
            location.href = './login.php';
          }
        }
    })
  })
</script>

</html>
