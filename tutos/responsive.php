<div class="help-main-topic">
	<h3 class="title">Le responsive</h3>
	<p>Le Responsive Web design est une approche de conception Web qui vise à l'élaboration de sites offrant une expérience de lecture et de navigation optimales pour l'utilisateur quelle que soit sa gamme d'appareil (téléphones mobiles, tablettes, liseuses, moniteurs d'ordinateur de bureau).

		Une expérience utilisateur "Responsive" réussie implique un minimum de redimensionnement (zoom), de recadrage, et de défilements multidirectionnels de pages.

		Le terme de "Responsive Web design" a été introduit par Ethan Marcotte dans un article de A List Apart publié en mai 2010.
	Il décrira par la suite sa théorie et pratique du responsive dans son ouvrage "Responsive Web Design" publié en 2011. Celle-ci se limite à des adaptations côté client (grilles flexibles en pourcentages, images fluides et CSS3 Media Queries).</p>

	<h4 class="title">Une version responsive</h4>
	<p>À l'heure où des centaines de tailles et formats d'écrans différents se connectent à chaque instant, la méthode du Responsive Web design apparaît comme la "solution de facilité" en vertu de son objectif principal :</p>
	<blockquote>S'adapter à tout type d'appareil de manière transparente pour l'utilisateur</blockquote>
	<ul>
		<li>Une maintenance de projet facilitée (une seule feuille de style, un seul fichier HTML, etc.)</li>
		<li>Une mise à jour transparente et un déploiment multi-plateformes</li>
		<li>Le Responsive peut être envisagé après la conception initiale du site (même si ce n'est pas l'idéal)</li>
	</ul>
	<p>L'un des avantages indéniables depuis quelques temps est que Google met en avant les sites "adaptés au mobile" au sein de ses résultats de recherche :</p>
	<img src="../img/tuto/site_mobile_badge.png" class="img-typo mb">

	<h5 class="title">Les inconvénients ne sont cependant pas nuls :</h5>
	<ul>
		<li>De bonnes connaissances techniques, et une veille technologique constante, sont indispensables</li>
		<li>Il est nécessaire de prévoir des tests nombreux et variés tout au long du projet ("device labs", simulateurs)</li>
		<li>Il est difficile de contourner les limites ergonomiques et de performances des navigateurs web</li>
		<li>Faire du responsive, c'est… plus long que de ne rien faire (25% du temps supplémentaire)</li>
	</ul>
	<p>Au final, le Responsive Web design n'est qu'un moyen parmi d'autres de parvenir à ses objectifs mais ne doit pas être considéré comme la seule éventualité ni comme une "solution magique" à tous les problèmes.

		D'ailleurs, il est fréquent qu'un cumul de différentes méthodes soit employé : par exemple un site à la fois dédié et responsive, ou un site responsive garni de certaines détections côté serveur (on parle alors de RESS), etc.

		Le site <a href="https://mediaqueri.es/">mediaqueri.es</a> est une excellente ressource pour découvrir d'autres sites web responsive à travers un annuaire.
	</p>
	<img src="../img/tuto/multiscreen2.png" class="img-typo mb">

	<h4 class="title">Responsive, Adaptatif ou Fluide ?</h4>
	<p>En France, et selon Wikipedia, le Responsive Web Design est un synonyme de "site web adaptatif".

		Techniquement, il conviendrait de distinguer les sites web Statiques, Liquides, Adaptatifs et Responsive :
	</p>
	<h5 class="title">Un design "Static"</h5>
	<p>Un design statique (ou fixe) se réfère à des dimensions figées (par exemple 960px) quelle que soit la surface de l'écran. La grande majorité des sites web était construite sur cette base avant l'arrivée du Responsive Web Design dans les années 2010.
	</p>
	<h5 class="title">Un design "Fluide"</h5>
	<p>Un site web Fluide (ou "liquid") est un site web dont toutes les largeurs de colonnes sont exprimées en unités variables (pourcentages, em, vw, etc.) et qui s'adapte généralement automatiquement à la taille de fenêtre, jusqu'à une certaine mesure.
	</p>
	<h5 class="title">Un design "Adaptive"</h5>
	<p>Un design Adaptatif est une amélioration du design statique : les unités de largeur sont fixes, mais différentes selon la taille de l'écran, qui est détectée via CSS3 Media Queries.

		Un tel design tient uniquement compte des principaux points de rupture (320px, 480px, 768px, 1024px, etc.) et adapte le gabarit en conséquence. Au final, on se retrouve avec autant de gabarits fixes que de points de ruptures.
	</p>
	<h5 class="title">Un design "Responsive"</h5>
	<p>Un site web Responsive est une amélioration du design liquide associé à des méthodes CSS3 Media Queries permettant de modifier les styles (ré-organisation de la page par exemple) selon certains critères, pour s'adapter complètement à la taille d'écran, quel que soit le point de rupture.
	</p>
	<h5 class="title">En résumé</h5>
	<p>Le site <a href="http://www.liquidapsive.com/">liquidapsive</a> propose de tester visuellement ces différents types de design.
	</p>

	<h4 class="title">et techniquement, le RWD ça implique quoi ?</h4>
	<p>Depuis sa première appellation en 2010, le Responsive Web design a quelque peu évolué. Il nécessite actuellement - en général - les technologies et méthodes suivantes :</p>
	<ul>
		<li>Une grille fluide, où les largeurs des éléments de structure sont débarrassées des unités de pixels</li>
		<li>Des images, des médias et des contenus flexibles leur permettant de ne pas <a href="https://www.alsacreations.com/tuto/lire/1038-gerer-debordement-contenu-et-cesures-css.html">"déborder de leur parent"</a> lorsque celui-ci se restreint</li>
		<li>Une adaptation de l'affichage au <a href="https://www.alsacreations.com/article/lire/1490-comprendre-le-viewport-dans-le-web-mobile.html">Viewport du terminal</a></li>
		<li>Des <a href="https://www.alsacreations.com/article/lire/930-css3-media-queries.html">CSS3 Media Queries</a> permettant d'appliquer différentes règles de styles CSS selon la taille, l'orientation ou le ratio du device</li>
		<li>Éventuellement des adaptations conditionnelles (menu de navigation) côté client, basées sur JavaScript ou jQuery</li>
		<li>Une philosophie "Mobile First" et <a href="https://www.alsacreations.com/tuto/lire/1584-menu-de-navigation-avec-amelioration-progressive.html">Enrichissement progressif"</a> facilitant l'accessibilité, la compatibilité et la performance des pages produites</li>
		<li>De plus en plus souvent de parties détectées et générées côté serveur (RESS), là aussi notamment pour accélérer l'affichage de certains composants ou ressources.</li>
	</ul>
	<p>Au final, le Responsive Web design, <a href="https://www.alsacreations.com/article/lire/1559-responsive-web-design-present-futur-adaptation-mobile.html">c'est pas si facile !</a></p>

	<h4 class="title">Le récapitulatif en une image ? </h4>
	<img src="../img/tuto/recap_responsive.png" class="img-typo mb">

	 
</div>