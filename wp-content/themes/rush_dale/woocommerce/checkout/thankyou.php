<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
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
