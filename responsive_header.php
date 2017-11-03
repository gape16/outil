<?php
$id_graph=$_SESSION['id_graph'];

$query_graph = $bdd->prepare("SELECT nom, prenom, photo_avatar, nom_statut FROM user inner join statut on user.id_statut =statut.id_statut where id_user = ?");
$query_graph->bindParam(1, $id_graph);
$query_graph->execute();
$infos = $query_graph->fetch();

$query_select_card = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and (date_retour_maquette IS NOT NULL and date_retour_cq IS NOT NULL)");
$query_select_card->bindParam(1, $id_graph);
$query_select_card->execute();
$cards_client_select=$query_select_card->fetchAll();
$nb_cards_client=$query_select_card->rowCount();

$query_select_notif = $bdd->prepare("SELECT id_notif from notifications where id_user = ?");
$query_select_notif->bindParam(1, $id_graph);
$query_select_notif->execute();
$nb_notifs=$query_select_notif->rowCount();
if($nb_notifs==0){
  $query_insert_notif = $bdd->prepare("INSERT INTO notifications (notif_A, notif_B, notif_C, notif_D, id_user) VALUES ('0','0','0','0',?)");
  $query_insert_notif->bindParam(1, $id_graph);
  $query_insert_notif->execute();
}
?>
<header class="header header-responsive" id="site-header-responsive">

  <div class="header-content-wrapper">
    <?php 
    $bdd->exec('SET NAMES utf8');
    $query_select=$bdd->prepare("SELECT * FROM notifications where id_user = ?");
    $query_select->bindParam(1, $id_graph);
    $query_select->execute();
    $result=$query_select->fetch();
    if($result['notif_A']==0){
      $query_notif_code=$bdd->prepare("SELECT * FROM code where accept_code = 1 order by id_code DESC limit 1");
      $query_notif_code->execute();
      $result_notif_code=$query_notif_code->fetch();
      $dernier=$result_notif_code['id_code'];
      $query_inser_code=$bdd->prepare("UPDATE notifications set notif_A = ? where id_user = ?");
      $query_inser_code->bindParam(1, $dernier);
      $query_inser_code->bindParam(2, $id_graph);
      $query_inser_code->execute();
    }else{
      $dernier=$result['notif_A'];
      $query_notif_code=$bdd->prepare("SELECT description, titre, photo, categorie_code.categorie_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? and accept_code = 1 order by id_code DESC");
      $query_notif_code->bindParam(1, $dernier);
      $query_notif_code->execute();
    }
    if($result['notif_B']==0){
      $query_notif_codeb=$bdd->prepare("SELECT * FROM veille order by id_veille DESC limit 1");
      $query_notif_codeb->execute();
      $result_notif_codeb=$query_notif_codeb->fetch();
      $dernierb=$result_notif_codeb['id_veille'];
      $query_inser_codeb=$bdd->prepare("UPDATE notifications set notif_B = ? where id_user = ?");
      $query_inser_codeb->bindParam(1, $dernierb);
      $query_inser_codeb->bindParam(2, $id_graph);
      $query_inser_codeb->execute();
    }else{
      $dernierb=$result['notif_B'];
      $query_notif_codeb=$bdd->prepare("SELECT description, titre, file, categorie_veille.categorie FROM veille inner join categorie_veille on veille.categorie = categorie_veille.id_categorie_veille WHERE id_veille > ? order by id_veille DESC");
      $query_notif_codeb->bindParam(1, $dernierb);
      $query_notif_codeb->execute();
    }
    if($result['notif_C']==0){
      $query_notif_codec=$bdd->prepare("SELECT * FROM achat_photos order by id_achat DESC limit 1");
      $query_notif_codec->execute();
      $result_notif_codec=$query_notif_codec->fetch();
      $dernierc=$result_notif_codec['id_achat'];
      $query_inser_codec=$bdd->prepare("UPDATE notifications set notif_C = ? where id_user = ?");
      $query_inser_codec->bindParam(1, $dernierc);
      $query_inser_codec->bindParam(2, $id_graph);
      $query_inser_codec->execute();
    }else{
      $dernierc=$result['notif_C'];
      $query_notif_codec=$bdd->prepare("SELECT id_client, categorie, etat_achat.etat, photo FROM achat_photos inner join user on achat_photos.id_controleur = user.id_user inner join etat_achat on achat_photos.id_etat_achat = etat_achat.etat WHERE id_achat > ? order by id_achat DESC");
      $query_notif_codec->bindParam(1, $dernierc);
      $query_notif_codec->execute();
    }
    ?>
    <ul class="nav nav-tabs mobile-app-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#request" role="tab">
          <div class="control-icon has-items">
            <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Accueil"><use xlink:href="icons/icons.svg#olymp-status-icon"></use></svg>
            <div class="label-avatar bg-blue label_notifs"><?php if($result['notif_A']==0){ echo "0";}else{echo $query_notif_code->rowCount();}?></div>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#chat" role="tab">
          <div class="control-icon has-items">
            <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
              <title>chat---messages-icon</title>
              <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
            </svg></svg>
            <div class="label-avatar bg-purple label_veille"><?php if($result['notif_B']==0){ echo "0";}else{echo $query_notif_codeb->rowCount();}?></div>
          </div>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#notification" role="tab">
          <div class="control-icon has-items">
            <svg class="olymp-thunder-icon"><svg id="olymp-thunder-icon" viewBox="0 0 26 32" width="100%" height="100%">
              <title>thunder-icon</title>
              <path d="M25.6 11.198h-8l6.4-11.198-18.669 0.005-5.331 17.597h4.798l-1.598 14.398 4.8-4.458v-4.914l-1.6 1.371 1.6-9.602h-3.2l3.2-11.2h9.6l-4.8 11.2h4.8v4.23l8-7.43zM11.2 22.4h3.2v-3.2h-3.2v3.2z"></path>
            </svg></svg>
            <div class="label-avatar bg-primary label_achat"><?php if($result['notif_C']==0){ echo "0";}else{echo $query_notif_codec->rowCount();}?></div>
          </div>
        </a>
      </li>
    </ul>
  </div>

  <!-- Tab panes -->
  <div class="tab-content tab-content-responsive">

    <div class="tab-pane " id="request" role="tabpanel">

      <div class="mCustomScrollbar" data-mcs-theme="dark">
        <div class="ui-block-title ui-block-title-small">
          <h6 class="title">Nouveau code créés</h6>
          <a href="explore.php">Allez aux partage de codes</a>
        </div>
        <ul class="notification-list friend-requests notif_list">
          <?php 
          if($result['notif_A']==0){?>
          <li>
            Aucune notification
          </li>
          <?php }else{
            foreach ($query_notif_code as $key => $value) {?>
            <li>
              <div class="author-thumb">
                <img src="<?php echo $value['photo'];?>" alt="author">
              </div>
              <div class="notification-event">
                <a href="explore.php" class="h6 notification-friend"><?php echo $value['titre'];?></a>
                <span class="chat-message-item"><?php echo $value['description'];?></span>
              </div>
              <span class="notification-icon">
                <?php echo $value['categorie_code'];?>
              </span>
            </li>
            <?php } 
          }?>
        </ul>
        <a href="explore.php" class="view-all bg-blue">Voir tous les codes</a>
      </div>

    </div>

    <div class="tab-pane " id="chat" role="tabpanel">

      <div class="mCustomScrollbar" data-mcs-theme="dark">
        <div class="ui-block-title ui-block-title-small">
         <h6 class="title">Veille technologique</h6>
         <a href="veille.php">Allez aux veilles</a>
       </div>

       <ul class="notification-list chat-message veille_list">
        <?php 
        if($result['notif_B']==0){?>
        <li>
          Aucune notification
        </li>
        <?php }else{
          foreach ($query_notif_codeb as $key => $value) {?>
          <li>
            <div class="author-thumb">
              <img src="uploads/veille/<?php echo $value['file'];?>" alt="author" style="border-radius:0% !important;height:100% !important;">
            </div>
            <div class="notification-event">
              <a href="veille.php" class="h6 notification-friend"><?php echo $value['titre'];?></a>
              <span class="chat-message-item"><?php echo $value['description'];?></span>
            </div>
            <span class="notification-icon">
              <?php echo $value['categorie'];?>
            </span>
          </li>
          <?php } 
        }?>
      </ul>

      <a href="veille.php" class="view-all bg-purple">Voir toutes la partie veille</a>
    </div>

  </div>

  <div class="tab-pane " id="notification" role="tabpanel">

    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <div class="ui-block-title ui-block-title-small">
        <h6 class="title">Achats de photos</h6>
        <a href="achat_photos.php">Allez aux achats</a>
      </div>

      <ul class="notification-list veille_achat">
        <?php 
        if($result['notif_C']==0){?>
        <li>
          Aucune notification
        </li>
        <?php }else{
          foreach ($query_notif_codec as $key => $value) {?>
          <li>
            <div class="author-thumb">
              <img src="<?php echo $value['photo'];?>" alt="author">
            </div>
            <div class="notification-event">
              <a href="achat_photos.php" class="h6 notification-friend"><?php echo $value['id_client'];?></a>
              <span class="chat-message-item"><?php echo $value['categorie'];?></span>
            </div>
            <span class="notification-icon">
              <?php echo $value['etat'];?>
            </span>
          </li>
          <?php } 
        }?>
      </ul>

      <a href="achat_photos.php" class="view-all bg-primary">Voir tous les achats de photos</a>
    </div>

  </div>

  <div class="tab-pane " id="search" role="tabpanel">


    <form class="search-bar w-search notification-list friend-requests">
      <div class="form-group with-button">
        <input class="form-control js-user-search" placeholder="Search here people or pages..." type="text">
      </div>
    </form>


  </div>

</div>
<!-- ... end  Tab panes -->

</header>