$(function(){




	$('body').on('click', '.open_modal', function(){
		var id_remontees = $(this).parent().parent().find('.id_remontees').val();
		var kats = $(this).parent().parent().find('.kats').val();
		var commentaires = $(this).parent().parent().find('.commentaires').val();
		var description = $(this).parent().parent().find('input.description').val();
		var file = $(this).parent().parent().find('input.file').val();
		var day = $(this).parent().parent().find('.day').html();
		var month = $(this).parent().parent().find('.month').html();
		var who = $(this).parent().parent().find('.auteur').html();
		var rep = $(this).parent().parent().find('.id_rep').val();
		var title_sous = $(this).parent().parent().find('input.letitre').val();


		console.log(commentaires);
		console.log(kats);

		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {id_rep_remontees: rep, id_remontees: id_remontees},
		})
		.done(function(data) {
			console.log(data);
			var author = $(".get_author").html();
			$(".get_author").html(author + " " + data);
		})
		

		if (file === '') {
			$('a.fancy-img.img-link').css('display', 'none');
		}else{
			$('a.fancy-img.img-link').css('display', 'block');
		}

		if (kats == '') {
			$('a.kats-link').hide();
		}

		$('#modal_remontees span.day').html(' ');
		$('#modal_remontees span.month').html(' ');
		$('#modal_remontees .commentaires').html(' ');
		$('#modal_remontees p.description').html(' ');
		$('#modal_remontees .auteur').html(' ');
		$('#modal_remontees .title_sous').html(' ');

		$('.hax_id_remontees').val(id_remontees);
		$('#modal_remontees .kats').val(kats);
		$('#modal_remontees .kats-link').attr('href', kats);
		$('#modal_remontees .commentaires').val(commentaires);
		$('#modal_remontees p.description').append(description);
		$('#modal_remontees .auteur').append(who);
		$('#modal_remontees span.day').append(day);
		$('#modal_remontees span.month').append(month);
		$('#modal_remontees .title_sous').append(title_sous);
		$('#modal_remontees img.image_upload').attr('src', '../../uploads/remontees/' + file);
		$('#modal_remontees .img-link').attr('href', '../../uploads/remontees/' + file);
		$('.form-control').each(function(){
			$(this).parent().addClass('is-empty');
			$(this).parent().removeClass('is-focused');
			if($.trim($(this).val())!=''){
				$(this).parent().addClass('is-focused');
			}
		});
	})



	$('.cat-list__item').on('click', function(){
		var etat = $(this).data('filter');
		$('.event-item').css('display', 'table-row');
		$('.event-item').each(function(){
			if (!$(this).hasClass(etat)) {
				$(this).css('display', 'none');
			}
		})
	})
	$('.cat-list__item.active').on('click', function(){
		$('.search').val('');
		$('.event-item').css('display', 'table-row');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {admin_remontees_search_empty: 'value'},
		})
		.done(function(data) {
			$('table.event-item-table tbody').html('');
			$(data).appendTo('table.event-item-table tbody');
		})
	})


	$('.accepter_remontees').on('click', function(){
		var commentaire = $('textarea.commentaires').val();
		var id_remontees = $('.hax_id_remontees').val();
		var kats = $('#modal_remontees .kats').val();
		$('textarea.commentaires').removeClass('empty');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {commentaire_remontees: commentaire, id_remontees: id_remontees, kats: kats},
		})
		.done(function() {
			swal(
				'Remontée validée',
				'Le graph est notifié',
				'success'
				).then(function(){
					location.reload();
				})
			})
	})

	$('.refuser_remontees').on('click', function(){
		var commentaire = $('textarea.commentaires').val();
		var id_remontees = $('.hax_id_remontees').val();
		var kats = $('.kats').val();
		$('textarea.commentaires').removeClass('empty');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {commentaire_remontees_refus: commentaire, id_remontees: id_remontees, kats: kats},
		})
		.done(function(data) {
			swal(
				'Remontée refusée',
				'Le graph est notifié',
				'error'
				).then(function(){
					location.reload();
				})
			})
	})

	$('.traitement_remontees').on('click', function(){
		var commentaire = $('textarea.commentaires').val();
		var id_remontees = $('.hax_id_remontees').val();
		var kats = $('.kats').val();
		$('textarea.commentaires').removeClass('empty');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {commentaire_remontees_traitement: commentaire, id_remontees: id_remontees, kats: kats},
		})
		.done(function(data) {
			swal(
				'Remontée en traitement',
				'La remontée est en cours de traitement',
				'success'
				).then(function(){
					location.reload();
				})
			})
	})


	$('.search').keyup(function(){
		var search = $(this).val();
		if(search.length >= 3){
			$.ajax({
				url: '../../formulaire.php',
				type: 'POST',
				data: {admin_remontees_search: search},
			})
			.done(function(data) {
				$('table.event-item-table tbody').html('');
				$(data).appendTo('table.event-item-table tbody');
			})
		}else{
			$.ajax({
				url: '../../formulaire.php',
				type: 'POST',
				data: {admin_remontees_search_empty: search},
			})
			.done(function(data) {
				$('table.event-item-table tbody').html('');
				$(data).appendTo('table.event-item-table tbody');
			})
		}
	});
})