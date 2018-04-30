$(function(){
	$("body").on('click', ".confirmpw", function(){
		var passwordActuel = $('.mdpActuel').val();
		var password = $('.password').val();
		var passwordverify = $('.passwordverify').val();	
		if(password == passwordverify){
			$.ajax({
				url: '../../formulaire.php',
				type: 'POST',
				data: {
					ancienPasswordAccount: passwordActuel,newPasswordAccount : password
				}
			}).done(function(data) {
				if(data=="ok"){
					swal(
						'Modification effectuée!',
						'Votre mot de passe a bien été modifié!',
						'success'
						)
					$('.mdpActuel').val('');
					$('.password').val('');
					$('.passwordverify').val('');
				}else{
					swal(
						'Modification impossible!',
						'l\'ancien mot de passe ne doit pas être correct!',
						'error'
						)
					console.log(data);
				}
			})
		}else{
			$('.password').prev().html('Les mots de passe ne correspondent pas');
			$('.password').addClass('empty');
			$('.passwordverify').prev().html('Les mots de passe ne correspondent pas');
			$('.passwordverify').addClass('empty');
		}
	})

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		text += '-';

		return text;
	}

	$('.change_img').on('click', function(e){
		e.preventDefault();
		$('#file-s').trigger('click');
	})

	$('body').on('click', '.confirm_date', function(){
		var date = $(".date").val();
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {date_naissance: date},
		})
		.done(function(data) {
			swal(
				'Modification validée!',
				'Votre date de naissance a bien été changé!',
				'success'
				)
		})
	})

	$("body").on('click', '.accept_img', function (e){
		e.preventDefault();
		e.stopPropagation();
		var file = $('#file-s').prop("files");
		var names = $.map(file, function (val) { return val.name; });

		var token = makeid();
		Cookies.set('token', token);
		console.log(token);
		
		$('#file-s').simpleUpload("../../uploads/upload_avatar.php", {

			start: function(file){
									//upload started
									console.log(file);
								},
								progress: function(progress){
									//received progress
									// console.log(progress);
								},
								success: function(data){
									console.log(data);
									if (data != "") {
										swal(
											'Erreur!',
											'Votre image est trop lourde, maximum autorisé 100ko',
											'error'
											)
									}else{	
										swal(
											'validé!',
											'Votre avatar a bien été changé!',
											'success'
											).then(function(){
												$.ajax({
													url: '../../formulaire.php',
													type: 'POST',
													data: {file_avatar: names, token: token},
												})
											})

										}
									},
									error: function(error){
									//upload failed
									// console.log(error);
									// alert(error);
								}

							});
	})




})