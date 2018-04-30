			function isValidEmailAddress(emailAddress) {
				var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
				return pattern.test(emailAddress);
			};
			$(function(){
				$(".lemodal_moderation").on('click', function(){
					var moderation_modif_user = $(this).data('id');
					$.ajax({
						url: '../../formulaire.php',
						type: 'POST',
						data: {moderation_modif_user:moderation_modif_user}
					})
					.done(function(data) {
						$(".resultat_moderation").html(data);
					})
				})
				$(".search_user").on('keyup', function(){
					if($(this).val().length > 2){
						var search_user_moderation = $(this).val();
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {search_user_moderation: search_user_moderation}
						})
						.done(function(data) {
							$(".sortt li").css("border", "none");
							$(".sortt").css("border", "none");
							$(".sortt li").css("box-shadow", "none");
							$(".sortt ").css("box-shadow", "none");
							var infos = JSON.parse(data);
							for( var i = 0; i < infos.length; i++){
								$("#"+infos[i]).css('border','1px solid white');
								$("#"+infos[i]).css('box-shadow','0 0 35px black');
							}
						})							
					}else{
						$(".sortt li").css("border", "none");
						$(".sortt").css("border", "none");
						$(".sortt li").css("box-shadow", "none");
						$(".sortt ").css("box-shadow", "none");
					}
				})
				$(".sortt").sortable({
					connectWith: ".sortt",
					helper: "clone",
					appendTo: 'body',
					dropOnEmpty: true,
					placeholder: "ui-state-highlight",
					start: function( event, ui ) {
						$(".nouvv").remove();
						$(".sortt").prepend("<li class='nouvv lemodal_moderation'>+</li>");
					},
					stop: function( event, ui ) {
						$(".nouvv").remove();
					},
					receive: function(event, ui) {
						var newLead = this.id;
						var newGraph = ui.item.attr("id");
						var ancien_statut = ui.item.find(".temp_stat").val();
						var ancien_lead=ui.sender.attr("id");
						$(".nouvv").remove();
						if(newLead=="controlleur"){
							console.log("go control");
							$.ajax({
								url: '../../formulaire.php',
								type: 'POST',
								data: {newLeader_control: newLead, newGraph:newGraph, ancien_statut:ancien_statut}
							})	
						}else if(ancien_lead=="controlleur"){
							console.log(newLead);
							console.log(newGraph);
							console.log(ancien_statut);
							$.ajax({
								url: '../../formulaire.php',
								type: 'POST',
								data: {ancienLeader_control: newLead, newGraph:newGraph, ancien_statut:ancien_statut}
							})
						}else{
							console.log("equipe");
							console.log(newLead);
							console.log(newGraph);
							$.ajax({
								url: '../../formulaire.php',
								type: 'POST',
								data: {newLeader: newLead, newGraph:newGraph}
							})	
						}					
					}
				});
				$("body").on('click', '.modif_us', function(e){
					e.preventDefault();
					e.stopPropagation();
					$(".form_user").submit();
				})
				$("body").on('click', '.remove_us', function(e){
					e.preventDefault();
					e.stopPropagation();
					var id=$("#le_id").val();
					swal({
						title: 'êtes vous sûr?',
						text: "Vous allez supprimer l'utilisateur!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Oui!'
					}).then(function () {
						$.ajax({
							url: '../../formulaire.php',
							type: 'POST',
							data: {remove_user_moderation: id}
						})
						.done(function(data) {
							$("#"+id).remove();
							$('#problemos').modal('toggle');
						})
					})
				})
				$(".valid_user").on('click', function(e){
					e.preventDefault();
					email_check=$(".check_email").val();
					if (!isValidEmailAddress(email_check)) {
						$(".check_email").addClass('empty');
					}else{
						$(".check_email").removeClass('empty');
						if($(".check_nom").val()==""){
							$(".check_nom").addClass('empty');
						}else{
							$(".check_nom").removeClass('empty');
							if($(".check_prenom").val()==""){
								$(".check_prenom").addClass('empty');
							}else{
								$(".check_prenom").removeClass('empty');
								if($(".check_statut").val()=="0"){
									$(".check_statut").addClass('empty');
								}else{
									$(".check_statut").removeClass('empty');
									if($(".check_leader").val()=="0"){
										$(".check_statut").addClass('empty');
									}else{
										$(".user_form").submit();
											// console.log($(".check_statut").val());
											// console.log($(".check_leader").val());
										}
									}
								}
							}
						}
					})


				$('body').on('click', '.send_mail', function(){
					var id_graph = $('#le_id').val();
					var mail = $('.email').val();
					console.log(id_graph);
					console.log(mail);
					$.ajax({
						url: '../../formulaire.php',
						type: 'POST',
						data: {send_mail: id_graph, mail: mail},
					})
					.done(function(data) {
					})
					
				})

				$(".check_statut").on('change', function(){
					var statut_change=$(this).val();
					console.log(statut_change);
					$.ajax({
						url: '../../formulaire.php',
						type: 'POST',
						data: {statut_change: statut_change},
					})
					.done(function(data) {
						// alert(data);
						console.log(data);
						$("select[name='leader']").html(data);
					})					
				})
			})