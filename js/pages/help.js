$(function(){


	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		text += '-';

		return text;
	}

	$('.show_code').on('click', function(){
		$('.code_wrapper').toggle();
	})

	$('ul.comments-list li').each(function(){
		console.log($(this).html());
		if(this.length <= 1){
			alert('lol');
			$('.comments-list li:first-child > a::after').css('display', 'none');
		}
	})

	$('.choose_answer').on('click', function(){
		var id_aide = $(this).attr('data-aide');
		var id_com = $(this).attr('data-id');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {best_answer_aide: id_aide, best_answer: id_com},
		})
		.done(function(data) {
			swal('Réponse acceptée !').then(function(){
				location.reload();
			})
		})
	})

	$('.annuler').on('click', function(){
		var id_aide = $(this).attr('data-aide');
		var id_com = $(this).attr('data-id');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {cancel_best_answer: id_aide, best_answer: id_com},
		})
		.done(function(data) {
			swal('Réponse acceptée !').then(function(){
				location.reload();
			})
		})
	})



//HELP
$('.valider_aide').click(function(e){
	e.preventDefault();
	var file = $("#file-select").prop("files");
	var names = $.map(file, function (val) { return val.name; });
	var numClient = $('.numclient').val();
	var titre = $('.titre_probleme').val();
	var adresseCms = $('.adressecms').val();
	var splitAdresseCms = 'cms.site-privilege.pagesjaunes.fr/workflow/service/';
	var descriptionProblem = $('textarea#description').val();
	var code = $('textarea#code').val();
	var token = makeid();
	Cookies.set('token', token);
	var categorie = $('select.categorie').val();

	if (categorie != 0) {
		$('select.categorie').removeClass('empty');
		$('select.categorie').css('color', '#464a4c');
		if(numClient.length == 8 && $.isNumeric(numClient)){
			$('.numclient').removeClass('empty');
			$('.numclient').prev().html('Numéro client');
			if(adresseCms.indexOf(splitAdresseCms) != -1){
				$('.adressecms').removeClass('empty');
				$('.adressecms').prev().html('Adresse CMS');
				if (titre.length >= 5) {
					$('.titre_probleme').removeClass('empty');
					$('.titre_probleme').prev().html('Titre du problème');
					if(descriptionProblem.length >= 140){
						$('textarea#description').removeClass('empty');
						$('textarea#description').prev().html('Description du problème');
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {aide: numClient,
								adresse_aide: adresseCms,
								descriptionProblem: descriptionProblem,
								capture: names,
								titre: titre,
								code: code,
								categorie: categorie,
								token: token
							}
						})
						.done(function(data) {
							console.log(data);
							swal(
								'Demande validée!',
								'Votre demande va être prise en compte!',
								'success'
								).then(function () {
									location.replace('help.php');
								})
							})
						$('#file-select').simpleUpload("../../uploads/upload_help.php", {

							start: function(file){
						//upload started
					},
					progress: function(progress){
						//received progress
					},
					success: function(data){
					},
					error: function(error){
						//upload failed
					}
				});
					}else{
						$('textarea#description').addClass('empty');
						$('textarea#description').prev().html('Il faut 140 caractères minimum dans votre déscription');
					}
				}else{
					$('.titre_probleme').addClass('empty');
					$('.titre_probleme').prev().html('5 caractères requis minimum');
				}
			}else{
				$('.adressecms').addClass('empty');
				$('.adressecms').prev().html('L\'adresse n\'est pas valide');
			}
		}else{
			$('.numclient').addClass('empty');
			$('.numclient').prev().html('Le numéro client n\'est pas valide');
		}
	}else{
		$('select.categorie').addClass('empty');
		$('select.categorie').css('color', 'tomato');
	}
})

$('.search').keyup(function(){
	var search = $(this).val();
	if(search.length >= 3){
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {search: search},
		})
		.done(function(data) {
			$('.newss').html('');
			$(data).appendTo('.newss');
		})
	}else{
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {search_empty: search},
		})
		.done(function(data) {
			$('.newss').html('');
			$(data).appendTo('.newss');
		})
	}
});

$(".aide_envoi").on('click', function(e){
	e.preventDefault();
	var mess = $(".envoi_message_aide").val();
	var id_aide_com = $(".id_aide").val();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {envoi_com_aide: mess, id_aide_com:id_aide_com}
	})
	.done(function(data) {
		$(".envoi_message_aide").val('');
		$(".envoi_message_aide").html('');
		location.reload();
	})
})


$(".reponse").on("click", function(){
	$('html,body').animate({ scrollTop: 9999 }, 'slow');
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
		url: "../../formulaire.php",
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

var idleTime = 0;
$(document).ready(function () {
                        //Increment the idle time counter every minute.
                         var idleInterval = setInterval(timerIncrement, 1000); // 1 minute

                        //Zero the idle timer on mouse movement.
                        $(this).mousemove(function (e) {
	        idleTime = 0;
    });
    $(this).keypress(function (e) {
	        idleTime = 0;
    });
});

function timerIncrement() {
	    idleTime = idleTime + 1;
	    if (idleTime > 300) { 
// 5 minutes
        window.location.reload();
    }
}
})
