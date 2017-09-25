<?php
include('connexion_session.php');

if (isset($_POST['jobUser'])) {
	$job = $_POST['jobUser'];
	$query_test_code = $bdd->prepare("SELECT code FROM statut WHERE id_statut = :code");
	$query_test_code->bindParam(':code', $job);
	$query_test_code->execute();
	$test_code = $query_test_code->fetch();
	echo $test_code["code"];
}