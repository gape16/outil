$(function(){

	//CACHER LA BRIQUE DE  L'UTILISATEUR
	$('.bd').each(function(){
		var id = $(this).find('.participer').attr('data-id');
		var id_graph = $('.who').val();

		if (id === id_graph) {
			$(this).hide();
		}
	})

	function charger_commentaires(){
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
				var id_commentair = max;
				if(id_commentair==undefined){
					id_commentair=0;
				}
				$.ajax({
					url: '../../formulaire.php',
					type: 'POST',
					data: {charger_com: id_emet, id_com:id_commentair},
				})
				.done(function(data) {
					var liste = "";
					var infos = JSON.parse(data);
					for (var i = 0; i <= infos.length - 1; i++) {

						liste+="<li class='com_anniv' id='"+infos[i]['id_commentaires']+"'>";
						liste+="<p class='auteur'> <img src='"+infos[i]['photo_avatar']+"' class='img_avatar'>"+ infos[i]['nom'] + "";
						liste+="<span class='date'>, "+infos[i]['date']+"</span>";
						liste+="</p>";
						liste+="<p class='msg'>"+infos[i]['msg']+"</p>";
						liste+="</li>";

						var $target = $('ul.com_anniv').parent(); 
						$target.animate({scrollTop: $(".com_anniv").height()}, 200);
					}
					$("ul.com_anniv").append(liste);
				})
			}
			charger_commentaires();
		}, 500);
	}

//CLIC SUR UNE PERSONNE
$('.participer').on('click', function(){
	charger_commentaires();
	var qui = $(this).parent().find('.author-name').html();
	var quand = $(this).parent().find('.birthday-date').html();
	var img = $(this).parent().find('.author-thumb img').attr('src');


		//RESET
		$('#anniversaire .who').html('');
		$('#anniversaire .when').html('');


		$('#anniversaire .who').append(qui);
		$('#anniversaire .who').append(qui);
		$('#anniversaire .when').append(quand);
		$('#anniversaire img.avatar').attr('src', img);

		var receveur = $(this).data('id');
		$('.hax-qui').val(receveur);
		$('.msg_gestionnaire').html('');

		//AFFICHE COM
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {receveur_anniv: receveur},
		})
		.done(function(data) {
			$('.com_anniv').html('');
			$('textarea.form-control.envoi_message_anniversaire').val('');
		})

		// SI IL Y A DEJA UN GESTIONNAIRE
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {msg_chef_anniv: receveur},
		})
		.done(function(data) {
			var data_anniv = JSON.parse(data);	
			var date_butoir = data_anniv[1];
			date_butoir = date_butoir.split(' ')[0];
			year = date_butoir.split('-')[0];
			month = date_butoir.split('-')[1];
			day = date_butoir.split('-')[2];

			$('.msg_gestionnaire').html('');
			$('.butoir').remove();

			$('.msg_gestionnaire').append(data_anniv[0]);
			$('.event-description').append('<div class="butoir" style="display: block;"><p>Date butoir : <br> <span class="date_butoir">' + day + '/' + month + '/' + year +'</span></p><a class="btn edit_msg">Modifier le message</a><a class="btn save_edit">Sauvegarder le message</a></div>');
		})

		// MSG + DATE	
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {receveur_gestion: receveur},
		})
		.done(function(data) {
			
		//SI IL N Y A PAS DE GESTIONNAIRE
		if (data == 1) {
			console.log('pas de msg');
			$('.butoir').remove();
		}else{
			$('a.btn.chef_anniv').css('display', 'none');
			$('.butoir').css('display', 'block');
			$('.wrapper_msg').css('display', 'block');
		}
	})

	//CHECK SI L'UTILISATEUR EST LE GESTIONNAIRE DE CETTE BRIQUE
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {user_gestion: receveur},
	})
	.done(function(data) {
		if (data==0) {
			$('a.btn.edit_msg').css('display', 'none');
		}
	})


	$('.wrapper_msg').css('display', 'none');
	$('.wrapper_anniv_cmd').css('display', 'none');
	$('a.btn.chef_anniv').css('display', 'block');

})

//AFFICHAGE DU CHAMP POUR ECRIRE ET SE DEFINIR COMME CHEF DE L'ANNIV
$('a.btn.chef_anniv').click(function(){
	$(this).fadeOut(10);
	$('.wrapper_msg').fadeIn(500);
	$('.wrapper_anniv_cmd').fadeIn(500);
	$('.msg_gestionnaire').attr('contenteditable', 'true');
})

//RESET CHAMP
$('.reni').on('click', function(){
	$('.msg_gestionnaire').html('');
})

//ENVOI DU MSG GESTIONNAIRE DANS LA DTB
$('.save').on('click', function(){
	var receveur = $(this).parents().find('.modal').attr('class');
	receveur = receveur.split('_')[1];
	var date = $(this).parent().find('.date_bday').val();
	var msg = $(this).parents('.modal').find('.msg_gestionnaire').html();

	console.log(receveur);
	console.log(date);
	console.log(msg);
	swal({
		title: 'Êtes-vous sur ?',
		text: "Vous allez devenir le gestionnaire de cet anniversaire",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#1ed760',
		cancelButtonColor: 'tomato',
		confirmButtonText: 'Oui'
	}).then(function () {
		swal(
			'Merci!',
			'Vous êtes maintenant le gestionnaire cet anniversaire'
			)
		$.ajax({
			url: '../../formulaire.php',
			context: this,
			type: 'POST',
			data: {receveur_chef_anniv: receveur, date_bday: date, message_anniv: msg},
		})
		.done(function(data) {					
			$('.msg_gestionnaire').append(data);
			$('.msg_gestionnaire').css('border', 'inherit');
			$('.msg_gestionnaire').attr('contenteditable', 'false');
			$('.wrapper_anniv_cmd').css('display', 'none');
			$('.butoir').css('display', 'block');

			$('.event-description').append('<div class="butoir" style="display: block;"><p>Date butoir : <br> <span class="date_butoir">'+ date +'</span></p><a class="btn edit_msg">Modifier le message</a><a class="btn save_edit">Sauvegarder le message</a></div>');
		})
	})

})

//BIND COMMENTAIRE
$(document).keypress(function(e) {
	if ($('.envoi_message_anniversaire').is(':focus') && e.which == 13) {
		$('.add-options-message').trigger('click');
	}
});

//ENVOI COMMENTAIRE
$('.add-options-message').on('click', function(){
	var receveur = $(this).parents().find('.modal').attr('class');
	receveur = receveur.split('_')[1];
	var commentaire = $('textarea.form-control.envoi_message_anniversaire').val();

	if (commentaire.length > 2) {
		$('.security').remove();
		$('.envoi_message_anniversaire').removeClass('empty');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {commentaire_anniv: commentaire, receveur: receveur},
		})
		.done(function(data) {
			$('.comments-list').append(data);
			$('textarea.form-control.envoi_message_anniversaire').val('');
		})
	}else{
		$('<p class="security">2 caractères minimum</p>').insertBefore('.envoi_message_anniversaire');
		$('.envoi_message_anniversaire').addClass('empty');
	}
	
})



//EDIT LE MSG SI ON EST GESTIONNAIRE
$('body').on('click', '.edit_msg', function(){
	var receveur = $(this).parents().find('.hax-qui').val();
	console.log('lolilol');
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {modif_msg: receveur},
	})
	.done(function(data) {
		console.log(data);
		if (data == 1) {
			$(this).hide();
			var date = $('.date_butoir').html();
			$('.date_butoir').remove();
			var inputDate = "<input type='date' class='change_date'>";
			$('.butoir p').append(inputDate);
			$('.change_date').val(date);
			$('.change_date').css('border', '1px solid rgba(255, 99, 71, 0.22)');
			$('.msg_gestionnaire').attr('contenteditable', 'true');

			var div = $('.msg_gestionnaire');
			setTimeout(function() {
				div.focus();
			}, 0);

			$('.save_edit').css('display', 'block');
		}else{
			alert('Tu ne t\'occupes pas de cet anniversaire');
		}
	})
})


//SAVE LE MSG ET LA DATE GESTIONNAIRE APRES EDIT
$('body').on('click', '.save_edit', function(){
	var msg = $('.msg_gestionnaire').html();
	var receveur = $(this).parents().find('.hax-qui').val();
	var newDate = $('input.change_date').val();
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {msg_after_edit: msg, receveur_after_edit: receveur, date: newDate},
	})
	.done(function(data) {
		$('.msg_gestionnaire').append(data);
		$('.msg_gestionnaire').css('border', 'inherit');
		$('.msg_gestionnaire').attr('contenteditable', 'false');
		$('.wrapper_anniv_cmd').css('display', 'none');
		$('.butoir').remove();

		$('.event-description').append('<div class="butoir" style="display: block;"><p>Date butoir : <br> <span class="date_butoir">'+ newDate +'</span></p><a class="btn edit_msg">Modifier le message</a><a class="btn save_edit">Sauvegarder le message</a></div>');
	})
});

$(".switch_1").on('click', function(){
	var check="dial_";
	var cls = $(this).attr('class').split(' ');
	for (var i = 0; i < cls.length; i++) {
		if (cls[i].indexOf(check) > -1) {
			var id_emet = cls[i].slice(check.length, cls[i].length);
		}
	}
	if( $(this).is(':checked') ){
		$(this).parents(".ui-block").append("<div class='act'><p style='margin:auto;color:white;'>Vous serez notifié pour cette personne</p></div>");
		setTimeout(function(){
			$(".act").animate({ opacity: 0 }, 2000 , "linear", function() {
				$( this ).remove();
			});
		}, 1000);
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {id_anniv_notif: id_emet, active_anniv:1}
		})
		.done(function(data) {
			
		})
	}else{
		$(this).parents(".ui-block").append("<div class='act_n'><p style='margin:auto;color:black;'>Vous ne serez plus notifié pour cette personne</p></div>");
		setTimeout(function(){
			$(".act_n").animate({ opacity: 0 }, 2000 , "linear", function() {
				$( this ).remove();
			});
		}, 1000);
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {id_anniv_notif: id_emet, active_anniv:0}
		})
		.done(function(data) {
			
		})
	}
});

})