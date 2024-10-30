<?php

session_start();

include("../classes/connect.php");
include("../classes/login_s.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $login = new Login();
    $result = $login->evaluate($_POST);

    if($result != ""){
        echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
        echo "<br>Os seguintes erros aconteceram:<br><br>";
        echo $result;
        echo "</div>";
    }else{
     header("Location: ../timeline/index.php");
      die;
    }

  }