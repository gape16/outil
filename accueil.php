<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');


if (isset($_SESSION['id_statut'])) {
	$id_graph=$_SESSION['id_graph'];
	$query_select_card_crea_maquette = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and date_retour_maquette IS NULL and date_retour_cq IS NULL");
	$query_select_card_crea_maquette->bindParam(1, $id_graph);
	$query_select_card_crea_maquette->execute();
	$cards_client=$query_select_card_crea_maquette->fetchAll();
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
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-reboot.css">
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="Bootstrap/dist/css/bootstrap-grid.css">

		<!-- Theme Styles CSS -->
		<link rel="stylesheet" type="text/css" href="css/theme-styles.css">
		<link rel="stylesheet" type="text/css" href="css/blocks.css">

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
				<div class="content-bg bg-group"></div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
						<div class="main-header-content">
							<h1>Manage your Friend Groups</h1>
							<p>Welcome to your friends groups! Do you wanna know what your close friends have been up to? Groups
								will let you easily manage your friends and put the into categories so when you enter you’ll only
								see a newsfeed of those friends that you placed inside the group. Just click on the plus button below and start now!
							</p>
						</div>
					</div>
				</div>
			</div>

			<img class="img-bottom" src="img/group-bottom.png" alt="friends">
		</div>

		<!-- Main Content Groups -->
		<?php 
		// si c'est un graph qui se connect
		if ($_SESSION['id_statut'] == 1) {?>

		<div class="container cards">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="friend-item friend-groups create-group" data-mh="friend-groups-item">
						<a href="#" class="full-block" data-toggle="modal" data-target="#create-friend-group-1"></a>
						<div class="content">
							<a href="#" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-1">
								<svg class="olymp-plus-icon"><use xlink:href="icons/icons.svg#olymp-plus-icon"></use></svg>
							</a>
							<div class="author-content">
								<a href="#" class="h5 author-name">Ajouter un client</a>
								<div class="country">-</div>
							</div>
						</div>
					</div>
				</div>


				<?php foreach ($cards_client as $key => $value) {?>

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<div class="ui-block" data-mh="friend-groups-item">
						<div class="friend-item friend-groups">
							<div class="friend-item-content">
								<div class="more">
									<svg class="olymp-three-dots-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
									<ul class="more-dropdown">
										<li>
											<a href="#">Commencer le check</a>
										</li>
										<li>
											<a href="#">Rapporter un problème</a>
										</li>
									</ul>
								</div>
								<div class="friend-avatar">
									<div class="author-thumb">
										<img src="img/crea_maquette.png" alt="Olympus">
									</div>
									<div class="author-content">
										<a href="#" class="h5 author-name"><?php echo utf8_encode($value['raison_social']);?></a>
										<div class="country"><?php echo $value['num_client'];?></div>
									</div>
								</div>
								<ul class="friends-harmonic">
									<li>
										<a href="#">
											<img src="<?php echo utf8_encode($value['photo']);?>" alt="friend">
										</a>
									</li>
								</ul>
								<div class="control-block-button">
									<a href="<?php echo utf8_encode($value['lien_CMS']);?>" class="  btn btn-control bg-blue" data-toggle="modal" data-target="#create-friend-group-add-friends">
										<svg class="olymp-happy-faces-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>
									</a>
									<a href="#check.php" class="btn btn-control btn-grey-lighter">
										<svg class="olymp-settings-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-settings-icon"></use></svg>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<!-- ... end Main Content Groups -->


		<!-- Window-popup Create Friends Group -->
		<div class="modal fade" id="create-friend-group-1">
			<div class="modal-dialog ui-block window-popup create-friend-group create-friend-group-1">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>

				<div class="ui-block-title">
					<h6 class="title">Ajouter un client</h6>
				</div>

				<div class="ui-block-content">
					<form class="form-group label-floating is-empty addclient">
						<div class="form-group is-empty label-floating ">
							<label class="control-label">Numéro client</label>
							<input class="form-control numclient" placeholder="" value="" type="text">
						</div>
						<div class="form-group label-floating is-empty">
							<label class="control-label">Raison sociale</label>
							<input class="form-control raisonsociale" placeholder="" value="" type="text">
						</div>
						<div class="form-group label-floating is-empty">
							<label class="control-label">Adresse CMS</label>
							<input class="form-control adressecms" placeholder="" value="" type="text">
						</div>
					</form>
					<a href="#" class="btn btn-blue btn-lg full-width btn-addclient">Ajouter le client</a>
				</div>


			</div>
		</div>
		<!-- ... end Window-popup Create Friends Group -->


		<!-- Window-popup Create Friends Group Add Friends -->
		<div class="modal fade" id="create-friend-group-add-friends">
			<div class="modal-dialog ui-block window-popup create-friend-group create-friend-group-add-friends">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
				</a>

				<div class="ui-block-title">
					<h6 class="title">Add Friends to “Freelance Clients” Group</h6>
				</div>

				<div class="ui-block-content">
					<form class="form-group label-floating is-select">

						<select class="selectpicker form-control style-2 show-tick" multiple data-max-options="2" data-live-search="true" size="auto">
							<option title="Green Goo Rock" data-content='<div class="inline-items">
								<div class="author-thumb">
									<img src="img/avatar52-sm.jpg" alt="author">
								</div>
								<div class="h6 author-title">Green Goo Rock</div>

							</div>'>
						</option>

						<option title="Mathilda Brinker" data-content='<div class="inline-items">
							<div class="author-thumb">
								<img src="img/avatar74-sm.jpg" alt="author">
							</div>
							<div class="h6 author-title">Mathilda Brinker</div>
						</div>'>
					</option>

					<option title="Marina Valentine" data-content='<div class="inline-items">
						<div class="author-thumb">
							<img src="img/avatar48-sm.jpg" alt="author">
						</div>
						<div class="h6 author-title">Marina Valentine</div>
					</div>'>
				</option>

				<option title="Dave Marinara" data-content='<div class="inline-items">
					<div class="author-thumb">
						<img src="img/avatar75-sm.jpg" alt="author">
					</div>
					<div class="h6 author-title">Dave Marinara</div>
				</div>'>
			</option>

			<option title="Rachel Howlett" data-content='<div class="inline-items">
				<div class="author-thumb">
					<img src="img/avatar76-sm.jpg" alt="author">
				</div>
				<div class="h6 author-title">Rachel Howlett</div>
			</div>'>
		</option>

	</select>
</form>

<a href="#" class="btn btn-blue btn-lg full-width">Save Changes</a>
</div>

</div>
</div>
<?php }?>
<!-- ... end Window-popup Create Friends Group Add Friends -->

<!-- Window-popup-CHAT for responsive min-width: 768px -->

<div class="ui-block popup-chat popup-chat-responsive">
	<div class="ui-block-title">
		<span class="icon-status online"></span>
		<h6 class="title" >Chat</h6>
		<div class="more">
			<svg class="olymp-three-dots-icon"><use xlink:href="icons/icons.svg#olymp-three-dots-icon"></use></svg>
			<svg class="olymp-little-delete js-chat-open"><use xlink:href="icons/icons.svg#olymp-little-delete"></use></svg>
		</div>
	</div>
	<div class="mCustomScrollbar">
		<ul class="notification-list chat-message chat-message-field">
			<li>
				<div class="author-thumb">
					<img src="img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
				</div>
			</li>

			<li>
				<div class="author-thumb">
					<img src="img/author-page.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Don’t worry Mathilda!</span>
					<span class="chat-message-item">I already bought everything</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:29pm</time></span>
				</div>
			</li>

			<li>
				<div class="author-thumb">
					<img src="img/avatar14-sm.jpg" alt="author" class="mCS_img_loaded">
				</div>
				<div class="notification-event">
					<span class="chat-message-item">Hi James! Please remember to buy the food for tomorrow! I’m gonna be handling the gifts and Jake’s gonna get the drinks</span>
					<span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 8:10pm</time></span>
				</div>
			</li>
		</ul>
	</div>

	<form>

		<div class="form-group label-floating is-empty">
			<label class="control-label">Press enter to post...</label>
			<textarea class="form-control" placeholder=""></textarea>
			<div class="add-options-message">
				<a href="#" class="options-message">
					<svg class="olymp-computer-icon"><use xlink:href="icons/icons.svg#olymp-computer-icon"></use></svg>
				</a>
				<div class="options-message smile-block">

					<svg class="olymp-happy-sticker-icon"><use xlink:href="icons/icons.svg#olymp-happy-sticker-icon"></use></svg>

					<ul class="more-dropdown more-with-triangle triangle-bottom-right">
						<li>
							<a href="#">
								<img src="img/icon-chat1.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat2.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat3.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat4.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat5.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat6.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat7.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat8.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat9.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat10.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat11.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat12.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat13.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat14.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat15.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat16.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat17.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat18.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat19.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat20.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat21.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat22.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat23.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat24.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat25.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat26.png" alt="icon">
							</a>
						</li>
						<li>
							<a href="#">
								<img src="img/icon-chat27.png" alt="icon">
							</a>
						</li>
					</ul>
				</div>
			</div>
			<span class="material-input"></span></div>

		</form>


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

	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">


	<script src="js/mediaelement-and-player.min.js"></script>
	<script src="js/mediaelement-playlist-plugin.min.js"></script>

	<script src="js/charte.js"></script>

</body>
</html>
<?php }else{
	header('Location: login.php');
}
?>