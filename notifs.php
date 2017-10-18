<?php

include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

$query_select=$bdd->prepare("SELECT * FROM notifications where id_user = ?");
$query_select->bindParam(1, $id_graph);
$query_select->execute();
$result=$query_select->fetch();

if($result['notif_A']==0){
	$query_notif_code=$bdd->prepare("SELECT * FROM code order by id_notif DESC limit 1");
	$query_notif_code->execute();
	$result_notif_code=$query_notif_code->fetch();
	$dernier=$result_notif_code['id_notif'];
	$query_inser_code=$bdd->prepare("UPDATE code set notif_A = ? where id_user = ?");
	$query_inser_code->bindParam(1, $dernier);
	$query_inser_code->bindParam(2, $id_graph);
	$query_inser_code->execute();
}else{
	$dernier=$result['notif_A'];
	$query_notif_code=$bdd->prepare("SELECT * FROM code WHERE id_notif > ? order by id_notif DESC");
	$query_notif_code->bindParam(1, $dernier);
	$query_notif_code->execute();
	$notif_code = ;
	json_encode($query_notif_code);
}

if($result['notif_B']==0){

}

if($result['notif_C']==0){

}

