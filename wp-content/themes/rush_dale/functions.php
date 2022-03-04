<?php

/**
 * @Descripcion: function.php
 *
 * Funciones especificas para TORUS Tecnologia
 *
 **/

/*
|---------------------------------------------------------------------------
| Definicio de constantes para el manejo de url absolutas
|---------------------------------------------------------------------------
|
*/
// Constante URL del tema
define('WPURL', get_bloginfo('wpurl'));
define('THEMEURL', get_bloginfo('template_url'));
define('BASEPATH', dirname(__FILE__));


// Constante URL CSS
define('CSSURL', THEMEURL . '/assets/css/');

// Constante URL JS
define('JSURL', THEMEURL . '/assets/js/');

// Constante URL IMG
define('IMGURL', THEMEURL . '/assets/images/');

// Constante version CACHE
define('VCACHE', '5.2.3');

// Constante URL APP
define( 'APPURL', THEMEURL . '/app/' );
define( 'APPPATH', BASEPATH . '/app/' );

// Constante URL APP
define( 'CLASSURL', APPURL . '/class/' );
define( 'CLASSPATH', APPPATH . '/class/' );
// Constante Path Composer
define('HTMLPATH', BASEPATH . '/cacheHtml/');
// Constante URL Email
define( 'EMAILURL', THEMEURL . '/assets/email/' );
define( 'EMAILPATH', BASEPATH . '/assets/email/' );

define('MONTO', 45);
/*
|---------------------------------------------------------------------------
| Llamada a funciones
|---------------------------------------------------------------------------
|
*/

$fileFunctions = array( 'internal-functions.php', 'ajax-functions.php', 'helpers-functions.php' );

foreach( $fileFunctions as $fileName ){
    require_once ( APPPATH . $fileName );
}
/*
|---------------------------------------------------------------------------
| Llamada a Class
|---------------------------------------------------------------------------
|
*/

$fileClass = array( 
    'class-CustomWoo.php',
    'class-ZocoMail.php',
    'class-Cities.php'
);

foreach( $fileClass as $fileName ){
    require_once ( CLASSPATH . $fileName );
}

//Plugin variation
function disable_plugin_updates( $value ) {
    unset( $value->response['woo-variation-swatches/woo-variation-swatches.php'] );
    return $value;
}
add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );


//forzamos el innicio de sesion
add_action( 'woocommerce_init', function(){
	if(!is_user_logged_in()){
		if ( isset(WC()->session) && !WC()->session->has_session()) {
			WC()->session->set_customer_session_cookie( true );
		}
	}
});



 
// Función para cambiar el nombre del remitente. Cambiamos "Admin Admin" por el nombre que deseemos
function wpb_sender_name( $original_email_from ) {
    return 'Rush';
}
 
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );