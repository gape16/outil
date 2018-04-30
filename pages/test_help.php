<?php

// Connexion à la base de donnée et insertion de session_start
include('../connexion_session.php');


function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'an',
		'm' => 'mois',
		'w' => 'semaine',
		'd' => 'jour',
		'h' => 'heure',
		'i' => 'minute',
		's' => 'seconde',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? ' Il y a ' .implode(', ', $string) : 'maintenant';
}

// truncate string at word
function shapeSpace_truncate_string_at_word($string, $limit, $break = " ", $pad = "...") {  
	
	if (strlen($string) <= $limit) return $string;
	
	if (false !== ($max = strpos($string, $break, $limit))) {

		if ($max < strlen($string) - 1) {
			
			$string = substr($string, 0, $max) . $pad;
		}
		
	}
	return $string;
}

if (isset($_SESSION['id_statut'])) {
	if ($_SESSION['id_statut'] == 1 || $_SESSION['id_statut'] == 2 || $_SESSION['id_statut'] == 3 || $_SESSION['id_statut'] == 4) {

		if (isset($_GET['limite'])) {
			$limite=intval($_GET['limite'])-1;
		}else{
			$limite=0;
		}
		$query_select_aide = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC limit :offset, 10");
		$query_select_aide->bindValue('offset', $limite, PDO::PARAM_INT);
		$query_select_aide->execute();
		$id_graph=$_SESSION['id_graph'];
		$query_select_aide_limit = $bdd->prepare("SELECT * FROM aide inner join user on aide.id_user=user.id_user inner join etat_aide on aide.id_etat_aide = etat_aide.id_etat_aide order by date_aide DESC");
		$query_select_aide_limit->execute();
		$nb_limit=$query_select_aide_limit->rowCount();
		$query_notif_code=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
		$query_notif_code->execute();
		$query_featured=$bdd->prepare("SELECT commentaires_aide.id_aide, titre, date_aide, count(commentaires_aide.id_aide) as toto FROM aide inner join commentaires_aide on aide.id_aide = commentaires_aide.id_aide group by commentaires_aide.id_aide order by toto DESC limit 5");
		$query_featured->execute();
		$query_recent=$bdd->prepare("SELECT commentaires_aide.id_aide,commentaires_aide.id_aide, date_commentaire, titre FROM commentaires_aide left join aide on commentaires_aide.id_aide = aide.id_aide group by id_aide order by date_commentaire DESC limit 5");
		$query_recent->execute();
		$result_notif_code=$query_notif_code->fetch();
		$dernier=$result_notif_code['id_aide'];
		$query_inser_code=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
		$query_inser_code->bindParam(1, $dernier);
		$query_inser_code->bindParam(2, $id_graph);
		$query_inser_code->execute();
		?>

		<!DOCTYPE html>
		<html lang="fr">
		<head>

			<title>Demande d'aide</title>

			<!-- Required meta tags always come first -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="x-ua-compatible" content="ie=edge">

			<link rel="icon" type="image/png" href="img/favicon.png" />

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" type="text/css" href="../css/bootstrap-reboot.css">
			<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="../css/bootstrap-grid.css">

			<!-- Theme Styles CSS -->
			<link rel="stylesheet" type="text/css" href="../css/theme-styles.css">
			<link rel="stylesheet" type="text/css" href="../css/blocks.css">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.css">

			<!-- Main Font -->
			<script src="../js/webfontloader.min.js"></script>
			<script>
				WebFont.load({
					google: {
						families: ['Roboto:300,400,500,700:latin']
					}
				});
			</script>

			<link rel="stylesheet" type="text/css" href="../css/fonts.css">

			<!-- Styles for plugins -->
			<link rel="stylesheet" type="text/css" href="../css/jquery.mCustomScrollbar.min.css">
			<!-- Custom CSS -->
			<link rel="stylesheet" href="../css/main.css">
			<link rel="stylesheet" href="../css/jquery.fancybox.min.css">
			<style>
			.text				{
				max-width: 300px;
				word-wrap: break-word;
			}
		</style>
	</head>

	<body>

		<!-- NAV + HEADER -->
		<?php 
		include('../includes/left_sidebar.php');
		include('../includes/header.php');
		include('../includes/responsive_header.php');
		?>
		<!-- ... end NAV + HEADER -->

		<div class="header-spacer header-spacer-small"></div>


		<!-- Main Header Groups -->

		<div class="main-header">
			<div class="content-bg-wrap">
				<div class="content-bg bg-group"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 m-auto col-md-8 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Bienvenu au centre d'aide!</h1>
							<p>Vous avez un problème et vous ne savez pas comment le résoudre ou bien vous ne savez pas combien de temps cela va vous prendre ? Ne cherchez plus vous allez trouver votre bonheur ici !</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/group-bottom.png" alt="friends">
		</div>

		<!-- ... end Main Header Groups -->

		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="ui-block responsive-flex">
						<div class="ui-block-title">
							<div class="h6 title">Historique des demandes</div>
							<div class="align-right">
								<form class="w-search">
									<div class="form-group with-button">
										<input class="form-control search" type="text" placeholder="Rechercher...">
										<button>
											<svg class="olymp-magnifying-glass-icon"><use xlink:href="../icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
										</button>
									</div>
								</form>
								<a href="new_help.php" class="btn btn-blue btn-md">Demandez de l'aide</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="container">
			<div class="row">
				<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-xs-12">

					<div class="ui-block">
						

						<!-- Forums Table -->

						<table class="forums-table">

							<thead>

								<tr>

									<th class="forum">
										Sujet
									</th>

									<th class="topics">
										N° client
									</th>

									<th class="posts">
										Messages
									</th>

									<th class="freshness">
										derniers messages
									</th>

								</tr>

							</thead>

							<tbody class="newss">
								<?php
								foreach ($query_select_aide as $key => $value) {
									$id_aide=$value['id_aide'];
									$query_commentaire_nb=$bdd->prepare("SELECT id_commentaires_aide FROM commentaires_aide where id_aide = ?");
									$query_commentaire_nb->bindParam(1, $id_aide);
									$query_commentaire_nb->execute();
									$query_nb_com=$query_commentaire_nb->rowCount();
									$query_last_com=$bdd->prepare("SELECT * FROM commentaires_aide inner join user on commentaires_aide.id_user = user.id_user where id_aide = ? order by date_commentaire DESC limit 1");
									$query_last_com->bindParam(1, $id_aide);
									$query_last_com->execute();
									$last= $query_last_com->fetch();
									$date_tab=explode("-", $value['date_aide']);
									$jour_tab=explode(" ",$date_tab[2]);
									$jour=$jour_tab[0];

									$m=$date_tab[1];
									$months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Avr',5=>'Mai',6=>'Juin',7=>'Juil',8=>'Aout',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
									?>
									<tr>
										<td class="forum">
											<div class="forum-item">
												<div class="content">
													<a href="test_help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
													<p class="text"><?php echo shapeSpace_truncate_string_at_word(utf8_encode($value['description']),50);?></p>
												</div>
											</div>
										</td>
										<td class="topics">
											<a href="test_help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 count"><?php echo $value['id_client'];?></a>
										</td>
										<td class="posts">
											<a href="test_help_open.php?post=<?php echo $value['id_aide'];?>" class="h6 count"><?php echo $query_nb_com;?></a>
										</td>
										<td class="freshness">
											<div class="author-freshness">
												<div class="author-thumb">
													<?php if($query_nb_com==0){
														echo "Pas de message";
													}else{?>
													<img src="../<?php echo utf8_encode($last['photo']);?>" alt="author">
													<?php }?>
												</div>
												<?php if($query_nb_com!=0){?>
												<a href="#" class="h6 title"><?php echo utf8_encode($last['prenom'].$last['nom']);?></a>
												<time class="entry-date updated" datetime="2017-06-24T18:18"><?php echo time_elapsed_string($last['date_commentaire']);?></time>
												<?php }?>
											</div>
										</td>
									</tr>
									<?php }?>
									
								</tbody>
							</table>

							<!-- ... end Forums Table -->

						</div>


						<!-- Pagination -->

						<nav aria-label="Page navigation">
							<ul class="pagination justify-content-center">
								<li class="page-item <?php if(!isset($_GET['limite']) || $_GET['limite'] == 1){ echo 'disabled';}?>">
									<?php if(isset($_GET['limite'])){
										$limite=$_GET['limite']-9;
										?>
										<a class="page-link" href="test_help.php?limite=<?php echo $limite;?>" tabindex="-1">Précédent</a>
										<?php }else{?>
										<a class="page-link" href="#" tabindex="-1">Précédent</a>
										<?php }?>
									</li>
									<li class="page-item">
										<?php if(isset($_GET['limite'])){
											if($nb_limit-10>=$_GET['limite']){
												$limite=$_GET['limite']+9;
												?>
												<a class="page-link" href="test_help.php?limite=<?php echo $limite;?>">Suivant</a>
												<?php }}else{?>
												<a class="page-link" href="test_help.php?limite=<?php echo $$_GET['limite']+10;?>" tabindex="-1">Suivant</a>
												<?php }?>
											</li>
										</ul>
									</nav>

									<!-- ... end Pagination -->

								</div>

								<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12">
									<div class="ui-block">
										<div class="ui-block-title">
											<h6 class="title">Sujets favoris</h6>
										</div>
										<div class="ui-block-content">


											<!-- Widget Featured Topics -->

											<ul class="widget w-featured-topics">
												<?php foreach ($query_featured as $value) {?>
												<li>
													<i class="icon fa fa-star" aria-hidden="true"></i>
													<div class="content">
														<a href="test_help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
														<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_aide']) ;?></time>
													</div>
												</li>
												<?php }?>
											</ul>

											<!-- ... end Widget Featured Topics -->
										</div>
									</div>

									<div class="ui-block">
										<div class="ui-block-title">
											<h6 class="title">Sujets commentés récemment</h6>
										</div>
										<div class="ui-block-content">


											<!-- Widget Recent Topics -->

											<ul class="widget w-featured-topics">
												<?php foreach ($query_recent as $value) {
													?>
													<li>
														<div class="content">
															<a href="test_help_open.php?post=<?php echo $value['id_aide'] ;?>" class="h6 title"><?php echo utf8_encode($value['titre']);?></a>
															<time class="entry-date updated" datetime="$value['date_aide']"><?php echo time_elapsed_string($value['date_commentaire']) ;?></time>
														</div>
													</li>
													<?php }?>
												</ul>

												<!-- ... end Widget Recent Topics -->
											</div>
										</div>

									</div>

								</div>
							</div>



							<!-- ... end Window-popup-CHAT for responsive min-width: 768px -->
							<!-- jQuery first, then Other JS. -->
							<script src="../js/jquery-3.2.0.min.js"></script>
							<!-- Js effects for material design. + Tooltips -->
							<script src="../js/material.min.js"></script>
							<!-- Helper scripts (Tabs, Equal height, Scrollbar, etc) -->
							<script src="../js/theme-plugins.js"></script>
							<!-- Init functions -->
							<script src="../js/main.js"></script>
							<script src="../js/alterclass.js"></script>
							<!-- Select / Sorting script -->
							<script src="../js/selectize.min.js"></script>

							<link rel="stylesheet" type="text/css" href="../css/bootstrap-select.css">


							<script src="../js/mediaelement-and-player.min.js"></script>
							<script src="../js/mediaelement-playlist-plugin.min.js"></script>
							<script src="../https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>
							<script src="../js/simpleUpload.min.js"></script>
							<script src="../js/pages/help.js"></script>
							<script src="../js/charte.js"></script>
							<script src="../js/jquery.fancybox.min.js"></script>
							<?php 
							if($_SESSION['id_statut']==1) {
						//page graphistes 
								?><script src="../js/notifications.js"></script><?php
							}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
								?><script src="../js/notifications_redac.js"></script><?php
							}
							elseif ($_SESSION['id_statut']==3) {
						//page leader
								?><script src="../js/notifications_leader.js"></script><?php
							}elseif ($_SESSION['id_statut']==4) {
						//page controleur
								?><script src="../js/notifications_controleur.js"></script><?php
							}elseif($_SESSION['id_statut']==5){
						//page admin
								?><script src="../js/notifications_admin.js"></script><?php
							}
							?> 
						</body>
						</html>
						<?php }else{
							header('Location: help_admin.php');
						}
					}else{
						header('Location: ../login.php');
					}
					?>
