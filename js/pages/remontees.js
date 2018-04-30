		// init Isotope
		var $grid = $('.grid').isotope({
			itemSelector: '.element-item',
		});




		$(function(){

			function makeid() {
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for (var i = 0; i < 5; i++)
					text += possible.charAt(Math.floor(Math.random() * possible.length));
				text += '-';

				return text;
			}


// bind filter on select change
$('body').on( 'change', '.filters-remontees', function() {
  // get filter value from option value
  var filterValue = $(this).val();
  $grid.isotope({ filter: filterValue });
  console.log(filterValue);
});

$('.valider_remontee').on('click', function(){
	var categorie = $('select.categorie').val();
	var titre = $('.titre').val();
	var description = $('#description').val();
	var file = $("#file-select").prop("files");
	var names = $.map(file, function (val) { return val.name; });
	var token = makeid();
	Cookies.set('token', token);

	if (categorie != 0) {
		$('.categorie').removeClass('empty');
		if (titre.length >= 5) {
			$('.titre').removeClass('empty');
			if (description.length >= 30) {
				$('#description').removeClass('empty');
				$.ajax({
					url: '../../formulaire.php',
					type: 'POST',
					data: {categorie_remontees: categorie, titre_remontees: titre, description_remontees: description, file: names, token: token},
				})
				.done(function(data) {
					swal(
						'Remontée effectuée',
						'Votre remontée sera étudiée sous peu',
						'success'
						).then(function(){
							location.reload();
						})		
					})
				$('#file-select').simpleUpload("../../uploads/upload_remontees.php", {

					start: function(file){
						//upload started
					},
					progress: function(progress){
						//received progress
					},
					success: function(data){
						console.log("upload successful!");
						console.log(data);
					},
					error: function(error){
						//upload failed
					}
				});
			}else{
				$('#description').addClass('empty');
				$('#description').prev().html('30 caractères minimum requis');
			}
		}else{
			$('.titre').addClass('empty');
			$('.titre').prev().html('5 caractères minimum requis');
		}
	}else{
		$('.categorie').addClass('empty');
		$('.categorie').prev().html('Une catégorie est requise');
	}
})

$('.reni').on('click', function(){
	$('select.categorie').val(0);
	$('.titre').val('');
	$('#description').val('');
})


$('.search').keyup(function(){
	var search = $(this).val();
	console.log(search);
	if(search.length >= 3){
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {remontees_search: search},
		})
		.done(function(data) {
			$('table.event-item-table tbody').html('');
			$(data).appendTo('table.event-item-table tbody');
		})
	}else{
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {remontees_search_empty: search},
		})
		.done(function(data) {
			$('table.event-item-table tbody').html('');
			$(data).appendTo('table.event-item-table tbody');
		})
	}
});
})