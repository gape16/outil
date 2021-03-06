$(function() {
	//fonction pour check si le format d'email est valide
	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		text += '-';

		return text;
	}

//CONNEXION
$(".connec_first").on('click', function(e) {
	e.preventDefault();
		//var récup valeur de l'input email
		var emailAddress = $(".connexion_first .email").val();
		var token_first = $(".connexion_first .token_first").val();
		$('.connexion_first .email').removeClass('empty');
		$('.connexion_first .token_first').removeClass('empty');
		$('.connexion_first .email').prev().html('Ton Email');
		$('.connexion_first .token_first').prev().html('Ton code reçu par mail');
		// console.log(emailAddress);
		//comparaison entre la valeur du mail et le format
		if (!isValidEmailAddress(emailAddress)) {
			$('.connexion_first .email').addClass('empty');
		} else {
			$.ajax({
				url: '../formulaire.php',
				type: 'POST',
				data: {email_first: emailAddress, token_first:token_first}
			})
			.done(function(data) {
				if(data=="email introuvable"){
					$('.connexion_first .email').addClass('empty');
					$('.connexion_first .email').prev().html('Email introuvable');
				}
				if(data=="Code invalide"){
					$('.connexion_first .token_first').addClass('empty');
					$('.connexion_first .token_first').prev().html('Code invalide');
				}
				if(data=="ok"){
					$('.connexion_first .nouveau_pass1').show();
					$('.connexion_first .nouveau_pass2').show();
					$(".connec_first").removeClass('validation_mdp');
					$(".connec_first").addClass('validation_mdp');
				}
			})

		}
	})

$("body").on('click', '.validation_mdp', function(e){
	e.stopPropagation();
	e.preventDefault();
	var emailAddress = $(".connexion_first .email").val();
	var token_first = $(".connexion_first .token_first").val();
	var emailAddress = $(".connexion_first .email").val();
	var token_first = $(".connexion_first .token_first").val();
	var mdp2 = $(".connexion_first .mdp2").val();
	var mdp1 = $(".connexion_first .mdp1").val();
	$('.connexion_first .email').removeClass('empty');
	$('.connexion_first .mdp1').removeClass('empty');
	$('.connexion_first .mdp2').removeClass('empty');
	$('.connexion_first .token_first').removeClass('empty');
	$('.connexion_first .email').prev().html('Ton Email');
	$('.connexion_first .token_first').prev().html('Ton code reçu par mail');
		// console.log(emailAddress);
		//comparaison entre la valeur du mail et le format
		if (mdp1 == mdp2) {
			if (!isValidEmailAddress(emailAddress)) {
				$('.connexion_first .email').addClass('empty');
			} else {
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {email_first_mdp: emailAddress, token_first:token_first, mdp2:mdp2 , mdp1:mdp1}
				})
				.done(function(data) {
					$(location).attr('href', 'login.php');
					// console.log(data);
				})
			}
		}else{
			$(".connexion_first .mdp1").val('');
			$(".connexion_first .mdp2").val('');
			$('.connexion_first .mdp1').addClass('empty');
			$('.connexion_first .mdp2').addClass('empty');
			$('.connexion_first .mdp1').prev().html('les deux mots de passe ne sont pas identiques');
		}
	})

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
		url: '../formulaire.php',
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
	$(".no").remove();
	var emailforgot = $('input.forgotemail').val();
	if (!isValidEmailAddress(emailforgot)) {
		$('.forgotemail').addClass('empty');
	} else {
		console.log('mail valide');
		$('.forgotemail').css('display', 'none');
		$.ajax({
			url: '../formulaire.php',
			type: 'POST',
			data: {
				idForgot : emailforgot,
			}
		}).done(function(data) {
			if(data != ""){
			// console.log(data);
			$(".changement").html('Entrer le token');
			$('.token').css('display', 'block');
			$('.hidden').val(data);
			// console.log($('.token').val());
			$('.getpassword').css('display', 'none');
			$('.newpassword').css('display', 'block');
		}else{
			$('.forgotemail').css('display', 'block');
			$('.forgotemail').after("<p class='no' style='color:red;'>L'email n'est pas enregistré !</p>");
		}
	})
	}
})

//NEW PW
$('.newpassword').on('click', function(){
	data = $('.hidden').val();
	var emailforgot = $('input.forgotemail').val();
	new_d=$('.token').val().replace(' ','');;
	if(data == new_d){
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
					url: '../formulaire.php',
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
	var soprod = $('.soprod').val();
	var splitAdresseCms = 'cms.site-privilege.pagesjaunes.fr/workflow/service/';
	var splitAdresseSoprod = 'http://soprod3.pjms.intra/';

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		if(adresseCms.indexOf(splitAdresseCms) != -1){
			$('.adressecms').removeClass('empty');
			if (soprod.indexOf(splitAdresseSoprod) != -1) {
				$('.soprod').removeClass('empty');
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {numClient : numClient,
						raisonSociale : raisonSociale,
						adresseCms : adresseCms,
						soprod: soprod
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
				$('.soprod').addClass('empty');
				$('.soprod').prev().html('L\'adresse n\'est pas valide');
			}
		}else{
			$('.adressecms').addClass('empty');
			$('.adressecms').prev().html('L\'adresse n\'est pas valide');
			if(adresseCms = "http://cms.site-privilege.pagesjaunes.fr/pagesjaunes/"){
				$('.adressecms').prev().html('Il faut copier le lien de l\'onglet "Informations" du CMS');
			}
		}
	}else{
		$('.numclient').addClass('empty');
		$('.numclient').prev().html('Le numéro client n\'est pas valide');
	}

});

	//BIND ENTER TO LOG
	$(document).keypress(function(e) {
		if(e.which == 13) {
			$('#profile .connec').trigger('click');
		}
	})
	//BIND ENTER COMMENTAIRE
	// $("textarea.form-control.envoi_message_aide").keypress(function(e) {
	// 	if(e.which == 13) {
	// 		$(".aide_envoi").trigger( "click" );
	// 	}
	// }); 
	$("textarea.form-control.envoi_message_anniversaire").keypress(function(e) {
		if(e.which == 13) {
			$(".anniversaire_envoi").trigger( "click" );
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

//RESET
$(".reset_new_help").on('click', function(){
	$("select.categorie").val(0);
	$(".numclient").val('');
	$(".titre_probleme").val('');
	$(".adressecms").val('');
	$("#description").val('');
	$("#code").val('');
	$("input#file-select").val('');
	$('.form-group').removeClass('is-focused');
	$('.form-group').addClass('is-empty');
})

//ACHAT PHOTOS
$('.valider_achat').click(function(){
	var numClient = $('.numclient').val();
	var adresseGetty = $('.liengetty').val();
	var splitAdresseGetty = 'https://www.gettyimages.fr/collaboration/boards/';
	var descriptionProblem = $('textarea#description').val();

	var categorie = $('.categorie').val();
	var lien = $('.liengetty').val();
	var id_client = $('.numclient').val();

	if(numClient.length == 8 && $.isNumeric(numClient)){
		$('.numclient').removeClass('empty');
		$('.numclient').prev().html('Numéro client');
		if (categorie != 0) {
			$('.categorie').removeClass('empty');
			$('.categorie').prev().html('Catégorie du site');
			if(adresseGetty.indexOf(splitAdresseGetty) != -1){
				$('.liengetty').removeClass('empty');
				$('.liengetty').prev().html('Lien du tableau getty');
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {categorie: categorie,
						lien: lien,
						id_client: id_client
					}
				})
				.done(function() {
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
			$('.categorie').addClass('empty');
			$('.categorie').prev().html('Une catégorie est requise');
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


	if (etat_select == 0) {
		$('.etat_select').addClass('empty');
		$('.etat_select').prev().html('Un état est requis');
	}else{
		$('.etat_select').removeClass('empty');
		$('.etat_select').prev().html('Etat');
	}

		//SI REFUSE
		if (etat_select == 2) {
			if (commentaires.length >= 30)  {
				$('.commentaires').removeClass('empty');
				$('.commentaires').prev().html('Commentaire (obligatoire si commande refusée)');
				$.ajax({
					url: '../formulaire.php',
					type: 'POST',
					data: {achat_client: id_client, lien_wetrans: lien_we, commentaire_achat:commentaires, etat_achat: etat_select, achat : id_achat}
				})
				.done(function(data) {
					swal(
						'Refus transmis!',
						'Le graphiste va recevoir votre refus!',
						'error'
						).then(function () {
							location.reload();
						})
					})
			}else{
				$('.commentaires').addClass('empty');
				$('.commentaires').prev().html('30 caractères minimum requis');
			}
		}

		if (etat_select == 3) {
			$('.commentaires').removeClass('empty');
			$('.commentaires').prev().html('Commentaire (obligatoire si commande refusée)');
			if(lien_we.length != 0){
				$('.lien_we').removeClass('empty');
				$('.lien_we').prev().html('Lien weTransfer');
				$.ajax({
					url: '../formulaire.php',
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
			}else{
				$('.lien_we').addClass('empty');
				$('.lien_we').prev().html('Le lien n\'est pas valide');
			}
		}else{
			$('.commentaires').addClass('empty');
			$('.commentaires').prev().html('30 caractères minimum requis');
		}				
	})

//COUNT TEXTAREA
var text_min = 0;
$('#description').keyup(function() {
	var text_length = $('#description').val().length;
	var text_remaining = text_min + text_length;

	$('span.count').html(text_remaining);
});


$("body").on('click', ".moproblem", function(e){

	var id_aide = $(this).data("id");
	$(".id_aide").val(id_aide);
	$("#problemos").alterClass("dial_*", '');
	$("#problemos").addClass('dial_'+id_aide);
	charger_commentaires();
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		data: {popup_aide: id_aide}
	})
	.done(function(data) {
		var infos = JSON.parse(data);
		// console.log(infos);
		// console.log(infos.length);
		// console.log(data);
		$(".user_popup").html(infos[0]['prenom']+" "+infos[0]['nom']);
		$(".author").html(infos[0]['image_avatar']);
		$(".date_popup").html(infos[0]['date_aide']);
		$(".titreproblemos").html(infos[0]['titre']);
		$(".descproblemos").html(infos[0]['description']);
		$(".lien_cms").attr("href",infos[0]['adresse_cms']);
		$(".imgg").html("<a class='fancy-img' href='../uploads/help/"+infos[0]['capture']+"' data-fancybox><img src='../uploads/help/"+infos[0]['capture']+"'></a>");
		$(".etat").html(infos[0]['etat_aide']);
		$(".etat").css("background",infos[0]['couleur']);
		$(".etat").css("color","white");
		var liste = "";
		var total = infos.length*1 - 1*1;
		for (var i = 1; i <= total; i++) {
			liste+='<li id="'+infos[i]['id_commentaires_aide']+'">';
			liste+='<div class="post__author author vcard inline-items">';
			liste+='<a class="fancy-img" href="../uploads/template/previsualisation/" data-fancybox>';
			liste+='<img src="'+infos[i]['photo_avatar']+'" alt="author">';
			liste+='</a>';
			liste+='<div class="author-date">';
			liste+='<a class="h6 post__author-name fn">'+infos[i]['nom_commentaire']+'</a>';
			liste+='<div class="post__date">';
			liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
			liste+=''+infos[i]['date_commentaire']+'';
			liste+='</time>';
			liste+='</div></div>';
			liste+='</div>';
			liste+='<p>'+infos[i]['commentaire']+'</p>';
			liste+='<a class="post-add-icon inline-items com like_commentaire_'+infos[i]['id_commentaires_aide']+'" '+infos[i]['like_test']+'>';
			liste+='<svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>';
			liste+='<span>'+infos[i]['like']+'</span>';
			liste+='</a>';
			liste+='</li>';
		}
		$(".comments-list").empty();
		$(".comments-list").append(liste);

	})
})



$('a.logout').on('click', function(){
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		data: {logOut: '1'},
	})
	.done(function() {
		$(location).attr('href', '../login.php');
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














$("body").on('click', "*[class*='like_veille_']", function(e){
	var check="like_veille_";
	var nb_like = $(this).find("span").html();
	var cls = $(this).attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	$.ajax({
		url: "../formulaire.php",
		type: 'POST',
		context: this,
		data: {likelaveille:id_emet, nb_like_veille:nb_like}
	})
	.done(function(data) {
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
			var max = 0;
			$('#problemos li').each(function() {
				max = Math.max(this.id, max);
			});
			// console.log(max); 
			var id_commentair = max;
			if(id_commentair==undefined){
				id_commentair=0;
			}
			$.ajax({
				url: '../formulaire.php',
				type: 'POST',
				data: {id_timer_aide: id_emet, id_timer_com:id_commentair},
			})
			.done(function(data) {
				// console.log(data);
				var liste = "";
				var infos = JSON.parse(data);
				for (var i = 0; i <= infos.length - 1; i++) {
					liste+='<li id="'+infos[i]['id_commentaires_aide']+'">';
					liste+='<div class="post__author author vcard inline-items">';
					liste+='<img src="'+infos[i]['photo_avatar']+'" alt="author">';
					liste+='<div class="author-date">';
					liste+='<a class="h6 post__author-name fn">'+infos[i]['nom_commentaire']+'</a>';
					liste+='<div class="post__date">';
					liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
					liste+=''+infos[i]['date_commentaire']+'';
					liste+='</time>';
					liste+='</div></div>';
					liste+='</div>';
					liste+='<p>'+infos[i]['commentaire']+'</p>';
					liste+='<a class="post-add-icon inline-items com like_commentaire_'+infos[i]['id_commentaires_aide']+'" '+infos[i]['like_test']+'>';
					liste+='<svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-heart-icon"></use></svg>';
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
		url: '../formulaire.php',
		type: 'POST',
		data: {changement_etat_id_ok: id_emet}
	})
	.done(function() {
		swal(
			'Demande d\'aide résolue!',
			'L\'etat résolu va être partagé avec tout le monde!',
			'success'
			).then(function(){
				location.reload();
			})
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
		url: '../formulaire.php',
		type: 'POST',
		data: {changement_etat_id_cours: id_emet}
	})
	.done(function() {
		swal(
			'Demande d\'aide en cours!',
			'L\'etat en cours va être partagé avec tout le monde!',
			'info '
			).then(function(){
				location.reload();
			})
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
		url: '../formulaire.php',
		type: 'POST',
		data: {changement_etat_id_non: id_emet}
	})
	.done(function(data) {
		console.log(data);
		swal(
			'Demande d\'aide impossible!',
			'L\'etat impossible va être partagé avec tout le monde!',
			'error'
			).then(function(){
				location.reload();
			})
		})
})
})

var jour = $('.date-j').val();

if (jour >= 20) {
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		data: {mois_rappel: 'value'},
	})
	.done(function(data) {
		console.log(data);
		if (data == 0) {
			$('span.notif').css('display', 'flex');	
		}
	})
}





function charger_commentaires_anniversaire(){
	setTimeout( function(){
		if($("#anniversaire").is('[class*="show"]')){
			var check="dial_";
			var cls = $("#anniversaire").attr('class').split(' ');
			for (var i = 0; i < cls.length; i++) {
				if (cls[i].indexOf(check) > -1) {
					var id_emet = cls[i].slice(check.length, cls[i].length);
				}
			}
			var max = 0;
			$('#anniversaire li').each(function() {
				max = Math.max(this.id, max);
			});
			// console.log(max); 
			var id_commentair = max;
			if(id_commentair==undefined){
				id_commentair=0;
			}
			$.ajax({
				url: '../formulaire.php',
				type: 'POST',
				data: {id_timer_anniversaire: id_emet, id_timer_com:id_commentair},
			})
			.done(function(data) {
				var liste = "";
				var infos = JSON.parse(data);
				for (var i = 0; i <= infos.length - 1; i++) {
					liste+='<li id="'+infos[i]['id_commentaires_anniversaire']+'">';
					liste+='<div class="post__author author vcard inline-items">';
					liste+='<img src="'+infos[i]['photo_avatar']+'" alt="author">';
					liste+='<div class="author-date">';
					liste+='<a class="h6 post__author-name fn">'+infos[i]['nom_commentaire']+'</a>';
					liste+='<div class="post__date">';
					liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
					liste+=''+infos[i]['date_commentaire']+'';
					liste+='</time>';
					liste+='</div></div>';
					liste+='</div>';
					liste+='<p>'+infos[i]['commentaire']+'</p>';
					liste+='</li>';
					var $target = $('.comments-list').parent(); 
					$target.animate({scrollTop: $(".comments-list").height()}, 200);
				}
				$(".comments-list").append(liste);
			})
		}
		charger_commentaires_anniversaire();
	}, 500);
}

$("body").on('click', ".participer", function(e){
	var qui = $(this).parent().find('.author-name').html();
	var quand = $(this).parent().find('.birthday-date').html();
	$('#anniversaire .who').html('');
	$('#anniversaire .when').html('');
	$('#anniversaire .who').append(qui);
	$('#anniversaire .when').append(quand);
	var id_anniversaire = $(this).data("id");
	$(".id_anniversaire").val(id_anniversaire);
	$("#anniversaire").alterClass("dial_*", '');
	$("#anniversaire").addClass('dial_'+id_anniversaire);

	charger_commentaires_anniversaire();
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		data: {popup_anniversaire: id_anniversaire}
	})
	.done(function(data) {
		var infos = JSON.parse(data);
		var liste = "";
		var total = infos.length*1 - 1*1;
		console.log(infos.length);
		for (var i = 0; i <= total; i++) {
			liste+='<li id="'+infos[i]['id_commentaires_anniversaire']+'">';
			liste+='<div class="post__author author vcard inline-items">';
			liste+='<img src="'+infos[i]['photo_avatar']+'" alt="author">';
			liste+='<div class="author-date">';
			liste+='<a class="h6 post__author-name fn">'+infos[i]['nom_commentaire']+'</a>';
			liste+='<div class="post__date">';
			liste+='<time class="published" datetime="'+infos[i]['date_commentaire']+'">';
			liste+=''+infos[i]['date_commentaire']+'';
			liste+='</time>';
			liste+='</div></div>';
			liste+='</div>';
			liste+='<p>'+infos[i]['commentaire']+'</p>';
			liste+='</li>';
		}
		$(".comments-list").empty();
		$(".comments-list").append(liste);
	})
})

$(".anniversaire_envoi").on('click', function(e){
	e.preventDefault();
	var mess = $(".envoi_message_anniversaire").val();
	var id_anniversaire_com = $(".id_anniversaire").val();
	$.ajax({
		url: '../formulaire.php',
		type: 'POST',
		data: {envoi_com_anniversaire: mess, id_anniversaire_com:id_anniversaire_com}
	})
	.done(function(data) {
		$(".envoi_message_anniversaire").val('');
		$(".envoi_message_anniversaire").html('');
	})
})

$("input, textarea").on('keyup', function(){
	if($(this).html()!=""){
		$(this).parent().addClass('is-focused');
	}
}) 

$("input, textarea").on('blur', function(){
	if($(this).html()!=""){
		$(this).parent().addClass('is-focused');
	}
}) 

$('input.form-control, textarea').on('change', function(){
	$(this).removeClass('empty');
})