$(function(){



//BIND LES IMAGES AVEC LES INPUTS
$('a.lien-betheme').on('click', function(e){
	e.preventDefault();
	$('#betheme').trigger('click');
})
$('a.lien-previsu').on('click', function(e){
	e.preventDefault();
	$('#previsualisation').trigger('click');
})
$('a.lien-slider').on('click', function(e){
	e.preventDefault();
	$('#slider').trigger('click');
})

// AFFICHAGE DES INPUTS EN FONCTION DE LA CATEGORIE
$('#categorie').on('change', function(){
	if ($(this).val() == 1) {
		$('.wrapper-slider').css('display', 'flex');
		$('.wrapper-previsu').css('display', 'flex');
		$('.wrapper-betheme').css('display', 'none');
		$('.wrapper-betheme').css('display', 'none');
		$('.hide-label-shortcode').css('display', 'none');
	}
	if ($(this).val() == 2) {
		$('.wrapper-slider').css('display', 'none');
		$('.wrapper-previsu').css('display', 'flex');
		$('.wrapper-betheme').css('display', 'flex');
		$('#description, .hide-label-shortcode').css('display', 'flex');
	}
	if ($(this).val() == 3) {
		$('.wrapper-previsu').css('display', 'flex');
		$('.wrapper-betheme').css('display', 'flex');
		$('.wrapper-slider').css('display', 'none');
		$('#description, .hide-label-shortcode').css('display', 'flex');
	}
})

//AFFICHAGE DU NOM DU FICHIER UPLOADE
$('#slider').on('change', function(){
	var file_slider = $("#slider").prop("files");
	var names_slider = $.map(file_slider, function (val) { return val.name; });
	$('<p class="file">'+ names_slider + '</p>').appendTo('.wrapper-slider .need')
})

$('#previsualisation').on('change', function(){
	var file = $("input#previsualisation").prop("files");
	var names = $.map(file, function (val) { return val.name; });
	$('<p class="file">'+ names + '</p>').appendTo('.wrapper-previsu .need')
})

$('#betheme').on('change', function(){
	var file_betheme = $("#betheme").prop("files");
	var names_betheme = $.map(file_betheme, function (val) { return val.name; });
	$('<p class="file">'+ names_betheme + '</p>').appendTo('.wrapper-betheme .need')
})

$('.bloc_template').on('click', function(){

	var id_template = $(this).find('.id_template').val();
	var titre = $(this).find('.titre').val();
	var shortcode = $(this).find('.shortcode').val();
	var image = $(this).find('.image').val();
	var betheme = $(this).find('.betheme').val();
	var slider = $(this).find('.slider').val();
	var img_avatar = $(this).find('.photo').val();
	var whois = $(this).find('.nom').val();
	var time = $(this).find('time.published').html();
	var description = $(this).find('.description').val();

	$('#template .title').html(titre);
	$('#template .shortcode pre').html(shortcode);
	$('#template .description').html(description);
	$('#template .id_template').val(id_template);
	$('textarea#tt').val(description);
	$('#template a.img_betheme').attr('href', '../../uploads/template/betheme/' + betheme);
	$('#template .fancy-img').attr('href', '../../uploads/template/previsualisation/' + image);
	$('#template .fancy-img img').attr('src', '../../uploads/template/previsualisation/' + image);
	$('#template .img_avatar').attr('src', '../../' + img_avatar);
	$('#template .author.qui').html('<p class="who">' + whois + '</p><p class="when">' + time + '</p>');
	$('#template .slider-rev').attr('href', '../../uploads/template/slider/' + slider);

	$('.slider-rev').css('display', 'block');
	$('.img_betheme').css('display', 'block');
	$('.previsualisation').css('display', 'block');

	if (slider == 0) {
		$('.slider-rev').css('display', 'none');
	}else{
		$('a.copy').css('display', 'none');
		$('#shortcode_modal code').css('display', 'none');
	}
	if (betheme == 0) {
		$('.img_betheme').css('display', 'none');
	}else{
		$('a.copy').css('display', 'block');
		$('#shortcode_modal code').css('display', 'block');
	}
	if (shortcode == 0) {
		$('p.toggle_code').css('display', 'none');
	}else{
		$('p.toggle_code').css('display', 'block');
	}
})

$('.bloc_template_moderer').on('click', function(){
	var id_template = $(this).find('.id_template').val();
	var titre = $(this).find('.titre').val();
	var shortcode = $(this).find('.shortcode').val();
	var image = $(this).find('.image').val();
	var betheme = $(this).find('.betheme').val();
	var slider = $(this).find('.slider').val();
	var img_avatar = $(this).find('.photo').val();
	var whois = $(this).find('.nom').val();
	var time = $(this).find('time.published').html();
	var description = $(this).find('.description').val();

	$('#template_moderer .title').html(titre);
	$('#template_moderer .shortcode pre').html(shortcode);
	$('#template_moderer .description').html(description);
	$('#template_moderer .id_template').val(id_template);
	$('textarea#tt').val(description);
	$('#template_moderer a.img_betheme').attr('href', '../../uploads/template/betheme/' + betheme);
	$('#template_moderer .fancy-img').attr('href', '../../uploads/template/previsualisation/' + image);
	$('#template_moderer .fancy-img img').attr('src', '../../uploads/template/previsualisation/' + image);
	$('#template_moderer .img_avatar').attr('src', '../../' + img_avatar);
	$('#template_moderer .author.qui').html('<p class="who">' + whois + '</p><p class="when">' + time + '</p>');
	$('#template_moderer .slider-rev').attr('href', '../../uploads/template/slider/' + slider);

	$('.slider-rev').css('display', 'block');
	$('.img_betheme').css('display', 'block');
	$('.previsualisation').css('display', 'block');

	if (slider == 0) {
		$('.slider-rev').css('display', 'none');
	}else{
		$('a.copy').css('display', 'none');
		$('#shortcode_modal code').css('display', 'none');
	}
	if (betheme == 0) {
		$('.img_betheme').css('display', 'none');
	}else{
		$('a.copy').css('display', 'block');
		$('#shortcode_modal code').css('display', 'block');
	}
	if (shortcode == 0) {
		$('p.toggle_code').css('display', 'none');
		$('code.shortcode').css('display', 'none');
	}else{
		$('p.toggle_code').css('display', 'block');
	}
})

$("a.copy").on('click', function(){
	$('#tt').select();
	document.execCommand('copy');
});

function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 5; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	text += '-';

	return text;
}


$('.valider_template').on('click', function(e){
	e.preventDefault();
	e.stopPropagation();
	var categorie = $('#prop-template select#categorie').val();
	var titre = $('#prop-template .titre').val();
	var description = $('#prop-template #description').val();
	var shortcode = $('#prop-template #shortcode').val();
	var slider = $('#prop-template #slider').val();
	var previsualisation = $('#prop-template #previsualisation').val();
	var betheme = $('#prop-template #betheme').val();
	var token = makeid();
	Cookies.set('token', token);


	var file_betheme = $("#betheme").prop("files");
	var names_betheme = $.map(file_betheme, function (val) { return val.name; });

	var file_slider = $("#slider").prop("files");
	var names_slider = $.map(file_slider, function (val) { return val.name; });

	var file = $("input#previsualisation").prop("files");
	var names = $.map(file, function (val) { return val.name; });


	console.log(categorie);
	console.log(titre);
	console.log(description);
	console.log(shortcode);
	console.log(previsualisation);
	console.log(token);
	console.log(names_betheme);
	console.log(names_slider);
	console.log(names);

	if (categorie != 0) {
		$('select#categorie').removeClass('empty');
		if (titre.length >= 5) {
			$('.titre').removeClass('empty');
			if (categorie == 1) {
				if (previsualisation != 0) {
					$('.wrapper-previsu p.need').removeClass('empty-p');
					if (slider != 0) {
						$('.wrapper-slider p.need').removeClass('empty-p');
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {categorie_template: categorie, titre: titre, shortcode: shortcode, betheme: names_betheme, visu: names, slider: names_slider, token: token, description_template: description},
						})
						.done(function(data) {
							swal(
								'Template proposé !',
								).then(function(){
									location.reload();
								})
							})
					}else{
						$('.wrapper-slider p.need').addClass('empty-p');
						$('.wrapper-slider p.need').html('Veuillez uploader votre fichier ZIP slider');
					}
				}else{
					$('.wrapper-previsu p.need').addClass('empty-p');
					$('.wrapper-previsu p.need').html('Veuillez uploader votre image de prévisualisation');
				}
			}else if (categorie == 2 || categorie == 3) {
				$('select#categorie').removeClass('empty');
				if (shortcode != 0) {
					$('#description').removeClass('empty');
					$('#description').prev().html('Shortcode VC');
					if (betheme != 0) {
						$('.wrapper-betheme p.need').removeClass('empty-p');
						if (previsualisation != 0) {
							$('.wrapper-previsu p.need').removeClass('empty-p');
							$.ajax({
								url: '../../formulaire.php',
								type: 'POST',
								data: {categorie_template: categorie, titre: titre, shortcode: shortcode, betheme: names_betheme, visu: names, slider: names_slider, token: token, description_template: description},
							})
							.done(function(data) {
								swal(
									'Template proposé !',
									).then(function(){
										location.reload();
									})
								})
							$('#betheme').simpleUpload("../../uploads/upload_betheme.php", {

								start: function(file){
									//upload started
									console.log(file);
								},
								progress: function(progress){
									//received progress
									console.log(progress);
								},
								success: function(data){
									console.log(data);
								},
								error: function(error){
									//upload failed
									console.log(error);
								}
							});

							$('#slider').simpleUpload("../../uploads/upload_slider.php",{

								start: function(file){
									//upload started
									console.log(file);
								},
								progress: function(progress){
									//received progress
									console.log(progress);
								},
								success: function(data){
									console.log(data);
								},
								error: function(error){
									//upload failed
									console.log(error);
								}
							});

							$('input#previsualisation').simpleUpload("../../uploads/upload_template.php", {

								start: function(file){
									//upload started
									console.log(file);
								},
								progress: function(progress){
									//received progress
									console.log(progress);
								},
								success: function(data){
									console.log(data);
								},
								error: function(error){
									//upload failed
									console.log(error);
								}

							});
						}else{
							$('.wrapper-previsu p.need').addClass('empty-p');
							$('.wrapper-previsu p.need').html('Veuillez uploader votre image de prévisualisation');
						}
					}else{
						$('.wrapper-betheme p.need').addClass('empty-p');
						$('.wrapper-betheme p.need').html('Veuillez uploader votre fichier BeTheme');
					}
				}else{
					$('#description').addClass('empty');
					$('#description').prev().html('Le shortcode est nécessaire pour partager un template');
				}
			}
		}else{
			$('.titre').addClass('empty');
		}
	}else{
		$('select#categorie').addClass('empty');
	}	
});
$("[data-fancybox]").fancybox({
// Options will go here
});

$('.ok_template').on('click', function(){
	var id_template = $(this).parents('#template_moderer').find('.id_template').val();
	console.log(id_template);
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {id_template: id_template},
	})
	.done(function() {
		swal(
			'Template accepté',
			).then(function(){
				location.reload();
			})
		})			
})

$('.ko_template').on('click', function(){
	var id_template = $('#template_moderer .id_template').val();
	console.log(id_template);
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {refus_template: '0', id_template: id_template},
	})
	.done(function() {
		swal(
			'Template refusé',
			).then(function(){
				location.reload();
			})
		})
})

$('.toggle_code').on('click', function(){
	$('code.shortcode').slideToggle('medium', function() {
		if ($('code.shortcode').is(':visible')){
			$('code.shortcode').css('display','block');
		}else{
			$('code.shortcode').css('display','none');
		}
	});
})
})