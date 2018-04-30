<?php
$id_graph=$_COOKIE['id_graph'];
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
<header class="header" id="site-header">

  <div class="page-title">
    <img src="../img/solocal_ms_rvb.png" alt="" style="height: 65px;
    position: absolute;
    top: 5px;">
  </div>
  <div class="header-content-wrapper">
    <div class="control-block" >

      <div class="control-icon more has-items" id="first">
        <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right"><use xlink:href="../icons/icons.svg#olymp-calendar-icon"></use></svg>
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
          $query_notif_code=$bdd->prepare("SELECT description, titre, photo_avatar, categorie_code.categorie_code FROM code inner join user on code.id_user = user.id_user inner join categorie_code on code.categorie_code = categorie_code.id_categorie_code WHERE id_code > ? and accept_code = 1 order by id_code DESC");
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
          $query_notif_codec=$bdd->prepare("SELECT id_client, categorie, etat_achat.etat, photo_avatar FROM achat_photos left join user on achat_photos.id_controleur = user.id_user left join etat_achat on achat_photos.id_etat_achat = etat_achat.id_etat_achat WHERE id_achat > ? and (achat_photos.id_etat_achat = 2 or achat_photos.id_etat_achat = 3) order by id_achat DESC");
          $query_notif_codec->bindParam(1, $dernierc);
          $query_notif_codec->execute();
        }
        if($result['notif_D']==0){
          $query_notif_coded=$bdd->prepare("SELECT * FROM aide order by id_aide DESC limit 1");
          $query_notif_coded->execute();
          $result_notif_coded=$query_notif_coded->fetch();
          $dernierd=$result_notif_coded['id_aide'];
          $query_inser_coded=$bdd->prepare("UPDATE notifications set notif_D = ? where id_user = ?");
          $query_inser_coded->bindParam(1, $dernierd);
          $query_inser_coded->bindParam(2, $id_graph);
          $query_inser_coded->execute();
        }else{
          $dernierd=$result['notif_D'];
          $query_notif_coded=$bdd->prepare("SELECT id_client, titre, description, photo_avatar FROM aide inner join user on aide.id_user = user.id_user WHERE id_aide > ? and id_etat_aide = 1 order by id_aide DESC");
          $query_notif_coded->bindParam(1, $dernierd);
          $query_notif_coded->execute();
        }
        $dd=$bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo_avatar, IDGPP, client.id_etat, etat.nom_etat FROM client left join user on client.envoi_maquette=user.id_user left join etat on client.id_etat = etat.id_etat where client.envoi_maquette=? and (client.id_etat = 1 or client.id_etat= 3 or client.id_etat = 4 or client.id_etat = 6)");
        $dd->bindParam(1, $id_graph);
        $dd->execute();


        ?>
        <div class="label-avatar bg-blue label_notifs" <?php echo "style='display:none;'";?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Nouveau code créés</h6>
            <a href="../pages/explore.php">Allez aux partage de codes</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="    overflow-y: scroll;">
            <ul class="notification-list friend-requests notif_list">

            </ul>
          </div>

          <a href="../pages/explore.php" class="view-all bg-blue">Voir tous les codes</a>
        </div>
      </div>

      <div class="control-icon more has-items" id="second">
        <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right"><use xlink:href="../icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
        <div class="label-avatar bg-purple label_veille"  <?php echo "style='display:none;'"; ?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Veille technologique</h6>
            <a href="../pages/veille.php">Allez aux veilles</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="    overflow-y: scroll;">
            <ul class="notification-list chat-message veille_list">

            </ul>
          </div>

          <a href="../pages/veille.php" class="view-all bg-purple">Voir toutes la partie veille</a>
        </div>
      </div>

      <div class="control-icon more has-items" id="third">
        <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right" ><use xlink:href="../icons/icons.svg#olymp-multimedia-icon"></use></svg>

        <div class="label-avatar bg-primary label_achat" <?php echo "style='display:none;'";?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Achats de photos</h6>
            <a href="../pages/achat_photos.php">Allez aux achats</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="overflow-y: scroll;">
            <ul class="notification-list friend-requests veille_achat">

            </ul>
          </div>

          <a href="../pages/achat_photos.php" class="view-all bg-primary">Voir tous les achats de photos</a>
        </div>
      </div>
      <div class="control-icon more has-items" id="ann">
        <svg class="olymp-status-icon left-menu-icon" data-toggle="tooltip" data-placement="right" ><use xlink:href="../icons/icons.svg#olymp-cupcake-icon"></use></svg>

        <div class="label-avatar bg-primary label_anniv" <?php echo "style='display:none;'";?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Anniversaires</h6>
            <a href="../pages/birthday.php">Allez aux anniversaires</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="overflow-y: scroll;">
            <ul class="notification-list friend-requests veille_anniv">

            </ul>
          </div>

          <a href="../pages/birthday.php" class="view-all bg-primary">Voir tous les anniversaires</a>
        </div>
      </div>
      <div class="control-icon more has-items" id="rem">
        <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right" ><use xlink:href="../icons/icons.svg#olymp-share-post-icon"></use></svg>

        <div class="label-avatar bg-primary label_remontee" <?php echo "style='display:none;'";?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Remontées</h6>
            <a href="<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5) { echo "remontees_admin.php";}else{ echo "remontees.php";}?>">Allez aux remontées</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="overflow-y: scroll;">
            <ul class="notification-list friend-requests veille_rem">

            </ul>
          </div>

          <a href="<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5) { echo "remontees_admin.php";}else{ echo "remontees.php";}?>" class="view-all bg-primary">Voir toutes les remontées</a>
        </div>
      </div>
      <div class="control-icon more has-items" id="quad">
        <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right" title=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="../icons/icons.svg#olymp-happy-faces-icon"></use></svg>

        <div class="label-avatar bg-primary label_aide" <?php echo "style='display:none;'"; ?>></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Demandes d'aides</h6>
            <a href="../pages/help.php">Allez aux demandes</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark" style="    overflow-y: scroll;">
            <ul class="notification-list friend-requests veille_aide">

            </ul>
          </div>

          <a href="../pages/help.php" class="view-all bg-primary">Voir les demandes</a>
        </div>
      </div>

      <div class="author-page author vcard inline-items more" id="five">
        <div class="author-thumb">
          <img alt="author" src="../<?php echo utf8_encode($infos["photo_avatar"]);?>" class="avatar">
          <span class="icon-status online"></span>
          <div class="more-dropdown more-with-triangle" style="z-index: 999999999;">
            <div class="mCustomScrollbar" data-mcs-theme="dark">
              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Votre compte</h6>
              </div>

              <ul class="account-settings">
                <li>
                  <a href="../pages/account_setting.php">

                    <svg class="olymp-menu-icon"><svg id="olymp-menu-icon" viewBox="0 0 41 32" width="100%" height="100%">
                      <title>menu-icon</title>
                      <path d="M4.571 0h-4.571v4.571h4.571v-4.571zM9.143 0v4.571h32v-4.571h-32zM13.714 13.714h-13.714v4.571h13.714v-4.571zM18.286 13.714v4.571h4.571v-4.571h-4.571zM27.429 18.286h13.714v-4.571h-13.714v4.571zM0 32h32v-4.569h-32v4.569zM36.571 32h4.571v-4.569h-4.571v4.569z"></path>
                    </svg></svg>

                    <span>Configuration du compte</span>
                  </a>
                </li>
                <li>
                  <a class="logout">
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
        <a href="../pages/account_setting.php" class="author-name fn">
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

  <?php if($_COOKIE['id_statut']==3) {?>
  <a href="../pages/jury.php"><span class="notif">/!\ veuillez proposer un site du mois /!\</span></a>
  <input type="hidden" class="date-j" value="<?php echo date('d') ?>">
  <?php }?>


</header>

