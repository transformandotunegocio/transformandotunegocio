<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Nampa Basico
 * @since Nampa Basico 1.0
 */
$nonce = wp_create_nonce( 'nonceContactForm' ); 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo get_bloginfo('description', 'display'); ?>">
		<meta name="title" content="<?php echo wp_title('|', true, 'left'); ?>">
		<meta name="language" content="Español">
		<meta name="googlebot" content="INDEX, FOLLOW">
		<meta name="facebook-domain-verification" content="jcy1hxckl2at4ms1etgev61jnlp9ra"/>
		<!-- Iccon Site -->
		<link rel="stylesheet" href="<?php echo CSSURL ?>fuentes.css?ver=<?php echo VCACHE ?>">
		<!-- Icomoon -->
		<link rel="stylesheet" href="<?php echo CSSURL ?>icomoon/style.css">
		<!-- General Css Styles -->
		<link rel="stylesheet" href="<?php echo CSSURL ?>pure-min.css">
		<link rel="stylesheet" href="<?php echo CSSURL ?>grids-responsive-min.css">
		<link rel="stylesheet" href="<?=CSSURL?>swiper.min.css">
		<!-- Style Site -->
		<link rel="stylesheet" href="<?php echo CSSURL ?>style.css?ver=<?php echo VCACHE ?>">
		<!-- Responsive Style Site -->
		<link rel="stylesheet" href="<?php echo CSSURL ?>style-responsive.css?ver=<?php echo VCACHE ?>">
		<?php wp_head(); ?>
		<style>html{margin: 0 !important;}</style>
		<title><?php wp_title('|', true, 'left'); ?></title>
	</head>
	<body <?php body_class(); ?>>
		<header class="header">
			<div class="woowContent1250 header_content">
				<div class="header_logo">
					<a href="<?=home_url()?>"><img src="<?=IMGURL?>logo.jpg" alt=""></a>
				</div>
				<div class="header_tools">
					<div class="header_car">
						<a class="car_a" href="<?=home_url('carrito')?>">
							<img src="<?=IMGURL?>cart.jpg" alt="">
						</a>
						<div class="content_carrito wrapperHeader">
							<div class="content_carrito_header">
								<h3>BOLSA DE COMPRAS</h3>
								<div class="close_carrito">
									<i class="icon-cheveron-down"></i>
								</div>
							</div>
							<div class="cart_mini_fast"></div>
						</div>
					</div>
					<div class="header_car">
						<a href="https://wa.link/3trbdl" target="_blank"><img src="<?=IMGURL?>wp.png" alt=""></a>
						
					</div>
					<?php
						if(is_front_page()){
							?>
							<div class="header_menu">
								<svg width="80" height="80" viewBox="0 0 32 42" xmlns="http://www.w3.org/2000/svg" onclick="this.classList.toggle('active')">
									<g transform="matrix(1,0,0,1,-389.5,-264.004)">
									<g id="arrow_left2">
										<g transform="matrix(1,0,0,1,0,5)">
										<path
											id="top"
											d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967"
										/>
										</g>
										<g
										transform="matrix(1,1.22465e-16,1.22465e-16,-1,0.00024296,564.935)"
										>
										<path
											id="bottom"
											d="M390,270L420,270L420,270C420,270 420.195,250.19 405,265C389.805,279.81 390,279.967 390,279.967"
										/>
										</g>
										<path id="middle" d="M390,284.967L420,284.967" />
									</g>
									</g>
								</svg>
								<nav class="nav_menu">
									<ul>
										<li><a href="#boleteria">Boleteria</a></li>
										<li><a href="#djs">Djs Invitados</a></li>
										<li><a href="#dresscode">Dresscode</a></li>
										<li><a href="#faqs">Questions & Answer</a></li>
										<li><a href="#contacto">Contacto</a></li>
									</ul>
								</nav>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</header>