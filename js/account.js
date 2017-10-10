$(function(){
	$("body").on('click', ".confirmpw", function(){
		var passwordActuel = $('.mdpActuel').val();
		var password = $('.password').val();
		var passwordverify = $('.passwordverify').val();	
		if(password == passwordverify){
			$.ajax({
				url: 'formulaire.php',
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
				}
			})
		}else{
			$('.password').prev().html('Les mot de passes ne correspondent pas');
			$('.password').addClass('empty');
			$('.passwordverify').prev().html('Les mot de passes ne correspondent pas');
			$('.passwordverify').addClass('empty');
		}
	})
})