$(function(){

	$(".inscription").on('click', function(e){
		e.preventDefault();

		//fonction pour check si le format d'email est valide
		function isValidEmailAddress(emailAddress) {
			var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
			return pattern.test(emailAddress);
		};
		//var récup valeur de l'input email
		var emailAddress = $(".email").val();
		//comparaison entre la valeur du mail et le format
		if( !isValidEmailAddress(emailAddress) ) { console.log("email faux"); }else{console.log('email vrai');}

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
				if($('select.form-control[name="statut"]').val() != 0){
					$("form.signin").submit();
				}else{
					$('select.form-control[name="statut"]').css('border', '1px solid red');
				}
			}else{
				$('.email').prev().html('Email pas bon').css('color', 'red');
			}
		}else{
			$('.empty').css('border', '1px solid red');
		}

	})
	$(document).on('key', '.empty', function() {
		$(this).css('border', '1px solid #e6ecf5');
	});
})