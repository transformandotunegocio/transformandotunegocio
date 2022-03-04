jQuery(function($) {
  /*	
  ==============================================	
  Scripts NEWSLETTER	
  ==============================================
  */
  if($('#pop_bancobogota').length){
    var htmlElement = $('#pop_bancobogota').find('.popup_content').html();
    $('.popup_txt').html(htmlElement).css('display', 'block').css({ 'background-color': '#FFF' });
    $('.popup_cover').fadeIn(100);
    var fateheul = $('.popup_txt').find(".autocom_div");
    $('#pop_bancobogota').find('.popup_content').empty();
  }
  /*
	==============================================
	==============================================
	*/
  $('.car_a').click(function(e){
    e.preventDefault();
    var miniCartTime = $.cookie("miniCartTime");
    var timeRest = new Date();
    var theTime = new Date().getTime();
    var timeRest = timeRest.setSeconds(timeRest.getSeconds() - 30);

    if (
      typeof miniCartTime == "undefined" ||
      miniCartTime < timeRest ||
      $(".cart_mini_fast").is(":empty")
    ) {
      // Run ajax mini cart
      ajaxMiniCart();
      $.cookie("miniCartTime", theTime);
    }


    $('.content_carrito').addClass('open_carrito');
  });
  $('.close_carrito').click(function(){
    $('.content_carrito').removeClass('open_carrito');
  });


  $('.header_menu svg').click(function(){
    $('.nav_menu').toggleClass('openMenu');
  });




  
  /*
	==============================================
	==============================================
	*/
  $('.button_play').click(function(e){
    $('#videoHome')[0].play();
    $('.button_play').fadeOut(200);
  });
  //Slider del producto
  if($('.swiper-container').length){
    new Swiper('.swiper-container', {
        loop: false,
        breakpoints: {
          360: {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
        },
    });
  } 

  if($('.swiper-container2').length){
    new Swiper('.swiper-container2', {
        loop: true,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        breakpoints: {
          360: {
            slidesPerView: 3,
            spaceBetween: 5,
          },
          1024: {
            slidesPerView: 6,
            spaceBetween: 10,
          },
        },
    });
  } 

});