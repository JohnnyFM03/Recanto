<?php



?>
    <div style="display:flex; display-direction:row;" >


        <div class="post_amg_img" >
            <?php
    
                $image= "../Comum/img/placeholder.jpg";

                if(file_exists($post_owner_data['0']['profile_img'])){

                    $image = $post_owner_data['0']['profile_img'];
                }   
   
            ?>

            <img src="<?php echo $image?>" class="img_p" style="height:50px;width:50px;">

        </div>
        <div class="dono_post" style="text-align: center;">

            <?php echo $post_owner_data['0']['usuario'] ?>

        </div>

    </div>


    <div class="post_amg">
    
        <div style="padding-left: 50px;padding-top:10px;max-width:532px;">    
            <?php echo $row['post'] ?>
            <br><br>
        </div>
        
        <div class="interacao_btn">

            <a id="curtir_btn">Curtir</a>  <a id="comentar_btn">Comentar</a>  <span class="dia"><?php echo $row['data']?></span>

        </div>

    </div>