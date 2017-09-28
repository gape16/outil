<?php
$id_graph=$_SESSION['id_graph'];
$query_select_card = $bdd->prepare("SELECT num_client, raison_social, lien_CMS, photo FROM client inner join user on client.id_graph_maquette=user.id_user where client.id_graph_maquette=? and date_retour_maquette IS NULL and date_retour_cq IS NULL");
$query_select_card->bindParam(1, $id_graph);
$query_select_card->execute();
$cards_client_select=$query_select_card->fetchAll();
$nb_cards_client=$query_select_card->rowCount();
?>
<header class="header" id="site-header">

  <div class="page-title">
    <h6>Profile Page</h6>
  </div>

  <div class="header-content-wrapper">
    <form class="search-bar w-search notification-list friend-requests">
      <div class="form-group with-button">
        <input class="form-control js-user-search" placeholder="Rechercher des clients..." type="text">
        <button>
          <svg class="olymp-magnifying-glass-icon"><svg id="olymp-magnifying-glass-icon" viewBox="0 0 34 32" width="100%" height="100%">
            <title>magnifying-glass-icon</title>
            <path d="M20.809 3.57c-4.76-4.76-12.478-4.76-17.239 0s-4.76 12.48 0 17.239c4.76 4.76 12.48 4.76 17.239 0 4.76-4.759 4.76-12.478 0-17.239zM18.654 18.654c-3.57 3.57-9.361 3.57-12.93 0-3.57-3.57-3.57-9.359 0-12.93s9.361-3.57 12.93 0c3.57 3.569 3.57 9.359 0 12.93z"></path>
            <path d="M24.022 21.907l2.154-2.156 2.157 2.155-2.154 2.156-2.157-2.155z"></path>
            <path d="M28.34 28.364c-0.596 0.597-1.559 0.597-2.155 0l-6.464-6.464-0.834-0.852 4.3-4.3-1.312-1.314-6.466 6.466 8.62 8.619c1.783 1.783 4.683 1.783 6.464 0 1.783-1.781 1.783-4.681 0-6.464l-2.155 2.155c0.596 0.596 0.594 1.562 0 2.155z"></path>
          </svg></svg>
        </button>
      </div>
    </form>

    <a href="#" class="link-find-friend">Voir mon tableau de clients</a>

    <div class="control-block">

      <div class="control-icon more has-items">
        <svg class="olymp-happy-face-icon"><svg id="olymp-happy-face-icon" viewBox="0 0 32 32" width="100%" height="100%">
          <title>happy-face-icon</title>
          <path d="M16 0c-8.837 0-16 7.16-16 15.989 0 7.166 4.715 13.227 11.213 15.262v-3.39c-4.69-1.899-8-6.49-8-11.859 0-7.070 5.731-12.802 12.8-12.802s12.8 5.731 12.8 12.802c0 5.37-3.312 9.96-8 11.859v3.378c6.485-2.040 11.187-8.094 11.187-15.25 0-8.829-7.165-15.989-16-15.989zM11.211 12.8h-3.2v3.202h3.2v-3.202zM20.813 12.8v3.202h3.2v-3.202h-3.2zM11.198 19.365c0 1.675 2.146 3.032 4.794 3.032s4.794-1.357 4.794-3.032v-0.16h-9.587v0.16zM14.413 32.002h3.2v-3.2h-3.2v3.2z"></path>
        </svg></svg>
        <div class="label-avatar bg-blue"><?php echo $nb_cards_client;?></div>

        <div class="more-dropdown more-with-triangle triangle-top-center">
          <div class="ui-block-title ui-block-title-small">
            <h6 class="title">Retours en attentes</h6>
            <a href="accueil.php">Allez aux retours</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="notification-list friend-requests">
              <?php foreach ($cards_client_select as $key => $value_card) {?>
              <li>
                <div class="author-thumb">
                  <img src="img/avatar55-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="accueil.php" class="h6 notification-friend"><?php echo utf8_encode($value_card['raison_social']);?></a>
                  <span class="chat-message-item"><?php echo $value_card['num_client'];?></span>
                </div>
                <span class="notification-icon">
                  <a href="<?php echo $value_card['lien_CMS'];?>" class="accept-request">
                    <span class="icon-add without-text">
                      <svg class="olymp-happy-face-icon"><svg id="olymp-happy-face-icon" viewBox="0 0 32 32" width="100%" height="100%">
                        <title>happy-face-icon</title>
                        <path d="M16 0c-8.837 0-16 7.16-16 15.989 0 7.166 4.715 13.227 11.213 15.262v-3.39c-4.69-1.899-8-6.49-8-11.859 0-7.070 5.731-12.802 12.8-12.802s12.8 5.731 12.8 12.802c0 5.37-3.312 9.96-8 11.859v3.378c6.485-2.040 11.187-8.094 11.187-15.25 0-8.829-7.165-15.989-16-15.989zM11.211 12.8h-3.2v3.202h3.2v-3.202zM20.813 12.8v3.202h3.2v-3.202h-3.2zM11.198 19.365c0 1.675 2.146 3.032 4.794 3.032s4.794-1.357 4.794-3.032v-0.16h-9.587v0.16zM14.413 32.002h3.2v-3.2h-3.2v3.2z"></path>
                      </svg></svg>
                    </span>
                  </a>

                  <a href="check.php?num_client=<?php echo $value_card['num_client'];?>" class="accept-request request-del">
                    <span class="icon-minus">
                      <svg class="olymp-happy-face-icon"><svg id="olymp-happy-face-icon" viewBox="0 0 32 32" width="100%" height="100%">
                        <title>happy-face-icon</title>
                        <path d="M16 0c-8.837 0-16 7.16-16 15.989 0 7.166 4.715 13.227 11.213 15.262v-3.39c-4.69-1.899-8-6.49-8-11.859 0-7.070 5.731-12.802 12.8-12.802s12.8 5.731 12.8 12.802c0 5.37-3.312 9.96-8 11.859v3.378c6.485-2.040 11.187-8.094 11.187-15.25 0-8.829-7.165-15.989-16-15.989zM11.211 12.8h-3.2v3.202h3.2v-3.202zM20.813 12.8v3.202h3.2v-3.202h-3.2zM11.198 19.365c0 1.675 2.146 3.032 4.794 3.032s4.794-1.357 4.794-3.032v-0.16h-9.587v0.16zM14.413 32.002h3.2v-3.2h-3.2v3.2z"></path>
                      </svg></svg>
                    </span>
                  </a>

                </span>
              </li>
              <?php }?>



            </ul>
          </div>

          <a href="accueil.php" class="view-all bg-blue">Voir tous les retours</a>
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
            <h6 class="title">Chat / Messages</h6>
            <a href="#">Mark all as read</a>
            <a href="#">Settings</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="notification-list chat-message">
              <li class="message-unread">
                <div class="author-thumb">
                  <img src="img/avatar59-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="#" class="h6 notification-friend">Diana Jameson</a>
                  <span class="chat-message-item">Hi James! It’s Diana, I just wanted to let you know that we have to reschedule...</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
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
                  <a href="#" class="h6 notification-friend">Jake Parker</a>
                  <span class="chat-message-item">Great, I’ll see you tomorrow!.</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
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
                  <img src="img/avatar61-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="#" class="h6 notification-friend">Elaine Dreyfuss</a>
                  <span class="chat-message-item">We’ll have to check that at the office and see if the client is on board with...</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 9:56pm</time></span>
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

              <li class="chat-group">
                <div class="author-thumb">
                  <img src="img/avatar11-sm.jpg" alt="author">
                  <img src="img/avatar12-sm.jpg" alt="author">
                  <img src="img/avatar13-sm.jpg" alt="author">
                  <img src="img/avatar10-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <a href="#" class="h6 notification-friend">You, Faye, Ed &amp; Jet +3</a>
                  <span class="last-message-author">Ed:</span>
                  <span class="chat-message-item">Yeah! Seems fine by me!</span>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 16th at 10:23am</time></span>
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

          <a href="#" class="view-all bg-purple">View All Messages</a>
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
            <h6 class="title">Notifications</h6>
            <a href="#">Mark all as read</a>
            <a href="#">Settings</a>
          </div>

          <div class="mCustomScrollbar" data-mcs-theme="dark">
            <ul class="notification-list">
              <li>
                <div class="author-thumb">
                  <img src="img/avatar62-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div><a href="#" class="h6 notification-friend">Mathilda Brinker</a> commented on your new <a href="#" class="notification-link">profile status</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">4 hours ago</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
                    <title>comments-post-icon</title>
                    <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
                    <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
                  </svg></svg>
                </span>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>

              <li class="un-read">
                <div class="author-thumb">
                  <img src="img/avatar63-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div>You and <a href="#" class="h6 notification-friend">Nicholas Grissom</a> just became friends. Write on <a href="#" class="notification-link">his wall</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">9 hours ago</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-happy-face-icon"><svg id="olymp-happy-face-icon" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>happy-face-icon</title>
                    <path d="M16 0c-8.837 0-16 7.16-16 15.989 0 7.166 4.715 13.227 11.213 15.262v-3.39c-4.69-1.899-8-6.49-8-11.859 0-7.070 5.731-12.802 12.8-12.802s12.8 5.731 12.8 12.802c0 5.37-3.312 9.96-8 11.859v3.378c6.485-2.040 11.187-8.094 11.187-15.25 0-8.829-7.165-15.989-16-15.989zM11.211 12.8h-3.2v3.202h3.2v-3.202zM20.813 12.8v3.202h3.2v-3.202h-3.2zM11.198 19.365c0 1.675 2.146 3.032 4.794 3.032s4.794-1.357 4.794-3.032v-0.16h-9.587v0.16zM14.413 32.002h3.2v-3.2h-3.2v3.2z"></path>
                  </svg></svg>
                </span>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>

              <li class="with-comment-photo">
                <div class="author-thumb">
                  <img src="img/avatar64-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div><a href="#" class="h6 notification-friend">Sarah Hetfield</a> commented on your <a href="#" class="notification-link">photo</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">Yesterday at 5:32am</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
                    <title>comments-post-icon</title>
                    <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
                    <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
                  </svg></svg>
                </span>

                <div class="comment-photo">
                  <img src="img/comment-photo1.jpg" alt="photo">
                  <span>“She looks incredible in that outfit! We should see each...”</span>
                </div>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>

              <li>
                <div class="author-thumb">
                  <img src="img/avatar65-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div><a href="#" class="h6 notification-friend">Green Goo Rock</a> invited you to attend to his event Goo in <a href="#" class="notification-link">Gotham Bar</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 5th at 6:43pm</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-happy-face-icon"><svg id="olymp-happy-face-icon" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>happy-face-icon</title>
                    <path d="M16 0c-8.837 0-16 7.16-16 15.989 0 7.166 4.715 13.227 11.213 15.262v-3.39c-4.69-1.899-8-6.49-8-11.859 0-7.070 5.731-12.802 12.8-12.802s12.8 5.731 12.8 12.802c0 5.37-3.312 9.96-8 11.859v3.378c6.485-2.040 11.187-8.094 11.187-15.25 0-8.829-7.165-15.989-16-15.989zM11.211 12.8h-3.2v3.202h3.2v-3.202zM20.813 12.8v3.202h3.2v-3.202h-3.2zM11.198 19.365c0 1.675 2.146 3.032 4.794 3.032s4.794-1.357 4.794-3.032v-0.16h-9.587v0.16zM14.413 32.002h3.2v-3.2h-3.2v3.2z"></path>
                  </svg></svg>
                </span>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>

              <li>
                <div class="author-thumb">
                  <img src="img/avatar66-sm.jpg" alt="author">
                </div>
                <div class="notification-event">
                  <div><a href="#" class="h6 notification-friend">James Summers</a> commented on your new <a href="#" class="notification-link">profile status</a>.</div>
                  <span class="notification-date"><time class="entry-date updated" datetime="2004-07-24T18:18">March 2nd at 8:29pm</time></span>
                </div>
                <span class="notification-icon">
                  <svg class="olymp-heart-icon"><svg id="olymp-heart-icon" viewBox="0 0 36 32" width="100%" height="100%">
                    <title>heart-icon</title>
                    <path d="M23.111 21.333h3.556v3.556h-3.556v-3.556z"></path>
                    <path d="M32.512 2.997c-2.014-2.011-4.263-3.006-7.006-3.006-2.62 0-5.545 2.089-7.728 4.304-2.254-2.217-5.086-4.295-7.797-4.295-2.652 0-4.99 0.793-6.937 2.738-4.057 4.043-4.057 10.599 0 14.647 1.157 1.157 12.402 13.657 12.402 13.657 0.64 0.638 1.481 0.958 2.32 0.958s1.678-0.32 2.318-0.958l1.863-2.012-2.523-2.507-1.655 1.787c-2.078-2.311-11.095-12.324-12.213-13.442-1.291-1.285-2-2.994-2-4.811 0-1.813 0.709-3.518 2-4.804 1.177-1.175 2.54-1.698 4.425-1.698 0.464 0 2.215 0.236 5.303 3.273l2.533 2.492 2.492-2.532c2.208-2.242 4.201-3.244 5.196-3.244 1.769 0 3.113 0.588 4.496 1.97 1.289 1.284 1.998 2.99 1.998 4.804 0 1.815-0.709 3.522-1.966 4.775-0.087 0.085-0.098 0.094-1.9 2.041l-0.156 0.167 2.523 2.51 0.24-0.26c0 0 1.742-1.881 1.774-1.911 4.055-4.043 4.055-10.603-0.002-14.644z"></path>
                  </svg></svg>
                </span>

                <div class="more">
                  <svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
                    <title>three-dots-icon</title>
                    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
                  </svg></svg>
                  <svg class="olymp-little-delete"><svg id="olymp-little-delete" viewBox="0 0 32 32" width="100%" height="100%">
                    <title>little-delete</title>
                    <path d="M32 4.149l-3.973-3.979-11.936 11.941-11.941-11.941-3.979 3.979 11.941 11.936-11.941 11.936 3.979 3.979 11.941-11.936 11.936 11.936 3.973-3.979-11.936-11.936z"></path>
                  </svg></svg>
                </div>
              </li>
            </ul>
          </div>

          <a href="#" class="view-all bg-primary">View All Notifications</a>
        </div>
      </div>

      <div class="author-page author vcard inline-items more">
        <div class="author-thumb">
          <img alt="author" src="img/author-page.jpg" class="avatar">
          <span class="icon-status online"></span>
          <div class="more-dropdown more-with-triangle">
            <div class="mCustomScrollbar" data-mcs-theme="dark">
              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Your Account</h6>
              </div>

              <ul class="account-settings">
                <li>
                  <a href="#">

                    <svg class="olymp-menu-icon"><svg id="olymp-menu-icon" viewBox="0 0 41 32" width="100%" height="100%">
                      <title>menu-icon</title>
                      <path d="M4.571 0h-4.571v4.571h4.571v-4.571zM9.143 0v4.571h32v-4.571h-32zM13.714 13.714h-13.714v4.571h13.714v-4.571zM18.286 13.714v4.571h4.571v-4.571h-4.571zM27.429 18.286h13.714v-4.571h-13.714v4.571zM0 32h32v-4.569h-32v4.569zM36.571 32h4.571v-4.569h-4.571v4.569z"></path>
                    </svg></svg>

                    <span>Profile Settings</span>
                  </a>
                </li>
                <li>
                  <a href="">
                    <svg class="olymp-star-icon left-menu-icon"  data-toggle="tooltip" data-placement="right"   data-original-title="FAV PAGE"><svg id="olymp-star-icon" viewBox="0 0 32 32" width="100%" height="100%">
                      <title>star-icon</title>
                      <path d="M24.029 27.192h3.2v3.2h-3.2v-3.2z"></path>
                      <path d="M31.88 11.91c-0.275-0.826-0.984-1.43-1.837-1.562l-8.309-1.28-3.611-7.763c-0.379-0.816-1.194-1.336-2.090-1.336-0.893 0-1.707 0.522-2.086 1.336l-3.613 7.763-8.309 1.28c-0.854 0.131-1.563 0.736-1.838 1.562-0.275 0.827-0.067 1.739 0.536 2.36l6.088 6.298-1.413 8.731c-0.142 0.88 0.226 1.762 0.947 2.277 0.397 0.28 0.862 0.424 1.328 0.424 0.384 0 0.766-0.098 1.115-0.291l7.243-4.037 4.768 2.656v-3.662l-4.768-2.658-7.184 4.005 1.378-8.517-1.114-1.154-4.922-5.090 8.323-1.282 0.723-1.552 2.798-6.014 3.52 7.566 8.326 1.283-6.038 6.243 0.733 4.53h3.242l-0.56-3.458 6.091-6.298c0.6-0.622 0.806-1.534 0.531-2.362z"></path>
                    </svg></svg>

                    <span>Create Fav Page</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <svg class="olymp-logout-icon"><svg id="olymp-logout-icon" viewBox="0 0 43 32" width="100%" height="100%">
                      <title>logout-icon</title>
                      <path d="M26.667 3.557c4.962 0 9.232 2.91 11.23 7.111h3.838c-2.197-6.212-8.105-10.668-15.068-10.668s-12.873 4.457-15.070 10.667h3.84c1.998-4.199 6.268-7.109 11.23-7.109zM26.667 28.446c-4.962 0-9.232-2.91-11.23-7.111h-3.84c2.199 6.21 8.107 10.665 15.070 10.665 6.962 0 12.871-4.455 15.070-10.665h-3.838c-2 4.201-6.27 7.111-11.232 7.111zM23.111 17.778v-3.556h-16.306l3.252-3.25-2.514-2.514-7.543 7.541 7.543 7.543 2.514-2.514-3.252-3.252h16.306zM39.111 14.224v3.556h3.556v-3.556h-3.556z"></path>
                    </svg></svg>

                    <span>Log Out</span>
                  </a>
                </li>
              </ul>

              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Chat Settings</h6>
              </div>

              <ul class="chat-settings">
                <li>
                  <a href="#">
                    <span class="icon-status online"></span>
                    <span>Online</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="icon-status away"></span>
                    <span>Away</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span class="icon-status disconected"></span>
                    <span>Disconnected</span>
                  </a>
                </li>

                <li>
                  <a href="#">
                    <span class="icon-status status-invisible"></span>
                    <span>Invisible</span>
                  </a>
                </li>
              </ul>

              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">Custom Status</h6>
              </div>

              <form class="form-group with-button custom-status">
                <input class="form-control" placeholder="" type="text" value="Space Cowboy">

                <button class="bg-purple">
                  <svg class="olymp-check-icon"><svg id="olymp-check-icon" viewBox="0 0 37 32" width="100%" height="100%">
                    <title>check-icon</title>
                    <path d="M11.243 23.184l-7.424-7.421-3.712 3.712 11.136 11.136 18.557-18.557-3.712-3.715-14.845 14.845zM33.512 0.915l-3.712 3.712 3.712 3.712 3.712-3.712-3.712-3.712z"></path>
                  </svg></svg>
                </button>
              </form>

              <div class="ui-block-title ui-block-title-small">
                <h6 class="title">About Olympus</h6>
              </div>

              <ul>
                <li>
                  <a href="#">
                    <span>Terms and Conditions</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>FAQs</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Careers</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Contact</span>
                  </a>
                </li>
              </ul>
            </div>

          </div>
        </div>
        <a href="" class="author-name fn">
          <div class="author-title">
            James Spiegel <svg class="olymp-dropdown-arrow-icon"><svg id="olymp-dropdown-arrow-icon" viewBox="0 0 48 32" width="100%" height="100%">
              <title>dropdown-arrow-icon</title>
              <path d="M41.888 0.104l-17.952 19.064-17.952-19.064-5.984 6.352 23.936 25.44 23.936-25.44z"></path>
            </svg></svg>
          </div>
          <span class="author-subtitle">SPACE COWBOY</span>
        </a>
      </div>

    </div>
  </div>

</header>