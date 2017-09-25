$(function(){


		//fonction pour check si le format d'email est valide
		function isValidEmailAddress(emailAddress) {
			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
			return pattern.test(emailAddress);
		};

		$(".connec").on('click', function(e){
			e.preventDefault();

				//var récup valeur de l'input email
				var emailAddress = $(".connexion .email").val();
				console.log(emailAddress);
		//comparaison entre la valeur du mail et le format
		if( !isValidEmailAddress(emailAddress) ) 			{
			$('.connexion .email').addClass('empty');
			console.log('mail non valide');
			$('.connexion .email').prev().html('Email pas bon');
		}else{
			$("form.connexion").submit();
			console.log('mail valide');
		}

	})

		$(".inscription").on('click', function(e){
			e.preventDefault();

		//var récup valeur de l'input email
		var emailAddress = $(".signin .email").val();

		var has_empty = false;

		$('.connect').find( 'input.check' ).each(function () {
			if (!$(this).val()){ 
				has_empty = true; 
				console.log('pas rempli');
				$(this).addClass('empty');
			}else{
				console.log('rempli!');
			}
		});

		if (has_empty == false){
			if(isValidEmailAddress(emailAddress)){
				if($('.signin').find(":selected").val() != 0){
					var poste = $('.form-control').find(":selected").text();
					$('.poste').html('').append(poste);
					console.log(poste);
					$.fancybox({
					href  : '#hidden-content-a', // Source of the content
					type : 'iframe',
					modal : true
				});

				}else{
					$('select.form-control[name="statut"]').addClass('empty');
				}
			}else{
				$('.email').prev().html('Email pas bon');
				console.log(emailAddress);
				$('.email').addClass('empty');
			}
		}else{
			$('.empty').addClass('empty');
		}

		return false;

	})
		$('.connect').on('keyup', '.empty', function(event) {
			$(this).addClass('onchange');
		});

		$('.submit').on('click', function(){
			var poste = $('.form-control').find(":selected").val();
			console.log(poste);
			var code = $('.code').val();
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {codeInput: code, jobUser : poste}
			})
			.done(function(data) {
				console.log(data);
			})
		})

	})