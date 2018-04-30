<style type="text/css">
@media (min-width: 540px){
	.modal-dialog {
		max-width: 750px;
		margin: 100px auto !important;
	}
}
</style>
<div class="modal fade show" id="private-event" data-vivaldi-spatnav-clickable="1" style="padding-right: 17px; display: block;">
	<div class="modal-dialog ui-block window-popup event-private-public private-event">
		<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close" data-vivaldi-spatnav-clickable="1">
			<svg class="olymp-close-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
		</a>
		<article class="hentry post has-post-thumbnail thumb-full-width private-event">

			<div class="private-event-head inline-items">
				<svg class="olymp-close-icon" style="fill: white;background: tomato;margin: 10px;padding: 9px;width: 50px;height: 50px;border-radius: 20%;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-day-calendar-icon"></use></svg>

				<div class="author-date">
					<a class="h3 event-title" href="#">Nouvelle page remontées</a>
					<div class="event__date">
						<time class="published" datetime="2017-03-24T18:18">
							<?php echo date("d-m-Y");?>
						</time>
					</div>
				</div>
			</div>

			<div class="post-thumb">
				<img src="../img/screen_remontees.JPG" alt="photo">
			</div>

			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="post__author author vcard inline-items">
						<img src="../img/author-page.jpg" alt="author">

						<div class="author-date">
							<a class="h6 post__author-name fn" href="../pages/remontees.php">Gaylord Petit</a> a créé une  <a href="#">Mise à jour</a>
							<div class="post__date">
								<time class="published" datetime="2017-03-24T18:18">
									<?php echo date("d-m-Y");?>
								</time>
							</div>
						</div>

					</div>

					<p>
						Bonjour à tous, <br>
						Aujourd'hui je vous propose de découvrir la nouvelle page pour les remontées !	<br>					Elle vous permettra d'avoir un affichage plus clair et détaillé de chaque remontée.	<br>				La capture d'écran sera mise en avant pour un aperçu rapide.	<br>
						Toute personne pourra commenter et ainsi, un dialogue pourra s'installer pour comprendre plus facilement la demande.		<br>
						Bonne découverte à tous !
					</p>
				</div>
			</div>
			<a href="remontees.php" class="btn btn-blue btn-md" style="background: tomato;width: 100%">Voir la nouvelle page</a>
		</article>
	</div>
</div>

<script type="text/javascript">

	$(function(){
		$("#private-event").modal();


	})

</script>

<script>

	new confettiKit({
		confettiCount: 150,
		angle: 90,
		startVelocity: 75,
		colors: randomColor({hue: 'blue',count: 18}),
		elements: {
			'confetti': {
				direction: 'down',
				rotation: true,
			},
			'star': {
				count: 10,
				direction: 'down',
				rotation: true,
			},
			'ribbon': {
				count: 5,
				direction: 'down',
				rotation: true,
			},
			'custom': [{
				count: 2,
				width: 5000,
				textSize: 150,
				content: 'http://www.clker.com/cliparts/0/6/9/c/1194986736244974413balloon-red-aj.svg.thumb.png',
				contentType: 'image',
				direction: 'up',
				rotation: false,
			}]
		},
		position: 'bottomLeftRight',
	});

</script>