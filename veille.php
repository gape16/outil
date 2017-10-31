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

	$selection_categorie = $bdd->prepare("SELECT * FROM categorie_veille");
	$selection_categorie->execute();

	$selection_categorie2 = $bdd->prepare("SELECT * FROM categorie_veille");
	$selection_categorie2->execute();

	$selection_article_veille = $bdd->prepare("SELECT * FROM veille");
	$selection_article_veille->execute();

	$id_graph=$_SESSION['id_graph'];

	$query_notif_code=$bdd->prepare("SELECT * FROM veille where accept_veille = 1 order by id_veille DESC limit 1");
	$query_notif_code->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_veille'];
	$query_inser_code=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();

	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>

		<title>Veille</title>

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
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


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
		<?php 
		if($_SESSION['id_statut']==1) {
			//page graphistes 
			include('left_sidebar.php');
		}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
			include('left_sidebar_redac.php');
		}
		elseif ($_SESSION['id_statut']==3) {
			//page leader
			include('left_sidebar_leader.php');
		}elseif ($_SESSION['id_statut']==4) {
			//page controleur
			include('left_sidebar_controleur.php');
		}elseif($_SESSION['id_statut']==5){
			//page admin
			include('left_sidebar_admin.php');
		}
		?>

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
				<div class="content-bg bg-events"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Retrouvez toutes les veilles technologiques</h1>
							<p>Bienvenu sur la page de la veille technologique qui vous permettra de trouver un maximum d'informations sur les nouveautés sans aller sur le net!
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/event-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<div class="container">
			<div class="row">

				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="clients-grid">

						<ul class="cat-list-bg-style align-center sorting-menu">
							<li class="cat-list__item active" data-filter="*"><a href="#" class="">Toutes les catégories</a></li>

							<?php foreach ($selection_categorie2 as $key => $value) {?>
							<li class="cat-list__item" data-filter=".<?php echo($value['id_categorie_veille']) ?>"><a href="#" class=""><?php echo($value['categorie']) ?></a></li>
							<?php }
							?>
						</ul>
						<div class="row sorting-container" id="veille_code" data-layout="masonry">
							<?php foreach ($selection_article_veille as $key => $value) {?>
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 sorting-item <?php echo($value['categorie']) ?>">
								<div class="ui-block">
									<article class="hentry blog-post">
										<div class="post-thumb">
											<img src="uploads/veille/<?php echo($value['file']) ?>" alt="photo">
										</div>
										<div class="post-content">
											<a href="#" class="h4 post-title"><?php echo($value['titre']) ?></a>
											<p><?php echo($value['description']) ?>											</p>

											<div class="author-date not-uppercase">
												<div class="post__date">
													<time class="published" datetime="2017-03-24T18:18">
														<?php echo($value['date_veille']) ?>
													</time>
												</div>
											</div>
											<a class="post-add-icon inline-items like_veille_<?php echo($value['id_veille']) ?>" <?php if($value['like_veille'] != "0"){echo "style='fill: #ff5e3a;color: #ff5e3a;'";}?>><svg class="olymp-heart-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-heart-icon"></use></svg><span><?php echo($value['like_veille']) ?></span></a>
										</div>
									</article>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>





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
	<!-- <script src="js/chat.js"></script> -->
	<!-- Select / Sorting script -->
	<script src="js/selectize.min.js"></script>

	<!-- Swiper / Sliders -->
	<script src="js/swiper.jquery.min.js"></script>

	<script src="js/isotope.pkgd.min.js"></script>

	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>

	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>

	<script src="js/charte.js"></script>
	<script src="js/notifications.js"></script>

</body>
</html>
<?php }else{
	header('Location: login.php');
}
?>