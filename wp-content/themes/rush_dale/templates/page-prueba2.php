<?php
/**
 * Template Name: Prueba2
 *
 * @package WordPress
*/


//convertimos el json a array
$aEntradas= json_encode($jEntradas);


$jEntradas= update_post_meta(219, '_billing_participantes', true);




?>