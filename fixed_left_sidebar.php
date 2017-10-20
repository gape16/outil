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
<div class="fixed-sidebar fixed-sidebar-responsive">

  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
    <a href="#" class="logo js-sidebar-open">
      <svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" width="100%" height="100%"><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"/><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"/></svg>
    </a>

  </div>

  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
    <a href="#" class="logo">
      <svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" width="45px"><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"/><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"/></svg>
      <h6 class="logo-title" style="margin-left: 20px;">Solocal MS</h6>
    </a>

    <div class="mCustomScrollbar" data-mcs-theme="dark">

      <div class="control-block">
        <div class="author-page author vcard inline-items">
          <div class="author-thumb">
            <img alt="author" src="<?php echo utf8_encode($infos["photo_avatar"]);?>" class="avatar">
            <span class="icon-status online"></span>
          </div>
          <a href="account_setting.php" class="author-name fn">
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

    <ul class="left-menu">
      <li>
        <a href="#" class="js-sidebar-open">
          <svg class="olymp-close-icon left-menu-icon"><use xlink:href="icons/icons.svg#olymp-close-icon"></use></svg>
          <span class="left-menu-title">Réduire Menu</span>
        </a>
      </li>
      <li>
        <a href="accueil.php">
          <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-newsfeed-icon"></use></svg>
          <span class="left-menu-title">Check clients</span>
        </a>
      </li>
      <li>
        <a href="achat_photos.php">
          <svg class="olymp-multimedia-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-multimedia-icon"></use></svg>
          <span class="left-menu-title">Achats de photos</span>
        </a>
      </li>
      <li>
        <a href="help.php">
          <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-happy-faces-icon"></use></svg>
          <span class="left-menu-title">Demandes aux contrôleurs</span>
        </a>
      </li>
      <li>
        <a href="veille.php">
          <svg class="olymp-magnifying-glass-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
          <span class="left-menu-title">Veilles</span>
        </a>
      </li>
      <li>
        <a href="newsletter.php">
          <svg class="olymp-star-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-star-icon"></use></svg>
          <span class="left-menu-title">Newletters</span>
        </a>
      </li>
      <li>
        <a href="explore.php">
          <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-calendar-icon"></use></svg>
          <span class="left-menu-title">Partage de code</span>
        </a>
      </li>
      <li>
        <a href="badges.php">
          <svg class="olymp-badge-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-badge-icon"></use></svg>
          <span class="left-menu-title">Mes badges</span>
        </a>
      </li>
      <li>
        <a href="birthday.php">
         <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-cupcake-icon"></use></svg>
         <span class="left-menu-title">Les anniversaires</span>
       </a>
     </li>
     <li>
      <a href="stats.php">
        <svg class="olymp-stats-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-stats-icon"></use></svg>
        <span class="left-menu-title">Mes stats</span>
      </a>
    </li>
    <li>
      <a href="account_setting.php">
        <svg class="olymp-settings-v2-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="icons/icons.svg#olymp-settings-v2-icon"></use></svg>
        <span class="left-menu-title">Mon compte</span>
      </a>
    </li>
  </ul>


</div>
</div>
</div>