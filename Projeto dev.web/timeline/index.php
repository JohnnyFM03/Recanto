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
            header("Location: index.php");
        }else{
            echo "<div style='text-align:center;font-size:15px;background-color:grey;'>";
            echo "<br>Os seguintes erros aconteceram:<br><br>";
            echo $result;
            echo "</div>";
        }

    }

    $post = new Post();
    $id = $_SESSION['recanto_userid'];
    $posts = $post->get_posts_outros($id);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <link rel="stylesheet" href="timeline.css">
</head>
<body>

<?php
    
    include("../Comum/header.php")

    ?>

    <div class="conteudo">

        <div class="menu_box">
            <div class="nome_foto">
            <?php

                $image= "../Comum/img/placeholder.jpg";

                if(file_exists($usuario_data['profile_img'])){

                    $image = $usuario_data['profile_img'];
                }

            ?>
                <img src="<?php echo $image?>" class="foto_perfil">
                <br>
                <a href="../perfil/perfil.php" style="text-decoration:none;" ><?php echo $usuario_data['usuario']?></a>
            </div>
            <div class="menus">
                <a></a>
            </div>
        </div>

        <div class="post_box">

            <form method="post">

                <div class="postar">
                    <textarea style="resize:none" name="post" class="fazer_post" placeholder="Escreva o que pensa aqui..."></textarea>
                    <input type="submit" class="post_btn" value="Postar">
                </div>

            </form>

            <div class="post_bar">

                <div class="post">

                    <?php
                    if(!empty($posts)){
                        foreach($posts as $row){

                            $post_owner = $row['userid'];
                            $query = "select * from usuarios where userid = '$post_owner'"; 
                            $DB = new Database();
                            $post_owner_data = $DB->read($query);
                            include("../Comum/post_outros.php");

                            
                        }
                    }  
                     
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>