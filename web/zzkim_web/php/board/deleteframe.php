<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="utf-8">


  <!-- 파비콘 -->
  <link rel="shortcut icon" href="/zzkim_web/dist/images/favicon.ico">


  <!-- Title -->
  <title>아두이농 - No1. 시설재배 관리 시스템</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans%3A400%2C300%2C500%2C600%2C700%7CPlayfair+Display%7CRoboto%7CRaleway%7CSpectral%7CRubik">
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="../../assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/vendor/bootstrap/offcanvas.css">
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="../../assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../assets/vendor/icon-line/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../assets/vendor/icon-etlinefont/style.css">
  <link rel="stylesheet" href="../../assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="../../assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="../../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
  <link rel="stylesheet" href="../../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
  <link rel="stylesheet" href="../../assets/vendor/animate.css">
  <link rel="stylesheet" href="../../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../../assets/vendor/hamburgers/hamburgers.min.css">
  <link rel="stylesheet" href="../../assets/vendor/bootstrap/offcanvas.css">
  <link rel="stylesheet" href="../../assets/vendor/jquery-ui/themes/base/jquery-ui.min.css">

  <!-- Show / Copy Code -->
  <link rel="stylesheet" href="../../assets/vendor/malihu-scrollbar/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="../../assets/vendor/prism/themes/prism.css">
  <link rel="stylesheet" href="../../assets/vendor/custombox/custombox.min.css">


  <!-- CSS Unify -->
  <link rel="stylesheet" href="../../assets/css/unify-core.css">
  <link rel="stylesheet" href="../../assets/css/unify-components.css">
  <link rel="stylesheet" href="../../assets/css/unify-globals.css">

  <!-- Star Rating -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="../../assets/css/custom.css">



  <!-- hit 표시 애니메이션에 관한 효과를 정의한 부분 -->
  <style>
        #container {
          width: 70%;
          margin: 0 auto;     /* 가로로 중앙에 배치 */
          padding-top: 10%;   /* 테두리와 내용 사이의 패딩 여백 */
        }

        #list {
          text-align: center;
        }

        #write {
          text-align: right;
        }

        /* Bootstrap 수정 */
        .table > thead {
          background-color: #b3c6ff;
        }
        .table > thead > tr > th {
          text-align: center;
        }
        .table-hover > tbody > tr:hover {
          background-color: #e6ecff;
        }
        .table > tbody > tr > td {
          text-align: center;
        }
        .table > tbody > tr > #title {
          text-align: left;
        }

        div > #paging {
          text-align: center;
        }

        .hit {
          animation-name: blink;
          animation-duration: 1.5s;
          animation-timing-function: ease;
          animation-iteration-count: infinite;
          /* 위 속성들을 한 줄로 표기하기 */
          /* -webkit-animation: blink 1.5s ease infinite; */
        }

        /* 애니메이션 지점 설정하기 */
        /* 익스플로러 10 이상, 최신 모던 브라우저에서 지원 */
        @keyframes blink {
          from {color: white;}
          30% {color: yellow;}
          to {color: red; font-weight: bold;}
          /* 0% {color:white;}
          30% {color: yellow;}
          100% {color:red; font-weight: bold;} */
        }
  </style>


</head>


<body>
  <center>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <th width="10%">번호</th>
          <th width="50%">제목</th>
          <th width="10%">작성자</th>
        </thead>

          <tbody>


            <?php

              // 한 화면에 보일 페이지 수
              $page_num = 5;

              // start를 GET방식으로 넘겨받아야 페이지가 바뀔 때 링크뒤에 start가 바뀐다.
              $start = $_GET['start'];


              // 맨 처음 접속할 경우(시작페이지일 경우) --> 처음부터 출력하게 하기 위한 값
              if(!$start) {
                $start = 0; // $start가 없으면 $start를 0으로 초기화 한다.
              }

              require_once($_SERVER['DOCUMENT_ROOT'].'/res/dbcon.php'); // db에 접근


              // 삭제글 테이블의 전체 로우 갯수
              $query_board_delete = "select count(*) as t from board_delete";
              $result_board_delete = mysql_query($query_board_delete);
              $tmp_board_delete = mysql_fetch_array($result_board_delete);
              $total_board_delete = $tmp_board_delete[t];

              // 게시글을 번호순,역순으로 조회한다. 그리고 위에서부터 10개를 짤라서 출력한다.
              $query2_board_delete = "SELECT * from board_delete ORDER BY bnumber DESC limit $start, $page_num";
              $result2_board_delete = mysql_query($query2_board_delete);

              while($data_board_delete = mysql_fetch_array($result2_board_delete)) {
            ?>

          <tr>
            <td><?=$data_board_delete[bnumber]?></td>
            <td id="title">
                &nbsp;&nbsp;
              <a href="./deletedetail.php?bnumber=<?=$data_board_delete[bnumber]?>"><font color="black"><?=$data_board_delete[title]?></font></a>


          <!-- 조회수가 10 이상이면 hit표시를 하게 작성하자. -->
          <?php
            if($data_board_delete[views] >= 10) { ?>
              <span class="hit">hit!</span>

          <?php
            }
          ?>
            </td>
            <td><?=$data_board_delete[writer]?></td>
          </tr>

          <?php } ?>

        </tbody>
      </table>

      <?php

        //
        $assa = $_GET['start'];
        $prev = $assa - $page_num;
        $after = (($assa/$page_num)+1) * $page_num;

        if($prev < 0) {
          $prev = 0;
        }

        if($after > $total_board_delete) {
          $after = $after - $page_num;
        }

      ?>


      <a href='./deleteframe.php?start=0'><font color="black">◀◀</font></a> &nbsp;
      <a href=./deleteframe.php?start=<?=$prev?>><font color="black">[이전]</font></a> &nbsp; <?php

      $case = $total_board_delete % $page_num;
      $pages = (int)($total_board_delete / $page_num);
      $last = $pages * $page_num;

      if($case!=0) {

      for($i=1; $i<=$pages+1; $i++) {
        $assa = $page_num * ($i-1); ?>
        <a href=./deleteframe.php?start=<?=$assa?>><font color="black">[<?=$i?>]</font></a> &nbsp;
      <?php
        }
      } else {

        for($i=1; $i<=$pages; $i++) {
          $assa = $page_num * ($i-1); ?>
          <a href=./deleteframe.php?start=<?=$assa?>><font color="black">[<?=$i?>]</font></a> &nbsp;
        <?php
        }
      } ?>


      <a href=./deleteframe.php?start=<?=$after?>><font color="black">[다음]</font></a> &nbsp;
      <a href=./deleteframe.php?start=<?=$last?>><font color="black">▶▶</font></a>


  </center>

</body>

</html>
