<?php
// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 1 || $_SESSION['id_statut'] == 4) {
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
				$requete_etat = $bdd->prepare('SELECT id_etat, envoi_maquette, soprod from client where IDGPP = ?');
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
					.tt{
						background: #1d1f20;
						color: white;
						padding: 5px;
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
					.fp-slides{
						min-height: 600px;
					}
				</style>
			</head>
			<body>

				<?php 
				if($_SESSION['id_statut']==1) {
		//page graphistes 
					include('left_sidebar.php');
					include('header.php');
				}elseif  ($_SESSION['id_statut']==2){
		//page  redacteurs
					include('left_sidebar_redac.php');
					include('header_redac.php');
				}
				elseif ($_SESSION['id_statut']==3) {
		//page leader
					include('left_sidebar_leader.php');
					include('header_leader.php');
				}elseif ($_SESSION['id_statut']==4) {
		//page controleur
					include('left_sidebar_controleur.php');
					include('header_controleur.php');
				}elseif($_SESSION['id_statut']==5){
		//page admin
					include('left_sidebar_admin.php');
					include('header_admin.php');
				}
				?>


				<!-- Responsive Header -->

				<?php include('responsive_header.php');?>

				<!-- ... end Responsive Header -->


				<div class="container custom">
					<div class="row">
						<div id="fullpage">
							<div id="loader-wrapper">
								<div id="loader"></div>
								<input type="hidden" class="chrono">
								
								<div class="loader-section section-left"></div>
								<div class="loader-section section-right"></div>

							</div>
							<div class="section">
								<input class="idgpp" type="hidden" value="<?php echo $_GET['idgpp']; ?>">
								<input class="soprod" type="hidden" value="<?php echo $etat_test['soprod']; ?>">
								<input class="etat_final" type="hidden" value="<?php echo $etat_test['id_etat']; ?>">
								<?php 
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
														<div class="legend">
															<p class="legend"><span class="legend-level"></span>Important</p>
															<p class="legend"><span class="legend-level"></span>Moyen</p>
															<p class="legend"><span class="legend-level"></span>Faible</p>
														</div>
													</div>
												</div>
											</div>
											<div class="container custom">
												<div class="row">
													<?php foreach ($content as $card){ ?>
													<!-- point check -->
													<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_check card_<?php echo  $card['id_check']; ?>">
														<div class="flip-container">
															<div class="ui-block box-diagonal front <?php if ($etat_test['id_etat'] == 2 || $etat_test['id_etat'] == 5) { if($card['commentaire_graph'] != ""){echo 'box-orange';}}else{ if(isset($card['commentaire_controleur'])){if($card['commentaire_controleur']!=''){echo 'box-orange';}}} ?>">
																<div class="available-widget">
																	<div>
																		<div class="infos-check">
																			<h4 class="title"><span class="level"><?php echo $card['importance']; ?></span><?php echo  $card['titre']; ?></h4>
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
													if($etat_test['id_etat']>4){
														$tt=4;
													}else{
														$tt=1;
													}
													$content_fin = $bdd->prepare('SELECT * from pointcheck inner join controle on pointcheck.id_check = controle.id_check where '. $etat .' = ? and controle.id_gpp=? and commentaire_controleur != "" and controle.etat=?');
													$content_fin->bindParam(1, $valueetat);
													$content_fin->bindParam(2, $_GET['idgpp']);
													$content_fin->bindParam(3, $tt);
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
																<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 card_check card_<?php echo  $card['id_check']; ?>">
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
																									<?php if ($etat_test['id_etat'] == 1 || $etat_test['id_etat'] == 4) {?>
																									<input type="hidden" id="description_control" value="">
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
													<textarea name="" id="tt" cols="30" rows="10" style="opacity: 0;"></textarea>
												</div>
											</div>

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
											<?php 
											if($_SESSION['id_statut']==1) {
												?><script src="js/notifications.js"></script><?php
											}elseif  ($_SESSION['id_statut']==2){
												?><script src="js/notifications_redac.js"></script><?php
											}elseif ($_SESSION['id_statut']==3) {
												?><script src="js/notifications_leader.js"></script><?php
											}elseif ($_SESSION['id_statut']==4) {
												?><script src="js/notifications_controleur.js"></script><?php
											}elseif($_SESSION['id_statut']==5){
												?><script src="js/notifications_admin.js"></script><?php
											}
											?>
											<script>
												var startTime = 0
												var start = 0
												var end = 0
												var diff = 0
												var timerID = 0

												start = new Date();
												chrono();
												function chrono(){
													end = new Date()
													diff = end - start
													diff = new Date(diff)
													var sec = diff.getSeconds()
													var min = diff.getMinutes()
													var hr = diff.getHours()-1
													if (min < 10){
														min = "0" + min
													}
													if (sec < 10){
														sec = "0" + sec
													}
													var chrono_final = hr + ":" + min + ":" + sec;
													timerID = setTimeout("chrono()", 10);
													$(".chrono").val(chrono_final);
												}

												$(document).ready(function() {
													$('#fullpage').fullpage({
														scrollingSpeed: 300,
														css3: false,
														onSlideLeave: function( anchorLink, index, slideIndex, direction, nextSlideIndex){
															var leavingSlide = $(this);
															<?php if ($etat_test['id_etat'] != 3 && $etat_test['id_etat'] != 6) {?>
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
																			var soprod="";
																			var soprod_graph="";
																			var arraycom_graph= [];
																			var idGpp = $('.idgpp').val();
																			var chronoo=$(".chrono").val();
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
																					if($(this).find('#description_control').val()!=''){
																						var temp = $(this).find('h4').find('span').remove();
																						soprod+=$(this).find('h4').html()+" : "+$(this).find('#description_control').val()+"\n";
																					}
																					if($(this).find('#description_graph').val()!=''){
																						var temp = $(this).find('h4').find('span').remove();
																						soprod_graph+=$(this).find('h4').html()+" : "+$(this).find('#description_graph').val()+"\n";
																					}
																				}else{
																					idCheck.push(id_emet);	
																					valueCheck.push(0);	
																					arraycom_contr.push($(this).find('#description_control').val());
																					arraycom_graph.push($(this).find('#description_graph').val());	
																					if($(this).find('#description_control').val()!=''){
																						var temp = $(this).find('h4').find('span').remove();
																						soprod+=$(this).find('h4').html()+" : "+$(this).find('#description_control').val()+"\n";
																					}	
																					if($(this).find('#description_graph').val()!=''){
																						var temp = $(this).find('h4').find('span').remove();
																						soprod_graph+=$(this).find('h4').html()+" : "+$(this).find('#description_graph').val()+"\n";
																					}
																				}
																				i++;
																			});
																			if (etatFinal==2) {
																				var inputOptions = new Promise((resolve) => {
																					setTimeout(() => {
																						resolve({
																							'0': 'Process',
																							'1': 'Hors process'
																						})
																					}, 2000)
																				})

																				swal({
																					title: 'êtes vous sûr?',
																					text: "Vous allez finir le contrôle!",
																					type: 'warning',
																					showCancelButton: true,
																					confirmButtonColor: '#3085d6',
																					cancelButtonColor: '#d33',
																					confirmButtonText: 'Oui!',
																					allowEscapeKey: false,
																					allowOutsideClick : false,
																					allowEnterKey: false
																				}).then(function () {
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
																						buttonsStyling: false,
																						allowEscapeKey: false,
																						allowOutsideClick : false,
																						allowEnterKey: false
																					}).then(function () {
																						$.ajax({
																							url: 'formulaire.php',
																							type: 'POST',
																							data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"retour", chrono:chronoo},
																						})
																						.done(function(data) {
																							const {value: color} = swal({
																								title:'Votre projet est-il hors process ?',
																								input: 'radio',
																								inputOptions: inputOptions,
																								allowEscapeKey: false,
																								allowOutsideClick : false,
																								allowEnterKey: false
																							}).then(function (data) {
																								swal({
																									title:'Retour maquette!',
																									html:'La maquette va être renvoyée au graphiste !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod+'</pre>',
																									type:'success',
																									allowEscapeKey: false,
																									allowOutsideClick : false,
																									allowEnterKey: false
																								}).then(function (d) {
																									
																									var clone = $('.tt').html();
																									$('#tt').val(clone);
																									$("#tt").select();
																									document.execCommand( 'copy' );
																									if(data==1){
																											//hors process
																											var lien = $(".soprod").val();
																											var newLien = lien.replace("Operator","Consultation");
																											window.open(newLien);

																										}else{
																											//Process
																											var lien = $(".soprod").val();
																											var newLien = lien.replace("Consultation","Operator");
																											window.open(newLien);
																										}
																										$(location).attr('href', 'accueil.php');
																									})
																							})
																						})
																					}, function (dismiss) {
																						if (dismiss === 'cancel') {
																							$.ajax({
																								url: 'formulaire.php',
																								type: 'POST',
																								data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"ok", chrono:chronoo},
																							})
																							.done(function(data) {
																								swal({
																									title:'Validation faite!',
																									text:'le site passe en créa graph !',
																									type:'success',
																									allowEscapeKey: false,
																									allowOutsideClick : false,
																									allowEnterKey: false
																								}).then(function () {
																									const {value: color} = swal({
																										title:'Votre projet est-il hors process ?',
																										input: 'radio',
																										inputOptions: inputOptions,
																										allowEscapeKey: false,
																										allowOutsideClick : false,
																										allowEnterKey: false
																									}).then(function (data) {
																										if(data==1){
																											//hors process
																											var lien = $(".soprod").val();
																											var newLien = lien.replace("Operator","Consultation");
																											window.open(newLien);
																										}else{
																											//Process
																											var lien = $(".soprod").val();
																											var newLien = lien.replace("Consultation","Operator");
																											window.open(newLien);
																										}
																										$(location).attr('href', 'accueil.php');
																									})
																								})
																							})
																						}
																					})
})
}else if (etatFinal==5) {
	var inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'0': 'Process',
				'1': 'Hors process'
			})
		}, 2000)
	})
	swal({
		title: 'êtes vous sûr?',
		text: "Vous allez finir le contrôle!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oui!',
		allowEscapeKey: false,
		allowOutsideClick : false,
		allowEnterKey: false
	}).then(function () {
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
			buttonsStyling: false,
			allowEscapeKey: false,
			allowOutsideClick : false,
			allowEnterKey: false
		}).then(function () {
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"retour", chrono:chronoo},
			})
			.done(function(data) {
				const {value: color} = swal({
					title:'Votre projet est-il hors process ?',
					input: 'radio',
					inputOptions: inputOptions,
					allowEscapeKey: false,
					allowOutsideClick : false,
					allowEnterKey: false
				}).then(function (data) {
					swal({
						title:'Retour CQ!',
						html:'Le site va être renvoyé au graphiste !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod+'</pre>',
						type:'success',
						allowEscapeKey: false,
						allowOutsideClick : false,
						allowEnterKey: false
					}).then(function (d) {
						var clone = $('.tt').html();
						$('#tt').val(clone);
						$("#tt").select();
						document.execCommand( 'copy' );
						if(data==1){
							var lien = $(".soprod").val();
							var newLien = lien.replace("Operator","Consultation");
							window.open(newLien);

						}else{
							var lien = $(".soprod").val();
							var newLien = lien.replace("Consultation","Operator");
							window.open(newLien);
						}
						$(location).attr('href', 'accueil.php');
					})
				})
			})
		}, function (dismiss) {
			if (dismiss === 'cancel') {
				$.ajax({
					url: 'formulaire.php',
					type: 'POST',
					data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, envoi:"ok", chrono:chronoo},
				})
				.done(function(data) {
					swal({
						title:'Validation faite!',
						text:'le site part en validation !',
						type:'success',
						allowEscapeKey: false,
						allowOutsideClick : false,
						allowEnterKey: false
					}).then(function () {
						const {value: color} = swal({
							title:'Votre projet est-il hors process ?',
							input: 'radio',
							inputOptions: inputOptions,
							allowEscapeKey: false,
							allowOutsideClick : false,
							allowEnterKey: false
						}).then(function (data) {
							if(data==1){
								var lien = $(".soprod").val();
								var newLien = lien.replace("Operator","Consultation");
								window.open(newLien);
							}else{
								var lien = $(".soprod").val();
								var newLien = lien.replace("Consultation","Operator");
								window.open(newLien);
							}
							$(location).attr('href', 'accueil.php');
						})
					})
				})
			}
		})
	})
}else if(etatFinal==1){
	var inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'0': 'Process',
				'1': 'Hors process'
			})
		}, 2000)
	})
	swal({
		title: 'êtes vous sûr?',
		text: "Vous allez valider votre checklist!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oui, envoyer!',
		allowEscapeKey: false,
		allowOutsideClick : false,
		allowEnterKey: false
	}).then(function () {
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal, com_graph:arraycom_graph,com_contr:arraycom_contr, chrono:chronoo},
		})
		.done(function(d) {
			const {value: color} = swal({
				title:'Votre projet est-il hors process ?',
				input: 'radio',
				inputOptions: inputOptions,
				allowEscapeKey: false,
				allowOutsideClick : false,
				allowEnterKey: false
			}).then(function (data) {
				swal({
					title:'Validation faite!',
					html:'Votre maquette va être transmise aux contrôleurs !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod_graph+'</pre>',
					type:'success',
					allowEscapeKey: false,
					allowOutsideClick : false,
					allowEnterKey: false
				}).then(function (d) {
					var clone = $('.tt').html();
					$('#tt').val(clone);
					$("#tt").select();
					document.execCommand( 'copy' );
					if(data==1){
						var lien = $(".soprod").val();
						var newLien = lien.replace("Operator","Consultation");
						window.open(newLien);
					}else{
						var lien = $(".soprod").val();
						var newLien = lien.replace("Consultation","Operator");
						window.open(newLien);
					}
					$(location).attr('href', 'accueil.php');
				})
			})
		})
	})
}else if(etatFinal==4){
	var inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'0': 'Process',
				'1': 'Hors process'
			})
		}, 2000)
	})
	swal({
		title: 'êtes vous sûr?',
		text: "Vous allez valider votre checklist!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oui, envoyer!',
		allowEscapeKey: false,
		allowOutsideClick : false,
		allowEnterKey: false
	}).then(function () {
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal, com_graph:arraycom_graph, chrono:chronoo},
		})
		.done(function(data) {
			const {value: color} = swal({
				title:'Votre projet est-il hors process ?',
				input: 'radio',
				inputOptions: inputOptions,
				allowEscapeKey: false,
				allowOutsideClick : false,
				allowEnterKey: false
			}).then(function (data) {
				swal({
					title:'Validation faite!',
					html:'Votre site va être transmis aux contrôleurs !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod_graph+'</pre>',
					type:'success',
					allowEscapeKey: false,
					allowOutsideClick : false,
					allowEnterKey: false
				}).then(function (d) {
					var clone = $('.tt').html();
					$('#tt').val(clone);
					$("#tt").select();
					document.execCommand( 'copy' );
					if(data==1){
						var lien = $(".soprod").val();
						var newLien = lien.replace("Operator","Consultation");
						window.open(newLien);
					}else{
						var lien = $(".soprod").val();
						var newLien = lien.replace("Consultation","Operator");
						window.open(newLien);
					}
					$(location).attr('href', 'accueil.php');
				})
			})
		})
	})
}else if(etatFinal==3) {
	var inputOptions = new Promise((resolve) => {
		setTimeout(() => {
			resolve({
				'0': 'Process',
				'1': 'Hors process'
			})
		}, 2000)
	})
	swal({
		title: 'êtes vous sûr?',
		text: "Vous allez valider!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oui, envoyer!',
		allowEscapeKey: false,
		allowOutsideClick : false,
		allowEnterKey: false
	}).then(function () {
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, chrono:chronoo},
		})
		.done(function(data) {
			const {value: color} = swal({
				title:'Votre projet est-il hors process ?',
				input: 'radio',
				inputOptions: inputOptions,
				allowEscapeKey: false,
				allowOutsideClick : false,
				allowEnterKey: false
			}).then(function (data) {
				swal({
					title:'Renvoi fait!',
					html:'Votre maquette va être retransmise aux contrôleurs !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod_graph+'</pre>',
					type:'success',
					allowEscapeKey: false,
					allowOutsideClick : false,
					allowEnterKey: false
				}).then(function (d) {
					var clone = $('.tt').html();
					$('#tt').val(clone);
					$("#tt").select();
					document.execCommand( 'copy' );
					if(data==1){
						var lien = $(".soprod").val();
						var newLien = lien.replace("Operator","Consultation");
						window.open(newLien);
					}else{
						var lien = $(".soprod").val();
						var newLien = lien.replace("Consultation","Operator");
						window.open(newLien);
					}
					$(location).attr('href', 'accueil.php');
				})
			})
		})
	})
}else if(etatFinal==6) {
	swal({
		title: 'êtes vous sûr?',
		text: "Vous allez valider!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oui, envoyer!',
		allowEscapeKey: false,
		allowOutsideClick : false,
		allowEnterKey: false
	}).then(function () {
		$.ajax({
			url: 'formulaire.php',
			type: 'POST',
			data: {idCheck: idCheck, valueCheck: valueCheck, idGpp: idGpp,etatFinal:etatFinal,com_contr:arraycom_contr,com_graph:arraycom_graph, chrono:chronoo},
		})
		.done(function(data) {
			const {value: color} = swal({
				title:'Votre projet est-il hors process ?',
				input: 'radio',
				inputOptions: inputOptions,
				allowEscapeKey: false,
				allowOutsideClick : false,
				allowEnterKey: false
			}).then(function (data) {
				swal({
					title:'Site Renvoyé!',
					html:'Votre site va être retransmis aux contrôleurs !<br>N\'oubliez pas de collez dans Soprod:<br><pre class="tt">'+soprod_graph+'</pre>',
					type:'success',
					allowEscapeKey: false,
					allowOutsideClick : false,
					allowEnterKey: false
				}).then(function (d) {
					var clone = $('.tt').html();
					$('#tt').val(clone);
					$("#tt").select();
					document.execCommand( 'copy' );
					if(data==1){
						var lien = $(".soprod").val();
						var newLien = lien.replace("Operator","Consultation");
						window.open(newLien);
					}else{
						var lien = $(".soprod").val();
						var newLien = lien.replace("Consultation","Operator");
						window.open(newLien);
					}
					$(location).attr('href', 'accueil.php');
				})
			})
		})
	})
}
return false;
}


},

afterSlideLoad: function( anchorLink, index, slideAnchor, slideIndex){
	var loadedSlide = $(this);
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

$('.card_check').each(function(){
	var level = $(this).find('.level').html();
	if (level == "high") {
		$(this).find('.level').css('background-color', 'tomato');
	}
	if (level == "medium") {
		$(this).find('.level').css('background-color', '#ffb547');
	}
	if (level == "low") {
		$(this).find('.level').css('background-color', '#1ed760');
	}
//console.log(level);
})

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
	header('Location: accueil.php');
}
}else{
	header('Location: login.php');
}
?>