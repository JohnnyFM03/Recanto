<?php

  include("../classes/connect.php");
  include("../classes/regis.php");

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

      $registrar = new Registrar();
      $result = $registrar->evaluate($_POST);

      if($result != ""){
          echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
          echo "<br>Os seguintes erros aconteceram:<br><br>";
          echo $result;
          echo "</div>";
      }else{
       header("Location: login.html");
       echo "Conta criada com sucesso.";
        die;
      }
      
  $usuario = $_POST['usuario'];
  $email = $_POST['email'];

    }