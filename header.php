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
  $query_insert_notif = $bdd->prepare("INSERT INTO notifications (notif_A, notif_B, notif_C, id_user) VALUES ('0','0','0',?)");
  $query_insert_notif->bindParam(1, $id_graph);
  $query_insert_notif->execute();
}
?>
<header class="header" id="site-header">

  <div class="page-title">
    <h6>SOLOCAL MARKETING SERVICE</h6>
  </div>

  <div class="header-content-wrapper">
    <div class="control-block">

      <div class="control-icon more has-items">
        <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Accueil"><use xlink:href="icons/icons.svg#olymp-status-icon"></use></svg>
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
        ?>
        <div class="label-avatar bg-blue label_notifs"><?php if($result['notif_A']==0){ echo "0";}else{echo $query_notif_code->rowCount();}?></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Nouveau code créés</h6>
            <a href="explore.php">Allez aux partage de codes</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
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
                    <a href="explore.php?id_code=1" class="h6 notification-friend"><?php echo $value['titre'];?></a>
                    <span class="chat-message-item"><?php echo $value['description'];?></span>
                  </div>
                  <span class="notification-icon">
                    <?php echo $value['categorie_code'];?>
                  </span>
                </li>
                <?php } 
              }?>
            </ul>
          </div>

          <a href="accueil.php" class="view-all bg-blue">Voir tous les codes</a>
        </div>
      </div>

      <div class="control-icon more has-items">
        <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
          <title>chat---messages-icon</title>
          <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
        </svg></svg>
        <div class="label-avatar bg-purple">2</div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Veille / Newsletter</h6>
            <a href="#">Tout marquer comme lu</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="notification-list chat-message">
              <li class="message-unread">
                <div class="author-thumb">
                  <img src="img/avatar59-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="#" class="h6 notification-friend">Tendances web 2017</a>
                  <span class="chat-message-item">Retrouver notre blog sur toutes les nouveautés tendances pour 2017...</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Il y a 4h</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
                    <title>chat---messages-icon</title>
                    <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
                  </svg></svg>
                </span>
                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                </div>
              </li>

              <li>
                <div class="author-thumb">
                  <img src="img/avatar60-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="#" class="h6 notification-friend">l'UX et nous</a>
                  <span class="chat-message-item">Vous voulez en apprendre davantage sur l'ux !?.</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Il y a 2 jours</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
                    <title>chat---messages-icon</title>
                    <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
                  </svg></svg>
                </span>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                </div>
              </li>
            </ul>
          </div>

          <a href="#" class="view-all bg-purple">Voir tous les articles</a>
        </div>
      </div>

      <div class="control-icon more has-items">
        <svg class="olymp-thunder-icon"><svg id="olymp-thunder-icon" viewBox="0 0 26 32" width="100%" height="100%">
          <title>thunder-icon</title>
          <path d="M25.6 11.198h-8l6.4-11.198-18.669 0.005-5.331 17.597h4.798l-1.598 14.398 4.8-4.458v-4.914l-1.6 1.371 1.6-9.602h-3.2l3.2-11.2h9.6l-4.8 11.2h4.8v4.23l8-7.43zM11.2 22.4h3.2v-3.2h-3.2v3.2z"></path>
        </svg></svg>

        <div class="label-avatar bg-primary">8</div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Achats de photos</h6>
            <a href="#">Tout marquer comme lu</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="notification-list">
              <li>
                <div class="author-thumb">
                  <img src="img/avatar62-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div>Les photos pour le client <a href="#" class="h6 notification-friend">09434383</a> ont été ajoutées dans <a href="#" class="notification-link">le tableau</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                </div>
                <div class="more">
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>


            </ul>
          </div>

          <a href="#" class="view-all bg-primary">Voir tous les achats de photos</a>
        </div>
      </div>

      <div class="author-page author vcard inline-items more" >
        <div class="author-thumb">
          <img alt="author" src="<?php echo utf8_encode($infos["photo_avatar"]);?>" class="avatar">
          <span class="icon-status online"></span>
          <div class="more-dropdown more-with-triangle" style="z-index: 999999999;">
            <div class="mCustomScrollbar" data-mcs-theme="dark">
              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Votre compte</h6>
              </div>

              <ul class="account-settings">
                <li>
                  <a href="account_setting.php">

                    <svg class="olymp-menu-icon"><svg id="olymp-menu-icon" viewBox="0 0 41 32" width="100%" height="100%">
                      <title>menu-icon</title>
                      <path d="M4.571 0h-4.571v4.571h4.571v-4.571zM9.143 0v4.571h32v-4.571h-32zM13.714 13.714h-13.714v4.571h13.714v-4.571zM18.286 13.714v4.571h4.571v-4.571h-4.571zM27.429 18.286h13.714v-4.571h-13.714v4.571zM0 32h32v-4.569h-32v4.569zM36.571 32h4.571v-4.569h-4.571v4.569z"></path>
                    </svg></svg>

                    <span>Configuration du compte</span>
                  </a>
                </li>
                <li>
                  <a href="#" class="logout">
                    <svg class="olymp-logout-icon"><svg id="olymp-logout-icon" viewBox="0 0 43 32" width="100%" height="100%">
                      <title>logout-icon</title>
                      <path d="M26.667 3.557c4.962 0 9.232 2.91 11.23 7.111h3.838c-2.197-6.212-8.105-10.668-15.068-10.668s-12.873 4.457-15.070 10.667h3.84c1.998-4.199 6.268-7.109 11.23-7.109zM26.667 28.446c-4.962 0-9.232-2.91-11.23-7.111h-3.84c2.199 6.21 8.107 10.665 15.070 10.665 6.962 0 12.871-4.455 15.070-10.665h-3.838c-2 4.201-6.27 7.111-11.232 7.111zM23.111 17.778v-3.556h-16.306l3.252-3.25-2.514-2.514-7.543 7.541 7.543 7.543 2.514-2.514-3.252-3.252h16.306zM39.111 14.224v3.556h3.556v-3.556h-3.556z"></path>
                    </svg></svg>

                    <span>Se déconnecter</span>
                  </a>
                </li>
              </ul>     
            </div>

          </div>
        </div>
        <a href="" class="author-name fn">
          <div class="author-title">
            <?php echo utf8_encode($infos["prenom"]." ".$infos['nom']);?><svg class="olymp-dropdown-arrow-icon"><svg id="olymp-dropdown-arrow-icon" viewBox="0 0 48 32" width="100%" height="100%">
            <title>dropdown-arrow-icon</title>
            <path d="M41.888 0.104l-17.952 19.064-17.952-19.064-5.984 6.352 23.936 25.44 23.936-25.44z"></path>
          </svg></svg>
        </div>
        <span class="author-subtitle"><?php echo utf8_encode($infos["nom_statut"]);?></span>
      </a>
    </div>

  </div>
</div>

</header>