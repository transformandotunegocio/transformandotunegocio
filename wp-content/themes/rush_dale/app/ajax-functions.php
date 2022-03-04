<?php
/***
 * @Descripcion: ajax-functions.php
 * Contiene las diferentes funciones de ajax
 *
 * Estas funciones ajax son utilizadoas tanto en el front-end como en el back-end
 *
 *
***/



/*
|-------------------------------------------------------------------------------
| Function Encontrar Productos
|-------------------------------------------------------------------------------
*/

function update_mini_cart()
{
	// Create response object Ajax
	echo wc_get_template('cart/mini-cart.php');
	die();
}

add_filter('wp_ajax_miniCart', 'update_mini_cart');
add_filter('wp_ajax_nopriv_miniCart', 'update_mini_cart');


/*
|-------------------------------------------------------------------------------
| Function Encontrar Productos
|-------------------------------------------------------------------------------
*/

function saveRegistro()
{
	// Create response object Ajax
    $objLoad = ( object ) array( 'validate' => true );

	$name  = $_POST['name'];
	$email = $_POST['email'];
	$entrdas = array();
	//recorremos los array
	//entrada 1
	if(count($name) == count($email)){
		for ($i=0; $i < count($name); $i++) { 
			array_push(
				$entrdas,
				array(
					'name'  => $name[$i],
					'email' => $email[$i]
				)
			);
		}
	}else{
		$objLoad->validate = false;
	}
	$objLoad->entradas = json_encode($entrdas);

	echo json_encode( $objLoad );
	die( ); // Siempre hay que terminar con die
}

add_filter('wp_ajax_saveRegistro', 'saveRegistro');
add_filter('wp_ajax_nopriv_saveRegistro', 'saveRegistro');


/*
|-------------------------------------------------------------------------------
| Function Encontrar Productos
|-------------------------------------------------------------------------------
*/

function registrarEntrada()
{
	// Get $wpdb
	global $wpdb;
	// Create response object Ajax
    $objLoad = ( object ) array( 'validate' => true );

	$id     = $_POST['id'];
	$nombre = $_POST['nombre'];
	$email  = $_POST['email'];

	$tablename = $wpdb->prefix . "entradas";
	$wpdb->insert($tablename, array(
			'id_order'	=>	$id
		,	'name'		=>	$nombre
		,	'email'		=>	$email
	),array(
			'%s'
		,	'%s'
		,	'%s'
	));

	echo json_encode( $objLoad );
	die( ); // Siempre hay que terminar con die
}

add_filter('wp_ajax_registrarEntrada', 'registrarEntrada');
add_filter('wp_ajax_nopriv_registrarEntrada', 'registrarEntrada');



