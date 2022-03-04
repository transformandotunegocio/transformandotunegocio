<?php

/**
 * Template Name: Home
 *
 * @package WordPress
 */

get_header();

?>
  <script type="text/javascript">    
    function videoEnded(video) {
      video.load();
    };
  </script>
  <main class="main">
      <div class="main_content">
        <div class="main_content_video">
          <video id="videoHome" onended="videoEnded(this)" poster="banner-1.jpg">
            <source src="<?=IMGURL?>home.mp4" type="video/mp4" >
          </video>
          <div class="button_play">
            <img src="<?=IMGURL?>playbutton.png" alt="">
          </div>
          <div class="button_buy">
            <a href="#boleteria">Comprar.</a>
          </div>
        </div>
        <div class="main_section_1">
          <img src="<?=IMGURL?>banner-2-RUSH.jpg" alt="">
        </div>
        <div id="boleteria" class="main_section_services">
         
              <?php
                $css_woocommerce = new Woocommerce_Custom;
                $productos = $css_woocommerce->printProductosHome();
                foreach ($productos->products as $key => $wc_product) {
                  //Otro Proceso
                  $image        = $wc_product->get_image_id();
                  $image_url    = wp_get_attachment_image_url( $image, '400x600' );
                  $tipo_product = $wc_product->get_type();
                  //obtenemos array de price
                  $aPrecios     = getPriceProduct($wc_product);
                  ?>
          
                    <div class="services">
                      <img src="<?= $image_url ?>" alt="">
                      <h1><?= $wc_product->get_name() ?></h1>
                      <p class="date_services">
                        <?php
                          $metas_product = get_post_meta($wc_product->get_id());
                          if (isset($metas_product['fecha_evento'][0]) && $metas_product['fecha_evento'][0] != '') {
                            echo $metas_product['fecha_evento'][0];
                          }else{
                            echo 'Sin fecha';
                          }
                        ?>
                      </p>
                      <?php
                        if(is_array($aPrecios)){
                          ?>
                          <p class="price_services"><span class="home_product_price_old">$<?=number_format( $aPrecios['price'], 0, ',', '.' )?></span><span class="home_product_price_new">$<?=number_format( $aPrecios['price_sale'], 0, ',', '.' )?></span> <span class="cop">COP</span></p>
                          <h3></h3>
                          <?php
                        }else{
                          ?>
                          <p class="price_services">$<?=number_format( $aPrecios, 0, ',', '.' )?> <span class="cop">COP</span></p>
                          <?php
                        }
                      ?>
                      <?php
                        if($wc_product->is_in_stock()){
                          ?>
                          <p class="link_services"><a href="<?=$wc_product->get_permalink()?>">Comprar</a></p>
                          <?php
                        }
                      ?>
                    </div>
    
                  <?php
                }
              ?>
						
					</div>
        </div>
        <div id="djs" class="main_section_dj" style="width: 100%; display:flex;justify-content:center">
          <a href="https://open.spotify.com/playlist/2Ip9yHnApsTdequbPJ2GsU?si=Y3BDtyh5S-SFu50hVwF14g&utm_source=whatsapp&dl_branch=1" target="_blank"><img src="<?=IMGURL?>dj1.png" alt=""></a>
        </div>

        <img src="<?=IMGURL?>dj2.jpg" alt="">

        <div id="dresscode" class="main_section_manes">
          <h3>FIRE UP YOUR <span>DRESSCODE</span></h3>
          <div class="container_modelos">
            <a href="https://dalemas.store/tienda/bdsm/" taget="_blank"><img src="<?=IMGURL?>modelo1.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/sintetico/" taget="_blank"><img src="<?=IMGURL?>modelo2.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/urbano/" taget="_blank"><img src="<?=IMGURL?>modelo3.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/sintetico/" taget="_blank"><img src="<?=IMGURL?>modelo4.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/sintetico/" taget="_blank"><img src="<?=IMGURL?>modelo5.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/urbano/" taget="_blank"><img src="<?=IMGURL?>modelo6.jpg" alt=""></a>
            <a href="https://dalemas.store/tienda/cuero/" taget="_blank"><img src="<?=IMGURL?>modelo7.jpg" alt=""></a>
          
          </div>
        </div>
        <div id="faqs" class="main_section_faqs"> 
          <h3>Q&A’S</h3>
          <div class="faqs_item">
            <h4>¿DÓNDE PUEDO COMPRAR MI ENTRADA?</h4>
            <p>LOS TICKETS LOS PUEDES ADQUIRIR A TRAVÉS DE NUESTRO SITIO WEB O TAMBIÉN CON LOS PROMOTORES OFICIALES, WHATSAPP, REDES SOCIALES Y LAS TIENDAS DE DALE+. RECUERDA QUE ES UN TICKET VIRTUAL POR TAL RAZÓN ES ÚNICO E INSTRANSFERIBLE.</p>
          </div>
          <div class="faqs_item">
            <h4>¿QUÉ PUEDO HACER Y QUÉ NO EN LA FIESTA RUSH?</h4>
            <p>SABEMOS QUE ERES CURIOSO Y PRECAVIDO, ASÍ QUE TENEMOS UN POST (DO´S & DONT´S) QUE RECIBIRÁS CUANDO ADQUIERAS TU TICKET.  </p>
          </div>
          <div class="faqs_item">
            <h4>¿DEBO IR SOLO O ACOMPAÑADO?</h4>
            <p>COMO DESEES, PUEDES IR SOLO Y HACER MUCHAS AMISTADES NUEVAS O IR ACOMPAÑADO Y PASAR IGUALMENTE UNA NOCHE INCREÍBLE.</p>
          </div>
          <div class="faqs_item">
            <h4>¿CUÁL ES EL DIFERENCIAL DE RUSH FRENTE A OTROS EVENTOS FETICHISTAS?</h4>
            <p>RUSH ES EXCLUSIVO PARA HOMBRES, Y ADEMÁS DE TENER GRANDES INVITADOS TOP PARA UN COMPLETO DESARROLLO DEL EVENTO, TENDRÁ UN PLAY- GROUND COMPLETAMENTE PRODUCIDO POR DALE+.</p>
          </div>
          <div class="faqs_item">
            <h4>¿HABRÁN ZONAS HÚMEDAS?</h4>
            <p>NO, AUNQUE TENDREMOS A DISPOSICIÓN DE NUESTROS CLIENTES BAÑOS ADECUADOS PARA  CUALQUIER PERCANCE QUE PUEDAN LLEGAR A  TENER </p>
          </div>
          <div class="faqs_item">
            <h4>¿CADA CUÁNTO HABRÁ EVENTO RUSH?</h4>
            <p>RUSH ES UN EVENTO ITINERANTE, EL CUAL TENDRÁ PRESENCIA EN LAS PRINCIPALES CIUDADES DEL PAÍS, COMO BOGOTÁ, MEDELLÍN Y CALI. AL TERMINAR CADA EVENTO, SE DARÁN A CONOCER LAS PRÓXI- MAS FECHAS </p>
          </div>
          <div class="faqs_item">
            <h4>¿PARA QUÉ TIPO DE PÚBLICO ES EL EVENTO?</h4>
            <p>EL EVENTO ES EXCLUSIVO PARA HOMBRES, PUEDES SER GAY, BI O HETERO. <br> UNA DE LAS RAZONES: IDENTIFICAMOS UN VACÍO EN EL SECTOR FETICHISTA Y DE EVENTOS COMERCIALES Y QUISIMOS SATISFACER LAS NECESIDADES DEL MERCADO MASCULINO, ASÍ PODREMOS DESARROLLAR UNA EXPERIENCIA DE MARCA ÚNICA Y ACERCARNOS DE MANERA CREATIVA Y ORIGINAL.</p>
          </div>
          <div class="faqs_item">
            <h4>¿HAY REEMBOLSO O DEVOLUCIONES DE DINERO?</h4>
            <p>AUNQUE TENEMOS TODO PREVISTO PARA LLEVAR A CABALIDAD EL EVENTO, DE NO SER POSIBLE POR ALGUNA FUERZA MAYOR EXTERIOR, EN EL MOMENTO DE SER NECESARIO, SE COMUNICARÁN LAS OPCIO- NES QUE SE HABILITARÁN PARA EL REEMBOLSO O REPROGRAMACIÓN. </p>
          </div>
          <div class="faqs_item">
            <h4>¿QUÉ DEBO ESPERAR AL INTERIOR DEL EVENTO?</h4>
            <p>ES UNA FIESTA TECHNO GAY FETICHISTA, VE CON LA MENTE ABIERTA Y DISFRUTA DE LOS SHOWS Y DE LOS OTROS ASISTENTES EN GENERAL.  </p>
          </div>
          <div class="faqs_item">
            <h4>¿CUÁL ES EL DRESSCODE DEL EVENTO?</h4>
            <p>TENEMOS UNA SECCIÓN EN LA QUE TE VAS A INSPIRAR LLAMADA ‘’FIRE UP YOUR DRESSCODE’’. SIN EMBARGO, PUEDES IR EN PANTALON DE CUERO, CUERINA, TELA MILITAR, SINTETICO, LICRAS, ETC. </p>
          </div>

        </div>
        <div class="main_section_divider">
          <p>POWERED BY:</p>
        </div>
        <div class="main_section_logos" style="display: #000;">
          <img src="<?=IMGURL?>logo_dale_white.png" style="width:300px;display:block;margin:40px auto 80px auto" alt="">
        </div>
        <div class="main_section_divider">
          <p>SPONSORS:</p>
        </div>
        <div class="main_section_logos" style="display: #000;">
          <img src="<?=IMGURL?>sponsors-en-negro.jpg" style="width:500px;display:block;margin:40px auto 80px auto" alt="">
        </div>
        <div class="main_section_logos" style="display: none;">
          <div class="slider_logos">
            <div class="swiper-container2 woowContent1250">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider1.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider2.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider3.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider4.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider5.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider6.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider7.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider8.jpg" alt="">
                </div>
                <div class="swiper-slide">
                  <img src="<?=IMGURL?>slider/slider9.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
  </main>
<?php
get_footer();
?>