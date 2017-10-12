<?php
// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {
	if (isset( $_GET['idgpp'])) {
		if ($_GET['idgpp']!="") {
			$id_graph=$_SESSION['id_graph'];
			$requete = $bdd->prepare('SELECT * from categorie');
			$requete->execute();
			$requete_user = $bdd->prepare('SELECT id_statut, nom, prenom from user where id_user = ?');
			$requete_user->bindParam(1, $id_graph);
			$requete_user->execute();
			$user= $requete_user->fetch();
			$requete_etat = $bdd->prepare('SELECT id_etat, envoi_maquette from client where IDGPP = ?');
			$requete_etat->bindParam(1, $_GET['idgpp']);
			$requete_etat->execute();
			$etat_test = $requete_etat->fetch();
			if($etat_test['id_etat']=='1'){
				$etat = 'maquette';
				$controle=0;
			}elseif ($etat_test['id_etat']==2 ){
				if($user['id_statut']!=1 && $user['id_statut']!=2) {
					$etat = 'maquette';
					$controle=1;
				}else {
					header('Location: accueil.php');
				}
			}elseif ($etat_test['id_etat']=='3') {
				$etat = 'maquette';
				$controle=0;
			}elseif ($etat_test['id_etat']=='4') {
				$etat = 'design';
				$controle=0;
			}elseif ($etat_test['id_etat']=='5'){
				if($user['id_statut']!='1' && $user['id_statut']!='2') {
					$etat = 'design';
					$controle=1;
				}else {
					header('Location: accueil.php');
				}
			}elseif ($etat_test['id_etat']=='6') {
				$etat = 'design';
				$controle=0;
			}
			?>
			<!DOCTYPE html>
			<html lang="en">
			<head>

				<title>Post Versions</title>

				<!-- Required meta tags always come first -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="x-ua-compatible" content="ie=edge">

				<!-- Main Font -->
				<script src="js/webfontloader.min.js"></script>
				<script>
					WebFont.load({
						google: {
							families: ['Roboto:300,400,500,700:latin']
						}
					});
				</script>

				<!-- Bootstrap CSS -->
				<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
				<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
				<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

				<!-- Theme Styles CSS -->
				<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
				<link rel="stylesheet" type="text/css" href="css/blocks.css">
				<link rel="stylesheet" type="text/css" href="css/fonts.css">

				<!-- Styles for plugins -->
				<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">

				<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">
				<!-- Lightbox popup script-->
				<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
				<!-- fullPageJS -->
				<link rel="stylesheet" href="css/jquery.fullPage.css">
				<!-- CUSTOM CSS -->
				<link rel="stylesheet" href="css/main.css">

				<style>
					body{
						overflow-y: hidden;
					}
				</style>
			</head>
			<body>

				<!-- Fixed Sidebar Left -->

				<?php include('left_sidebar.php');?>

				<!-- ... end Fixed Sidebar Left -->

				<!-- Fixed Sidebar Left -->

				<?php include('fixed_left_sidebar.php');?>

				<!-- ... end Fixed Sidebar Left -->

				<!-- Fixed Sidebar Right -->

				<?php include('fixed_sidebar_right.php');?>

				<!-- ... end Fixed Sidebar Right -->


				<!-- Header -->

				<?php include('header.php');?>

				<!-- ... end Header -->


				<!-- Responsive Header -->

				<?php include('responsive_header.php');?>

				<!-- ... end Responsive Header -->

				<!-- ... end Responsive Header -->


				<div class="container custom">
					<div class="row">
						<div id="fullpage">
							<div id="loader-wrapper">
								<div id="loader"></div>

								<div class="loader-section section-left"></div>
								<div class="loader-section section-right"></div>

							</div>
							<div class="section">
								<input class="idgpp" type="hidden" value="<?php echo $_GET['idgpp']; ?>">
								<input class="use" type="hidden" value="<?php echo $etat_test['envoi_maquette']; ?>">
								<input class="etat_final" type="hidden" value="<?php echo $etat_test['id_etat']; ?>">
								<input class="use_nom" type="hidden" value="<?php echo utf8_encode($user['prenom']); ?> <?php echo utf8_encode($user['nom']); ?>">
								<?php 
								if($etat_test['envoi_maquette']==0){
									$envoid=1;
									$requete_up_pret = $bdd->prepare('UPDATE client set envoi_maquette=?, id_graph_maquette=? where IDGPP = ?');
									$requete_up_pret->bindParam(1, $envoid);
									$requete_up_pret->bindParam(2, $id_graph);
									$requete_up_pret->bindParam(3, $_GET['idgpp']);
									$requete_up_pret->execute();
								}
								foreach ($requete as $key => $value) {
									$valueetat = 1;
									if ($etat_test['id_etat'] == 1 || $etat_test['id_etat'] == 4) {
										$content = $bdd->prepare('SELECT * from pointcheck where '. $etat .' = ? and id_categorie = ?');
										$content->bindParam(1, $valueetat);
										$content->bindParam(2, $value['id_categorie']);
										$content->execute();
									}else{
										$content = $bdd->prepare('SELECT * from pointcheck inner join controle on pointcheck.id_check = controle.id_check where '. $etat .' = ? and id_categorie = ? and controle.id_gpp=?');
										$content->bindParam(1, $valueetat);
										$content->bindParam(2, $value['id_categorie']);
										$content->bindParam(3, $_GET['idgpp']);
										$content->execute();
									}
									
									?>
									<div class="slide">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="ui-block">
												<div class="ui-block-title">
													<h3 class="title"><?php echo  utf8_encode($value['nom_categorie']); ?></h3>
												</div>
											</div>
										</div>
										<div class="container custom">
											<div class="row">
												<?php foreach ($content as $card){ ?>
												<!-- point check -->
												<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_<?php echo  utf8_encode($card['id_check']); ?>">
													<div class="ui-block">
														<div class="available-widget">
															<div class="checkbox">
																<label>
																	<h4 class="title"><?php echo  utf8_encode($card['titre']); ?></h4>
																	<img alt="" class="illu" src="<?php echo  utf8_encode($card['picto']); ?>">
																	<p class="desc"><?php echo  utf8_encode($card['description']); ?></p>
																	<?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) {?>
																	<div class="form-group label-floating com_contr" style="min-height: 80px;">
																		<label class="control-label">Commentaire contrôleur</label>
																		<textarea class="form-control" ></textarea>
																		<span class="material-input"></span>
																	</div>
																	<div class="form-group label-floating com_graph" style="min-height: 80px;">
																		<label class="control-label">Commentaire graphiste</label>
																		<textarea class="form-control" ></textarea>
																		<span class="material-input"></span>
																	</div>
																	<?php }?>
																	<input name="optionsCheckboxes" type="checkbox" <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) {
																		if($card['reponse']==1){echo "checked";}
																		echo "disabled";}?>>
																		<span class="checkbox-material"><span class="check"></span></span>
																		<div class="voirplus">
																			<a href="<?php echo  utf8_encode($card['lien']); ?>">En savoir plus</a>
																		</div>
																	</label>
																</div>
															</div>
														</div>
														<!--end point check-->
													</div>
													<?php } ?>
													<!--end row au dessous-->	
												</div>
												<!-- end container-->
											</div>
											<!-- end slide-->
										</div>
										<?php } ?>
										<!-- new slide -->
										<div class="slide">
											<!-- end slide-->
										</div>
									</div>
									<!-- end section-->
								</div>
								<!-- fullpage-->	
							</div>
						</div>
					</div>

					<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->

					<!-- jQuery first, then Other JS. -->
					<script src="js/jquery-3.2.0.min.js"></script>
					<!-- Js effects for material design. + Tooltips -->
					<script src="js/material.min.js"></script>
					<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
					<script src="js/theme-plugins.js"></script>
					<!-- Init functions -->
					<script src="js/main.js"></script>

					<!-- Select / Sorting script -->
					<script src="js/selectize.min.js"></script>

					<!-- Lightbox popup script-->
					<script src="js/jquery.magnific-popup.min.js"></script>
					<!-- Gif Player script-->
					<script src="js/jquery.gifplayer.js"></script>

					<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
					<script src="js/mediaelement-and-player.min.js"></script>
					<script src="js/mediaelement-playlist-plugin.min.js"></script>

					<script src="js/jquery.fullPage.min.js"></script>
					<script>
						$(document).ready(function() {
							use=$(".use").val();
							pren=$(".use_nom").val();
							if (use==1) {
								swal(
									'Client déjà en cours!',
									'le site est déjà en train d\'être checké par : '+pren+'',
									'warning'
									).then(function () {
										$(location).attr('href', 'accueil.php');
									  				// console.log(data);
									  			})
								}
								$('#fullpage').fullpage({
									onSlideLeave: function( anchorLink, index, slideIndex, direction, nextSlideIndex){
										var leavingSlide = $(this);

							//leaving the first slide of the 2nd Section to the right
							if(index == 1 && slideIndex == 4 && direction == 'right'){
								var checked = new Array();
								var i = 0;
								var idCheck = [];
								var valueCheck = [];
								var arrayCheck = [];
								var arraycom_contr = [];
								var arraycom_graph= [];
								var idGpp = $('.idgpp').val();
								var etatFinal = $('.etat_final').val();
								$("div[class*='card_']").each(function(){
									var check = "card_";
									checked[i] = new Array();
									var cls = $(this).attr('class').split(' ');
									for (var i = 0; i < cls.length; i++) {
										if (cls[i].indexOf(check) > -1) {
											var id_emet = cls[i].slice(check.length, cls[i].length);
										}
									} 
									if($(this).find('.checkbox').hasClass('clicked')){
										idCheck.push(id_emet);
										valueCheck.push(1);
										arraycom_contr.push($(this).find('.com_contr textarea').val());
										arraycom_graph.push($(this).find('.com_graph textarea').val());
									}else{
										idCheck.push(id_emet);	
										valueCheck.push(0);	
										arraycom_contr.push($(this).find('.com_contr textarea').val());
										arraycom_graph.push($(this).find('.com_graph textarea').val());		
									}
									i++;
								});
								if (etatFinal==2) {
									swal({
										title: 'Que voulez vous faire?',
										text: "Vous ne pourrez pas revenir en arrière!",
										type: 'warning',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Retour maquette',
										cancelButtonText: 'Maquette OK!',
										confirmButtonClass: 'btn btn-success',
										cancelButtonClass: 'btn btn-danger',
										buttonsStyling: false
									}).then(function () {
										//retour maquette
										$.ajax({
											url: 'formulaire.php',
											type: 'POST',
											data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"retour"},
										})
										.done(function(data) {
											swal(
												'Retour maquette!',
												'La maquette va être renvoyée au graphiste !',
												'success'
												).then(function () {
													$(location).attr('href', 'accueil.php');
												})
											})
									}, function (dismiss) {
									  // maquette ok
									  if (dismiss === 'cancel') {
									  	$.ajax({
									  		url: 'formulaire.php',
									  		type: 'POST',
									  		data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"ok"},
									  	})
									  	.done(function(data) {
									  		swal(
									  			'Validation faite!',
									  			'le site passe en créa graph !',
									  			'success'
									  			).then(function () {
									  				$(location).attr('href', 'accueil.php');
									  				// console.log(data);
									  			})
									  		})
									  }
									})
								}else if(etatFinal==1){
									$.ajax({
										url: 'formulaire.php',
										type: 'POST',
										data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph},
									})
									.done(function(data) {
										swal(
											'Validation faite!',
											'Votre maquette va être transmise aux contrôleurs !',
											'success'
											).then(function () {
												$(location).attr('href', 'accueil.php');
											})
										})
								}
								return false;
							}


						},

						afterSlideLoad: function( anchorLink, index, slideAnchor, slideIndex){
							var loadedSlide = $(this);
    						//after loadin;g the 0th (first) slide
    						if (slideIndex == 0){
    							$('div.fp-controlArrow.fp-prev').hide()
    						} else {
    							$('div.fp-controlArrow.fp-prev').show()
    						}
    					}
    				});
});

$(document).ready(function() {
	setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#222222');
	}, 2000);

});
</script>
</body>
</html>
<?php 
}else{
	header('Location: accueil.php');
}
}else{
	header('Location: accueil.php');
}
}else{
	header('Location: login.php');
}
?>