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
			$ig=utf8_decode($_GET['idgpp']);
			$requete_etat = $bdd->prepare('SELECT id_etat, envoi_maquette from client where IDGPP = ?');
			$requete_etat->bindParam(1, $ig);
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
					.btn-danger {
						color: #fff;
						background-color: #5cb85c !important;
						border-color: #5cb85c!important;
					}
					.btn-success {
						color: #fff;
						background-color: #d9534f!important;
						border-color: #d9534f!important;
					}
					.container.custom{
						max-width: 100%;
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
								<?php if($etat_test['envoi_maquette'] == $id_graph || $etat_test['envoi_maquette'] == 0){?>
								<input class="use" type="hidden" value="0">
								<?php }else{ ?>
								<input class="use" type="hidden" value="1">
								<?php } ?>
								<input class="etat_final" type="hidden" value="<?php echo $etat_test['id_etat']; ?>">
								<input class="use_nom" type="hidden" value="<?php echo $user['prenom']; ?> <?php echo $user['nom']; ?>">
								<?php 
								if($etat_test['envoi_maquette']==0){
									$ig=utf8_decode($_GET['idgpp']);
									$requete_up_pret = $bdd->prepare('UPDATE client set envoi_maquette=? where IDGPP = ?');
									$requete_up_pret->bindParam(1, $id_graph);
									$requete_up_pret->bindParam(2, $ig);
									$requete_up_pret->execute();
								}
								if ($etat_test['id_etat'] != 3 && $etat_test['id_etat'] != 6) {
									foreach ($requete as $key => $value) {
										$valueetat = 1;
										if ($etat_test['id_etat'] == 1 || $etat_test['id_etat'] == 4) {
											$content = $bdd->prepare('SELECT * from pointcheck where '. $etat .' = ? and id_categorie = ?');
											$content->bindParam(1, $valueetat);
											$content->bindParam(2, $value['id_categorie']);
											$content->execute();
										}else{
											$ig=$_GET['idgpp'];
											if($etat_test['id_etat']== 2 || $etat_test['id_etat'] == 3){
												$etat_control=1;
											}else{
												$etat_control=4;
											}
											$content = $bdd->prepare('SELECT * from pointcheck inner join controle on pointcheck.id_check = controle.id_check where '. $etat .' = ? and id_categorie = ? and controle.id_gpp=? and controle.etat = ?');
											$content->bindParam(1, $valueetat);
											$content->bindParam(2, $value['id_categorie']);
											$content->bindParam(3, $ig);
											$content->bindParam(4, $etat_control);
											$content->execute();
										}

										?>
										<div class="slide">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="ui-block">
													<div class="ui-block-title">
														<h3 class="title"><?php echo  $value['nom_categorie']; ?></h3>
													</div>
												</div>
											</div>
											<div class="container custom">
												<div class="row">
													<?php foreach ($content as $card){ ?>
													<!-- point check -->
													<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_<?php echo  $card['id_check']; ?>">
														<div class="flip-container">
															<div class="ui-block box-diagonal front <?php if ($etat_test['id_etat'] == 2 || $etat_test['id_etat'] == 5) { if($card['commentaire_graph'] != ""){echo 'box-orange';}}else{ if(isset($card['commentaire_controleur'])){if($card['commentaire_controleur']!=''){echo 'box-orange';}}} ?>">
																<div class="available-widget">
																	<div>
																		<div class="infos-check">
																			<h4 class="title"><?php echo  $card['titre']; ?></h4>
																			<img alt="" class="illu" src="<?php echo  $card['picto']; ?>">
																			<p class="desc"><?php echo $card['description'];?></p>
																		</div>
																		<label class="checkbox <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) { echo 'impossible'; }?> <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) { if($card['reponse']==1){echo 'box-valide ';}}?>">
																			<input name="optionsCheckboxes" type="checkbox" <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) {
																				if($card['reponse']==1){echo "checked ";}
																				echo "disabled";}?>>
																				<span class="checkbox-material"><span class="check"></span></span>
																				<div class="voirplus">
																					<a href="tuto.php?page=<?php echo  $card['id_check']; ?>" target="_blank">En savoir plus</a>
																				</div>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="ui-block box-diagonal back">
																	<div class="available-widget">
																		<div class="checkbox">
																			<h4 class="title">Votre commentaire</h4>
																			<div class="fermer">&#735;</div>
																			<div class="form-group label-floating is-empty">
																				<label class="control-label"></label>
																				<?php if($etat_test['id_etat'] == 1 || $etat_test['id_etat'] == 4){?>
																				<textarea name="description" id="description_graph" cols="30" rows="10"></textarea>
																				<?php }?>
																				<?php if ($etat_test['id_etat'] == 2 || $etat_test['id_etat'] == 5) {?>
																				<?php if($card['commentaire_graph'] != ""){echo "Commentaire Graph:<br><span style='color:red;'>".$card['commentaire_graph']."</span><br><br>";?>
																					réponse: <?php } ?>
																					<textarea name="description" id="description_control" cols="30" rows="10"><?php echo $card['commentaire_controleur'];?></textarea>
																					<input type="hidden" id="description_graph" value="<?php echo $card['commentaire_graph'];?>">
																					<?php }?>
																					<?php if ($etat_test['id_etat'] == 3 || $etat_test['id_etat'] == 6) {?>
																					<?php  if($card['commentaire_controleur'] != ""){ echo "Commentaire Contrôleur:<br><span style='color:red;'>".$card['commentaire_controleur']."</span><br><br>";?>
																						réponse: <?php }?>
																						<textarea name="description" id="description_graph" cols="30" rows="10"><?php echo $card['commentaire_graph'];?></textarea>
																						<input type="hidden" id="description_control" value="<?php echo $card['commentaire_controleur'];?>">
																						<?php }?>
																					</div>
																					<div class="voirplus">
																						<a href="tuto.php?page=<?php echo  $card['id_check']; ?>" target="_blank">En savoir plus</a>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<!--end point check-->
																</div>
																<?php }
																?>
																<!--end row au dessous-->	
															</div>
															<!-- end container-->
														</div>
														<!-- end slide-->
													</div>
													<?php }
												}else{
													$valueetat = 1;
													$content_fin = $bdd->prepare('SELECT * from pointcheck inner join controle on pointcheck.id_check = controle.id_check where '. $etat .' = ? and controle.id_gpp=? and commentaire_controleur != "" ');
													$content_fin->bindParam(1, $valueetat);
													$content_fin->bindParam(2, $_GET['idgpp']);
													$content_fin->execute();
													?>
													<div class="slide">
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="ui-block">
																<div class="ui-block-title">
																	<h3 class="title">Les retours contrôleurs</h3>
																</div>
															</div>
														</div>
														<div class="container custom">
															<div class="row">
																<?php foreach ($content_fin as $card){ ?>
																<!-- point check -->
																<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_<?php echo  $card['id_check']; ?>">
																	<div class="flip-container">
																		<div class="ui-block box-diagonal front <?php if(isset($card['commentaire_controleur'])){if($card['commentaire_controleur']!=''){echo 'box-orange';}} ?>">
																			<div class="available-widget">
																				<div>
																					<div class="infos-check">
																						<h4 class="title"><?php echo  $card['titre']; ?></h4>
																						<img alt="" class="illu" src="<?php echo  $card['picto']; ?>">
																						<p class="desc"><?php echo $card['description'];?></p>
																					</div>
																					<label class="checkbox <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) { echo 'impossible'; }?> <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) { if($card['reponse']==1){echo 'box-valide ';}}?>">
																						<input name="optionsCheckboxes" type="checkbox" <?php if ($etat_test['id_etat'] != 1 && $etat_test['id_etat'] != 4) {
																							if($card['reponse']==1){echo "checked ";}
																							echo "disabled";}?>>
																							<span class="checkbox-material"><span class="check"></span></span>
																							<div class="voirplus">
																								<a href="tuto.php?page=<?php echo  $card['id_check']; ?>" target="_blank">En savoir plus</a>
																							</div>
																						</label>
																					</div>
																				</div>
																			</div>
																			<div class="ui-block box-diagonal back">
																				<div class="available-widget">
																					<div class="checkbox">
																						<h4 class="title">Votre commentaire</h4>
																						<div class="fermer">&#735;</div>
																						<div class="form-group label-floating is-empty">
																							<label class="control-label"></label>
																							<?php if ($etat_test['id_etat'] == 2 || $etat_test['id_etat'] == 5) {?>
																							<?php if($card['commentaire_graph'] != ""){echo "Commentaire Graph:<br><span style='color:red;'>".$card['commentaire_graph']."</span><br><br>";?>
																								réponse: <?php } ?>
																								<textarea name="description" id="description_control" cols="30" rows="10"><?php echo $card['commentaire_controleur'];?></textarea>
																								<input type="hidden" id="description_graph" value="<?php echo $card['commentaire_graph'];?>">
																								<?php }?>
																								<?php if ($etat_test['id_etat'] == 3 || $etat_test['id_etat'] == 6) {?>
																								<?php  if($card['commentaire_controleur'] != ""){ echo "Commentaire Contrôleur:<br><span style='color:red;'>".$card['commentaire_controleur']."</span><br><br>";?>
																									réponse: <?php }?>
																									<textarea name="description" id="description_graph" cols="30" rows="10"><?php echo $card['commentaire_graph'];?></textarea>
																									<input type="hidden" id="description_control" value="<?php echo $card['commentaire_controleur'];?>">
																									<?php }?>
																								</div>
																								<div class="voirplus">
																									<a href="tuto.php?page=<?php echo  $card['id_check']; ?>" target="_blank">En savoir plus</a>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<!--end point check-->
																			</div>
																			<?php }
																			?>
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
											<script src="js/notifications.js"></script>
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
																<?php if ($etat_test['id_etat'] != 3 && $etat_test['id_etat'] != 6) {?>
													//leaving the first slide of the 2nd Section to the right
													if(index == 1 && slideIndex == 4 && direction == 'right'){
														<?php }else{?>		
															if(index == 1 && slideIndex == 0 && direction == 'right'){
																<?php }?>
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
																	if($(this).find('.checkbox').hasClass('box-valide')){
																		idCheck.push(id_emet);
																		valueCheck.push(1);
																		arraycom_contr.push($(this).find('#description_control').val());
																		arraycom_graph.push($(this).find('#description_graph').val());
																	}else{
																		idCheck.push(id_emet);	
																		valueCheck.push(0);	
																		arraycom_contr.push($(this).find('#description_control').val());
																		arraycom_graph.push($(this).find('#description_graph').val());		
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
																		confirmButtonText: 'Refuser',
																		cancelButtonText: 'accepter!',
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
													// console.log(data);
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
																}else if (etatFinal==5) {
																	swal({
																		title: 'Que voulez vous faire?',
																		text: "Vous ne pourrez pas revenir en arrière!",
																		type: 'warning',
																		showCancelButton: true,
																		confirmButtonColor: '#3085d6',
																		cancelButtonColor: '#d33',
																		confirmButtonText: 'Refuser',
																		cancelButtonText: 'accepter!',
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
												'Retour CQ!',
												'Le site va être renvoyée au graphiste !',
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
									  			'le site part en validation !',
									  			'success'
									  			).then(function () {
									  				$(location).attr('href', 'accueil.php');
									  				// console.log(data);
									  			})
									  		})
									  }
									})
																}else if(etatFinal==1){
																	swal({
																		title: 'êtes vous sûr?',
																		text: "Vous allez valider votre checklist!",
																		type: 'warning',
																		showCancelButton: true,
																		confirmButtonColor: '#3085d6',
																		cancelButtonColor: '#d33',
																		confirmButtonText: 'Oui, envoyer!'
																	}).then(function () {
																		$.ajax({
																			url: 'formulaire.php',
																			type: 'POST',
																			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal, com_graph:arraycom_graph},
																		})
																		.done(function(data) {
																			swal(
																				'Validation faite!',
																				'Votre maquette va être transmise aux contrôleurs !',
																				'success'
																				).then(function (data) {
																					$(location).attr('href', 'accueil.php');
																				})
																			})
																	})
																}else if(etatFinal==4){
																	swal({
																		title: 'êtes vous sûr?',
																		text: "Vous allez valider votre checklist!",
																		type: 'warning',
																		showCancelButton: true,
																		confirmButtonColor: '#3085d6',
																		cancelButtonColor: '#d33',
																		confirmButtonText: 'Oui, envoyer!'
																	}).then(function () {
																		$.ajax({
																			url: 'formulaire.php',
																			type: 'POST',
																			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal, com_graph:arraycom_graph},
																		})
																		.done(function(data) {
																			swal(
																				'Validation faite!',
																				'Votre site va être transmis aux contrôleurs !',
																				'success'
																				).then(function (data) {
																					$(location).attr('href', 'accueil.php');
																				})
																			})
																	})
																}else if(etatFinal==3) {
										//retour maquette
										$.ajax({
											url: 'formulaire.php',
											type: 'POST',
											data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph},
										})
										.done(function(data) {
											swal(
												'Renvoi maquette fait!',
												'La maquette va être renvoyée aux contrôleurs !',
												'success'
												).then(function () {
													$(location).attr('href', 'accueil.php');
												})
											})

									}else if(etatFinal==6) {
										//retour maquette
										$.ajax({
											url: 'formulaire.php',
											type: 'POST',
											data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph},
										})
										.done(function(data) {
											swal(
												'Renvoi CQ fait!',
												'Le site va être renvoyée aux contrôleurs !',
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
	}, 100);
	// if($('.etat_final').val() != 1){
		$(".flip-container").on("click", function (e) {
			$(this).addClass("flipped");
		});
		$(".fermer").on("click", function (e) {
			e.stopPropagation();
			$(this).parent().parent().parent().parent().removeClass("flipped");
		});
	// }

	$(".voirplus a").on('click', function(){
		var productLink = $(this);
		productLink.attr("target", "_blank");
		window.open(productLink.attr("href"));
	})

	$(".box-diagonal label").click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		if(!$(this).hasClass('impossible')){
			$(this).toggleClass("box-valide");
			$(this).find(".checkbox").toggleClass("clicked");
			if ($(this).find("input").attr('checked')) {
				$(this).find("input").removeAttr('checked');
			} else {
				$(this).find("input").attr("checked","true");
			}
		}
	});
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