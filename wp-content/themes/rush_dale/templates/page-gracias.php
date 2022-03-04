<?php

/**
 * Template Name: Gracias
 *
 * @package WordPress
 */

get_header();

?>
    <main class="main_gracias">
        <?php
            if(!wp_is_mobile()){
              ?>
              <img src="<?=IMGURL?>gracias_n.png" alt="">
              <?php
            }else{
              ?>
              <img src="<?=IMGURL?>gracias_n_1.png" alt="">
              <img src="<?=IMGURL?>gracias_n_2.png" alt="">
              <?php
            }
        ?>
    </main>
<?php
get_footer();
?>