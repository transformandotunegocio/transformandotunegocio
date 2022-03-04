<?php
/***
 * @Descripcion: internal-functions.php
 * Contiene las diferentes funciones internas para el funcionamiento de wordpress
 * Opciones de wordpress por defecto
 *
 *
***/



function action_woocommerce_add_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
{	
	$printScriptEpica = '<script type="text/javascript">
			jQuery(function ($){
				$(document).ready(function(){
					var addtoCart = true;
					ajaxMiniCart(addtoCart);
				})
			});
		</script>';

	add_action('wp_footer', function () use ($printScriptEpica) {
		echo $printScriptEpica;
	}, 20, 1);

	
};

// add the action 
add_action('woocommerce_add_to_cart', 'action_woocommerce_add_to_cart', 10, 6);

/*
|-------------------------------------------------------------------------------
| Function to add default support
|-------------------------------------------------------------------------------
*/

	function WoowSetup(){

		// This theme uses Woocommerce
		add_theme_support( 'woocommerce' );

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images
		add_theme_support( 'post-thumbnails' );

		// This theme uses excerpt in pages
		add_post_type_support( 'page', 'excerpt' );

		// Register top menu
		register_nav_menu( 'Top', 'Top Menu' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();


	}

	add_action( 'after_setup_theme', 'WoowSetup' );

/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Front-end
|-------------------------------------------------------------------------------
*/

function FrontScripts (){
	wp_register_script( 'ajax-woow', JSURL.'ajax-woow.js', array(), '1.0.3', true );
	wp_localize_script( 'ajax-woow', 'MyAjax', array( 'url' => admin_url( 'admin-ajax.php' ), 'urlHome' => home_url(), 'urlJs' => JSURL ) );
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('ajax-woow');
}

add_action( 'wp_enqueue_scripts', 'FrontScripts' );



/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Back-end
|-------------------------------------------------------------------------------
*/

function BackScripts() {

	wp_register_script('js-woow-admin', JSURL . 'jswoow.admin.js', array(), '1.0.2', true);
	wp_localize_script('js-woow-admin', 'MyAjax', array('url' => admin_url('admin-ajax.php'), 'urlHome' => home_url(), 'urlJs' => JSURL));

	wp_enqueue_script('js-woow-admin');
}

add_action('admin_enqueue_scripts', 'BackScripts');




/*
|-------------------------------------------------------------------------------
| Function conseguir precios
|-------------------------------------------------------------------------------
*/
function getPriceProduct($wc_product){

	$tipo_product = $wc_product->get_type();

	$producto_oferta = $wc_product->is_on_sale();

	if ($producto_oferta) {

		if ($tipo_product == 'simple') {
			
			$ventaP 	= $wc_product->get_sale_price();
			$regularP 	= $wc_product->get_regular_price();


		} elseif ($tipo_product == 'variable') {

			$pricesSale = $wc_product->get_variation_prices(true);
			$ventaP = min($pricesSale['sale_price']);
			$keysale = array_search($ventaP, $pricesSale['sale_price']);
			$regularP 	= $pricesSale['regular_price'][$keysale];

			if ($ventaP >= $regularP) {

				reset($pricesSale['sale_price']);

				while (list($clave, $valor) = each($pricesSale['sale_price'])) {

					$regularCheck = $pricesSale['regular_price'][$clave];

					if ($valor < $regularCheck) {
						$regularP = $regularCheck;
						$ventaP = $valor;
						break;
					}
				}
			}
		}

		if(isset($regularP) && isset($ventaP)){
			
			return $aPrice = array(
				'price'			=> $regularP,
				'price_sale'	=> $ventaP
			); 
		}


	} else { //No esta en oferta

		if ($tipo_product == 'simple') {

			return $wc_product->get_regular_price();

		} elseif ($tipo_product == 'variable') {
			
			$prices = $wc_product->get_variation_prices(true);
			return end($prices['price']);
		}
	}
};

/*
|-------------------------------------------------------------------------------
| Function to add custom size Thumbnails
|-------------------------------------------------------------------------------
*/

function CustomThumbnail(){
	// Add size 360x150 (Blog list)
	add_image_size( '400x600', 400, 600, true );

}
add_action( 'after_setup_theme', 'CustomThumbnail' );

function pw_add_image_sizes() {
    add_image_size( '400x600', 400, 600, true );
}
add_action( 'init', 'pw_add_image_sizes' );
 
function pw_show_image_sizes($sizes) {
    $sizes['400x600'] = '400x600';

    return $sizes;
}
add_filter('image_size_names_choose', 'pw_show_image_sizes');


/*
|-------------------------------------------------------------------------------
| Function Ocultar Metodo
|-------------------------------------------------------------------------------
*/

function my_hide_shipping_when_free_is_available($rates)
{

	$free = array();

	foreach ($rates as $rate_id => $rate) {

		if ('free_shipping' === $rate->method_id) {

			$free[$rate_id] = $rate;
			break;
		}
	}
	return !empty($free) ? $free : $rates;
}

add_filter('woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100);


/*
|-------------------------------------------------------------------------------
| Function Modify Home Page
|-------------------------------------------------------------------------------
*/

function colombia_woocommerce_states( $states ) {

    $states['CO'] = array(
    		'AN' => 'Antioquia'
		,	'AT' => 'Atlantico'
		,	'DC' => 'Bogota D.C.'
		,	'BL' => 'Bolivar'
		,	'BY' => 'Boyaca'
		,	'CL' => 'Caldas'
		,	'CQ' => 'Caqueta'
		,	'CA' => 'Cauca'
		,	'CE' => 'Cesar'
		,	'CO' => 'Cordoba'
		,	'CU' => 'Cundinamarca'
		,	'CH' => 'Choco'
		,	'HU' => 'Huila'
		,	'LG' => 'La Guajira'
		,	'MA' => 'Magdalena'
		,	'ME' => 'Meta'
		,	'NA' => 'Nariño'
		,	'NS' => 'Norte de Santander'
		,	'QD' => 'Quindio'
		,	'RI' => 'Risaralda'
		,	'ST' => 'Santander'
		,	'SU' => 'Sucre'
		,	'TO' => 'Tolima'
		,	'VC' => 'Valle'
		,	'AR' => 'Arauca'
		,	'CS' => 'Casanare'
		,	'PU' => 'Putumayo'
		,	'SA' => 'San Andres y Providencia'
		,	'AM' => 'Amazonas'
		,	'GN' => 'Guainia'
		,	'GV' => 'Guaviare'
		,	'VP' => 'Vaupes'
		,	'VD' => 'Vichada'
    );

    return $states;

}

add_filter( 'woocommerce_states', 'colombia_woocommerce_states' );

/*
|-------------------------------------------------------------------------------
| Modificar Label Fields
|-------------------------------------------------------------------------------
*/

function custom_override_default_labels_fields( $fields ) {
	
	$fields['first_name']['label'] = __('Nombre', 'Dale');
	$fields['first_name']['priority'] = 1;
	$fields['last_name']['label'] = __('Apellido', 'Dale');
	$fields['last_name']['priority'] = 2;
	$fields['country']['label']  = __('País', 'Dale');
	$fields['country']['priority'] = 3;
	$fields['state']['label'] = __('Departamento', 'Dale');
	$fields['state']['priority'] = 4;
	$fields['city']['label'] = __('Ciudad', 'Dale');
	$fields['city']['priority'] = 5;
	$fields['address_1']['label'] = __('Dirección', 'Dale');
	$fields['address_1']['priority'] = 6;
	$fields['address_2']['label'] = __('Dirección C.', 'Dale');
	$fields['address_2']['priority'] = 7;

    return $fields;
}

add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_labels_fields' );

/*
|-------------------------------------------------------------------------------
| Modificar Billing Check Out
|-------------------------------------------------------------------------------
*/
function custom_override_checkout_fields($fields)
{

	$classCities = new Cities_Clas();

	//Tipos de documento
	$optiontypes = $classCities->Find_Tipo_Document();

	unset($fields['billing_company']);
	unset($fields['billing_postcode']);

	$fields['billing_first_name']['placeholder'] = __('Nombre', 'Dale');
	$fields['billing_first_name']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_first_name']['clear'] = false;

	$fields['billing_last_name']['placeholder'] = __('Apellido', 'Dale');
	$fields['billing_last_name']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_last_name']['clear'] = false;

	$fields['billing_state']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_state']['required']  = true;

	$fields['billing_city']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_city']['required']  = true;

	$fields['billing_country']['class'] = array('update_totals_on_change', 'pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_country']['required']  = true;

	$fields['billing_address_1']['placeholder'] = 'Carrera 20 # 60 - 50';
	$fields['billing_address_1']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p inputDireccion');
	$fields['billing_address_1']['required']  = true;
	$fields['billing_address_1']['clear'] = false;

	$fields['billing_address_2']['placeholder'] = 'Edificio 1 apto 603';
	$fields['billing_address_2']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_address_2']['required']  = false;
	$fields['billing_address_2']['clear'] = false;

	$fields['billing_tipo_document']['label'] = __('Tipo de Documento', 'Dale');
	$fields['billing_tipo_document']['type'] = 'select';
	$fields['billing_tipo_document']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_tipo_document']['options'] = $optiontypes['html'];
	$fields['billing_tipo_document']['required']  = true;
	$fields['billing_tipo_document']['clear'] = false;
	$fields['billing_tipo_document']['priority'] = 8;

	$fields['billing_no_documento']['label'] = __('No Documento', 'Dale');
	$fields['billing_no_documento']['type'] = 'number';
	$fields['billing_no_documento']['custom_attributes'] = array('min' => '1','pattern' => '^[0-9]+');
	$fields['billing_no_documento']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_no_documento']['placeholder'] = __('No Documento', 'Dale');
	$fields['billing_no_documento']['required']  = true;
	$fields['billing_no_documento']['clear'] = false;
	$fields['billing_no_documento']['priority'] = 9;

	$fields['billing_phone']['label'] = __('Teléfono', 'Dale');
	$fields['billing_phone']['type'] = 'text';
	$fields['billing_phone']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_phone']['placeholder'] = __('Teléfono', 'Dale');
	$fields['billing_phone']['required']  = true;
	$fields['billing_phone']['clear'] = false;
	$fields['billing_phone']['priority'] = 10;

	$fields['billing_email']['label'] = 'E-mail';
	$fields['billing_email']['placeholder'] = 'E-mail';
	$fields['billing_email']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_email']['clear'] = false;
	$fields['billing_email']['priority'] = 11;

	$fields['billing_participantes']['label'] = 'Participantes';
	$fields['billing_participantes']['type'] = 'text';
	$fields['billing_participantes']['class'] = array('pure-u-1', 'pure-u-md-1-2 custom_fields_p');
	$fields['billing_participantes']['required']  = true;
	$fields['billing_participantes']['clear'] = false;
	$fields['billing_participantes']['priority'] = 10;

	return $fields;
}

add_filter('woocommerce_billing_fields', 'custom_override_checkout_fields', 10, 2 );



/*
|-------------------------------------------------------------------------------
| Modificar Billing Admin
|-------------------------------------------------------------------------------
*/
function custom_override_checkout_fields_admin($fields)
{

	global $post;

	unset($fields['company']);
	unset($fields['postcode']);

	$fields['state'] = array(
		'label' => 'Departamento',	'value' => get_post_meta($post->ID, '_billing_state', true),	'show' =>	true
	);

	$fields['state'] = array(
		'label' => 'Ciudad',	'value' => get_post_meta($post->ID, '_billing_city', true),	'show' =>	true
	);

	$fields['cedula'] 		= array(
		'label' => 'Cedula',	'value' => get_post_meta($post->ID, '_billing_no_documento', true),	'show' =>	true
	);

	$fields['tipodocumento'] = array(
		'label' => 'Tipo de documento',	'value' => get_post_meta($post->ID, '_billing_tipo_document', true),	'show' =>	true
	);

	return $fields;
}

add_filter('woocommerce_admin_billing_fields', 'custom_override_checkout_fields_admin');

/*
|-------------------------------------------------------------------------------
| Order Billing Admin
|-------------------------------------------------------------------------------
*/
function reorder_woocommerce_fields_admin($fields)
{

	$fields2['first_name'] = $fields['first_name'];
	$fields2['last_name'] = $fields['last_name'];
	$fields2['state'] = $fields['state'];
	$fields2['city'] = $fields['city'];
	$fields2['country'] = $fields['country'];
	$fields2['address_1'] = $fields['address_1'];
	$fields2['address_2'] = $fields['address_2'];
	$fields2['tipodocumento'] = $fields['tipodocumento'];
	$fields2['cedula'] = $fields['cedula'];
	$fields2['phone'] = $fields['phone'];
	$fields2['email'] = $fields['email'];
	$fields2['fecha'] = $fields['fecha'];


	return $fields2;
}

add_filter('woocommerce_admin_billing_fields', 'reorder_woocommerce_fields_admin');


//Gancho de orden pendiente a procesado para guardar los puntos
add_filter ('woocommerce_order_status_pending_to_processing', 'order_pending_to_processing', 10, 2);
add_filter ('woocommerce_order_status_cancelled_to_processing', 'order_pending_to_processing', 10, 2);
add_filter ('woocommerce_order_status_refunded_to_processing', 'order_pending_to_processing', 10, 2);
add_filter ('woocommerce_order_status_failed_to_processing', 'order_pending_to_processing', 10, 2);
add_filter ('woocommerce_order_status_on-hold_to_processing', 'order_pending_to_processing', 10, 2);
function order_pending_to_processing($order_id) {
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
		wp_mail( $entrada->email, $subject, $body, $headers );
	}
}


/*
|-------------------------------------------------------------------------------
| Function to add Scripts in Front-end
|-------------------------------------------------------------------------------
*/
add_action("after_switch_theme", "create_table_calendario");

function create_table_calendario(){
	
	global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table_name = $wpdb->prefix . "entradas";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $table_name (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      id_order varchar(255) NOT NULL,
	  name varchar(255) NOT NULL,
	  email varchar(255) NOT NULL,
      PRIMARY KEY  (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	dbDelta( $sql );
}





/*
|-------------------------------------------------------------------------------
| Agregar Custom Field Productos SImples y Padres
|-------------------------------------------------------------------------------
*/

// en la pestaña avanzados
function woocommerce_product_custom_order_product()
{

	global $woocommerce, $post;

	echo '<div class="product_custom_field">';
	//Custom Product  order
	woocommerce_wp_text_input(
		array(
			'id'                => 'fecha_evento',
			'label'             => 'Fecha Evento',
			'type'              => 'txt'
		)
	);
	echo '</div>';
	
}

add_action('woocommerce_product_options_advanced', 'woocommerce_product_custom_order_product');


// guardar metacampos nuevos
function woocommerce_product_custom_fields_save($post_id)
{
	$fecha_evento = $_POST['fecha_evento'];
	if (!empty($fecha_evento))
		update_post_meta($post_id, 'fecha_evento', esc_html($fecha_evento));
}


// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');




// display the extra data in the order admin panel
function kia_display_order_data_in_admin( $order ){  ?>
    <div class="order_data_column" style="width: 100%;">
        <h4><?php _e( 'Extra Details' ); ?></h4>
        <?php 
			$jEntradas= get_post_meta($order->id, '_billing_participantes', true);
			//convertimos el json a array
			$aEntradas= json_decode($jEntradas);
			//Construmins los mensajes que se envian
			foreach ($aEntradas as $key => $entrada) {
				echo 'Nombre: '.$entrada->name;
				echo '<br>';
				echo 'Email: '.$entrada->email;
				echo '<br>';
			}
		?>
    </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'kia_display_order_data_in_admin' );