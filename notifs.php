<?php

include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

$bdd->exec('SET NAMES utf8');
$query_select=$bdd->prepare("SELECT * FROM notifications where id_user = ?");
$query_select->bindParam(1, $id_graph);
$query_select->execute();
$result=$query_select->fetch();

if($result['notif_A']==0){
	$query_notif_code=$bdd->prepare("SELECT * FROM code order by id_code DESC limit 1");
	$query_notif_code->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_code'];
	$query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();
	// echo "UPDATE notifications set notif_A = '$dernier' where id_user = '$id_graph'";
}else{
	$dernier=$result['notif_A'];
	$query_notif_code=$bdd->prepare("SELECT description, titre, photo, categorie_code.categorie_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? order by id_code DESC");
	$query_notif_code->bindParam(1, $dernier);
	$query_notif_code->execute();
	$notif_code = $query_notif_code->fetchAll();
	print_r(json_encode($notif_code));
}

if($result['notif_B']==0){

}

if($result['notif_C']==0){

}

