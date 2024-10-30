<?php

    session_start();

    include("../classes/connect.php");
    include("../classes/login_s.php");
    include("../classes/usuario.php");
    include("../classes/post.php");

    $login = new Login();
    $usuario_data = $login->check_login($_SESSION['recanto_userid']);

    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){


            if($_FILES['file']['type'] == "image/jpeg"){

                $tamanho = (1024 * 1024) * 10;

                if($_FILES['file']['size'] < $tamanho){


                    $filename = "../uploads/" . $_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    if(file_exists($filename)){

                        $userid = $usuario_data['userid'];

                        $query = "update usuarios set profile_img = '$filename' where userid = '$userid' limit 1";
                        $DB = new Database();
                        $DB->save($query);

                        header(("Location: perfil.php"));
                        die;
                    }

                }else{

                    echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
                    echo "<br>Apenas imagens menores que 10Mb são permitidas.<br><br>";
                    echo "</div>";

                }
                

            }else{

                echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
                echo "<br>Apenas imagens jpeg sao permitidas.<br><br>";
                echo "</div>";

            }

            



        }else{

            echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
            echo "<br>Adicione uma imagem valida<br><br>";
            echo "</div>";

        }


    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor de perfil</title>
    <link rel="stylesheet" href="../timeline/timeline.css">
</head>
<body>

<?php
    
    include("../Comum/header.php")

    ?>

    <div class="conteudo">

        <div class="post_box">

            <form method="post" enctype="multipart/form-data">

                <div class="postar">

                    <input type="file" name="file">
                    <input type="submit" class="post_btn" value="Mudar">

                </div>

            </form>

            
        </div>
    </div>
</body>
</html>