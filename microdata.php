<?php

// Connexion à la base de donnée et insertion de session_start
include('connexion_session.php');
$id_graph=$_SESSION['id_graph'];

$query_code = $bdd->prepare("SELECT * FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code  WHERE accept_code = 1 order by date_code DESC");
$query_code->execute();

$query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
$query_notif_code->execute();
$result_notif_code=$query_notif_code->fetch();
$dernier=$result_notif_code['id_code'];
$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
$query_inser_code->bindParam(1, $dernier);
$query_inser_code->bindParam(2, $id_graph);
$query_inser_code->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Découvre le code des autres</title>

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
	<style>
	.align-center {
		width: 100%;
	}
	input, textarea, select{
		background: white !important;
	}
	textarea.json{
		min-height: 400px;
	}
</style>
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

	<?php 
	if($_SESSION['id_statut']==1) {
			//page graphistes 
		include('header.php');
	}elseif  ($_SESSION['id_statut']==2){
			//page  redacteurs
		include('header_redac.php');
	}
	elseif ($_SESSION['id_statut']==3) {
			//page leader
		include('header_leader.php');
	}elseif ($_SESSION['id_statut']==4) {
			//page controleur
		include('header_controleur.php');
	}elseif($_SESSION['id_statut']==5){
			//page admin
		include('header_admin.php');
	}
	?>

	<!-- ... end Header -->


	<!-- Responsive Header -->

	<?php include('responsive_header.php');?>

	<!-- ... end Responsive Header -->

	<!-- ... end Responsive Header -->


	<div class="header-spacer header-spacer-small"></div>

	<div class="main-header">
		<div class="content-bg-wrap">
			<div class="content-bg bg-account"></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
					<div class="main-header-content">
						<h1>Générateur de microdata</h1>
						<p>Cet espace vous permet de simplement et rapidement créer vos microdatas. Vous devez complétez les champs à gauche et tout le code json ld s'écrira au fûr et à mesure sur la partie droite
						</p>
					</div>
				</div>
			</div>
		</div>

		<img class="img-bottom" src="img/account-bottom.png" alt="friends">
	</div>

	<!-- Code Editors -->
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<article class="page">
					<h1>GENERATEUR MICRODATA</h1>
					<h4>Fomulaire &amp; Json ld</h4>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="article-wrap">
								<div id="formHolder">
									<form id="selector" style="display:none;">
										Select the type of markup you want to create:
										<div class="form-group">
											<select id="form-selector" name="form-selector">
												<option>---</option>
											</select>
										</div>
									</form>
									<form id="local_business" >
										<input type="hidden" data-path="@context" value="http://www.schema.org">
										<div class="form-group">
											<label for="orgType">Selectionnez le type de Local Business:</label>
											<select class="work" name="orgType" data-path="@type">
												<option>Local Business</option>
												<option value="TravelAgency">Agence de voyage</option>
												<option value="InsuranceAgency">Agent d'assurance</option>
												<option value="RealEstateAgent">Agent immobilier</option>
												<option value="PetStore">Animalerie</option>
												<option value="Hostel">Auberge</option>
												<option value="Attorney">Avocat</option>
												<option value="BankOrCreditUnion">Banque ou caisse populaire</option>
												<option value="BarOrPub">Bar / Pub</option>
												<option value="JewelryStore">Bijouterie</option>
												<option value="Bakery">Boulangerie</option>
												<option value="HobbyShop">Boutique Hobby</option>
												<option value="Brewery">Brasserie</option>
												<option value="PostOffice">Bureau de poste</option>
												<option value="CafeOrCoffeeShop">Café / CoffeShop</option>
												<option value="Campground">Camping</option>
												<option value="AutoBodyShop">Carrosserie auto</option>
												<option value="Casino">Casino</option>
												<option value="RecyclingCenter">Centre de recyclage</option>
												<option value="HVACBusiness">Chauffagiste / Climatiseur</option>
												<option value="MovieTheater">Cinéma</option>
												<option value="MedicalClinic">Clinique médicale</option>
												<option value="NightClub">Club / Boite de nuit</option>
												<option value="ComedyClub">Club de comédie</option>
												<option value="SportsClub">Club de sport</option>
												<option value="TennisComplex">Club de tennis</option>
												<option value="MiddleSchool">Collège</option>
												<option value="Resort">Complexe touristique</option>
												<option value="AccountingService">Comptable</option>
												<option value="AutoDealer">Concession auto</option>
												<option value="MotorcycleDealer">Concession moto</option>
												<option value="FinancialService">Conseiller financier</option>
												<option value="HomeAndConstructionBusiness">Construction immobilière</option>
												<option value="RoofingContractor">Couvreur / Toiture</option>
												<option value="InternetCafe">Cyber café</option>
												<option value="MovingCompany">Déménageur</option>
												<option value="Dentist">Dentiste</option>
												<option value="School">École</option>
												<option value="Preschool">École maternelle</option>
												<option value="ElementarySchool">École primaire</option>
												<option value="Electrician">Electricien</option>
												<option value="SelfStorage">Entreposage</option>
												<option value="GroceryStore">Épicerie</option>
												<option value="HealthAndBeautyBusiness">Esthétique et bien etre</option>
												<option value="Winery">Établissement vinicole</option>
												<option value="Florist">Fleuriste</option>
												<option value="ArtGallery">Galerie d'art</option>
												<option value="AutoRepair">Garage auto</option>
												<option value="ChildCare">Garderie d'enfants</option>
												<option value="IceCreamShop">Glacier</option>
												<option value="AutomatedTeller">Guichet automatique</option>
												<option value="Hospital">Hopital</option>
												<option value="Hotel">Hotel</option>
												<option value="AutoWash">Lavage auto</option>
												<option value="BookStore">Librairie</option>
												<option value="BedAndBreakfast">Lit et petit-déjeuner</option>
												<option value="AutoRental">Location auto</option>
												<option value="LodgingBusiness">Location de vacances</option>
												<option value="HighSchool">Lycée</option>
												<option value="Store">Magasin</option>
												<option value="LiquorStore">Magasin d'alcool</option>
												<option value="WholesaleStore">Magasin d'alimentation</option>
												<option value="HomeGoodsStore">Magasin de bricolage / Maison</option>
												<option value="ShoeStore">Magasin de chaussures</option>
												<option value="OfficeEquipmentStore">Magasin de fournitures de bureau</option>
												<option value="GardenStore">Magasin de jardinage</option>
												<option value="ToyStore">Magasin de jouets</option>
												<option value="FurnitureStore">Magasin de meubles</option>
												<option value="AutoPartsStore">Magasin de pièces auto</option>
												<option value="TireShop">Magasin de pneus</option>
												<option value="ClothingStore">Magasin de vetements</option>
												<option value="ElectronicsStore">Magasin d'électronique</option>
												<option value="MusicStore">Magasin d'instruments de musique</option>
												<option value="ComputerStore">Magasin informatique</option>
												<option value="MobilePhoneStore">Magasin téléphonie</option>
												<option value="MensClothingStore">Magasin Vetements Homme</option>
												<option value="GeneralContractor">Maitre d'ouvrage</option>
												<option value="Physician">Médecin</option>
												<option value="ProfessionalService">Médecine alternative</option>
												<option value="EntertainmentBusiness">Métiers du spectacle</option>
												<option value="FurnitureStore">Meubles</option>
												<option value="Motel">Motel</option>
												<option value="Notary">Notaire</option>
												<option value="Optician">Opticien</option>
												<option value="AmusementPark">Parc d'attractions</option>
												<option value="RVPark">Parc de véhicules récréatifs</option>
												<option value="HousePainter">Peintre en bâtiment</option>
												<option value="Pharmacy">Pharmacie</option>
												<option value="PublicSwimmingPool">Piscine publique</option>
												<option value="DryCleaningOrLaundry">Pressing / Teinturier</option>
												<option value="Residence">Résidence / Maison de retraite</option>
												<option value="Restaurant">Restaurant</option>
												<option value="EventVenue">Salle de fêtes</option>
												<option value="ExerciseGym">Salle de sport</option>
												<option value="BeautySalon">Salon de beauté</option>
												<option value="HairSalon">Salon de coiffure</option>
												<option value="NailSalon">Salon de manucure</option>
												<option value="Locksmith">Serrurier</option>
												<option value="EmergencyService">Service d'urgences</option>
												<option value="DaySpa">Spa de jour</option>
												<option value="StadiumOrArena">Stade</option>
												<option value="RadioStation">Station de radio</option>
												<option value="SkiResort">Station de ski</option>
												<option value="TelevisionStation">Station de télévision</option>
												<option value="TattooParlor">Tattoo / Piercing</option>
												<option value="Taxi">Taxi</option>
												<option value="GolfCourse">Terrain de golf</option>
												<option value="CollegeOrUniversity">Université</option>
												<option value="BikeStore">Magasin vélos</option>
												<option value="ClothingStore">Magasin de vêtements</option>
												<option value="VeterinaryCare">Vétérinaire</option>
											</select>
										</div>
										<div class="form-group">
											<label for="name">Nom:</label>
											<input class="name" name="name" type="text" data-path="name" >
										</div>
										<div class="form-group">
											<label for="tel">Téléphone:</label>
											<input class="tel" name="tel" type="text" data-path="telephone" placeholder="+33XXXXXXXXX">
										</div>
										<div class="form-group">
											<label for="price">Prix:</label>
											<input class="price" name="price" type="text" data-path="priceRange" placeholder="$$$">
										</div>
										<div class="form-group">
											<label for="url">URL:</label>
											<input class="url" name="url" type="text" data-path="url" >
										</div>
										<div class="form-group">
											<label for="logo">Logo (utiliser l'URL de votre logo):</label>
											<input class="image" name="logo" type="text" data-path="image" >
										</div>
										<div class="form-group">
											<label for="desription">Description:</label><br>
											<textarea rows="5" cols="50" name="description" data-path="description" class="form-control" ></textarea>
										</div>
										<div class="form-group">
											<input type="hidden" data-path="address.@type" value="PostalAddress">
											<label for="address">Adresse:</label>
											<input class="address" name="address" type="text" data-path="address.streetAddress"  >
										</div>
										<div class="form-group">
											<label for="addressLocality">Ville:</label>
											<input class="addressLocality" name="addressLocality" type="text" data-path="address.addressLocality">
										</div>
										<div class="form-group">
											<label for="addressRegion">Région:</label>
											<input class="addressRegion" name="addressRegion" type="text" data-path="address.addressRegion">
										</div>
										<div class="form-group">
											<label for="postalCode">Code postal:</label>
											<input class="postalCode" name="postalCode" type="text" data-path="address.postalCode">
										</div>
										<div class="form-group">
											<label for="addressCountry">Pays:</label>
											<input class="addressCountry" name="addressCountry" type="text" data-path="address.addressCountry">
										</div>
										<h4>Localisation de l'entreprise</h4>
										<div class="form-group">
											<label for="geoOption">Inclure les coordonnées des Lat/Long pour une meilleure localisation</label>
											<br/>
											<input type='hidden' data-path='geo.@type' value='GeoCoordinates'>
											<label for="geoLat">Latitude:</label>
											<input type='text' class='geoLat' name='geoLat' data-path='geo.latitude'>
											<label for="geoLong">Longitude:</label>
											<input type='text' class='geoLong' name='geoLong' data-path='geo.longitude'>
										</div>
										<h4>Zone d'intervention</h4>
										<input type='hidden' data-path='areaServed.@type' value='GeoCircle'>
										<input type='hidden' data-path='areaServed.geoMidpoint.@type' value='GeoCoordinates'>
										<div class="form-group">
											<label for="geoMidpointLat">Latitude:</label>
											<input type='text' class='geoMidpointLat' name='geoMidpointLat' data-path='areaServed.geoMidpoint.latitude'>
										</div>
										<div class="form-group">
											<label for="geoMidpointLong">Longitude:</label>
											<input type='text' class='geoMidpointLong' name='geoMidpointLong' data-path='areaServed.geoMidpoint.longitude'>
										</div>
										<div class="form-group">
											<label for="geoRadiusdist">Distance (rayon):</label>
											<input type='text' class='geoRadiusdist' name='geoRadiusdist' data-path='areaServed.geoRadius'>
										</div>
										<div class="form-group">
											<label for="hasMap">Inclure une carte: <span class="mapHelp"><i class="fa fa-question-circle"></i></span></label>
											<input class="hasMap" name="hasMap" type="text" data-path="hasMap">
										</div>
										<p>
											Selectionnez les horaires d'ouverture:<br><br>
										</p>
										<input class='openingHours' type="hidden" data-path='openingHours'>
										<div class='days Mo'>
											<div class="day-line">
												<label for='openMon'>Lundi</label>
												<input name='openMon' class='openDays' type='checkbox' data-day='Mo'>
											</div>
										</div>
										<div class='days Tu'>
											<div class="day-line">
												<label for='openTue'>Mardi</label>
												<input name='openTue' class='openDays' type='checkbox' data-day='Tu'>
											</div>
										</div>
										<div class='days We'>
											<div class="day-line">
												<label for='openWed'>Mercredi</label>
												<input name='openWed' class='openDays' type='checkbox' data-day='We'>
											</div>
										</div>
										<div class='days Th'>
											<div class="day-line">
												<label for='openThu'>Jeudi</label>
												<input name='openThur' class='openDays' type='checkbox' data-day='Th'>
											</div>
										</div>
										<div class='days Fr'>
											<div class="day-line">
												<label for='openFri'>Vendredi</label>
												<input name='openFri' class='openDays' type='checkbox' data-day='Fr'>
											</div>
										</div>
										<div class='days Sa'>
											<div class="day-line">
												<label for='openSat'>Samedi</label>
												<input name='openSat' class='openDays' type='checkbox' data-day='Sa'>
											</div>
										</div>
										<div class='days Su'>
											<div class="day-line">
												<label for='openSun'>Dimanche</label>
												<input name='openSun' class='openDays' type='checkbox' data-day='Su'>
											</div>
										</div>
									</form>

								</div>
								<div id="sameAsHidden" style="display: none;">
									<input class="sameAsField" name="sameAs" type="text">
								</div>
								<div id="timeKeeper" style="display: none;">
									<span class='openHours' > <label for='open'>Ouvert</label>
										<select class='times' name='open'>
											<option value="">--</option>
											<option value="01:00">00:00</option>
											<option value="01:00">00:30</option>
											<option value="01:00">01:00</option>
											<option value="01:30">01:30</option>
											<option value="02:00">02:00</option>
											<option value="02:30">02:30</option>
											<option value="03:00">03:00</option>
											<option value="03:30">03:30</option>
											<option value="04:00">04:00</option>
											<option value="04:30">04:30</option>
											<option value="05:00">05:00</option>
											<option value="05:30">05:30</option>
											<option value="06:00">06:00</option>
											<option value="06:30">06:30</option>
											<option value="07:00">07:00</option>
											<option value="07:30">07:30</option>
											<option value="08:00">08:00</option>
											<option value="08:30">08:30</option>
											<option value="09:00">09:00</option>
											<option value="09:30">09:30</option>
											<option value="10:00">10:00</option>
											<option value="10:30">10:30</option>
											<option value="11:00">11:00</option>
											<option value="11:30">11:30</option>
											<option value="12:00">12:00</option>
											<option value="12:30">12:30</option>
											<option value="13:00">13:00</option>
											<option value="13:30">13:30</option>
											<option value="14:00">14:00</option>
											<option value="14:30">14:30</option>
											<option value="15:00">15:00</option>
											<option value="15:30">15:30</option>
											<option value="16:00">16:00</option>
											<option value="16:30">16:30</option>
											<option value="17:00">17:00</option>
											<option value="17:30">17:30</option>
											<option value="18:00">18:00</option>
											<option value="18:30">18:30</option>
											<option value="19:00">19:00</option>
											<option value="19:30">19:30</option>
											<option value="20:00">20:00</option>
											<option value="20:30">20:30</option>
											<option value="21:00">21:00</option>
											<option value="21:30">21:30</option>
											<option value="22:00">22:00</option>
											<option value="22:30">22:30</option>
											<option value="23:00">23:00</option>
											<option value="23:30">23:30</option>
										</select> </span>
										<span class='closeHours'> <label for='close'>Fermé</label>
											<select class='times' name='close'>
												<option value="">--</option>
												<option value="01:00">00:00</option>
												<option value="01:00">00:30</option>
												<option value="01:00">01:00</option>
												<option value="01:30">01:30</option>
												<option value="02:00">02:00</option>
												<option value="02:30">02:30</option>
												<option value="03:00">03:00</option>
												<option value="03:30">03:30</option>
												<option value="04:00">04:00</option>
												<option value="04:30">04:30</option>
												<option value="05:00">05:00</option>
												<option value="05:30">05:30</option>
												<option value="06:00">06:00</option>
												<option value="06:30">06:30</option>
												<option value="07:00">07:00</option>
												<option value="07:30">07:30</option>
												<option value="08:00">08:00</option>
												<option value="08:30">08:30</option>
												<option value="09:00">09:00</option>
												<option value="09:30">09:30</option>
												<option value="10:00">10:00</option>
												<option value="10:30">10:30</option>
												<option value="11:00">11:00</option>
												<option value="11:30">11:30</option>
												<option value="12:00">12:00</option>
												<option value="12:30">12:30</option>
												<option value="13:00">13:00</option>
												<option value="13:30">13:30</option>
												<option value="14:00">14:00</option>
												<option value="14:30">14:30</option>
												<option value="15:00">15:00</option>
												<option value="15:30">15:30</option>
												<option value="16:00">16:00</option>
												<option value="16:30">16:30</option>
												<option value="17:00">17:00</option>
												<option value="17:30">17:30</option>
												<option value="18:00">18:00</option>
												<option value="18:30">18:30</option>
												<option value="19:00">19:00</option>
												<option value="19:30">19:30</option>
												<option value="20:00">20:00</option>
												<option value="20:30">20:30</option>
												<option value="21:00">21:00</option>
												<option value="21:30">21:30</option>
												<option value="22:00">22:00</option>
												<option value="22:30">22:30</option>
												<option value="23:00">23:00</option>
												<option value="23:30">23:30</option>
												<option value="23:59">23:59</option>
											</select> </span></div>

											<div id="timeKeeper2" style="display: none;">
												<span class='openHours2'> <label for='open2'>Ouvert</label>
													<select class='times' name='open2'>
														<option value="">--</option>
														<option value="01:00">00:00</option>
														<option value="01:00">00:30</option>
														<option value="01:00">01:00</option>
														<option value="01:30">01:30</option>
														<option value="02:00">02:00</option>
														<option value="02:30">02:30</option>
														<option value="03:00">03:00</option>
														<option value="03:30">03:30</option>
														<option value="04:00">04:00</option>
														<option value="04:30">04:30</option>
														<option value="05:00">05:00</option>
														<option value="05:30">05:30</option>
														<option value="06:00">06:00</option>
														<option value="06:30">06:30</option>
														<option value="07:00">07:00</option>
														<option value="07:30">07:30</option>
														<option value="08:00">08:00</option>
														<option value="08:30">08:30</option>
														<option value="09:00">09:00</option>
														<option value="09:30">09:30</option>
														<option value="10:00">10:00</option>
														<option value="10:30">10:30</option>
														<option value="11:00">11:00</option>
														<option value="11:30">11:30</option>
														<option value="12:00">12:00</option>
														<option value="12:30">12:30</option>
														<option value="13:00">13:00</option>
														<option value="13:30">13:30</option>
														<option value="14:00">14:00</option>
														<option value="14:30">14:30</option>
														<option value="15:00">15:00</option>
														<option value="15:30">15:30</option>
														<option value="16:00">16:00</option>
														<option value="16:30">16:30</option>
														<option value="17:00">17:00</option>
														<option value="17:30">17:30</option>
														<option value="18:00">18:00</option>
														<option value="18:30">18:30</option>
														<option value="19:00">19:00</option>
														<option value="19:30">19:30</option>
														<option value="20:00">20:00</option>
														<option value="20:30">20:30</option>
														<option value="21:00">21:00</option>
														<option value="21:30">21:30</option>
														<option value="22:00">22:00</option>
														<option value="22:30">22:30</option>
														<option value="23:00">23:00</option>
														<option value="23:30">23:30</option>
													</select> </span>
													<span class='closeHours2'> <label for='close2'>Fermé</label>
														<select class='times' name='close2'>
															<option value="">--</option>
															<option value="01:00">00:00</option>
															<option value="01:00">00:30</option>
															<option value="01:00">01:00</option>
															<option value="01:30">01:30</option>
															<option value="02:00">02:00</option>
															<option value="02:30">02:30</option>
															<option value="03:00">03:00</option>
															<option value="03:30">03:30</option>
															<option value="04:00">04:00</option>
															<option value="04:30">04:30</option>
															<option value="05:00">05:00</option>
															<option value="05:30">05:30</option>
															<option value="06:00">06:00</option>
															<option value="06:30">06:30</option>
															<option value="07:00">07:00</option>
															<option value="07:30">07:30</option>
															<option value="08:00">08:00</option>
															<option value="08:30">08:30</option>
															<option value="09:00">09:00</option>
															<option value="09:30">09:30</option>
															<option value="10:00">10:00</option>
															<option value="10:30">10:30</option>
															<option value="11:00">11:00</option>
															<option value="11:30">11:30</option>
															<option value="12:00">12:00</option>
															<option value="12:30">12:30</option>
															<option value="13:00">13:00</option>
															<option value="13:30">13:30</option>
															<option value="14:00">14:00</option>
															<option value="14:30">14:30</option>
															<option value="15:00">15:00</option>
															<option value="15:30">15:30</option>
															<option value="16:00">16:00</option>
															<option value="16:30">16:30</option>
															<option value="17:00">17:00</option>
															<option value="17:30">17:30</option>
															<option value="18:00">18:00</option>
															<option value="18:30">18:30</option>
															<option value="19:00">19:00</option>
															<option value="19:30">19:30</option>
															<option value="20:00">20:00</option>
															<option value="20:30">20:30</option>
															<option value="21:00">21:00</option>
															<option value="21:30">21:30</option>
															<option value="22:00">22:00</option>
															<option value="22:30">22:30</option>
															<option value="23:00">23:00</option>
															<option value="23:30">23:30</option>
															<option value="23:59">23:59</option>
														</select> </span>
													</div>

												</div><!-- /.article-wrap -->
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<div class="output">
													<div class="form-group">
														<textarea class="json form-control" readonly="readonly"></textarea>
														<div id="buttonHolder">
															<button class="btn btn-warning" id="reset">
																Renitialiser
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</article>

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
						<script src="js/gen-microdata.js"></script>
						<script src="js/sur-microdata.js"></script>
					</body>
					</html>