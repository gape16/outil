<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

if (isset($_SESSION['id_statut'])) {
	// print_r($_POST);
	$query_=$bdd->prepare("SELECT id_user, nom, prenom FROM user");
	$query_->execute();
	$requete_proposition_ok = $bdd->prepare("SELECT id_proposition, date_proposition, num_client, lien_maquette, nom, prenom, id_gpp, proposition_design.id_user FROM proposition_design INNER JOIN user ON proposition_design.id_user = user.id_user");
	$requete_proposition_ok->execute();
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Controleur</title>
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
							<h1>Ici valide les designs pour les badges</h1>
							<p>C'est ici que vous allez pouvoir valider les design afin de distribuer des badges aux graphs
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/music-bottom.png" alt="friends">
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block">
						<div class="ui-block-title">
							<h6 class="title">Lien maquette</h6>
						</div>
						<div class="ui-block-content">
							<form method="POST" action="achat_photos.php" class="ajout_photo">
								<div class="form-group label-floating is-empty">
									<select name="" id="graphiste">
										<option value="0">Choisir un graphiste</option>
										<?php foreach ($query_ as $value): ?>
											<option value="<?php echo utf8_encode($value['id_user']);?>"><?php echo utf8_encode($value['nom'] .' '. $value['prenom']);?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Numero client</label>
									<input class="form-control numclient" type="text" placeholder="" name="id_client">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Lien maquette</label>
									<input class="form-control lienmaquette" type="text" placeholder="" name="id_client">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Lien CMS</label>
									<input class="form-control liencms" type="text" placeholder="" name="id_client">
									<span class="material-input"></span>
								</div>
							</form>


							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<a href="#" class="btn btn-green btn-lg full-width btn-icon-left valider_design"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
									Proposer la maquette</a>
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
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">Maquettes proposées</h6>
							<a href="#" class="showlastweek">Montrer la semaine en cours</a>
						</div>

						<table class="event-item-table" id="proposition_maquette">
							<tbody>
								<?php foreach ($requete_proposition_ok as $key => $value) {
									$date_tab=explode("-", $value['date_proposition']);
									$jour_tab=explode(" ",$date_tab[2]);
									$jour=$jour_tab[0];
									$semaine = date('W', strtotime($value['date_proposition']));

									$m=$date_tab[1];
									$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
									?>
									<tr class="event-item week_<?php echo $semaine;?>">
										<td class="upcoming">
											<div class="date-event">
												<svg class="olymp-small-calendar-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-small-calendar-icon"></use></svg>
												<span class="day"><?php echo $jour;?></span>
												<span class="month"><?php echo $months[(int)$m]; ?></span>
											</div>
										</td>
										<td class="author">
											<div class="event-author inline-items">
												<div class="author-thumb">
													<img src="img/avatar43-sm.jpg" alt="author" style="width:45px !important;">
												</div>
												<div class="author-date">
													<a class="author-name h6"><?php echo $value['num_client'] ?></a>
													<time class="published"><?php utf8_encode($value['nom']).' '. utf8_encode($value['prenom']) ?></time>
												</div>
											</div>
										</td>
										<td class="location">
											<div class="place inline-items">
												<svg class="olymp-add-a-place-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-add-a-place-icon"></use></svg>
												<a href="<?php echo $value['lien_maquette'] ?>" style="color: #9ea3b8;" target="_blank">Lien de la maquette</a>
											</div>
										</td>
										<td class="add-event">
											<a class="btn btn-breez btn-sm check_proposition" data-toggle="modal" data-id="<?php echo $value['id_gpp'] ?>" data-client="<?php echo $value['num_client'] ?>" data-target="#check_design" style="background: #9a9fbf;color: white;">En cours</a>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade show" id="check_design">
				<div class="modal-dialog ui-block window-popup edit-widget edit-widget-pool">
					<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
						<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
					</a>
					<div class="ui-block-title">
						<h6 class="title">Numéro client : </h6>
					</div>
					<div class="ui-block">
						<div class="ui-block-content">
							<div class="row modalcheck">	
								<div class="form-group is-empty label-floating ">
									<label class="control-label">Note sur /10</label>
									<input class="form-control note" placeholder="" value="" type="text">
								</div>
							</div>
							<div class="row">	
								<div class="col-lg-6 col-sm-12">
									<a href="#" data-dismiss="modal" class="btn btn-secondary btn-md full-width">Refuser</a>
								</div>

								<div class="col-lg-6 col-sm-12">
									<a href="#" data-dismiss="modal" class="btn btn-md full-width accept">Accepter</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


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


	<script>
		$(function(){
				//AJOUTER UN DESIGN
				$('.valider_design').on('click', function(e){
					e.preventDefault();
					var numClient = $('.numclient').val();
					var lienMaquette = $('.lienmaquette').val();
					var idUser = $('#graphiste').val();
					var adresseCms = $('.liencms').val();
					if(numClient.length == 8 && $.isNumeric(numClient)){
						$('.numclient').removeClass('empty');
						if(idUser != 0){
							$('#graphiste').removeClass('empty');
							if (lienMaquette.length != 0) {
								$('.lienmaquette').removeClass('empty');
								if (adresseCms.length != 0) {
									$('.liencms').removeClass('empty');
									var splitIgpp = adresseCms.split('cms.site-privilege.pagesjaunes.fr/workflow/service/');
									var idgpp = splitIgpp[1];
									var idgpp = idgpp.replace('/', '');
									console.log(idgpp);
									$.ajax({
										url: 'formulaire.php',
										type: 'POST',
										data: {numClient_controleur: numClient, lienMaquette: lienMaquette, idUser: idUser, idgpp_check: idgpp},
									})
									.done(function(data) {
										$(data).appendTo('#proposition_maquette tbody');
										swal(
											'Design validé',
											'La maquette est mise de côté',
											'success'
											)
										setTimeout(function(){
											location.reload();
										},1500);
									})
								}else{
									$('.liencms').addClass('empty');
									$('.liencms').prev().html("Lien CMS erroné");
								}
							}else{
								$('.lienmaquette').addClass('empty');
								$('.lienmaquette').prev().html("Un lien de maquette est requis");
							}
						}else{
							$('#graphiste').addClass('empty');
							$('#graphiste').prev().html("Un graphiste est requis");
						}
					}else{
						$('.numclient').addClass('empty');
						$('.numclient').prev().html("Le numéro client doit être à 8 chiffres");
					}
				});

				//MODAL
				$('.check_proposition').each(function(){
					var id = $(this).data('id');
					var num_client = $(this).data('client');
					$(this).on('click', function(){
						$('.modal h6.title').html(' ');
						$('.modal .accept').attr('data-id', id);
						$('.modal h6.title').append('Numéro client : ' + num_client);
					});
				});
				//ACCEPT PROPO
				$('.accept').on('click', function(e){
					var note = $('.note').val();
					var id = $(this).data('id');
					var num_client = $(this).data('client');
					e.preventDefault();
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {note: note, idgpp_check: id},
					})
					.done(function(data) {
						console.log(data);
					})
				});




				//AFFICHAGE SEMAINE EN COUR
				$('.showlastweek').on('click', function(e){
					e.preventDefault()
					$.ajax({
						url: 'formulaire.php',
						type: 'POST',
						data: {showWeek: 'value1'},
					})
					.done(function(data) {
						console.log(data);
						$('.event-item').each(function(){
							if ($(this).hasClass('week_'+ data +'')) {
								$(this).fadeIn();
							}else{
								$(this).fadeOut();
							}
						})
					})
				});
			});
		</script>
	</body>
	</html>
	<?php }else{
		header('Location: login.php');
	}
	?>