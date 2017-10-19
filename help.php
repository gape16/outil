<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = ".", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
		}
		
	}
	
	return $string;
	
}

if (isset($_SESSION['id_statut'])) {

	$query_select_aide = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC");
	$query_select_aide->execute();

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Friend Groups</title>

		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

		<!-- Main Font -->
		<script src="js/webfontloader.min.js"></script>
		<script>
			WebFont.load({
				google: {
					families: ['Roboto:300,400,500,700:latin']
				}
			});
		</script>

		<link rel="stylesheet" type="text/css" href="css/fonts.css">

		<!-- Styles for plugins -->
		<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/jquery.fancybox.min.css">

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


		<div class="header-spacer header-spacer-small"></div>


		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-music"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>N'hésitez plus, demandez de l'aide</h1>
							<p>C'est ici que vous allez pouvoir faire les demandes d'aide sur vos problèmes d'intégration</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/music-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<?php 
		// si c'est un graph qui se connect
		if ($_SESSION['id_statut'] == 1) {?>
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Demande d'aide</h6>
						</div>
						<div class="ui-block-content">
							<form class="form-group label-floating is-empty help form-reset">
								<div class="form-group is-empty label-floating ">
									<label class="control-label">Numéro client</label>
									<input class="form-control numclient" placeholder="" value="" type="text">
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Adresse CMS</label>
									<input class="form-control adressecms" placeholder="" value="" type="text">
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Titre du problème</label>
									<input class="form-control titre_probleme" placeholder="" value="" type="text">
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Description du problème</label>
									<textarea name="description" id="description" cols="30" rows="10"></textarea>
									<p><span class="count">0</span> / 140 caractères</p>
								</div>
								<div class="form-group label-floating is-empty">
									<input type="file" id="file-select" name="photos" multiple />
									<p id="status"></p>
								</div>
							</form>
							<div class="row whitecolor">
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-secondary btn-lg full-width reset">Renitialiser</a>
								</div>
								<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a class="btn btn-green btn-lg full-width btn-icon-left valider_aide"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
									Valider la demande</a>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Historique des demandes d'aide</h6> 
							<div class="form-group label-floating is-empty">
								<label class="control-label">Recherche</label>
								<input class="form-control search" placeholder="" value="" type="text">
							</div>
						</div>
						<table class="event-item-table">
							<tbody>
								<?php foreach ($query_select_aide as $key => $value) {
									$date_tab=explode("-", $value['date_aide']);
									$jour_tab=explode(" ",$date_tab[2]);
									$jour=$jour_tab[0];

									$m=$date_tab[1];
									$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

									?>
									<tr class="event-item">
										<td class="upcoming">
											<div class="date-event">
												<svg class="olymp-small-calendar-icon"><use xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
												<span class="day"><?php echo $jour;?></span>
												<span class="month"><?php echo $months[(int)$m]; ?></span>
											</div>
										</td>
										<td class="author">
											<div class="event-author inline-items">
												<div class="author-thumb">
													<img src="img/avatar43-sm.jpg" alt="author">
												</div>
												<div class="author-date">
													<a class="author-name h6"><?php echo utf8_encode($value['titre']);?></a>
												</div>

											</div>
										</td>
										<td class="location">
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<a target="_blank" style="color:inherit;"><?php echo $value['id_client'];?></a>
											</div>
										</td>
										<td class="description">
											<p class="description"><span style="font-weight: bold;">Description</span>: <?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
										</td>
										<td class="add-event">
											<a class="btn btn-breez btn-sm moproblem" data-toggle="modal" data-user="<?php echo utf8_encode($value['prenom'].' '.$value['nom']);?>" data-id="<?php echo utf8_encode($value['id_aide']);?>" data-target="#problemos" style="background:<?php echo $value['couleur'];?>;color:white;"><?php echo utf8_encode($value['etat_aide']);?></a>
										</td>

									</tr>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Window-popup Event Private Public -->
		<div class="modal fade show" id="problemos">
			<div class="modal-dialog ui-block window-popup event-private-public private-event">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>
				<article class="hentry post has-post-thumbnail thumb-full-width private-event">

					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<div class="post__author author vcard inline-items">
								<img src="img/author-page.jpg" alt="author">

								<div class="author-date">
									<a class="h6 post__author-name fn user_popup" href="#">USER</a>
									<div class="post__date date_popup">
										<time class="published" datetime="2017-03-24T18:18">
											DATE
										</time>
									</div>
								</div>

							</div>
							<h1 class="titreproblemos">
								Titre du probleme
							</h1>
							<p class="descproblemos">
								Hi Guys! I propose to go a litle earlier at the agency to have breakfast and talk a little more about the
								new design project we have been working on. Cheers!
							</p>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="event-description">
								<h6 class="event-description-title">Infos pratiques</h6>
								<div class="place inline-items">
									<div class="hax"><svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
										<a href="" style="color: inherit;" class="lien_cms"><span>Lien CMS</span></a></div>
										<div class="hax"><svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>

											<a href="" style="color: inherit;" class="lien_cms"><span>Lien CMS</span></a></div>
											<div class="hax"><svg class="olymp-add-a-place-icon"><use xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<span>Fichiers sources</span></div>
											</div>

											<a class="btn btn-green btn-sm full-width etat">Demande d'aide traitée</a>
										</div>

										
									</div>
								</div>

							</article>

							<div data-mcs-theme="dark" style="max-height: 300px;overflow-y: scroll;">

								<ul class="comments-list">

								</ul>

							</div>

							<form class="comment-form inline-items">

								<div class="post__author author vcard inline-items">
									<img src="img/author-page.jpg" alt="author">
								</div>

								<div class="form-group with-icon-right ">
									<textarea class="form-control envoi_message_aide" placeholder=""  ></textarea>
									<input type="hidden" class="id_aide">
									<div class="add-options-message">
										<a href="#" class="options-message aide_envoi">
											<svg class="olymp-camera-icon"><use xlink:href="icons/icons.svg#olymp-chat---messages-icon"></use></svg>
										</a>
									</div>

									<span class="material-input"></span><span class="material-input"></span></div>

								</form>
							</div>
						</div>


						<?php }?>
						<!-- ... end Window-popup Create Friends Group Add Friends -->

						<!-- Window-popup-CHAT for responsive min-width: 768px -->

						<?php include('chat_box.php');?>

						<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->


						<!-- jQuery first, then Other JS. -->
						<script src="js/jquery-3.2.0.min.js"></script>
						<!-- Js effects for material design. + Tooltips -->
						<script src="js/material.min.js"></script>
						<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
						<script src="js/theme-plugins.js"></script>
						<!-- Init functions -->
						<script src="js/main.js"></script>
						<script src="js/alterclass.js"></script>
						<script src="js/chat.js"></script>
						<!-- Select / Sorting script -->
						<script src="js/selectize.min.js"></script>

						<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


						<script src="js/mediaelement-and-player.min.js"></script>
						<script src="js/mediaelement-playlist-plugin.min.js"></script>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

						<script src="js/charte.js"></script>
						<script src="js/notifications.js"></script>

						<script>
							$('.reset').on('click', function(){
								$('.form-reset input').val('');
							})
							$('.search').keyup(function(){
								var search = $(this).val();
								if(search.length >= 3){
									$.ajax({
										url: 'formulaire.php',
										type: 'POST',
										data: {search: search},
									})
									.done(function(data) {
										console.log(data);
										$('table.event-item-table').html('');
										$(data).appendTo('table.event-item-table');
									})
								}else{
									$.ajax({
										url: 'formulaire.php',
										type: 'POST',
										data: {search_empty: search},
									})
									.done(function(data) {
										console.log(data);
										$('table.event-item-table').html('');
										$(data).appendTo('table.event-item-table');
									})
								}
							});
						</script>
					</body>
					</html>
					<?php }else{
						header('Location: login.php');
					}
					?>