<?php 

include('connexion_session.php');

$id_graph=$_SESSION['id_graph'];

if (isset($_POST['attente'])) {
	// toujours check et afficher le nombre de message non lu sur pastille du graph
	$lu=0;
	$query_test_chat=$bdd->prepare("SELECT id_graph_emet, count(*) as toto FROM `messages` WHERE id_graph_recep = ? and lu = ? group by id_graph_emet");
	$query_test_chat->bindParam(1, $id_graph);
	$query_test_chat->bindParam(2, $lu);
	$query_test_chat->execute();
	$tab=array();
	foreach ($query_test_chat as $key => $value) {
		$tab[$key]['identifiant'] = $value['id_graph_emet'];
		$tab[$key]['nombre'] = $value['toto'];
	}
	print_r(json_encode($tab));
}

if (isset($_POST['ajout_message'])) {
	$id_graph_emet=$_POST['ajout_message'];
	$query_photo_emet=$bdd->prepare("SELECT prenom, photo_avatar FROM user WHERE id_user = ?");
	$query_photo_emet->bindParam(1, $id_graph_emet);
	$query_photo_emet->execute();
	$photo_emet=$query_photo_emet->fetch();
	$query_photo_recep=$bdd->prepare("SELECT prenom, photo_avatar FROM user WHERE id_user = ?");
	$query_photo_recep->bindParam(1, $id_graph);
	$query_photo_recep->execute();
	$photo_recep=$query_photo_recep->fetch();
	$date_sql="( NOW() - INTERVAL 3 DAY )";
	$id_last=$_POST['id_last'];
	$lu=0;
	$query_message=$bdd->prepare("SELECT * FROM `messages` WHERE ((id_graph_emet = ? and id_graph_recep = ?) OR (id_graph_recep=? and id_graph_emet=?)) and date >= ? and lu = ? and id_messages>? order by date ASC");
	$query_message->bindParam(1, $id_graph_emet);
	$query_message->bindParam(2, $id_graph);
	$query_message->bindParam(3, $id_graph_emet);
	$query_message->bindParam(4, $id_graph);
	$query_message->bindParam(5, $date_sql);
	$query_message->bindParam(6, $lu);
	$query_message->bindParam(7, $id_last);
	$query_message->execute();
	// $lu=1;
	// $query_up_chat=$bdd->prepare("UPDATE `messages` SET lu = ? WHERE id_graph_emet = ?");
	// $query_up_chat->bindParam(1, $lu);
	// $query_up_chat->bindParam(2, $id_graph_emet);
	// $query_up_chat->execute();
	// $resu=$query_message->fetchAll(PDO::FETCH_ASSOC);
	// // print_r($resu);
	// $nb_resu=$query_message->rowCount();
	// var_dump($resu);
	$before="";
	$message="";
	$message_tab=array();
	$u=0;
	$t=0;
	foreach ($query_message as $key => $value) {
		// var_dump($query_message);
		$id_messages=$value["id_messages"];
		$query_message_lu=$bdd->prepare("UPDATE `messages` SET lu = 1 WHERE id_messages = ?");
		$query_message_lu->bindParam(1, $id_messages);
		$query_message_lu->execute();
		if($_POST['recep']=="emet" && $value['id_graph_emet']==$id_graph){
			$message.='<span class="chat-message-item">'.utf8_encode($value["message"]).'</span>';
			$message.='<span class="notification-date"><time class="entry-date updated" datetime="'.$value["date"].'">'.$value["date"].'</time></span>';
		}elseif( $_POST['recep']=="emet" && $value['id_graph_emet']==$id_graph_emet ){
			$message.='<li class="recep" id="'.$value["id_messages"].'">';
			$message.='<div class="author-thumb">';
			$message.='<img src="'.$photo_recep["photo_avatar"].'" alt="author" class="mCS_img_loaded">';
			$message.='</div>';
			$message.='<div class="notification-event">';
			$message.='<span class="chat-message-item">'.utf8_encode($value["message"]).'</span>';
			$message.='<span class="notification-date"><time class="entry-date updated" datetime="'.$value["date"].'">'.$value["date"].'</time></span>';
			$message.='<input type="hidden" value="'.$photo_emet["prenom"].'" class="lemet" >';
			$message.='</div>';
			$message.='</li>';
		}elseif ($_POST['recep']=="recep" && $value['id_graph_emet']==$id_graph ) {
			$message.='<li class="emet" id="'.$value["id_messages"].'">';
			$message.='<div class="author-thumb">';
			$message.='<img src="'.$photo_recep["photo_avatar"].'" alt="author" class="mCS_img_loaded">';
			$message.='</div>';
			$message.='<div class="notification-event">';
			$message.='<span class="chat-message-item">'.utf8_encode($value["message"]).'</span>';
			$message.='<span class="notification-date"><time class="entry-date updated" datetime="'.$value["date"].'">'.$value["date"].'</time></span>';
			$message.='<input type="hidden" value="'.$photo_emet["prenom"].'" class="lemet" >';
			$message.='</div>';
			$message.='</li>';
		}elseif($_POST['recep']=="recep" && $value['id_graph_emet']==$id_graph_emet){
			$message.='<span class="chat-message-item">'.utf8_encode($value["message"]).'</span>';
			$message.='<span class="notification-date"><time class="entry-date updated" datetime="'.$value["date"].'">'.$value["date"].'</time></span>';
		}

	}
	print_r($message);
}

if (isset($_POST['id_graph_emet'])) {
	// si on ouvre la chat box
	$id_graph_emet=$_POST['id_graph_emet'];
	$query_photo_emet=$bdd->prepare("SELECT prenom, photo_avatar FROM user WHERE id_user = ?");
	$query_photo_emet->bindParam(1, $id_graph_emet);
	$query_photo_emet->execute();
	$photo_emet=$query_photo_emet->fetch();
	$query_photo_recep=$bdd->prepare("SELECT prenom, photo_avatar FROM user WHERE id_user = ?");
	$query_photo_recep->bindParam(1, $id_graph);
	$query_photo_recep->execute();
	$photo_recep=$query_photo_recep->fetch();
	$date_sql="( NOW() - INTERVAL 3 DAY )";
	$query_message=$bdd->prepare("SELECT * FROM `messages` WHERE (id_graph_emet = ? and id_graph_recep = ?) OR (id_graph_recep=? and id_graph_emet=?) and date >= ? order by date ASC");
	$query_message->bindParam(1, $id_graph_emet);
	$query_message->bindParam(2, $id_graph);
	$query_message->bindParam(3, $id_graph_emet);
	$query_message->bindParam(4, $id_graph);
	$query_message->bindParam(5, $date_sql);
	$query_message->execute();
	

	$before="";
	$message="";
	$message_tab=array();
	$u=0;
	$t=0;
	$resu=$query_message->fetchAll(PDO::FETCH_ASSOC);
	// print_r($resu);
	$nb_resu=$query_message->rowCount();
	for ($i=0; $i < $nb_resu ; $i++) {
		$id_messages=$resu[$i]["id_messages"];
		$query_message_lu=$bdd->prepare("UPDATE `messages` SET lu = 1 WHERE id_messages = ? and id_graph_emet=?");
		$query_message_lu->bindParam(1, $id_messages);
		$query_message_lu->bindParam(2, $id_graph);
		$query_message_lu->execute();
		
		if($i==0){
			$message_tab[$i][$u]=$resu[$i]["message"];
		}elseif($resu[$i]["id_graph_emet"]==$resu[$i-1]["id_graph_emet"]){
			$u++;
			$message_tab[$t][$u]=$resu[$i]["message"];
		}else{	
			$u=0;
			$message_tab[$i][$u]=$resu[$i]["message"];
			$t=$i;
		}
	}
	for ($i=0; $i < $nb_resu ; $i++) {

		if($resu[$i]['id_graph_emet']==$id_graph){
			$message.='<li class="emet" id="'.$resu[$i]["id_messages"].'">';
		}else{	
			$message.='<li class="recep" id="'.$resu[$i]["id_messages"].'">';
		}	
		$message.='<div class="author-thumb">';
		if ($resu[$i]['id_graph_emet']==$id_graph) {
			$message.='<img src="'.$photo_recep["photo_avatar"].'" alt="author" class="mCS_img_loaded">';
		}else{
			$message.='<img src="'.$photo_emet["photo_avatar"].'" alt="author" class="mCS_img_loaded">';
		}
		$message.='</div>';
		$message.='<div class="notification-event">';
		if(isset($message_tab[$i])){
			$tt=count($message_tab[$i]);
			for ($u=0; $u < $tt ; $u++) { 
				$message.='<span class="chat-message-item">'.utf8_encode($message_tab[$i][$u]).'</span>';
			}
			$i=$i+$u-1;
		}
		$message.='<span class="notification-date"><time class="entry-date updated" datetime="'.$resu[$i]["date"].'">'.$resu[$i]["date"].'</time></span>';
		$message.='<input type="hidden" value="'.$photo_emet["prenom"].'" class="lemet" >';
		$message.='</div>';
		$message.='</li>';
	}
	print_r($message);
}

if (isset($_POST['envoi'])) {
	$id_recep=$_POST['envoi'];
	$id_emet=$id_graph;
	$message=utf8_decode($_POST['mess']);
	$date=date('Y-m-d H:i:s');
	$query_t_chat=$bdd->prepare("SELECT * FROM messages WHERE id_graph_emet= ? and id_graph_recep= ? and message=? and date = ?");
	$query_t_chat->bindParam(1, $id_graph);
	$query_t_chat->bindParam(2, $id_recep);
	$query_t_chat->bindParam(3, $message);
	$query_t_chat->bindParam(4, $date);
	$query_t_chat->execute();
	$nb_cha=$query_t_chat->rowCount();
	$lu=0;
	if($nb_cha==0){ 
		$query_insert_chat=$bdd->prepare("INSERT INTO messages (id_graph_emet, id_graph_recep, message, date, lu) VALUES (?,?,?,?,0) ");
		$query_insert_chat->bindParam(1, $id_graph);
		$query_insert_chat->bindParam(2, $id_recep);
		$query_insert_chat->bindParam(3, $message);
		$query_insert_chat->bindParam(4, $date);
		$query_insert_chat->execute();
	}
}