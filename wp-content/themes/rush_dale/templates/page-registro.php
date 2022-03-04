<?php

/**
 * Template Name: Registro
 *
 * @package WordPress
 */

get_header();

?>
    <main class="main_registro woowContent1250">
        <h1>Detalles de la entrada</h1>
        <?php
            $order_id = $_GET['order_id'];


            global $wpdb;
            $tablename = $wpdb->prefix . "entradas";
            $results   = $wpdb->get_results( 'SELECT * FROM '.$tablename.' WHERE id_order = '.$order_id.' AND email = "'.$_GET['email'].'"' );
            if(empty($results)){
                //traemos los participantes
                $jEntradas= get_post_meta($order_id, '_billing_participantes', true);
                //convertimos el json a array
                $aEntradas= json_decode($jEntradas);
                if(!empty( $aEntradas)){
                    $validate = false;
                    foreach ($aEntradas as $key => $entrada) {
                        if($entrada->email == $_GET['email']){
                            $validate = true;
                        }
                    }
                    //verificamos el email
                    if($validate == true){
                        ?>
                        <div class="content_registro">
                            <div class="item_registro">
                                <p><strong>Nombre: </strong><?=$_GET['nombre']?></p>
                            </div>
                            <div class="item_registro">
                                <p><strong>Email: </strong><?=$_GET['email']?></p>
                            </div>
                            <div class="item_registro">
                                <p><strong>ID Compra: </strong><?=$_GET['order_id']?></p>
                            </div>
                            <div class="item_registro item_registro_button">
                                <button type="button" onClick="registrarEntrada( <?=$_GET['order_id']?>, '<?=$_GET['email']?>', '<?=$_GET['nombre']?>' )">Registrar entrada</button>
                            </div>
                        </div>
                        <?php
                    }else{
                        ?>
                        <div class="content_registro">
                            <h2>Email no regitrado en la orden</h2>
                        </div>
                        <?php
                    }
                }
            }else{
                ?>
                <div class="content_registro">
                    <h2>Orden ya registrada</h2>
                </div>
                <?php
            }  
        ?>
    </main>
<?php
get_footer();
?>