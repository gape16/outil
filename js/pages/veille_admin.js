	$(function(){
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
			if (titreveille.length >= 5) {
				$('.titreveille').removeClass('empty');
				if (categorie != 0) {
					$('.categorie').removeClass('empty');
					if (description.length >= 30) {
						$('#description').removeClass('empty');
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {lienveille: lienveille, titreveille: titreveille, categorie_veille: categorie, description_veille: description, file_veille: names}
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
						$('#file-select').simpleUpload("../../upload.php", {

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