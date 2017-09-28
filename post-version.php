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

	<!-- <div class="header-spacer custom"></div> -->


	<div class="container custom">
		<div class="row">
			<div id="fullpage">
				<div id="loader-wrapper">
					<div id="loader"></div>

					<div class="loader-section section-left"></div>
					<div class="loader-section section-right"></div>

				</div>
				<div class="section">
					<div class="slide">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h3 class="title">Header</h3>
								</div>
							</div>
						</div>
						<div class="container custom">
							<div class="row">
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Le favicon</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le favicon est-il identifiable et cohérent avec le logo et charte graphique du client ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">La barre d'action</h4>
													<img alt="" class="illu" src="img/exemple-barre-action.jpg">
													<p class="desc">La barre d'action permet-elle d'avoir les coordonées du client et un moyen de contact accessible rapidement ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Le logo</h4>
													<img alt="" class="illu" src="img/exemple-logo.jpg">
													<p class="desc">Le logo est-il détouré et exporté au bon format dans la bonne résolution ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Le menu</h4>
													<img alt="" class="illu" src="img/exemple-menu.jpg">
													<p class="desc">Le menu est il interactif afin de renseigner l'utilisateur ? (changement de couleur au hover, de taille, la li active a-t-elle une couleur, une graisse, une taille différente ?)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Les li du menu</h4>
													<img alt="" class="illu" src="img/exemple-li.jpg">
													<p class="desc">Les li du menu sont-elles alignées ou centrées verticalement par rapport au logo ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!--end row au dessous-->	
							</div>
							<!-- end container-->
						</div>
						<!-- end slide-->
					</div>
					<!-- new slide -->
					<div class="slide">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h3 class="title">Slider & images</h3>
								</div>
							</div>
						</div>
						<div class="container custom">
							<div class="row">
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Identification</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Peut-on identifier l'activité du client, son moyen de contact et sa localité/zone d'intervention au dessus de la ligne de flottaison ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Contact</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Peut-on contacter le client au dessus de la ligne de flottaison ? (soit barre d'action, soit slider)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Images</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les images sont-elles redimensionnées, compressées et exportées dans le bon format et aux bonnes dimensions et qui ne sont pas floues ? </p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!--end row au dessous-->	
							</div>
							<!-- end container-->
						</div>
						<!-- end slide-->
					</div>
					<!-- new slide -->
					<div class="slide">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h3 class="title">Body</h3>
								</div>
							</div>
						</div>
						<div class="container custom">
							<div class="row">
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Pertinence</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le design est-il pertinent avec l'activité du client ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Harmonie du design</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le design est il harmonieux dans son ensemble ? (bon compromis entre les images, les textes et les espaces blancs)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Couleurs</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le choix des couleurs est-il cohérent par rapport à la charte graphique du client ? (3 à 7 couleurs par site)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Typographie</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Utilisation pertinente de la typographie ? (3 typos max, jeu de contraste/couleur)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Les marges</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les marges sont-elles équilibrées et suffisantes pour permettre une lecture aisée ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Texture</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le design joue-t-il sur le relief, les textures, les fonds en aplat ou tramés ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Cohérence des PA</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les pages du sites sont elles cohérentes entre elles ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Footer</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le design du footer est-il équilibré ? A-t-il des icones, des jeux de couleur, de contraste ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!--end row au dessous-->	
							</div>
							<!-- end container-->
						</div>
						<!-- end slide-->
					</div>
					<!-- new slide -->
					<div class="slide">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h3 class="title">Responsive</h3>
								</div>
							</div>
						</div>
						<div class="container custom">
							<div class="row">
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Breakpoints</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le responsive a-t-il été verifié ? (laptop, 1024px, 768px, 767px et moins)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Grille</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">La grille est-elle respectée ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Burger menu</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">La couleur du burger menu est-elle cohérente avec le reste du site ? <br> L'ouverture du burger menu fonctionne t-elle ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Mise en page</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">La mise en page des différentes résolutions est-elle adaptée au support ? </p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Hierarchie de l'information</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">L'ordre texte > img est-il respecté ? (il faut alterner entre un texte et une image, ne pas avoir deux images à la suite)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">La lecture</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">La lecture est-elle facilitée par la design (Aligné à gauche, bloc suffisement large pour ne pas avoir que 2 ou 3 mots par lignes) </p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Titres</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les tailles des titres et du texte sont-elles adaptées au device ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Largeur</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Sur les petits devices, la largeur de la fenêtre est-elle utilisée à son maximum ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!--end row au dessous-->	
							</div>
							<!-- end container-->
						</div>
						<!-- end slide-->
					</div>
					<!-- new slide -->
					<div class="slide">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="ui-block">
								<div class="ui-block-title">
									<h3 class="title">UX</h3>
								</div>
							</div>
						</div>
						<div class="container custom">
							<div class="row">
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Elements interactifs</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les éléments cliquables ressortent-ils du design ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Navigation</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">La navigation est elle efficace ? (animations qui se déclenchent au bon moment, les ancres vont aux bons endroits, pas deux menus sur chaque pages, navigation pas trop longue etc)</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Contraste</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Le contraste entre le background et le texte est-il suffisant ? </p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Elements rédactionnels</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les éléments rédactionnels incitatifs sont ils mis en avant ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Label ou agrément</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Des éléments de type label ou agrément ou partenaires ou réferences clients sont ils présents sur le site ? </p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!-- point check -->
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="ui-block">
										<div class="available-widget">
											<div class="checkbox">
												<label>
													<h4 class="title">Titres</h4>
													<img alt="" class="illu" src="img/exemple-favicon.jpg">
													<p class="desc">Les titres de niveaux sont ils mis en avant de façon propre et réfléchi ?</p>
													<input name="optionsCheckboxes" type="checkbox"><span class="checkbox-material"><span class="check"></span></span>
													<div class="voirplus">
														<a href="#">En savoir plus</a>
													</div>
												</label>
											</div>
										</div>
									</div>
									<!--end point check-->
								</div>
								<!--end row au dessous-->	
							</div>
							<!-- end container-->
						</div>
						<!-- end slide-->
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

	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>

	<script src="js/jquery.fullPage.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#fullpage').fullpage();
			$(document).ready(function() {
				setTimeout(function(){
					$('body').addClass('loaded');
					$('h1').css('color','#222222');
				}, 2000);

			});
		});
	</script>
</body>
</html>