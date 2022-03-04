<?php

/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 */

?>
	<footer id="contacto" class="footer">
		<div class="woowContent1250 footer_content">
			<div class="footer_content_logo">
				<img src="<?=IMGURL?>logo_footer.jpg" alt="">
			</div>
			<div class="footer_content_redes">
				<ul>
					<li><a target="_blank" href="https://www.instagram.com/rush_technofetish/"><span><i class="icon-instagram"></i></span>@rush_technofetish</a></li>
					<li><a target="_blank" href="https://vm.tiktok.com/ZMRqYvYAS/"><span><i class="icon-tiktok"></i></span>@rushtechnoparty</a></li>
					<li><a target="_blank" href="https://twitter.com/rush_fetish"><span><i class="icon-twitter"></i></span>@rush_fetish</a></li>
				</ul>
			</div>
		</div>
	</footer>

	<!-- LOADER SPECIAL-->		
	<section id="loader_special">
		<div class="cont_loader">
			<div class="cart_loader">
				<img src="<?php echo IMGURL; ?>elements/oval.svg" />
				<p class="expecial_txt_loader"><?= __('Cargando', 'Dale') ?>...</p>
			</div>
		</div>
		<div class="cont_cart_pre_loader" style="display: none;">
			<div class="cart_loader">
				<img src="<?php echo IMGURL; ?>elements/ovalb.svg" />
				<p class="expecial_cart_loader"><?= __('Cargando', 'Dale') ?>...</p>
			</div>
		</div>
	</section>

	<section id="registro" class="woowContentFull padigSpecialMac">
		<div class="alertOk alertRegistro" >
			<span>
				<?= __('!Gracias por registrarte!', 'Dale') ?>
			</span>
		</div>
		<div class="alertFail" >
			<span></span>
		</div>
	</section>

	<section class="popup_cover">
		<!-- Pop Up to images -->
		<div class="content_img">
			<span class="popup_close">&times;</span>
			<img class="popup_img popup_animate"></img>
		</div>

		<!-- Pop Up to texts -->
		<div class="popup_txt popup_animate">
			<span class="popup_close">&times;</span>
			aaaa
		</div>
		
	<!-- Pop Up to Video -->
		<div class="popup_video popup_animate">
			<span class="popup_close">&times;</span>
		</div>
	</section>
	<?php wp_footer(); ?>
	<!-- Slider Scripts -->
	<!-- General Scripts -->
	<script type="text/JavaScript" src="<?php echo JSURL ?>html5.js"></script>
	<script src="<?php echo JSURL ?>jquery.form.min.js"></script>
	<script type='text/javascript' src='<?php echo JSURL ?>jquery.cookie.js'></script>
	<script  type="text/JavaScript" src="<?=JSURL?>swiper.min.js"></script>
	<!-- Woow Custom Scripts -->
	<script type='text/javascript' src='<?php echo JSURL ?>app.js?ver=<?php echo VCACHE ?>'></script>
</body>
</html>