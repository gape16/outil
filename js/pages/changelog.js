$(function(){

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		text += '-';

		return text;
	}

	$('span.date').each(function(){
		var date = $(this).html();
		var newDate = date.split(' ', 1);
		$(this).html(newDate);
	})

	$('.valider_log').on('click', function(){	
		var categorie = $('select.categorie').val();
		var titre = $('.titre').val();
		var description = $('#description').val();
		var file = $("#file-select").prop("files");
		var names = $.map(file, function (val) { return val.name; });

		var token = makeid();
		Cookies.set('token', token);

		if (categorie != 0) {
			$('.categorie').removeClass('empty');
			if (titre.length >= 3) {
				$('.titre').removeClass('empty');
				if (description.length >= 5) {
					$.ajax({
						url: '../../formulaire.php',
						type: 'POST',
						processData: true,
						data: {categorie_log: categorie, titre: titre, description: description, file_log: names, token: token},
					})
					.done(function(data) {
						swal(
							'Log ajouté !',
							'',
							'success'
							).then(function(){
								location.reload();
							})	
						})
					$('#file-select').simpleUpload("../../uploads/upload_log.php", {

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


				})
				}else{
					$('#description').addClass('empty');
				}
			}else{
				$('.titre').addClass('empty');
			}
		}else{
			$('.categorie').addClass('empty');
		}

	})

});