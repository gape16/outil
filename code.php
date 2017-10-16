<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');

if(isset($_GET['id_code'])){
	$id_code = $_GET['id_code'];
	$query_show_code = $bdd->prepare("SELECT * FROM code WHERE id_code = ?");
	$query_show_code->bindParam(1, $id_code);
	$query_show_code->execute();
	$code = $query_show_code->fetch();
}


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
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	


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
	<link rel="stylesheet" href="http://codemirror.net/lib/codemirror.css">
	<link rel="stylesheet" href="css/monokai.css">

	<style>
		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}

		html, body {
			width: 100%; height: 100%;
		}

		#wrap {
			width: 100%;
			height: 100%;
		}

		/* Code Editors */

		#code_editors {
			position: absolute;
			top: 70px;
			left: 70px;
			bottom: 0;
			right: 60%;
		}

		#code_editors .code_box {
			height: 33%; width: 100%;
			position: relative;
			z-index: 9;
		}
		.code_box h3 {
			font-size: 13px;
			height: 30px;
			padding: 5px 10px 5px 40px;
			margin: 0;
			background: #343436;
			color: white;
			border-bottom: 1px solid #202020;
			z-index: 10;
		}
		.code_box textarea {
			position: absolute;
			left: 0; right: 0; top: 30px; bottom: 0;
			resize: none; border: 0;
			padding: 10px;
			font-family: monospace;
		}
		.code_box textarea:focus {
			outline: none;
			background: #EFEFEF;
		}
		.CodeMirror {
			color: white;
		}

		/* Output Area */
		#output {
			position: absolute;
			left: 40%; top: 70px; right: 0; bottom: 0;
			border-left-width: 10px;
			overflow: hidden;
		}
		.CodeMirror-scroll {
			background: #1d1f20;
			padding-bottom: initial;
		}

		#output iframe {
			width: 100%; height: 100%;
			border: 0;
		}
		.CodeMirror-gutters {
			background-color: #1d1f20;
			white-space: nowrap;
			border-right: inherit;
		}
		::-webkit-scrollbar {
			width: 12px;
		}

		::-webkit-scrollbar-thumb {
			-webkit-box-shadow: inset 0 0 20px rgb(0, 0, 0);
		}

		::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		}
		.CodeMirror pre, .CodeMirror-linenumber {
			font-size: 13px;
		}
		.option{
			position: absolute;
			bottom: 10px;
			right: 80px;
		}
	</style>

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
	<!-- Code Editors -->
	<section id="code_editors">
		<div id="html" class="code_box">
			<h3>HTML</h3>
			<textarea name="html"><?php if(isset($_GET['id_code'])) {echo utf8_encode($code['code_html']); }?></textarea>
		</div>
		<div id="css" class="code_box">
			<h3>CSS</h3>
			<textarea name="css"><?php if(isset($_GET['id_code'])) {echo utf8_encode($code['code_css']); }?></textarea>
		</div>
		<div id="js" class="code_box">
			<h3>JavaScript</h3>
			<textarea name="js"><?php if(isset($_GET['id_code'])) {echo utf8_encode($code['code_js']); }?></textarea>
		</div>
	</section>
	
	<!-- Sandboxing -->
	<section id="output">
		<iframe></iframe>
		<a href="#" class="option" data-toggle="modal" data-target="#check_code">CLIC</div>
		</section>

	</div>

	<div class="modal fade show" id="check_code">
		<div class="modal-dialog ui-block window-popup edit-widget edit-widget-pool">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
				<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
			</a>
			<div class="ui-block-title">
				<h6 class="title">Valider le code</h6>
			</div>
			<div class="ui-block">
				<div class="ui-block-content">
					<div class="row modalcheck">	
						<div class="form-group is-empty label-floating ">
							<label class="control-label">Titre</label>
							<input class="form-control titre" placeholder="" value="" type="text">
						</div>
						<div class="form-group is-empty label-floating ">
							<select id="categorie">
								<option value="1">HTML</option>
								<option value="2">CSS</option>
								<option value="3">JS</option>
							</select>
						</div>
						<div class="form-group is-empty label-floating ">
							<label class="control-label">Description</label>
							<textarea name="" id="" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="row">	
						<div class="col-lg-12 col-sm-12">
							<a href="#" data-dismiss="modal" class="btn btn-md full-width accept">Accepter</a>
						</div>
					</div>
				</div>
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
	<!-- <script src="js/chat.js"></script> -->
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

	<script src="http://codemirror.net/lib/codemirror.js"></script>

	<!-- For HTML/XML -->
	<script src="http://codemirror.net/mode/xml/xml.js"></script>
	<script src="http://codemirror.net/mode/htmlmixed/htmlmixed.js"></script>

	<!-- For CSS -->
	<script src="http://codemirror.net/mode/css/css.js"></script>

	<!-- For JS -->
	<script src="http://codemirror.net/mode/javascript/javascript.js"></script>

	<script>
		(function() {

	// Base template
	var base_tpl =
	"<!doctype html>\n" +
	"<html>\n\t" +
	"<head>\n\t\t" +
	"<meta charset=\"utf-8\">\n\t\t" +
	"<title>Test</title>\n\n\t\t\n\t" +
	"<script src='https://code.jquery.com/jquery-3.2.1.min.js'><\/script>\n\t\t" + 
	"</head>\n\t" +
	"<body>\n\t\n\t" +
	"</body>\n" +
	"</html>";
	
	var prepareSource = function() {
		var html = html_editor.getValue(),
		css = css_editor.getValue(),
		js = js_editor.getValue(),
		src = '';
		
		// HTML
		src = base_tpl.replace('</body>', html + '</body>');
		
		// CSS
		css = '<style>' + css + '</style>';
		src = src.replace('</head>', css + '</head>');
		
		// Javascript
		js = '<script>' + js + '<\/script>';
		src = src.replace('</body>', js + '</body>');
		
		return src;
	};
	
	var render = function() {
		var source = prepareSource();
		
		var iframe = document.querySelector('#output iframe'),
		iframe_doc = iframe.contentDocument;
		
		iframe_doc.open();
		iframe_doc.write(source);
		iframe_doc.close();
	};
	
	
	// EDITORS
	
	// CM OPTIONS
	var cm_opt = {
		mode: 'text/html',
		gutter: true,
		lineNumbers: true,
		theme: 'monokai'
	};
	
	// HTML EDITOR
	var html_box = document.querySelector('#html textarea');
	var html_editor = CodeMirror.fromTextArea(html_box, cm_opt);

	html_editor.on('change', function (inst, changes) {
		render();
	});
	
	// CSS EDITOR
	cm_opt.mode = 'css';
	var css_box = document.querySelector('#css textarea');
	var css_editor = CodeMirror.fromTextArea(css_box, cm_opt);

	css_editor.on('change', function (inst, changes) {
		render();
	});
	
	// JAVASCRIPT EDITOR
	cm_opt.mode = 'javascript';
	var js_box = document.querySelector('#js textarea');
	var js_editor = CodeMirror.fromTextArea(js_box, cm_opt);

	js_editor.on('change', function (inst, changes) {
		render();
	});
	
	<?php if(!isset($_GET['id_code'])){?>
	// SETTING CODE EDITORS INITIAL CONTENT
	html_editor.setValue('<p>Hello World</p>');
	css_editor.setValue('body { color: red; }');
	js_editor.setValue('$(document).ready(function(){\n});');
	
	<?php }else{?>
		render();
		<?php }	?>

	// RENDER CALL ON PAGE LOAD
	// NOT NEEDED ANYMORE, SINCE WE RELY
	// ON CODEMIRROR'S onChange OPTION THAT GETS
	// TRIGGERED ON setValue
	// render();
	
	
	// NOT SO IMPORTANT - IF YOU NEED TO DO THIS
	// THEN THIS SHOULD GO TO CSS
	
	/*
		Fixing the Height of CodeMirror.
		You might want to do this in CSS instead
		of JS and override the styles from the main
		codemirror.css
		*/
		var cms = document.querySelectorAll('.CodeMirror .cm-s-monokai');
		for (var i = 0; i < cms.length; i++) {

			cms[i].style.position = 'absolute';
			cms[i].style.top = '30px';
			cms[i].style.bottom = '0';
			cms[i].style.left = '0';
			cms[i].style.right = '0';
			cms[i].style.height = '100%';
		}
	/*cms = document.querySelectorAll('.CodeMirror-scroll');
	for (i = 0; i < cms.length; i++) {
		cms[i].style.height = '100%';
	}*/

	$('#check_code .accept').on('click', function(){

			//recup info à propos du code
			var titre = $('.titre').val();
			var categorie = $('select#categorie').val();
			var description = $('#check_code textarea').val();
			//recup code
			var html = html_editor.getValue();
			var css = css_editor.getValue();
			var js = js_editor.getValue();
			console.log(html);
			$.ajax({
				url: 'formulaire.php',
				type: 'POST',
				data: {titre_code: titre, categorie_code: categorie, description_code: description, codeHTML: html, codeCSS: css, codeJS: js}
			})
			.done(function(data) {
				console.log(data);
			})
		});
	$('#check_code textarea').on('click', function(){
		$(this).parent().removeClass('is-empty');
	})
}());


</script>
</body>
</html>