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

$query_categorie = $bdd->prepare('SELECT * FROM categorie_code');
$query_categorie->execute();

$query_code = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code  WHERE accept_code = 1 order by date_code DESC");
$query_code->execute();

$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
$query_notif_code->execute();
$result_notif_code=$query_notif_code->fetch();
$dernier=$result_notif_code['id_code'];
$id_graph=$_SESSION['id_graph'];
$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
$query_inser_code->bindParam(1, $dernier);
$query_inser_code->bindParam(2, $id_graph);
$query_inser_code->execute();

?>


<!DOCTYPE html>
<html lang="en" id="code_wrap">
<head>

	<title>Code</title>

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
		margin-left: 70px;
		width: 100%;
		float: left;
	}
	#code_editors .code_box {
		width: 33%;
		z-index: 9;
		float: left;
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
		line-height: 21px;
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
	.CodeMirror-gutter {
		background: #343436;
	}
	.CodeMirror {
		color: white;
	}
	iframe#content {
		border: none;
		width: 100%;
		height: 60vh;
		padding: 0 0 0 70px;
	}

	/* Output Area */
	#code_wrap #output {
		height: 60vh;
		float: left;
		width: 100%;
	}
	.CodeMirror-scroll {
		background: #1d1f20;
		padding-bottom: 30px;
	}
	.CodeMirror-gutters {
		background-color: #1d1f20;
		white-space: nowrap;
		border-right: inherit;
	}
	.cm-s-monokai .CodeMirror-gutters {
		background: #343436;
		border-right: 0px;
	}
	::-webkit-scrollbar {
		width: 12px;
	}
	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 20px rgb(0, 0, 0);
		border: 1px solid #343436;
	}
	::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	}
	.CodeMirror pre, .CodeMirror-linenumber {
		font-size: 13px;
	}
	.option {
		position: fixed;
		bottom: 10px;
		right: 10px;
		font-size: 14px;
		color: #888da8;
		text-transform: capitalize;
		transition: all .3s ease;
		padding: 10px 20px;
		display: block;
		color: #fff;
		background-color: #ff5e3a;
	}
	.CodeMirror-scrollbar-filler {
		display: none !important;
	}
</style>
</head>

<body id="prop-code">

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

	<div class="header-spacer header-spacer-small"></div>


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
		<iframe id="content"></iframe>
		<?php  if (!isset($_GET['id_code'])) {?>
		<a href="#" class="option" data-toggle="modal" data-target="#check_code">Proposer le code</a>
		<?php } ?>
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
							<option value="0">Choisir une catégorie</option>
							<?php foreach ($query_categorie as $key => $value) {?>
							<option value="<?php echo($value['id_categorie_code']); ?>"><?php echo utf8_encode(($value['categorie_code'])); ?></option>
							<?php }
							?>
						</select>
					</div>
					<div class="form-group is-empty label-floating ">
						<label class="control-label">Description</label>
						<textarea name="" id="" cols="30" rows="10"></textarea>
					</div>
				</div>
				<div class="row">	
					<div class="col-lg-12 col-sm-12">
						<a href="#" class="btn btn-md full-width accept">Accepter</a>
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
<script src="js/alterclass.js"></script>
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
<!-- For JS -->
<script src="http://codemirror.net/mode/javascript/javascript.js"></script>

<!-- For HTML/XML -->
<script src="http://codemirror.net/mode/xml/xml.js"></script>
<script src="http://codemirror.net/mode/htmlmixed/htmlmixed.js"></script>

<!-- For CSS -->
<script src="http://codemirror.net/mode/css/css.js"></script>



<?php 
if($_SESSION['id_statut']==1) {
						//page graphistes 
	?><script src="js/notifications.js"></script><?php
}elseif  ($_SESSION['id_statut']==2){
						//page  redacteurs
	?><script src="js/notifications_redac.js"></script><?php
}
elseif ($_SESSION['id_statut']==3) {
						//page leader
	?><script src="js/notifications_leader.js"></script><?php
}elseif ($_SESSION['id_statut']==4) {
						//page controleur
	?><script src="js/notifications_controleur.js"></script><?php
}elseif($_SESSION['id_statut']==5){
						//page admin
	?><script src="js/notifications_admin.js"></script><?php
}
?>
<script src="js/charte.js"></script>
<script src="js/html2canvas.js"></script>
<script src="js/canvas2image.js"></script>
<script>
	(function() {

	// Base template
	var base_tpl =
	"<!doctype html>\n" +
	"<html>\n\t" +
	"<head>\n\t\t" +
	"<meta charset=\"utf-8\">\n\t\t" +
	"<title>Code !</title>\n\n\t\t\n\t" +
	"<script src='https://code.jquery.com/jquery-3.2.1.min.js'><\/script>\n\t\t" + 
	"</head>\n\t" +
	"<body class='test'>\n\t\n\t" +
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
			if (titre.length >= 5) {
				$('.titre').removeClass('empty');
				if (categorie != 0) {
					$('#categorie').removeClass('empty');
					if (description.length >= 30) {
						$('#description').removeClass('empty');
						$.ajax({
							url: 'formulaire.php',
							type: 'POST',
							data: {titre_code: titre, categorie_code: categorie, description_code: description, codeHTML: html, codeCSS: css, codeJS: js}
						})
						.done(function(data) {
							 $('#check_code').modal('toggle'); 
							setTimeout(function(){
								window.location.replace("explore.php");
							}, 1000);
						})
					}else{
						$('#check_code textarea').addClass('empty');
						$('#check_code textarea').prev().html('30 caractères minimum requis');
					}
				}else{
					$('#categorie').addClass('empty');
					$('#categorie').prev().html('Une catégorie est requise');
				}
			}else{
				$('.titre').addClass('empty');
				$('.titre').prev().html('5 caractères minimum requis');
			}
		});
	$('#check_code textarea').on('click', function(){
		$(this).parent().removeClass('is-empty');
	})
}());

$(function(){
	 $(".option").on('click', function(){
		        html2canvas($("body.test"), {
			            onrendered: function (canvas) {
				                var url = canvas.toDataURL();

				                var triggerDownload = $("<a>").attr("href", url).attr("download", "test.jpeg").appendTo("body");
				                triggerDownload[0].click();
				                triggerDownload.remove();
			            }
		        });
	    }) 
})
</script>
</body>
</html>