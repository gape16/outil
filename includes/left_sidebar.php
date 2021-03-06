<div class="fixed-sidebar graph">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
    <a href="accueil.php" class="logo">
      <svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" width="100%" height="100%"><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"/><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"/></svg>
    </a>

    <div class="mCustomScrollbar" data-mcs-theme="dark" >
      <ul class="left-menu" >
       <li>
        <a href="#" class="js-sidebar-open">
          <svg class="olymp-menu-icon left-menu-icon"><use xlink:href="../icons/icons.svg#olymp-menu-icon"></use></svg>
        </a>
      </li>
      <li>
        <a href="accueil.php">
          <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Accueil" ><use xlink:href="../icons/icons.svg#olymp-newsfeed-icon"></use></svg>
        </a>
      </li>
      <li>
        <a href="achat_photos.php">
          <svg class="olymp-multimedia-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Achat de photos"  ><use xlink:href="../icons/icons.svg#olymp-multimedia-icon"></use></svg>
        </a>
      </li>
      <li>
        <a href="help.php">
          <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Demande d'aide" ><use xlink:href="../icons/icons.svg#olymp-happy-faces-icon"></use></svg>
        </a>
      </li>
      <li>
        <a href="remontees.php">
         <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Remontées"  ><use xlink:href="../icons/icons.svg#olymp-share-post-icon"></use></svg>
       </a>
     </li>
     <li>
      <a href="moderation_user.php">
        <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Modération utilsiateur"  ><use xlink:href="../icons/icons.svg#olymp-albums-icon"></use></svg>
      </a>
    </li>
    <?php if($_COOKIE['id_statut']==3 || $_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5){?>
    <li>
      <a href="jury.php">
        <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Jury"  ><use xlink:href="../icons/icons.svg#olymp-trophy-icon"></use></svg>
      </a>
    </li>
    <?php } ?>
    <li>
      <a href="veille.php">
        <svg class="olymp-magnifying-glass-icon left-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Veille"   ><use xlink:href="../icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
      </a>
    </li>
    <li>
      <a href="changelog.php">
        <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Changelog" ><use xlink:href="../icons/icons.svg#olymp-weather-refresh-icon"></use></svg>
      </a>
    </li>
    <li>
      <a href="template.php">
        <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   data-original-title="Template" ><use xlink:href="../icons/icons.svg#olymp-status-icon"></use></svg>
      </a>
    </li>
    <li>
      <a href="explore.php">
        <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Partage de code"   ><use xlink:href="../icons/icons.svg#olymp-calendar-icon"></use></svg>
      </a>
    </li>
    <li>
      <a href="microdata.php">
        <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Générateur de microdata"  ><use xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
      </a>
    </li>
<!--     <li>
      <a href="newsletter.php">
        <svg class="olymp-star-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Newsletter"  ><use xlink:href="../icons/icons.svg#olymp-star-icon"></use></svg>
      </a>
    </li> -->
    <li>
      <a href="tuto.php" target="_blank">
        <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Tutos"  ><use xlink:href="../icons/icons.svg#olymp-checked-calendar-icon"></use></svg>
      </a>
    </li>
<!--     <li>
      <a href="badges.php">
        <svg class="olymp-badge-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Badges"  ><use xlink:href="../icons/icons.svg#olymp-badge-icon"></use></svg>
      </a>
    </li> -->
    <li>
      <a href="birthday.php">
        <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Anniversaires"  ><use xlink:href="../icons/icons.svg#olymp-cupcake-icon"></use></svg>
      </a>
    </li>
    <li>
      <a href="stats_graph.php">
        <svg class="olymp-stats-icon left-menu-icon" data-toggle="tooltip" data-placement="right"  data-original-title="Statistiques"  ><use xlink:href="../icons/icons.svg#olymp-stats-icon"></use></svg>
      </a>
    </li>
  </ul>
</div>
</div>

<div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
  <a href="#" class="logo">
    <svg id="Calque_1" data-name="Calque 1" viewBox="0 0 70 70" width="45px"><defs><style>.cls-1,.cls-2{fill:#fff;}.cls-1{opacity:0.8;}</style></defs><polygon class="cls-1" points="7.08 18.82 35 2.64 62.92 18.82 62.92 51.18 35 67.36 7.08 51.18 7.08 18.82"/><polygon class="cls-2" points="7.08 18.82 7.08 51.18 35 67.36 35 35 7.08 18.82"/></svg>
    <h6 class="logo-title">Solocal MS</h6>
  </a>

  <div class="mCustomScrollbar" data-mcs-theme="dark">
    <ul class="left-menu">
      <li>
        <a href="#" class="js-sidebar-open">
          <svg class="olymp-close-icon left-menu-icon"><use xlink:href="../icons/icons.svg#olymp-close-icon"></use></svg>
          <span class="left-menu-title">Réduire Menu</span>
        </a>
      </li>
      <li>
        <a href="accueil.php">
          <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"><use xlink:href="../icons/icons.svg#olymp-newsfeed-icon"></use></svg>
          <span class="left-menu-title">Accueil</span>
        </a>
      </li>
      <li>
        <a href="<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5) { echo "achat_photos_admin.php";}else{ echo "achat_photos.php";}?>">
          <svg class="olymp-multimedia-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-multimedia-icon"></use></svg>
          <span class="left-menu-title">Achats de photos</span>
        </a>
      </li>
      <li>
        <a href="help.php">
          <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-happy-faces-icon"></use></svg>
          <span class="left-menu-title">Demandes d'aide</span>
        </a>
      </li>
      <li>
        <a href="<?php if($_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5 ) { echo "remontees_admin.php";}else{ echo "remontees.php";}?>">
         <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-share-post-icon"></use></svg>
         <span class="left-menu-title">Remontées</span>
       </a>
     </li>
     <li>
      <a href="moderation_user.php">
       <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-albums-icon"></use></svg>
       <span class="left-menu-title">Modération équipe</span>
     </a>
   </li>
   <?php if($_COOKIE['id_statut']==3 || $_COOKIE['id_statut']==4 || $_COOKIE['id_statut']==5  ){?>
   <li>
    <a href="jury.php">
     <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-trophy-icon"></use></svg>
     <span class="left-menu-title">Jury</span>
   </a>
 </li>
 <?php } ?>
 <li>
  <a href="veille.php">
    <svg class="olymp-magnifying-glass-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-magnifying-glass-icon"></use></svg>
    <span class="left-menu-title">Veilles</span>
  </a>
</li>
<li>
  <a href="changelog.php">
    <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-weather-refresh-icon"></use></svg>
    <span class="left-menu-title">Changelog</span>
  </a>
</li>
<li>
  <a href="template.php">
    <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-status-icon"></use></svg>
    <span class="left-menu-title">Templates</span>
  </a>
</li>
<li>
  <a href="explore.php">
    <svg class="olymp-calendar-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-calendar-icon"></use></svg>
    <span class="left-menu-title">Partage de code</span>
  </a>
</li>
<li>
  <a href="microdata.php">
    <svg class="olymp-happy-faces-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-add-a-place-icon"></use></svg>
    <span class="left-menu-title">Générateur de microdata </span>
  </a>
</li>
    <!-- <li>
      <a href="newsletter.php">
        <svg class="olymp-star-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-star-icon"></use></svg>
        <span class="left-menu-title">Newsletters</span>
      </a>
    </li> -->
    <li>
      <a href="tuto.php" target="_blank">
        <svg class="olymp-newsfeed-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-checked-calendar-icon"></use></svg>
        <span class="left-menu-title">Tutos</span>
      </a>
    </li>
    <!-- <li>
      <a href="badges.php">
        <svg class="olymp-badge-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-badge-icon"></use></svg>
        <span class="left-menu-title">Badges</span>
      </a>
    </li> -->
    <li>
      <a href="birthday.php">
       <svg class="olymp-cupcake-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-cupcake-icon"></use></svg>
       <span class="left-menu-title">Anniversaires</span>
     </a>
   </li>
   <li>
    <a href="stats_graph.php">
      <svg class="olymp-stats-icon left-menu-icon" data-toggle="tooltip" data-placement="right"   ><use xlink:href="../icons/icons.svg#olymp-stats-icon"></use></svg>
      <span class="left-menu-title">Statistiques</span>
    </a>
  </li>
</ul>
</div>
</div>
</div>