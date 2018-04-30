<?php
include('connexion_session.php');

if (isset($_POST['item'])) {
	$cat=$_POST['categorie'];
	$query_test=$bdd->prepare("SELECT * FROM ux_title where nom = ?");
	$query_test->bindParam(1, $cat);
	$query_test->execute();
	$result_test=$query_test->fetch();
	$nb_test=$query_test->rowCount();
	if ($nb_test>0) {
		$val=$result_test['id_title'];
		foreach ($_POST['item'] as $value) {
			$query_ajout=$bdd->prepare("INSERT INTO ux_component (nom, id_title) VALUES (?,?)");
			$query_ajout->bindParam(1, $value);
			$query_ajout->bindParam(2, $val);
			$query_ajout->execute();
		}
	}else{
		$query_ajout_title=$bdd->prepare("INSERT INTO ux_title (nom) VALUES (?)");
		$query_ajout_title->bindParam(1, $cat);
		$query_ajout_title->execute();
		$query_select_title=$bdd->prepare("SELECT * FROM ux_title limit 1 DESC");
		$query_select_title->execute();
		$result_title=$query_select_title->fetch();
		$val=$result_title['id_title'];
		foreach ($_POST['item'] as $value) {
			$query_ajout=$bdd->prepare("INSERT INTO ux_component (nom, id_title) VALUES (?,?)");
			$query_ajout->bindParam(1, $value);
			$query_ajout->bindParam(2, $val);
			$query_ajout->execute();
		}
	}
}

if (isset($_POST['recherche'])) {
	$recherche = "%".$_POST['recherche']."%";
	$query_test=$bdd->prepare("SELECT * FROM ux_title where nom like ?");
	$query_test->bindParam(1, $recherche);
	$query_test->execute();
	$recherche_all=$query_test->fetchAll();
	print_r(json_encode($recherche_all));
}