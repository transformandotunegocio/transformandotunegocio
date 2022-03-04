(function( $ ){
	/*
	==============================================
	Scripts Mini Cart
	==============================================
	*/
	ajaxMiniCart = function(addcart) {
		var loader = $(".cont_cart_pre_loader").html();
	
		var data = { action: "miniCart" };

    if (addcart) {
      $('.content_carrito').addClass('open_carrito');
    }
	
		$.ajax({
		  type: "POST",
		  url: MyAjax.url,
		  data: data,
		  beforeSend: function() {
			
			$('.wrapperHeader').addClass("opened");
			$('.wrapperHeader').fadeIn(200);
			$(".wrapperHeader").find(".cart_mini_fast").html(loader);
		  },
		  success: function(msn) {
			  $(".wrapperHeader").find(".cart_mini_fast").html(msn);
		  },
	
		  error: function(msn) {
			console.log(msn);
		  },
	
		  complete: function() {
		  }
		});
	};
	
	// Publicamos la funcion paraque sea visible desde afuera
	this.ajaxMiniCart;

	/*
	==============================================
	Scripts Mini Cart
	==============================================
	*/
	registrarEntrada = function(id, email, nombre) {
	
		var data = { 
			action: "registrarEntrada",  
			id: id,
			email: email,
			nombre: nombre
		};
		$.ajax({
		  type: "POST",
		  url: MyAjax.url,
		  data: data,
		  beforeSend: function() {
			$( '#loader_special' ).fadeIn( 200 );
			$( '#loader_special .expecial_txt_loader' ).html( 'Registrando...' );
		  },
		  success: function(msn) {
			$(".alertOk").fadeIn(20);
		  },
		  error: function(msn) {
		  },
		  complete: function() {
			$( '#loader_special' ).fadeOut( 200 );
			location.reload();
		  }
		});
	};
	
	// Publicamos la funcion paraque sea visible desde afuera
	this.registrarEntrada;


	
	/*
	==============================================
	Scripts Ajax to send mail "Contact"
	==============================================
	*/

	SendForm = function ( idFom ){

		copyHtmlOk = $( '#alertSuccess span' ).html();

		$( ".input_submit" ).attr( 'disabled', 'disabled' );

		if ( $('.printErrors').is(':visible') ) {

			$('.printErrors').fadeOut(0);

		}
		
		var options = {
				type: "POST"
			,	url: MyAjax.url
			,	dataType: "json"
			,	resetForm: true
			,	beforeSubmit: validate
			,	beforeSend: function(){
				$( '#loader_special' ).fadeIn( 200 );
				$( '#loader_special .expecial_txt_loader' ).html( 'Enviando solicitud...' );
                    
				}
			,	success: function( msn ){

				if (msn.validate == true) {

					$(".alertOk").fadeIn(20);
		
				} else {
					if (msn.msnError) {
					  var divPrint = ".alertFail";
		  
					  // Print errors of validation
					  $(divPrint)
						.fadeIn()
						.html('<span>'+msn.msnError+'</span>');
					}
		  
					$(".alertFail").fadeIn(200);
					$("#loader_special").fadeOut(200);
				}
			}
			, 	error: function( msn ){

					console.log( msn );

				}
			, complete: function( msn ){
				//ocultar loader
				$( '#loader_special' ).fadeOut( 200 );
				$( ".input_submit" ).attr( 'disabled', false );
			}

		}

		$( idFom ).ajaxSubmit( options );

		setTimeout(function(){  $('.alertFail').fadeOut(500); }, 3500);

	}
	// Publicamos la funcion paraque sea visible desde afuera
	this.SendForm;
	/*
	==============================================
	Scripts Ajax to send mail "Contact"
	==============================================
	*/

	setRegistro = function ( idFom ){
		var options = {
				type: "POST"
			,	url: MyAjax.url
			,	dataType: "json"
			,	resetForm: true
			,	beforeSubmit: validate
			,	beforeSend: function(){
					$( '#loader_special' ).fadeIn( 200 );
					$( '#loader_special .expecial_txt_loader' ).html( 'Registrando entradas...' );
				}
			,	success: function( msn ){
					if(msn.validate){
						$('#billing_participantes').val(msn.entradas);
						$('.popup_cover').fadeOut(100);
      					$('.popup_txt').css({ 'display': 'none', 'width': 'initial', 'background-color': '' });
					}else{
						alert('Encontramos un error')
					}
			}
			, 	error: function( msn ){
					console.log( msn );
				}
			, complete: function( msn ){
				//ocultar loader
				$( '#loader_special' ).fadeOut( 200 );
			}
		}
		$( idFom ).ajaxSubmit( options );
	}
	// Publicamos la funcion paraque sea visible desde afuera
	this.setRegistro;

	/*
	==============================================
	Scripts to validate input requires in form
	==============================================
	*/
	function validate(formData, jqForm, options) {
		
		var inputValidate = true;
		$(jqForm.selector + " .woowRequireFail").removeClass("woowRequireFail");
		// Validate inputs type [text]
		for (var i = 0; i < formData.length; i++) {
		  var inputName = formData[i].name;
		  // Validate inputs type [text]
		  if (formData[i].required == true && !formData[i].value) {
			inputValidate = false;
			$(jqForm.selector + ' [name="' + inputName + '"]').addClass(
			  "woowRequireFail"
			);
		  }
	
		  // Validate inputs type [email]
		  if (formData[i].type == "email" && formData[i].value) {
			inputValidEmail = validateEmail(formData[i].value);
			if (!inputValidEmail) {
			  inputValidate = false;
			  $(jqForm.selector + ' input[name="' + inputName + '"]').addClass(
				"woowRequireFail"
			  );
			}
		  }
		}
		// Validate inputs type [radio]
		$(jqForm.selector)
		  .find(":radio, :checkbox")
		  .each(function() {
			// get name of input
			name = $(this).attr("name");
			// get attribute required of input
			requiredVal = $(this).attr("required");
			// get attribute checked of input
			checkedVal = $('[name="' + name + '"]:checked').length;
	
			// validate attributes of input
			if (requiredVal && checkedVal == 0) {
			  inputValidate = false;
			  $(this)
				.closest(".parentValidate")
				.addClass("woowRequireFail");
			}
		});
		if (!inputValidate) {
			// Print errors of validation
			$('.alertFail').html('<span>Campos vacios!!</span>');

		 	$(".alertFail").fadeIn(200);

			 setTimeout(function(){  $('.alertFail').fadeOut(500); }, 3500);

		  	return false;
		}
	}
	/*
	==============================================
	Scripts to validate input Email
	==============================================
	*/
	function validateEmail(email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
		if (!emailReg.test(email)) {
		  return false; //No es E-mail
		} else {
		  return true; //Si es E-mail
		}
	}
	/*
	==============================================
	Scripts to Validate numbers
	==============================================
	*/
	function ValidNumber(e) {
		tecla = document.all ? e.keyCode : e.which;
		//Tecla de retroceso para borrar, siempre la permite
		if (tecla == 8 || tecla == 0) {
		  return true;
		}
		// Patron de entrada, en este caso solo acepta numeros
		patron = /[0-9]/;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	}

})( jQuery );