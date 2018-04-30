
		// init Isotope
		var $grid = $('#veille_code').isotope({
			itemSelector: '.element-item',
			masonry: 'layout'
		});

		$grid.imagesLoaded().progress( function() {
			$grid.masonry('layout');
		});

		$(function(){
// bind filter on select change
$('.filters-select').on('change', function() {
  // get filter value from option value
  var filterValue = $(this).val();
  $grid.isotope({ filter: filterValue });
});

function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 5; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	text += '-';

	return text;
}


$('body').on('click', '.keyword', function(){
	$(this).remove();
	$(this).parent('.form-group').find('search_veille').val('');
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {remove_search_veille: 'value1'},
	})
	.done(function(data) {
		var $data = $(data);
		$('#veille_code').html('');
		$('#veille_code').append( $data );
		$('#veille_code').masonry();
	})
})

$('.search_veille').keyup(function(e){
	e.preventDefault();
	e.stopPropagation();
	if(e.keyCode == 13){
		$(".hax-btn").click();
	}
});

$('.hax-btn').on('click', function(){
	var search = $(this).prev().val();
	console.log(search);
	if(search.length >= 3){
		$(this).parent().append('<p class="keyword">'+ search +'</p>');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {veille_search: search},
		})
		.done(function(data) {
			$('#veille_code').html('');
			$(data).appendTo('#veille_code');
		})
	}else{
		
	}
})

$('.trigger').on('click', function(){
	$('.toggle').slideToggle();
})

$('.accepter').on('click', function(){
	var id = $(this).attr('data-id');
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {accept_veille: id},
	})
	.done(function() {
		swal(
			'Veille acceptée !',
			).then(function(){
				location.reload();
			})
		})
})
$('.refuser').on('click', function(){
	var id = $(this).attr('data-id');
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {refuser_veille: id},
	})
	.done(function() {
		swal(
			'Veille refusée !',
			).then(function(){
				location.reload();
			})
		})
})


$(".reni_veille").on("click", function(){
	$(".help").find("input").val('');
	$(".help").find("select").val(0);
	$(".help").find("textarea").val('');
})

$('.valider_veille').on('click', function(e){
	e.preventDefault();
	var lienveille = $('.lienveille').val();
	var titreveille = $('.titreveille').val();
	var categorie = $('select.categorie').val();
	var file = $("#file-select").prop("files");
	var description = $('#description').val();
	var names = $.map(file, function (val) { return val.name; });
	var token = makeid();
	Cookies.set('token', token);
	if (titreveille.length >= 5) {
		$('.titreveille').removeClass('empty');
		if (categorie != 0) {
			$('.categorie').removeClass('empty');
			if (description.length >= 30) {
				$('#description').removeClass('empty');
				$.ajax({
					url: '../../formulaire.php',
					type: 'POST',
					data: {lienveille: lienveille, titreveille: titreveille, categorie_veille: categorie, description_veille: description, file_veille: names, token: token}
				})
				.done(function(data) {
					swal(
						'Veille ajoutée !',
						'',
						'success'
						).then(function(){
							location.reload();
						})		
					})
				$('#file-select').simpleUpload("../../uploads/upload.php", {

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
			$('.categorie').addClass('empty');
			$('.categorie').prev().html('Une catégorie est requise');
		}
	}else{
		$('.titreveille').addClass('empty');
		$('.titreveille').prev().html('5 caractères minimum requis');
	}
})
})