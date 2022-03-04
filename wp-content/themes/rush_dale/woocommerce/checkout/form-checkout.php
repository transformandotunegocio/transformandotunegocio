<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$nonceContactForm = wp_create_nonce( 'nonceContactForm' );
?>
<main class="woowContentFull main main_carrito">
	<div class="woowContent1250 main_carrito_content">
		<h1>Checkout</h1>
		<?php
			do_action( 'woocommerce_before_checkout_form', $checkout );
			// If checkout registration is disabled and not logged in, the user cannot checkout.
			if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
				echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
				return;
			}
		?>
		<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col2-set" id="customer_details">
					<div class="col-1">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="col-2">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>
			
			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
				
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order">
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</form>
	</div>
</main>
<!--POPUP PRINCIPAL-->	
<div id="pop_bancobogota" class="woow_popup txt">
	<div class="popup_content">
		<div class="info_bancobogota">
			<div class="pure-g">
				<div class="pure-u-1 contentPopUp">
					<form class="pure-form pure-form-aligned forms_pages" id="kinky" method="POST">
						<fieldset>
							<div class="pure-g">
								<div class="pure-u-1">
									<div class="section_title_modal">
										<h1>Registro de participantes</h1>
										<p>Se enviara la invitacion vía correo electronico</p>
										<?php
											//obtnemos el monto del carrito
											$repeticiones = 0;
											// Loop through cart items
											foreach ( WC()->cart->get_cart() as $cart_item ) { 
												$repeticiones = $repeticiones + $cart_item['quantity'];
											}
				
											//repetimos la cantidad de email segun el monto
											for ($i=0; $i < $repeticiones; $i++) { 
												?>
												<div class="section_input_email">
													<label for=""><strong>Entrada <?= $i + 1?></strong></label><br>
													<input name="name[]" type="name" required placeholder="Nombre">
													<input name="email[]" type="email" required placeholder="Email">
												</div>
												<?php
											}
										?>
										<input type="hidden" name="action" value="saveRegistro">
										<div class="pure-control-group inputSubmit">
											<button type="button" class="send_registro" name="cargar" onClick="setRegistro( '#kinky' )">Registrar</button>
										</div>
									</div>
								</div>
								<div class="pure-control-group printErrors" id="div-errors" style="display: none;"></div>
							</div>
						</fieldset>
						<div class="alerts_forms">
							<div id="alertFailValidation" class="alertFail">
								<span> <?= __('Por favor, ingrese todos los datos requeridos', 'Dale') ?> </span>
							</div>
						</div>
					</form> 
				</div>
			</div>
		</div>
	</div>
</div>




<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
