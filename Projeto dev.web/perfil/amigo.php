<?php

$image= "../Comum/img/placeholder.jpg";

    if(file_exists($amg_row['profile_img'])){

        $image = $amg_row['profile_img'];
    }



?>

<div class="amigos">
    <img src="<?php echo $image;?>" class="foto_amigos">
    <br><?php echo $amg_row['usuario']?>
</div>