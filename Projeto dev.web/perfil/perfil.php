<?php

    session_start();

    include("../classes/connect.php");
    include("../classes/login_s.php");
    include("../classes/usuario.php");
    include("../classes/post.php");

    $login = new Login();
    $usuario_data = $login->check_login($_SESSION['recanto_userid']);


    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $post = new Post();
        $id = $_SESSION['recanto_userid'];
        $result = $post->create_post($id, $_POST);

        if($result ==""){
            header("Location: perfil.php");
        }else{
            echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
            echo "<br>Os seguintes erros aconteceram:<br><br>";
            echo $result;
            echo "</div>";
        }

    }

    
    $post = new Post();
    $id = $_SESSION['recanto_userid'];
    $posts = $post->get_posts($id);

    $amigo = new Usuario();
    $id = $_SESSION['recanto_userid'];
    $amigos = $amigo->get_amigos($id);
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>

    <?php
    
    include("../Comum/header.php")

    ?>

    <div class="perfil_capa">

        <div class="f_capa">

            <img src="../Comum/img/mountain.jpg" class="capa">

            <span>
                <?php

                    $image= "../Comum/img/placeholder.jpg";

                    if(file_exists($usuario_data['profile_img'])){

                        $image = $usuario_data['profile_img'];
                    }
                   
                ?>
                <img src="<?php echo $image?>" class="perfil">

                <br>

                <a href="muda_foto.php" style="text-decoration:none;">Alterar perfil</a>

            </span>

            <p class="perfil_nome" ><?php echo $usuario_data['usuario']?></p>

            <ul class="nav_bar">
                <li><a href="../timeline/index.php" style="text-decoration:none;">Timeline</a></li>
                <li><a href="sobre.html" style="text-decoration:none;">Sobre</a></li>
                <li><a href="amigos.html" style="text-decoration:none;">Amigos</a></li>
                <li><a href="config.html" style="text-decoration:none;">Fotos</a></li>
                <li><a href="config.html" style="text-decoration:none;">Configurações</a></li>
            </ul>

        </div>

        <div class="conteudo">

            <div class="amigos_box">

                <p>Amigos</p>

                
                <?php
                            
                    if(!empty($amigos)){
                        foreach($amigos as $amg_row){
                        include("amigo.php");
                        }
                    }
                                 
                ?>

            </div>

            <div class="post_box">

                <form method="post">

                    <div class="postar">
                        <textarea style="resize:none"name="post" class="fazer_post" placeholder="Escreva o que pensa aqui..."></textarea>
                        <input type="submit" class="post_btn" value="Postar">
                    </div>

                </form>

                <div class="post_bar">

                <div class="post">

                    <?php
                            
                        if($posts){
                            foreach($posts as $row){

                                include("../comum/post.php");
                            }
                        }
                             
                    ?>

                </div>

            </div>
        </div>

    </div>

</body>
</html>