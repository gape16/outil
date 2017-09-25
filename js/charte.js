$(function() {
	//fonction pour check si le format d'email est valide
	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};
	$(".connec").on('click', function(e) {
		e.preventDefault();
		//var récup valeur de l'input email
		var emailAddress = $(".connexion .email").val();
		console.log(emailAddress);
		//comparaison entre la valeur du mail et le format
		if (!isValidEmailAddress(emailAddress)) {
			$('.connexion .email').addClass('empty');
			console.log('mail non valide');
			$('.connexion .email').prev().html('Email pas bon');
		} else {
			$("form.connexion").submit();
			console.log('mail valide');
		}
	})
	$(".inscription").on('click', function(e) {
		e.preventDefault();
		//var récup valeur de l'input email
		var emailAddress = $(".signin .email").val();
		var has_empty = false;
		$('.connect').find('input.check').each(function() {
			if (!$(this).val()) {
				has_empty = true;
				console.log('pas rempli');
				$(this).addClass('empty');
			} else {
				console.log('rempli!');
			}
		});
		if (has_empty == false) {
			if (isValidEmailAddress(emailAddress)) {
				if ($('.signin').find(":selected").val() != 0) {
					var poste = $('.form-control').find(":selected").text();
					var valPoste = $('.form-control').find(":selected").val();
					$('.poste').html('').append(poste);
					console.log(poste);
					console.log(valPoste);
					if (valPoste != 1 && valPoste != 2) {
						$.fancybox({
							href: '#hidden-content-a', // Source of the content
							type: 'iframe',
							modal: true
						});
					} else {
						$('.signin').submit();
					}
				} else {
					$('select.form-control[name="statut"]').addClass('empty');
				}
			} else {
				$('.email').prev().html('Email pas bon');
				console.log(emailAddress);
				$('.email').addClass('empty');
			}
		} else {
			$('.empty').addClass('empty');
		}
		return false;
	})
	$('.connect').on('keyup', '.empty', function(event) {
		$(this).addClass('onchange');
	});
	$('.submit').on('click', function() {
		var poste = $('.form-control').find(":selected").val();
		console.log(poste);
		var code = $('.code').val();
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {
				codeInput: code,
				jobUser: poste
			}
		}).done(function(data) {
			if (data == code) {
				$('.signin').submit();
			} else {
				$('.code').val('').attr('placeholder', 'Code éronné');
			}
		})
	})




	$('a.forgot').on('click', function(){
		$('.token').css('display', 'none');
		$('.newpassword').css('display', 'none');
		$.fancybox({
			href: '#hidden-content-b', // Source of the content
			type: 'iframe',
			modal: true
		});	
	});
	$('.getpassword').on('click', function(){
		var emailforgot = $('input.forgotemail').val();
		if (!isValidEmailAddress(emailforgot)) {
			$('.forgotemail').addClass('empty');
		} else {
			console.log('mail valide');
			$('.token').css('display', 'block');
			$('.forgotemail').css('display', 'none');
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {
					idForgot : emailforgot,
				}
			}).done(function(data) {
				console.log(data);
				$('.hidden').val(data);
				console.log($('.token').val());
				$('.getpassword').css('display', 'none');
				$('.newpassword').css('display', 'block');
			})
		}
		console.log(emailforgot);
	})
	$('.newpassword').on('click', function(){
		data = $('.hidden').val();
		if(data == $('.token').val()){
			console.log('condition marche');
			$('.token').remove();
			$('<input type="text" placeholder="Ton nouveau mot de passe" class="password"> <input type="text" placeholder="Verifie ton nouveau mot de passe" class="passwordverify">').insertBefore('.getpassword')
			var password = $('.password').val();
			var passwordverify = $('.passwordverify').val();	
			$('.newpassword').css('display', 'none');
			$('<a href="#" class="btn btn-purple btn-lg full-width confirmpw" style="display: block;">Valider nouveau mot de passe<div class="ripple-container"></div></a>').insertAfter('input.passwordverify')

			$('.confirmpw').on('click', function(){
				if(password == passwordverify){
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {
							newPassword : password,
						}
					}).done(function(data) {
						console.log('ok');
					})
				}
			})

		}
	})
})