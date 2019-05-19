<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    $place = rand(1,5);

    echo "place : ".$place."\n";



    if($place==1) {
      echo "금상";
    }
    else if($place==2) {
      echo "은상";
    }
    else if($place==3) {
      echo "동상";
    }
    else {
      echo $place."위";
    }

     ?>

  </body>
</html>
