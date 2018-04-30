<?php
// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if (isset($_SESSION['id_statut'])) {
	$query_select_check = $bdd->prepare("SELECT * FROM pointcheck order by id_check ASC");
	$query_select_check->execute();

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
		<!-- TIPPED -->
		<link rel="stylesheet" href="css/tipped.css">

		<style>
		#check {
			max-width: 100%;
			padding: 0 20px 0 100px;
		}
		.point {
			padding: 23px 25px 18px;
			position: relative;
		}
		p.description_check {
			margin-bottom: 0;
			padding-right: 30px;
		}
		p.fake_title {
			font-weight: 600;
			font-size: 0.9rem;
			margin-bottom: 3px;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;	
		}
		input.checkbox_check {
			position: absolute;
			right: 10px;
			bottom: 30px;
			width: 30px;
			height: 30px;
		}


		/*desktop*/
		#desktop, #tablette, #smartphone{
			background: #F6F7F8;
			font-family: 'Open Sans', sans-serif;
		}
		#desktop .menu li, #tablette .menu li, #smartphone .menu li {
			float: left;
			padding: 39px 26px;
			cursor: pointer;
		}
		#desktop .menu li:hover{
			background: #f08168;
			color: white;
			text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.49);
			border-bottom: 4px solid #2e3e4e;
		}
		#desktop > div.menu > ul > li:nth-child(1)/*, #tablette .menu li:first-child, #smartphone .menu li:first-child*/{
			background: #f08168;
			color: white;
			text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.49);
			border-bottom: 4px solid #2e3e4e;
		}
		ul.white-li{
			background: 
		}
		img.maquette_logo {
			float: left;
		}
		.menu {
			height: 100px;
			display: flex;
			justify-content: space-between;
		}
		.menu ul {
			margin-bottom: 0;
		}
		#desktop .slider, #tablette .slider, #smartphone .slider{
			background: url(./img/slider.png);
			min-height: 330px;
			background-size: cover;
			background-repeat: no-repeat;
			padding: 50px 0 0 0;
		}
		.slider h1 {
			text-align: center;
			font-weight: 400;
			color: white;
		}
		p.catch {
			width: 80%;
			text-align: center;
			color: white;
			margin: 0 auto;
		}
		p.cta {
			text-align: center;
			padding: 10px;
			background: #f08168;
			max-width: 110px;
			margin: auto;
			margin-top: 20px;
			color: white !important;
			border-radius: 3px;
			cursor: pointer;
		}
		.picto {
			display: flex;
			margin: 50px 0;
		}
		.picto .col-xl-3.col-lg-3.col-md-6.col-sm-12.col-xs-12 {
			float: left;
		}
		.blue {
			background: #2E3E4E;
			padding: 50px 0;
			color: white;
		}
		.wrapper_content {
			text-align: center;
			padding: 50px 0;
		}
		img.pic {
			display: block;
			margin: 0 auto;
			padding-bottom: 20px;
			border-bottom: 2px solid #2C2C2C;
		}
		p.faketitle {
			text-align: center;
			margin-top: 20px;
		}
		p.desc_picto {
			text-align: center;
			margin-bottom: 0;
		}
		.blue .desc {
			text-align: left;
			margin-bottom: 0;
		}
		.blue img{
			width: 100%;
		}
		.blue h2 {
			margin-bottom: 25px;
		}
		.fifty {
			width: 50%;
		}
		.fakerow {
			min-height: 220px;
			display: flex;
		}
		p.fifty {
			margin: auto;
			padding: 0 50px;
		}
		.who {
			text-align: center;
		}
		img.whois {
			padding-bottom: 10px;
			border-bottom: 5px solid #2e3e4e;
		}
		.wrapper_flex {
			display: flex;
		}
		#desktop h2, #tablette h2, #smartphone h2 {
			padding: 0 15px;
		}
		.white {
			padding: 0 15px;
		}
		div.who > img:nth-child(3) {
			border-bottom-color: #f08264;
		}
		.fake_footer{
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flex;
			display: -o-flex;
			display: flex;
			background: #2E3E4E;
			color: white;
			padding: 50px 0;
		}
		.fake_footer .col-xl-3.col-lg-3.col-md-6.col-sm-12.col-xs-12 {
			float: left;
		}
		.fake_footer h3 {
			color: white;
		}
		.footer_wrapper p {
			margin-bottom: 3px;
			font-size: 0.8rem;
		}
		p.desc_footer.bleu {
			color: #18a4da;
			cursor: pointer;
		}
		p.blue {
			padding: inherit;
		}
		.footer_wrapper {
			padding: 10px 0;
		}
		.fake_footer input[type="text"] {
			padding: 10px;
		}
		#desktop > div > div.fake_footer > div.col-xl-6.col-lg-6.col-md-6.col-sm-12.col-xs-12 > div > div > input:nth-child(1), #desktop > div > div.fake_footer > div.col-xl-6.col-lg-6.col-md-6.col-sm-12.col-xs-12 > div > div > input:nth-child(3) {
			margin-right: 10px;
		}

		/*font*/
		.slider h1, p.faketitle, .menu li, .white h2, .blue h2, .fake_footer h3 {
			font-family: Anton;
		}
		p.faketitle, .white h2, .blue h2, .fake_footer h3 {
			color: #f08168;
		}
		p.faketitle {
			font-size: 1.2rem;
		}


		/*modal*/
		.modal-dialog.ui-block.window-popup.event-private-public.private-event {
			max-width: 60vw;
			width: 50vw;
			border: none;
			margin: 50px auto;
		}



		/*tablette*/
		#modal_tablette .modal-dialog.ui-block.window-popup.event-private-public.private-event, #tablette {
			width: 35vw;
			margin: 0 auto;
		}
		#tablette .menu {
			height: 80px;
		}
		#tablette .menu li {
			padding: 10px;
		}
		#tablette .picto {
			flex-wrap: wrap;
		}
		#tablette .col-xl-3 {
			flex: 0 0 50%;
			max-width: 50%;
		}
		#tablette > div.picto > div:nth-child(1), #tablette > div.picto > div:nth-child(2) {
			margin-bottom: 25px;
		}
		#tablette .blue .col-xl-4 {
			flex: 0 0 50%;
			max-width: 50%;
		}
		#tablette .blue .wrapper_flex {
			display: flex;
			flex-wrap: wrap;
		}
		#tablette .responsive-tablette:first-child {
			margin-top: 25px;
			flex: 0 0 100%;
			max-width: 100%;
			order: 3;
		}
		#tablette .responsive-tablette:first-child img{
			width: 50%;
			margin: 0 auto;
			display: block;
		}
		#tablette .fake_footer {
			flex-wrap: wrap;
		}
		#tablette > div.fake_footer > div:nth-child(2){
			order: 1;
		}
		#tablette > div.fake_footer > div:nth-child(3){
			order: 4;
		}


		/*burger menu*/
		#menu, label:before, label:after {
			content: " ";
			position: absolute;
			left: -40px;
			width: 40px;
			right: 0;
			height: 5px;
			background-color: #f08168;
			border-radius: 2px;
			transition: .5s ease;
		}

		label {
			padding: 38px 70px;
			position: absolute;
			z-index: 1;
		}
		label:before { top: -20px; }
		label:after { top: 0s; }

		#menu {
			top: 40px;
			width: 40px;
			transition: .2s ease;
			z-index: 0;
			left: inherit;
			right: 15px;
			position: relative;
		}
		label.menu-toggle{
			right: 0;
		}
		#menu li {
			line-height: 0.5;
			pointer-events: none;
			opacity: 0;
		}

		#menu-toggle:checked + label:before {
			top: -10px;
			transform: rotate(-45deg);
		}
		#menu-toggle:checked + label:after {
			top: -10px;
			transform: rotate(45deg);
		}
		#menu-toggle:checked + label + #menu {
			top: 80px;
			width: 150px;
			height: auto;
			box-shadow: 0 2px 5px rgba(0,0,0,0.26);
			transition: .3s ease .2s;
			z-index: 1;
		}
		#menu-toggle:checked + label + #menu li {
			pointer-events: all;
			opacity: 1;
			z-index: 2;
			transition: .2s ease .3s;
			width: 100%;
		}
		#tablette .menu li {
			padding: 15px 20px;
		}

		[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
			display: none;
		}

		#tablette label.menu-toggle {
			right: 15px;
			padding: 0;
			top: 100px;
		}
		#tablette #menu a {
			color: white;
			font-size: 1.2rem;
		}


		/*smartphone*/
		#modal_smartphone .modal-dialog.ui-block.window-popup.event-private-public.private-event, #smartphone {
			width: 25vw;
			margin: 0 auto;
		}
		#smartphone .slider h1 {
			padding: 25px 15px;
		}
		#smartphone .col-xl-3 {
			flex: 0 0 50%;
			max-width: 50%;
		}
		#smartphone .picto {
			flex-wrap: wrap;
		}
		#smartphone .picto > div:first-child {
			margin-bottom: 25px;
		}
		#smartphone .responsive-tablette {
			flex: 0 0 100%;
			max-width: 100%;
		}
		#smartphone .wrapper_flex {
			flex-wrap: wrap;
		}
		#smartphone .wrapper_flex > div {
			margin-bottom: 25px;
		}
		#smartphone .wrapper_flex > div:last-child {
			margin-bottom: 0;
		}
		#smartphone .fakerow {
			flex-wrap: wrap;
		}
		#smartphone p.fifty {
			padding: 0;
		}
		#smartphone > div.white > div.mosaique > div:nth-child(2) {
			flex-direction: column-reverse;
		}
		#smartphone img.fifty {
			margin-bottom: 10px;
		}
		#smartphone .fifty{
			width: 100%;
		}
		#smartphone p.fifty {
			margin-bottom: 25px;
		}
		#smartphone .fake_footer {
			flex-wrap: wrap;
		}
		#smartphone > div.fake_footer > div:nth-child(2){
			order: 1;
		}
		#smartphone > div.fake_footer > div:nth-child(3){
			order: 4;
		}
		#smartphone .menu li {
			padding: 15px 20px;
		}
		#smartphone #menu a {
			color: white;
			font-size: 1.2rem;
		}
		#smartphone .menu {
			height: 80px;
		}


		img.device {
			float: left;
			width: 70px;
		}

		.modal-dialog {
			box-shadow: 0 0 20px 5px rgba(0, 0, 0, 0.25);
		}
		.red-txt {
			color: #f08264;
		}
		a.fake-btn {
			width: 100%;
			text-align: center;
			display: block;
			padding: 20px;
			cursor: pointer;
			background: #f08168;
		}

		#desktop .picto:hover{
			border-top: 1px dashed rgba(0, 0, 0, 0.2);
			border-bottom: 1px dashed rgba(0, 0, 0, 0.2);
		}




		/*SUBMENU*/
		.menu ul{
			list-style:none;
			position:relative;
			float:left;
			margin:0;
			padding:0
		}
		.menu ul li{
			position:relative;
			float:left;
			margin:0;
			padding:0
		}
		.menu ul li.current-menu-item{
			background:#ddd
		}
		.menu ul li:hover{
			background:#f6f6f6
		}
		.menu ul ul {
			display: none;
			position: absolute;
			top: 104%;
			left: 0;
			background: #f6f7f8;
			padding: 0;
		}
		.menu ul ul li{
			float:none;
			width:200px
		}
		.menu ul ul a{
			line-height:120%;
			padding:10px 15px
		}
		.menu ul ul ul{
			top:0;
			left:100%
		}
		.menu ul li:hover > ul{
			display:block
		}
		ul.white-li li {
			color: #888da8;
			text-shadow: none;
		}

		/*input*/
		input.moit {
			width: calc( 50% - 5px );
			float: left;
		}
		#desktop > .fake_footer input:nth-child(1), #desktop > .fake_footer input:nth-child(3) {
			margin-right: 10px;
		}
		.fake_footer input[type="text"] {
			padding: 10px;
			margin-bottom: 5px;
			background: #f6f7f8;
			border-radius: 2px;
		}
		#desktop > .fake_footer input:nth-child(5){
			min-height: 74px;
		}


		#tablette, #smartphone{
			display: none;
		}
		img.picto_check {
			float: left;
			height: 60px;
			padding: 10px 0;
		}

		#smartphone label:before, #smartphone label:after {
			right: 128px;
			left: inherit;
		}
		#tablette	img.maquette_logo, #smartphone img.maquette_logo  {
			float: left;
			width: 80px;
		}

		.fake_grid {
			width: 100%;
			position: absolute;
			display: none;
		}

		#desktop .col {
			float: left;
			width: 47px;
			margin: 0 9px;
			background: rgba(255, 0, 0, 0.22);
		}
		#desktop .col:first-child{
			margin-left: 15px;
		}
		#desktop .col:last-child{
			margin-right: 15px;
		}
		#desktop .first {
			padding: 0 8px 0 15px;
		}
		#desktop .second {
			padding: 0 11px;
		}
		#desktop .third {
			padding: 0 15px 0 7px;
		}

		#tablette .col {
			float: left;
			width: 35px;
			margin: 0 9px;
			background: rgba(255, 0, 0, 0.22);
		}
		#tablette .col:first-child{
			margin-left: 15px;
		}
		#tablette .col:last-child{
			margin-right: 15px;
		}
		#tablette .first {
			padding: 0 8px 0 15px;
		}
		#tablette .second {
			padding: 0 11px;
		}
		#tablette .third {
			padding: 0 15px 0 7px;
		}


		div#desktop {
			height: 600px;
			overflow: hidden;
			overflow-y: scroll;
			margin-top: 110px;
			border-top: 30px solid #2C2C2C;
			border-left: 30px solid #2C2C2C;
			border-right: 30px solid #2C2C2C;
			border-top-left-radius: 20px;
			border-top-right-radius: 20px;
		}
		.bottom_desktop {
			height: 80px;
			background: #36353a;
			border-bottom-right-radius: 20px;
			border-bottom-left-radius: 20px;
			border-top: 30px solid #2c2c2c;
		}
		.bottom_desktop:after {
			content: "";
			display: block;
			border-bottom: 100px solid #36353a;
			border-left: 20px solid transparent;
			border-right: 20px solid transparent;
			height: 0;
			width: 210px;
			margin: 0 auto;
			position: relative;
			top: 50px;
			border-top: 1px solid rgba(76, 76, 76, 0.75);
		}
		.content{
			height: 100%;	
		}


		#tablette{
			height: 780px;
			overflow: hidden;
			overflow-y: scroll;
			margin-top: 110px;
			border-left: 30px solid #36353a;
			border-right: 30px solid #36353a;
			border-top: 60px solid #36353a;
			border-bottom: 60px solid #36353a;
			border-radius: 20px;
			position: fixed;
			margin-left: 100px;
		}

		.wrapper_desktop {
			position: fixed;
			padding-right: 30px;
		}

		div#smartphone {
			height: 780px;
			overflow: hidden;
			overflow-y: scroll;
			margin-top: 110px;
			border-left: 30px solid #2C2C2C;
			border-right: 30px solid #2C2C2C;
			border-top: 60px solid #2C2C2C;
			border-bottom: 60px solid #2C2C2C;
			border-radius: 20px;
		}
		#smartphone label.menu-toggle {
			right: 147px;
			top: 150px;
		}

		#tablette #menu {
			top: 90px;
			position: absolute;
		}
		#smartphone #menu {
			top: 210px;
			right: 275px;
			position: absolute;
		}
		#tablette #menu-toggle:checked + label + #menu {
			top: 134px;
		}
		#tablette .fifty {
			width: 50%;
			height: 160px;
		}
		#tablette p.fifty {
			margin: auto;
			padding: 10px;
			height: auto !important;
			font-size: 0.8rem;
		}
		#tablette .fakerow {
			min-height: inherit;
			display: flex;
		}
		#smartphone label:after {
			top: 70px;
		}
		#smartphone label:before {
			top: 50px;
		}
		#smartphone #menu-toggle:checked + label:after {
			top: 60px;
		}
		#smartphone #menu-toggle:checked + label:before {
			top: 60px;
		}
		#smartphone #menu-toggle:checked + label + #menu {
			top: 250px;
		}

		span.helpme {
			background: #f08168;
			width: 10px;
			height: 10px;
			display: block;
			float: right;
			color: white;
			border-radius: 10px;
			line-height: 10px;
			text-align: center;
			margin-left: 5px;
			font-size: 0.5rem;
			position: relative;
			top: 6px;
		}

		.action_bar {
			background: #364048;
		}
		.action_bar p {
			display: inline-block;
			margin-bottom: 0;
			height: 100%;
			line-height: 24px;
			padding: 15px 0;
			color: white;
		}

		.action_bar p:first-child::before {
			content: "";
			display: inline-block;
			width: 15px;
			height: 15px;
			background: url(img/phone-call.png);
			background-size: cover;
			margin: 0 10px;
		}
		.action_bar p:nth-child(2)::before {
			content: "";
			display: inline-block;
			width: 15px;
			height: 15px;
			background: url(img/placeholder.png);
			background-size: cover;
			margin: 0 10px;
		}
		.action_bar p:last-child::before {
			content: "";
			display: inline-block;
			width: 15px;
			height: 15px;
			background: url(img/mail.png);
			background-size: cover;
			margin: 0 10px;
		}
		#smartphone .slider {
			padding: 0;
		}
		#menu {
			z-index: 9;
		}

		#tablette .menu.sticky {
			position: fixed;
			width: 31vw;
			top: 240px;
			background: #F6F7F6;
			z-index: 999;
			transition: all 500ms;
			height: 50px;
			box-shadow: 0 3px 6px rgba(0, 0, 0, 0), 0 3px 6px rgba(0, 0, 0, 0.08);
		}
		#tablette .menu.sticky .maquette_logo {
			width: 50px;
		}
		#tablette .menu.sticky label.menu-toggle {
			top: 32px;
		}
		#tablette .menu.sticky #menu {
			top: 22px;
			position: absolute;
		}
		#tablette .menu.sticky #menu-toggle:checked + label + #menu {
			top: 50px;
		}

		.fixed {
			z-index: 1;
			position: fixed;
			background: white;
			border-bottom-left-radius: 5px;
			border-bottom-right-radius: 5px;
			right: 25%;
			padding: 10px 20px;
			transform: translateX(50%);
		}
		.fixed .device {
			width: 60px;
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

	<div class="header-spacer header-spacer-small"></div>

	<!-- Main Content Groups -->

	<div class="container" id="check">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 left">
				<div class="ui-block categorie">
					<div class="ui-block-title">
						<h6 class="title">Points de check</h6> 
					</div>
					<?php foreach ($query_select_check as $key => $value) {?>
					<div class="point <?php echo utf8_encode($value['id_check']) ?>">
						<img src="<?php echo utf8_encode($value['picto']) ?>" alt="" class="picto_check">
						<p class="fake_title"><?php echo utf8_encode($value['titre']) ?><span class="helpme help_<?php echo utf8_encode($value['id_check']) ?>">?</span></p>
						<p class="description_check"><?php echo utf8_encode($value['description']) ?></p>
						<input type="checkbox" class="checkbox_check">
					</div>
					<?php }?>
				</div>
			</div>


			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 right">
				<div class="fixed">
					<img class="device grid" data-toggle="modal" data-target="#modal_desktop" src="img/Picto-grille.png" alt="">
					<img class="device desktop" data-toggle="modal" data-target="#modal_desktop" src="img/desktop.png" alt="">
					<img class="device tablette" data-toggle="modal" data-target="#modal_tablette" src="img/tablette.png" alt="">
					<img class="device smartphone" data-toggle="modal" data-target="#modal_smartphone" src="img/smartphone.png" alt="">
				</div>
				<!-- DESKTOP -->
				<div class="wrapper_desktop">
					<div id="desktop">
						<div class="content">
							<div class="fake_grid">
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
								<div class="col"></div>
							</div>
							<div class="action_bar"><p class="tel">0545652514</p> <p class="adresse">137 lorem Ipsum Sit Amet
							</p> <p class="mail">jondoe@loremipsum.com</p></div>
							<div class="menu">
								<img src="img/avatar1.jpg" alt="" class="maquette_logo simple-tooltip" title="Le logo est-il détouré et exporté au bon format dans la bonne résolution ? <a class='showmore' href='#lol'>voir plus</a>">
								<ul class="first_ul">
									<li class="simple-tooltip" title="Les li du menu sont-elles alignées ou centrées verticalement par rapport au logo ? <a class='showmore' href='#lol'>voir plus</a>">Accueil</li>
									<li class="simple-tooltip" title="Si cette li sert uniquement à accéder au sous menu, le # dans le href est-il enlevé ?">Sous-menu
										<ul class="white-li">
											<li>Sous-menu 1</li>
											<li>Sous-menu 2</li>
										</ul>
									</li>
									<li class="simple-tooltip interactif" title="Le menu est il interactif afin de renseigner l'utilisateur ? <a class='showmore' href='#lol'>voir plus</a>"><a data-toggle="modal" data-target="#modal_smartphone">Nos réalisations</a></li>
									<li class="simple-tooltip center" title="Le menu est il interactif afin de renseigner l'utilisateur ? <a class='showmore' href='#lol'>voir plus</a>">Contact</li>
								</ul>
							</div>
							<div class="slider bottom tipso_style" data-tipso="This is a TIPSO with a title!">
								<h1 class="simple-tooltip" title="Peut-on identifier l'activité du client sa localité/zone d'intervention au dessus de la ligne de flottaison ? <a class='showmore' href='#lol'>voir plus</a>">GOOD DESIGN IS GOOD BUSINESS</h1>
								<p class="catch simple-tooltip identification" title="Peut-on identifier l'activité du client sa localité/zone d'intervention au dessus de la ligne de flottaison ? <a class='showmore' href='#lol'>voir plus</a>">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam esseum.</p>
								<p class="cta simple-tooltip contact" title="Peut-on contacter le client au dessus de la ligne de flottaison ?">Lorem !</p>
							</div>
							<div class="picto simple-tooltip marge" title="Les marges sont-elles homogènes ?">
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<img src="img/picto_1.png" alt="" class="pic simple-tooltip images" title="Les images sont-elles exportées dans le bon format ?">
									<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
									<p class="desc_picto simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor.</p>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<img src="img/picto_2.png" alt="" class="pic simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
									<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
									<p class="desc_picto simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor.</p>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<img src="img/picto_3.png" alt="" class="pic simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
									<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
									<p class="desc_picto simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor.</p>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<img src="img/picto_4.png" alt="" class="pic simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
									<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
									<p class="desc_picto simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor.</p>
								</div>
							</div>
							<div class="blue">
								<h2>Titre</h2>
								<div class="wrapper_flex">
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 first">
										<img src="img/img_trois.png" class="simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
										<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
										<p class="desc simple-tooltip" title="Le contraste entre les titres et les textes est-il suffisant ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 second">
										<img src="img/img_trois.png" class="simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
										<p class="faketitle" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
										<p class="desc">Lorem ipsum dolor sit amet, <a href="#" class="simple-tooltip" title="Le maillage est-il visibile et cohérent avec le reste du site ?">consectetur</a> adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 third">
										<img src="img/img_trois.png" class="simple-tooltip" title="Les images sont-elles exportées dans le bon format ?">
										<p class="faketitle simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">Titre</p>
										<p class="desc simple-tooltip" title="Le contraste entre les titres et les textes est-il suffisant ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
									</div>
								</div>
							</div>
							<div class="white">
								<div class="wrapper_content">
									<h2  class="simple-tooltip" title="Un contraste entre les titres et les textes est-il présent ?">Titre</h2>
									<p class="simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
								</div>
								<div class="mosaique">
									<div class="fakerow">
										<img src="img/img_mosaique.png" class="fifty simple-tooltip" title="Les photos sont-elles de bonne qualité ?">
										<p class="fifty simple-tooltip" title="Le texte est-il centré verticalement par rapport à l'image ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
									</div>
									<div class="fakerow">
										<p class="fifty simple-tooltip" title="Le texte est-il centré verticalement par rapport à l'image ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
										<img src="img/img_mosaique.png" class="fifty simple-tooltip" title="Les photos sont-elles de bonne qualité ?">
									</div>
								</div>
								<div class="wrapper_content">
									<h2  class="simple-tooltip" title="Un contraste entre les titres et les textes est-il présent ?">Titre</h2>
									<p class="simple-tooltip" title="Le texte centré est-il utilisé pour mettre en avant un atout de l'entreprise ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
								</div>
								<div class="who">
									<p class="red-txt simple-tooltip" title="Quand il y a plusieurs choix, une interactivité avec l'utilisateur est-elle mise en place ?">Jon Doe / CEO of Loremipsum</p>
									<img src="img/personne1.png" class="whois">
									<img src="img/personne2.png" class="whois simple-tooltip" title="Quand il y a plusieurs choix, une interactivité avec l'utilisateur est-elle mise en place ?">
									<img src="img/personne3.png" class="whois">
								</div>
							</div>
							<div class="fake_footer">
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<h3 class="simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">IPSUM</h3>
									<div class="footer_big_wrapper">
										<div class="footer_wrapper simple-tooltip" title="Les champs input du formulaire sont-ils bien alignés ?">
											<input type="text" placeholder="Nom *" class="moit">
											<input type="text" placeholder="Prénom *" class="moit">
											<input type="text" placeholder="Adresse email *" class="moit">
											<input type="text" placeholder="Téléphone *" class="moit">
											<input type="text" placeholder="Votre message *">
											<input type="text" placeholder="Combien font 3+2 ? *">
											<a class="fakesubmit"></a>
											<p class="small simple-tooltip" title="Le texte des mentions obligatoires est-il présent sous le formulaire ?">"Conformément à la Loi Informatique et Liberté du 6 janvier 1978 et de la loi pour la confiance dans l'Economie Numérique du 21 juin 2004...."</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<h3 class="simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">SI AMET</h3>
									<div class="footer_wrapper simple-tooltip" title="Le contenu est-il bien hiérarchisé ?">
										<img src="" alt="" class="footer_img">
										<p class="desc_footer">Excepteur sint occaecat</p>
										<p class="desc_footer bleu">http://loremipsum.fr</p>
										<p class="desc_footer">1 week ago</p>
									</div>
									<div class="footer_wrapper simple-tooltip" title="Le contenu est-il bien hiérarchisé ?">
										<img src="" alt="" class="footer_img">
										<p class="desc_footer">Excepteur sint occaecat</p>
										<p class="desc_footer bleu">http://loremipsum.fr</p>
										<p class="desc_footer">1 week ago</p>
									</div>
									<div class="footer_wrapper simple-tooltip" title="Le contenu est-il bien hiérarchisé ?">
										<img src="" alt="" class="footer_img">
										<p class="desc_footer">Excepteur sint occaecat</p>
										<p class="desc_footer bleu">http://loremipsum.fr</p>
										<p class="desc_footer">1 week ago</p>
									</div>
								</div>
								<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<h3 class="simple-tooltip" title="Les titres sont-ils mis en avant par rapport aux textes de façon propre et réfléchi ?">CONSECTETUR</h3>
									<div class="footer_wrapper simple-tooltip" title="Les moyens de contact sont-ils présents dans le footer ?">
										<img src="" alt="" class="footer_picto">
										<p class="desc_footer">Loremipsum</p>
										<p class="desc_footer">137 lorem Ipsum Sit Amet</p>
										<p class="desc_footer">75006 IPSUM</p>
									</div>
									<div class="footer_wrapper simple-tooltip" title="Les moyens de contact sont-ils présents dans le footer ?">
										<img src="" alt="" class="footer_picto">
										<p class="desc_footer">jondoe@loremipsum.com</p>
										<p class="desc_footer">support@loremipsum.com</p>
									</div>
									<div class="footer_wrapper simple-tooltip" title="Les moyens de contact sont-ils présents dans le footer ?">
										<a class="fake-btn simple-tooltip" title="Un CTA est-il présent dans le footer pour inciter l'utilisateur à contacter le client ?">LOREM</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bottom_desktop"></div>
				</div>
				

				<!-- TABLETTE -->
				<div id="tablette">
					<div class="fake_grid">
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
						<div class="col"></div>
					</div>
					<div class="action_bar simple-tooltip" title="Les informations de contact sont elles présentes ?"><p class="tel">0545652514</p> <p class="adresse">137 lorem Ipsum Sit Amet</p> <p class="mail">jondoe@loremipsum.com</p></div>
					<div class="menu">
						<img src="img/avatar1.jpg" alt="" class="maquette_logo simple-tooltip" title="Le logo est-il détouré et exporté au bon format dans la bonne résolution ? <a class='showmore' href='#lol'>voir plus</a>">
						<input type="checkbox" id="menu-toggle"/>
						<label class="menu-toggle" for="menu-toggle"></label>
						<ul id="menu" class="simple-tooltip" title="Le menu est il assez contrasté par rapport aux différents fonds">
							<li><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Portfolio</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
					<div class="slider">
						<h1>GOOD DESIGN IS GOOD BUSINESS</h1>
						<p class="catch">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam esseum.</p>
						<p class="cta">Lorem !</p>
					</div>
					<div class="picto">
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12  simple-tooltip" title="Le contenu est-il adapté à la largeur du device ?">
							<img src="img/picto_1.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 simple-tooltip" title="Le contenu est-il adapté à la largeur du device ?">
							<img src="img/picto_2.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 simple-tooltip" title="Le contenu est-il adapté à la largeur du device ?">
							<img src="img/picto_3.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 simple-tooltip" title="Le contenu est-il adapté à la largeur du device ?">
							<img src="img/picto_4.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
					</div>
					<div class="blue">
						<h2>Titre</h2>
						<div class="wrapper_flex">
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
						</div>
					</div>
					<div class="white">
						<div class="wrapper_content">
							<h2>Titre</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
						</div>
						<div class="mosaique">
							<div class="fakerow">
								<img src="img/img_mosaique.png" alt="" class="fifty">
								<p class="fifty simple-tooltip" title="Le padding est-il adapté à la résolution de l'écran ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
							</div>
							<div class="fakerow">
								<p class="fifty simple-tooltip" title="Le padding est-il adapté à la résolution de l'écran ?">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
								<img src="img/img_mosaique.png" alt="" class="fifty">
							</div>
						</div>
						<div class="wrapper_content">
							<h2>Titre</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
						</div>
						<div class="who">
							<p>Jon Doe / CEO of Loremipsum</p>
							<img src="img/personne1.png" alt="" class="whois">
							<img src="img/personne2.png" alt="" class="whois">
							<img src="img/personne3.png" alt="" class="whois">
						</div>
					</div>
					<div class="fake_footer simple-tooltip" title="Le footer est-il réorganisé en fonction de la taille de l'écran ?">
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>Lorem</h3>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>IPSUM</h3>
							<div class="footer_big_wrapper">
								<p class="desc_footer">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis fugit harum ea animi consectetur ratione adipisci quia illo molestiae necessitatibus neque tempora, voluptate cum veniam nesciunt sint dolorum</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>SI AMET</h3>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>CONSECTETUR</h3>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
					</div>
				</div>

				<!-- SMARTPHONE -->
				<div id="smartphone">
					<div class="menu">
						<img src="img/avatar1.jpg" alt="" class="maquette_logo">
						<input type="checkbox" id="menu-toggle"/>
						<label class="menu-toggle" for="menu-toggle"></label>
						<ul id="menu">
							<li><a href="#">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Portfolio</a></li>
							<li><a href="#">Contact</a></li>
						</ul>
					</div>
					<div class="slider">
						<h1>GOOD DESIGN IS GOOD BUSINESS</h1>
						<p class="catch">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam esseum.</p>
						<p class="cta">Lorem !</p>
					</div>
					<div class="picto">
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<img src="img/picto_1.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<img src="img/picto_2.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<img src="img/picto_3.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<img src="img/picto_4.png" alt="" class="pic">
							<p class="faketitle">Titre</p>
							<p class="desc_picto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor.</p>
						</div>
					</div>
					<div class="blue">
						<h2>Titre</h2>
						<div class="wrapper_flex">
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 responsive-tablette">
								<img src="img/img_trois.png" alt="">
								<p class="faketitle">Titre</p>
								<p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt beatae, voluptatibus impedit quod et vitae neque perspiciatis quidem velit saepe dicta temporibus iste explicabo! Numquam dolor illo quaerat tempore earum!</p>
							</div>
						</div>
					</div>
					<div class="white">
						<div class="wrapper_content">
							<h2>Titre</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
						</div>
						<div class="mosaique">
							<div class="fakerow">
								<img src="img/img_mosaique.png" alt="" class="fifty">
								<p class="fifty">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
							</div>
							<div class="fakerow">
								<p class="fifty">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore facere, ab incidunt sit natus provident repudiandae dolores. Rerum molestias quae, error. Libero quae beatae dolore cupiditate fugit autem inventore, quibusdam!</p>
								<img src="img/img_mosaique.png" alt="" class="fifty">
							</div>
						</div>
						<div class="wrapper_content">
							<h2>Titre</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem officiis quibusdam commodi voluptatem perferendis deserunt aut hic dolorem vel. Dolore, impedit, minus. Ratione molestiae quas porro animi, laudantium expedita quia?</p>
						</div>
						<div class="who">
							<p>Jon Doe / CEO of Loremipsum</p>
							<img src="img/personne1.png" alt="" class="whois">
							<img src="img/personne2.png" alt="" class="whois">
							<img src="img/personne3.png" alt="" class="whois">
						</div>
					</div>
					<div class="fake_footer">
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>Lorem</h3>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>IPSUM</h3>
							<div class="footer_big_wrapper">
								<p class="desc_footer">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis fugit harum ea animi consectetur ratione adipisci quia illo molestiae necessitatibus neque tempora, voluptate cum veniam nesciunt sint dolorum</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>SI AMET</h3>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_img">
								<p class="desc_footer">Excepteur sint occaecat</p>
								<p class="desc_footer bleu">http://loremipsum.fr</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
							<h3>CONSECTETUR</h3>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
							<div class="footer_wrapper">
								<img src="" alt="" class="footer_picto">
								<p class="desc_footer">Lorem</p>
								<p class="desc_footer">1 week ago</p>
							</div>
						</div>
					</div>
				</div>
			</div>
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
	<script src="js/tipped.js"></script>
	<?php 
	if($_SESSION['id_statut']==1) {
						//page graphistes 
		?><script src="../js/notifications.js"></script><?php
	}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
		?><script src="../js/notifications.js"></script><?php
	}
	elseif ($_SESSION['id_statut']==3) {
						//page leader
		?><script src="../js/notifications.js"></script><?php
	}elseif ($_SESSION['id_statut']==4) {
						//page controleur
		?><script src="../js/notifications_controleur.js"></script><?php
	}elseif($_SESSION['id_statut']==5){
						//page admin
		?><script src="../js/notifications_admin.js"></script><?php
	}
	?> 
	<script>
		$(function(){

			var heightDesktop = $('#desktop').css('height');
			var widthDesktop = $('#desktop').css('width');
			$('#desktop .fake_grid').css('height', heightDesktop);
			$('#desktop .fake_grid .col').css('height', heightDesktop);
			$('#desktop .fake_grid').css('width', widthDesktop);

			var heightTablette = $('#tablette').css('height');
			var widthTablette = $('#tablette').css('width');
			console.log('height :' + heightTablette);
			console.log('width :' + widthTablette);
			$('#tablette .fake_grid').css('height', heightTablette);
			$('#tablette .fake_grid .col').css('height', heightTablette);
			$('#tablette .fake_grid').css('width', widthTablette);

			var heightSmartphone = $('#smartphone').css('height');
			var widthSmartphone = $('#smartphone').css('width');
			$('#smartphone .fake_grid').css('height', heightSmartphone);
			$('#smartphone .fake_grid .col').css('height', heightSmartphone);
			$('#smartphone .fake_grid').css('width', widthSmartphone);

			//FOND BURGER MENU
			$('#tablette').scroll(function(){
				console.log('scroll');
				if ($('#tablette').scrollTop() > 50){
					$('ul#menu').addClass('fond');
				}else{
					$('<div class="test"></div>').remove();
				}
			});

			// HOVER LEFT DISPLAY RIGHT
			//GRILLE 
			$('.point.42').on('click', function(){
				$('.fake_grid').toggle();
			})
			// LOGO
			$('div#desktop').scroll(function(){
				$('.tpd-tooltip').hide();
			});
			

			$('span.helpme.help_3').on('click', function(e){
				var elem = $(".maquette_logo");
				var offset = elem.offset().left - elem.parent().offset().left; 
				$('div#desktop').animate({
					scrollTop: offset
				},500, function(){
					$(".maquette_logo").trigger("mouseenter");
				});
			});



			// HAX BURGER MENU
			$('.menu').on('click', function(){
				var checked = $("input#menu-toggle").is(":checked");
				if (checked == true) {
					$('input#menu-toggle').attr('checked', false);
				}else{
					$('input#menu-toggle').attr('checked', true);
				}
			})

			// CREATE TOOLTIP
			Tipped.create('.simple-tooltip');



			//CLICK DISPLAY DEVICE
			$('img.device.smartphone').on('click', function(){
				$('#smartphone').css('display', 'block');
				$('#tablette').css('display', 'none');
				$('.wrapper_desktop').css('display', 'none');
			})
			$('img.device.tablette').on('click', function(){
				$('#smartphone').css('display', 'none');
				$('#tablette').css('display', 'block');
				$('.wrapper_desktop').css('display', 'none');
			})
			$('img.device.desktop').on('click', function(){
				$('#smartphone').css('display', 'none');
				$('#tablette').css('display', 'none');
				$('.wrapper_desktop').css('display', 'block');
			})


			//STICKY NAVBAR
			$('#tablette').scroll(function(){
				if ($('#tablette').scrollTop() > 50){
					$('.menu').addClass('sticky');
				}else{
					$('.menu').removeClass('sticky');
				}
			});

		})
	</script>
</body>
</html>
<?php 
}else{
	header('Location: login.php');
}
?>