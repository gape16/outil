$(function() {
	//fonction pour check si le format d'email est valide
	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};

//CONNEXION
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

//INSCRIPTION
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
					if (valPoste != 1 && valPoste != 2) {
						$.fancybox({
							href: '#hidden-content-a', // Source of the content
							type: 'iframe',
							modal: true
						});
					} else {
						$('.inscription').addClass('signinok').html('Inscription OK !');
						setTimeout(function(){ $('.signin').submit(); }, 1500);
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

//CONNEXION	
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



//MDP OUBLIE
$('a.forgot').on('click', function(){
	$.fancybox({
			href: '#hidden-content-b', // Source of the content
			type: 'iframe',
			modal: true
		});	
});

//GET PASSWORD
$('.getpassword').on('click', function(){
	$('.token').css('display', 'block');
	var emailforgot = $('input.forgotemail').val();
	if (!isValidEmailAddress(emailforgot)) {
		$('.forgotemail').addClass('empty');
	} else {
		console.log('mail valide');
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

//NEW PW
$('.newpassword').on('click', function(){
	data = $('.hidden').val();
	var emailforgot = $('input.forgotemail').val();
	if(data == $('.token').val()){
		console.log('condition marche');
		$('.token').remove();
		$('<input type="text" placeholder="Ton nouveau mot de passe" class="password"> <input type="text" placeholder="Verifie ton nouveau mot de passe" class="passwordverify">').insertBefore('.getpassword')
		$('.newpassword').css('display', 'none');
		$('<a href="#" class="btn btn-purple btn-lg full-width confirmpw" style="display: block;">Valider nouveau mot de passe<div class="ripple-container"></div></a>').insertAfter('input.passwordverify')

		$('.confirmpw').on('click', function(){
			var password = $('.password').val();
			var passwordverify = $('.passwordverify').val();	
			if(password == passwordverify){
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {
						newPassword : password,
						mailNewPassword : emailforgot
					}
				}).done(function(data) {
					console.log(password);
					$.fancybox.close();
				})
			}
		})
	}
})


//AJOUT CLIENT
$('.btn-addclient').on('click', function(){
	var numClient = $('.numclient').val();
	var raisonSociale = $('.raisonsociale').val();
	var adresseCms = $('.adressecms').val();
	var splitAdresseCms = 'cms.site-privilege.pagesjaunes.fr/workflow/service/';

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseCms.indexOf(splitAdresseCms) != -1){
			$('.adressecms').removeClass('adressecms');
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {numClient : numClient,
					raisonSociale : raisonSociale,
					adresseCms : adresseCms
				},
			})
			.done(function(data) {
				if(data == "existant"){
					alert('Ce projet existe déjà');
				}else{
					$('div#create-friend-group-1').modal('hide');
					$('.container.cards .row').append(data);
				}
			})
		}else{
			$('.adressecms').addClass('empty');
			$('.adressecms').prev().html('L\'adresse n\'est pas valide');
		}
	}else{
		$('.numclient').addClass('empty');
		$('.numclient').prev().html('Le numéro client n\'est pas valide');
	}




});

	//BIND ENTER TO LOG
	$(document).keypress(function(e) {
		if($('#home').hasClass('active')){
			if(e.which == 13) {
				$('.inscription').trigger('click');
				console.log('test');
			}
		}if($('#profile').hasClass('active')){
			if(e.which == 13) {
				$('.connec').trigger('click');
			}
		}
	})


// MODAL HELP
$('textarea#description').on('click', function(){
	$(this).parent().removeClass('is-empty').addClass('is-focused');
})
// FIX SMALL LABEL
$('input').on('click', function(){
	if($('textarea#description').val().length != 0){
		$('textarea#description').parent().removeClass('is-focused');
	}else{
		$('textarea#description').parent().removeClass('is-focused').addClass('is-empty');
	}
})







//RESET
$(".reset").on('click', function(){
	$(".ajout_photo").find('.form-control').val('');
	$(".help").find('.form-control').val('');
})

//ACHAT PHOTOS
$('.valider_achat').click(function(){
	var id = $(this).data('id');
	var lien = $(this).data('lien');
	var achat = $(this).data('achat');
	$(".id_client").html( id );
	$(".lien_getty").attr("href",lien );
	$(".id_achat").val( achat );
	var numClient = $(this).data('achat');
	var adresseGetty = $('.liengetty').val();
	var splitAdresseGetty = 'http://www.gettyimages.fr/collaboration/boards/';
	var descriptionProblem = $('textarea#description').val();
	console.log(achat);

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseGetty.indexOf(splitAdresseGetty) != -1){
			$('.liengetty').removeClass('empty');
			swal(
				'Demande validée!',
				'Votre demande va être prise en compte!',
				'success'
				).then(function () {
				// location.reload();
				$(".ajout_photo").submit();
			})
			}else{
				$('.liengetty').addClass('empty');
				$('.liengetty').prev().html('L\'adresse n\'est pas valide');
			}
		}else{
			$('.numclient').addClass('empty');
			$('.numclient').prev().html('Le numéro client n\'est pas valide');
		}
	})


//HELP
$('.valider_aide').click(function(){
	var numClient = $('.numclient').val();
	var adresseCms = $('.adressecms').val();
	var splitAdresseCms = 'cms.site-privilege.pagesjaunes.fr/workflow/service/';
	var descriptionProblem = $('textarea#description').val();

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseCms.indexOf(splitAdresseCms) != -1){
			$('.adressecms').removeClass('empty');
			if(descriptionProblem.length >= 140){
				swal(
					'Demande validée!',
					'Votre demande va être prise en compte!',
					'success'
					).then(function () {
				// location.reload();
				$(".help").submit();
			})
				}else{
					$('textarea#description').addClass('empty');
					$('textarea#description').prev().html('Il faut 140 caractères minimum dans votre déscription');
				}
			}else{
				$('.adressecms').addClass('empty');
				$('.adressecms').prev().html('L\'adresse n\'est pas valide');
			}
		}else{
			$('.numclient').addClass('empty');
			$('.numclient').prev().html('Le numéro client n\'est pas valide');
		}
	})

//VALIDER ACHAT
$(".reset").on('click', function(){
	$(".ajout_photo").find('.form-control').val('');
})
$(".validation_achat").on('click', function(e){
	e.preventDefault();
	id_client=$(".id_client").text();
	lien_we=$(".lien_we").val();
	commentaires=$(".commentaires").val();
	etat_select=$(".etat_select").val();
	id_achat=$(".id_achat").val();							
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {achat_client: id_client, lien_wetrans: lien_we, commentaire_achat:commentaires, etat_achat: etat_select, achat : id_achat}
	})
	.done(function(data) {
		// console.log(data);
		swal(
			'Validation transmise!',
			'Le graphiste va reçevoir votre validation!',
			'success'
			).then(function () {
				location.reload();
			})
	})

})

//COUNT TEXTAREA
var text_min = 0;
$('#description').keyup(function() {
	var text_length = $('#description').val().length;
	var text_remaining = text_min + text_length;

	$('label.count').html(text_remaining);
});


})