<?php

/**
 * Template Name: Prueba
 *
 * @package WordPress
 */
/*
//$email    = $_GET['email'];
$order_id = $_GET['order_id'];
//traemos la clase
$mailZoco = new ZocoMail;
//traemos los participantes
$jEntradas= get_post_meta($order_id, '_billing_participantes', true);
//convertimos el json a array
$aEntradas= json_decode($jEntradas);
//definimos el encabezado
$msnSubject = 'Pase Directo Rush!';
$subject    = utf8_decode( $msnSubject );
$headers    = $mailZoco->HeaderMail();

//Construmins los mensajes que se envian
foreach ($aEntradas as $key => $entrada) {
    //definimos la ruta con los parametros de las entras
    $url  = urlencode(home_url('registro?order_id='.$order_id.'&email='.$entrada->email.'&nombre='.$entrada->name));
    // Generate body email
    $body = $mailZoco->HtmlMail( 
        // Fields to SEARCH
        array(
                '{EMAILURL}'
            ,	'{THEMEURL}'
        )
        // Fields to REPLACE into search
    ,	array(
                EMAILURL
            ,	$url
        )
        // Template HTML
    ,	'qr.html' 
    );
    $sent = wp_mail( $entrada->email, $subject, $body, $headers );
    echo '<pre>';
    var_dump($sent);
    echo '</pre>';
}
*/
//traemos la clase
$mailZoco = new ZocoMail;

//definimos el encabezado
$msnSubject = 'Pase Directo Rush!';
$subject    = utf8_decode( $msnSubject );
$headers    = $mailZoco->HeaderMail();

    //definimos la ruta con los parametros de las entras
    $url  = urlencode(home_url('registro?order_id='));
    // Generate body email
    $body = $mailZoco->HtmlMail( 
        // Fields to SEARCH
        array(
                '{EMAILURL}'
            ,	'{THEMEURL}'
        )
        // Fields to REPLACE into search
    ,	array(
                EMAILURL
            ,	$url
        )
        // Template HTML
    ,	'qr.html' 
    );
    $sent = wp_mail( 'andy@botslovers.com', $subject, $body, $headers );
    echo '<pre>';
    var_dump($sent);
    echo '</pre>';


?>