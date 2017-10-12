<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

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
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
	<link rel="stylesheet" type="text/css" href="css/prism.min.css">
	<link rel="stylesheet" type="text/css" href="css/codeflask.css">


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

<body id="prop-code">

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


	<!-- Main Content Groups -->
	<?php 
		// si c'est un graph qui se connect
	if ($_SESSION['id_statut'] == 1) {?>
	<div id="code">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 code">
				<form class="form-group label-floating is-empty help">
					<div class="form-group label-floating is-empty">
						<label class="control-label">//HTML</label>
						<textarea name="description" id="description" class="my-code-wrappers html" data-language="html" cols="30" rows="10"></textarea>
					</div>
				</form>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 code">
				<form class="form-group label-floating is-empty help">
					<div class="form-group label-floating is-empty">
						<label class="control-label">//CSS</label>
						<textarea name="description" id="description" class="my-code-wrappers css" data-language="css" cols="30" rows="10"></textarea>
					</div>
				</form>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 code">
				<form class="form-group label-floating is-empty help">
					<div class="form-group label-floating is-empty">
						<label class="control-label">//JS</label>
						<textarea name="description" id="description" class="my-code-wrappers js" data-language="javascript" cols="30" rows="10"></textarea>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 rendu">
				<iframe id="rendu-code" frameborder="0">
				</iframe>
			</div>
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

	<script src="js/prism.min.js"></script>
	<script src="js/codeflask.js"></script>

	<script>
		$(function(){
			$('.my-code-wrappers.html').keyup(function(){
				var code = $(this).val();
				var $iframe = $('#rendu-code');
				$iframe.ready(function() {
					$iframe.contents().find("body").html(code);
				});
			})
			$('.my-code-wrappers.css').keyup(function(){
				var code = $(this).val();
				var $iframe = $('#rendu-code');
				$iframe.ready(function() {
					$iframe.contents().find("head").html('<style>' + code + '</style>');
				});
			})
			$('.my-code-wrappers.js').keyup(function(){
				var code = $(this).val();
				var wrapCode =  document.createElement("script");
				wrapCode.innerHTML = code;
				var $iframe = $('#rendu-code');
				$iframe.ready(function() {
					$iframe.contents().find("body").append(wrapCode);
				});
			})
			var flask = new CodeFlask;
			flask.runAll('.my-code');
		})
	</script>
</body>
</html>