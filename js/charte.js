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
		// console.log(emailAddress);
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
	// console.log(poste);
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
			// console.log(data);
			$('.hidden').val(data);
			// console.log($('.token').val());
			$('.getpassword').css('display', 'none');
			$('.newpassword').css('display', 'block');
		})
	}
	// console.log(emailforgot);
})

//NEW PW
$('.newpassword').on('click', function(){
	data = $('.hidden').val();
	var emailforgot = $('input.forgotemail').val();
	if(data == $('.token').val()){
		// console.log('condition marche');
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
					// console.log(password);
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
<<<<<<< HEAD
			console.log(adresseCms);
			$('.adressecms').removeClass('adressecms');
=======
>>>>>>> ba1599bf14833e0bfec6c799265007f020cc7bc1
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
				// console.log('test');
			}
		}if($('#profile').hasClass('active')){
			if(e.which == 13) {
				$('.connec').trigger('click');
			}
		}
	})
		//BIND ENTER COMMENTAIRE
		$("textarea.form-control.envoi_message_aide").keypress(function(e) {
			if(e.which == 13) {
				$(".aide_envoi").trigger( "click" );
			}
		}); 


// MODAL HELP
$('textarea#description').on('click', function(){
	$(this).parent().removeClass('is-empty').addClass('is-focused');
})
// FIX SMALL LABEL
$('.help input').on('click', function(){
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
	var numClient = $('.numclient').val();
	var adresseGetty = $('.liengetty').val();
	var splitAdresseGetty = 'http://www.gettyimages.fr/collaboration/boards/';
	var descriptionProblem = $('textarea#description').val();

	var categorie = $('.categorie').val();
	var lien = $('.liengetty').val();
	var id_client = $('.numclient').val();

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseGetty.indexOf(splitAdresseGetty) != -1){
			$('.liengetty').removeClass('empty');
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {categorie: categorie,
					lien: lien,
					id_client: id_client
				}
			})
			.done(function(data) {
				// console.log(data);
				swal(
					'Demande validée!',
					'Votre demande va être prise en compte!',
					'success'
					).then(function () {
						location.reload();
					})
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
$('.valider_aide').click(function(e){
	e.preventDefault();
	var files = $("#file-select").prop("files");
	var numClient = $('.numclient').val();
	var titre = $('.titre_probleme').val();
	var adresseCms = $('.adressecms').val();
	var splitAdresseCms = 'cms.site-privilege.pagesjaunes.fr/workflow/service/';
	var descriptionProblem = $('textarea#description').val().replace(/\n/gi,'<br />');

	var names = $.map(files, function (val) { return val.name; });

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseCms.indexOf(splitAdresseCms) != -1){
			$('.adressecms').removeClass('empty');
			if(descriptionProblem.length >= 140){
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {aide: numClient,
						adresse_aide: adresseCms,
						descriptionProblem: descriptionProblem,
						capture: names,
						titre: titre
					}
				})
				.done(function(data) {
					// console.log(data);
					swal(
						'Demande validée!',
						'Votre demande va être prise en compte!',
						'success'
						).then(function () {
							location.reload();
						})
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
$(".valider_achat_admin").on('click', function(){	
	var id = $(this).data('id');
	var lien = $(this).data('lien');
	var achat = $(this).data('achat');
	$(".id_client").html( id );
	$(".lien_getty").attr("href",lien );
	$(".id_achat").val( achat );
})
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

	$('span.count').html(text_remaining);
});


$(".moproblem").on('click', function(e){
	var id_aide = $(this).data("id");
	$(".id_aide").val(id_aide);
	$("#problemos").alterClass("dial_*", '');
	$("#problemos").addClass('dial_'+id_aide);
	charger_commentaires();
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {popup_aide: id_aide}
	})
	.done(function(data) {
		var infos = JSON.parse(data);
		// console.log(data);
		$(".user_popup").html(infos[0]['prenom']+" "+infos[0]['nom']);
		$(".date_popup").html(infos[0]['date_aide']);
		$(".titreproblemos").html(infos[0]['titre']);
		$(".descproblemos").html(infos[0]['description']);
		$(".lien_cms").attr("href",infos[0]['adresse_cms']);
		$(".etat").html(infos[0]['etat_aide']);
		$(".etat").css("background",infos[0]['couleur']);
		$(".etat").css("color","white");
		var liste = "";
		for (var i = 1; i <= infos.length - 1; i++) {
			liste+='<li id="'+infos[i]['id_commentaires_aide']+'">';
			liste+='<div class="post__author author vcard inline-items">';
			liste+='<img src="'+infos[i]['photo']+'" alt="author">';
			liste+='<div class="author-date">';
			liste+='<a class="h6 post__author-name fn" href="02-ProfilePage.html">'+infos[i]['nom_commentaire']+'</a>';
			liste+='<div class="post__date">';
			liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
			liste+=''+infos[i]['date_commentaire']+'';
			liste+='</time>';
			liste+='</div></div>';
			liste+='</div>';
			liste+='<p>'+infos[i]['commentaire']+'</p>';
			liste+='<a href="#" class="post-add-icon inline-items like_commentaire_'+infos[i]['id_commentaires_aide']+'" '+infos[i]['like_test']+'>';
			liste+='<svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>';
			liste+='<span>'+infos[i]['like']+'</span>';
			liste+='</a>';
			liste+='</li>';
		}
		$(".comments-list").empty();
		$(".comments-list").append(liste);
	})
})


$(".aide_envoi").on('click', function(e){
	e.preventDefault();
	var mess = $(".envoi_message_aide").val();
	var id_aide_com = $(".id_aide").val();
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {envoi_com_aide: mess, id_aide_com:id_aide_com}
	})
	.done(function(data) {
		$(".envoi_message_aide").val('');
		$(".envoi_message_aide").html('');
		
	})
})

$('a.logout').on('click', function(){
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {logOut: '1'},
	})
	.done(function() {
		$(location).attr('href', 'login.php');
	})
	
})


//PARAM COMPTE
$('.changepassword').on('click', function(e){
	e.preventDefault();
	var lienAccount = $(this).attr('href');
	$.ajax({
		url: lienAccount,
		type: 'POST'
	})
	.done(function(data) {
		$('.ui-block.multitab').html('');
		$('.ui-block.multitab').append(data);
	})
})
$('.accountsetting').on('click', function(e){
	e.preventDefault();
	var lienAccount = $(this).attr('href');
	$.ajax({
		url: lienAccount,
		type: 'POST'
	})
	.done(function(data) {
		$('.ui-block.multitab').html('');
		$('.ui-block.multitab').append(data);
	})
})
$('.notification').on('click', function(e){
	e.preventDefault();
	var lienAccount = $(this).attr('href');
	$.ajax({
		url: lienAccount,
		type: 'POST'
	})
	.done(function(data) {
		$('.ui-block.multitab').html('');
		$('.ui-block.multitab').append(data);
	})
})




$('body').on('click', '.togglebutton .notifAccount', function(){
	if(!$(this).prev().prop('checked')){
		alert('oui');
		//recup quelles notifs l'utilisateur veut
	}else{
		//decochés
	}
})












$("body").on('click', "*[class*='like_commentaire_']", function(e){
	var check="like_commentaire_";
	var nb_like = $(this).find("span").html();
	var cls = $(this).attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	$.ajax({
		url: "formulaire.php",
		type: 'POST',
		context: this,
		data: {likelecommentaire:id_emet, nb_like:nb_like}
	})
	.done(function(data) {
		console.log(data);
		if (data == "ok") {
			$(this).css("fill", "#ff5e3a");
			$(this).css("color", "#ff5e3a");
			var valeur = $(this).find("span").html();
			$(this).find("span").html(valeur * 1 + 1 *1);
		}
	})
})

function charger_commentaires(){
	setTimeout( function(){
		if($("#problemos").is('[class*="show"]')){
			var check="dial_";
			var cls = $("#problemos").attr('class').split(' ');
			for (var i = 0; i < cls.length; i++) {
				if (cls[i].indexOf(check) > -1) {
					var id_emet = cls[i].slice(check.length, cls[i].length);
				}
			}
			var id_commentair = $("#problemos").find("li").last().attr('id');
			if(id_commentair==undefined){
				id_commentair=0;
			}
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {id_timer_aide: id_emet, id_timer_com:id_commentair},
			})
			.done(function(data) {
				var liste = "";
				var infos = JSON.parse(data);
				for (var i = 0; i <= infos.length - 1; i++) {
					liste+='<li id="'+infos[i]['id_commentaires_aide']+'">';
					liste+='<div class="post__author author vcard inline-items">';
					liste+='<img src="'+infos[i]['photo']+'" alt="author">';
					liste+='<div class="author-date">';
					liste+='<a class="h6 post__author-name fn" href="02-ProfilePage.html">'+infos[i]['nom_commentaire']+'</a>';
					liste+='<div class="post__date">';
					liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
					liste+=''+infos[i]['date_commentaire']+'';
					liste+='</time>';
					liste+='</div></div>';
					liste+='</div>';
					liste+='<p>'+infos[i]['commentaire']+'</p>';
					liste+='<a href="#" class="post-add-icon inline-items like_commentaire_'+infos[i]['id_commentaires_aide']+'" '+infos[i]['like_test']+'>';
					liste+='<svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg>';
					liste+='<span>'+infos[i]['like']+'</span>';
					liste+='</a>';
					liste+='</li>';
					var $target = $('.comments-list').parent(); 
					$target.animate({scrollTop: $(".comments-list").height()}, 200);
				}
				$(".comments-list").append(liste);

			})
		}
		charger_commentaires();
	}, 500);
}

<<<<<<< HEAD
=======
charger_commentaires();


$(".validation_aide_ok").on('click', function(e){
	e.preventDefault();
	var check="dial_";
	var cls = $("#problemos").attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {changement_etat_id_ok: id_emet}
	})
	.done(function() {
		swal(
			'Demande d\'aide résolue!',
			'L\'etat résolu va être partagé avec tout le monde!',
			'success'
			)
	})
})

$(".validation_aide_cours").on('click', function(e){
	e.preventDefault();
	var check="dial_";
	var cls = $("#problemos").attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {changement_etat_id_cours: id_emet}
	})
	.done(function() {
		swal(
			'Demande d\'aide en cours!',
			'L\'etat en cours va être partagé avec tout le monde!',
			'info '
			)
	})
})

$(".validation_aide_non").on('click', function(e){
	e.preventDefault();
	var check="dial_";
	var cls = $("#problemos").attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	$.ajax({
		url: 'formulaire.php',
		type: 'POST',
		data: {changement_etat_id_non: id_emet}
	})
	.done(function(data) {
		console.log(data);
		swal(
			'Demande d\'aide impossible!',
			'L\'etat impossible va être partagé avec tout le monde!',
			'error'
			)
	})
})
>>>>>>> ba1599bf14833e0bfec6c799265007f020cc7bc1
})