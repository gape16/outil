<?php
$id_graph=$_SESSION['id_graph'];
$query_equipe = $bdd->prepare("SELECT id_manager FROM user WHERE id_user = :graph");
$query_equipe->bindParam(':graph', $id_graph);
$query_equipe->execute();
$result_equipe = $query_equipe->fetch();
$equipe=$result_equipe['id_manager'];

$query_equipe_chat = $bdd->prepare("SELECT id_user, photo_avatar FROM user WHERE id_manager = :equipe and id_user != :user");
$query_equipe_chat->bindParam(':equipe', $equipe);
$query_equipe_chat->bindParam(':user', $id_graph);
$query_equipe_chat->execute();
$result_equipe_chat=$query_equipe_chat->fetchAll();


?>
<div class="fixed-sidebar right" style="z-index: 9!important;">
  <div class="fixed-sidebar-right sidebar--small" id="sidebar-right">

    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <ul class="chat-users">
        <?php foreach ($result_equipe_chat as $key => $value_equipe) {?>
        
        <li class="inline-items js-chat-open <?php echo utf8_encode($value_equipe['id_user']);?>">
          <div class="author-thumb">
            <input type="hidden" value="<?php echo utf8_encode($value_equipe['id_user']);?>" class="chat_graph">
            <img alt="author" src="<?php echo utf8_encode($value_equipe['photo_avatar']);?>" class="avatar">
            <span class="icon-status online"></span>
            <div class="label-avatar bg-primary" style="display: none;"></div>
          </div>
        </li>

        <?php }?>
      </ul>
    </div>

    

  </div>

  <div class="fixed-sidebar-right sidebar--large" id="sidebar-right-1">

    <div class="mCustomScrollbar" data-mcs-theme="dark">

      <div class="ui-block-title ui-block-title-small">
        <a href="#" class="title">Close Friends</a>
        <a href="#">Settings</a>
      </div>

      <ul class="chat-users">
        <li class="inline-items js-chat-open">

          <div class="author-thumb">
            <img alt="author" src="img/avatar67-sm.jpg" class="avatar">
            <span class="icon-status online"></span>
          </div>

          <div class="author-status">
            <a href="#" class="h6 author-name">Carol Summers</a>
            <span class="status">ONLINE</span>
          </div>

          <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
            <title>three-dots-icon</title>
            <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
          </svg></svg>

          <ul class="more-icons">
            <li>
              <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
                <title>comments-post-icon</title>
                <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
                <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
              </svg></svg>
            </li>

            <li>
              <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
                <title>add-to-conversation-icon</title>
                <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
                <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
                <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
              </svg></svg>
            </li>

            <li>
              <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
                <title>block-from-chat-icon</title>
                <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
                <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
                <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
              </svg></svg>
            </li>
          </ul>

        </div>

      </li>
      <li class="inline-items js-chat-open">

        <div class="author-thumb">
          <img alt="author" src="img/avatar62-sm.jpg" class="avatar">
          <span class="icon-status online"></span>
        </div>

        <div class="author-status">
          <a href="#" class="h6 author-name">Mathilda Brinker</a>
          <span class="status">AT WORK!</span>
        </div>

        <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
          <title>three-dots-icon</title>
          <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
        </svg></svg>

        <ul class="more-icons">
          <li>
            <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
              <title>comments-post-icon</title>
              <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
              <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
            </svg></svg>
          </li>

          <li>
            <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
              <title>add-to-conversation-icon</title>
              <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
              <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
              <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
            </svg></svg>
          </li>

          <li>
            <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
              <title>block-from-chat-icon</title>
              <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
              <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
              <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
            </svg></svg>
          </li>
        </ul>

      </div>

    </li>

    <li class="inline-items js-chat-open">


      <div class="author-thumb">
        <img alt="author" src="img/avatar68-sm.jpg" class="avatar">
        <span class="icon-status online"></span>
      </div>

      <div class="author-status">
        <a href="#" class="h6 author-name">Carol Summers</a>
        <span class="status">ONLINE</span>
      </div>

      <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
        <title>three-dots-icon</title>
        <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
      </svg></svg>

      <ul class="more-icons">
        <li>
          <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
            <title>comments-post-icon</title>
            <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
            <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
          </svg></svg>
        </li>

        <li>
          <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
            <title>add-to-conversation-icon</title>
            <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
            <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
            <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
          </svg></svg>
        </li>

        <li>
          <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
            <title>block-from-chat-icon</title>
            <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
            <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
            <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
          </svg></svg>
        </li>
      </ul>

    </div>


  </li>

  <li class="inline-items js-chat-open">


    <div class="author-thumb">
      <img alt="author" src="img/avatar69-sm.jpg" class="avatar">
      <span class="icon-status away"></span>
    </div>

    <div class="author-status">
      <a href="#" class="h6 author-name">Michael Maximoff</a>
      <span class="status">AWAY</span>
    </div>

    <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
      <title>three-dots-icon</title>
      <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
    </svg></svg>

    <ul class="more-icons">
      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
          <title>comments-post-icon</title>
          <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
          <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>add-to-conversation-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>block-from-chat-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
        </svg></svg>
      </li>
    </ul>

  </div>


</li>

<li class="inline-items js-chat-open">


  <div class="author-thumb">
    <img alt="author" src="img/avatar70-sm.jpg" class="avatar">
    <span class="icon-status disconected"></span>
  </div>

  <div class="author-status">
    <a href="#" class="h6 author-name">Rachel Howlett</a>
    <span class="status">OFFLINE</span>
  </div>

  <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
    <title>three-dots-icon</title>
    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
  </svg></svg>

  <ul class="more-icons">
    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
        <title>comments-post-icon</title>
        <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
        <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>add-to-conversation-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>block-from-chat-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
      </svg></svg>
    </li>
  </ul>

</div>


</li>
</ul>


<div class="ui-block-title ui-block-title-small">
  <a href="#" class="title">MY FAMILY</a>
  <a href="#">Settings</a>
</div>

<ul class="chat-users">
  <li class="inline-items js-chat-open">

    <div class="author-thumb">
      <img alt="author" src="img/avatar64-sm.jpg" class="avatar">
      <span class="icon-status online"></span>
    </div>

    <div class="author-status">
      <a href="#" class="h6 author-name">Sarah Hetfield</a>
      <span class="status">ONLINE</span>
    </div>

    <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
      <title>three-dots-icon</title>
      <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
    </svg></svg>

    <ul class="more-icons">
      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
          <title>comments-post-icon</title>
          <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
          <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>add-to-conversation-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>block-from-chat-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
        </svg></svg>
      </li>
    </ul>

  </div>
</li>
</ul>


<div class="ui-block-title ui-block-title-small">
  <a href="#" class="title">UNCATEGORIZED</a>
  <a href="#">Settings</a>
</div>

<ul class="chat-users">
  <li class="inline-items js-chat-open">

    <div class="author-thumb">
      <img alt="author" src="img/avatar71-sm.jpg" class="avatar">
      <span class="icon-status online"></span>
    </div>

    <div class="author-status">
      <a href="#" class="h6 author-name">Bruce Peterson</a>
      <span class="status">ONLINE</span>
    </div>

    <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
      <title>three-dots-icon</title>
      <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
    </svg></svg>

    <ul class="more-icons">
      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
          <title>comments-post-icon</title>
          <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
          <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>add-to-conversation-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
        </svg></svg>
      </li>

      <li>
        <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
          <title>block-from-chat-icon</title>
          <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
          <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
          <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
        </svg></svg>
      </li>
    </ul>

  </div>


</li>
<li class="inline-items js-chat-open">

  <div class="author-thumb">
    <img alt="author" src="img/avatar72-sm.jpg" class="avatar">
    <span class="icon-status away"></span>
  </div>

  <div class="author-status">
    <a href="#" class="h6 author-name">Chris Greyson</a>
    <span class="status">AWAY</span>
  </div>

  <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
    <title>three-dots-icon</title>
    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
  </svg></svg>

  <ul class="more-icons">
    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
        <title>comments-post-icon</title>
        <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
        <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>add-to-conversation-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>block-from-chat-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
      </svg></svg>
    </li>
  </ul>

</div>

</li>
<li class="inline-items js-chat-open">

  <div class="author-thumb">
    <img alt="author" src="img/avatar63-sm.jpg" class="avatar">
    <span class="icon-status status-invisible"></span>
  </div>

  <div class="author-status">
    <a href="#" class="h6 author-name">Nicholas Grisom</a>
    <span class="status">INVISIBLE</span>
  </div>

  <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
    <title>three-dots-icon</title>
    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
  </svg></svg>

  <ul class="more-icons">
    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
        <title>comments-post-icon</title>
        <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
        <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>add-to-conversation-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>block-from-chat-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
      </svg></svg>
    </li>
  </ul>

</div>
</li>
<li class="inline-items js-chat-open">

  <div class="author-thumb">
    <img alt="author" src="img/avatar72-sm.jpg" class="avatar">
    <span class="icon-status away"></span>
  </div>

  <div class="author-status">
    <a href="#" class="h6 author-name">Chris Greyson</a>
    <span class="status">AWAY</span>
  </div>

  <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
    <title>three-dots-icon</title>
    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
  </svg></svg>

  <ul class="more-icons">
    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
        <title>comments-post-icon</title>
        <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
        <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>add-to-conversation-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>block-from-chat-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
      </svg></svg>
    </li>
  </ul>

</div>
</li>
<li class="inline-items js-chat-open">

  <div class="author-thumb">
    <img alt="author" src="img/avatar71-sm.jpg" class="avatar">
    <span class="icon-status online"></span>
  </div>

  <div class="author-status">
    <a href="#" class="h6 author-name">Bruce Peterson</a>
    <span class="status">ONLINE</span>
  </div>

  <div class="more"><svg class="olymp-three-dots-icon"><svg id="olymp-three-dots-icon" viewBox="0 0 128 32" width="100%" height="100%">
    <title>three-dots-icon</title>
    <path d="M112-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM64-0.008c-8.84 0-16 7.16-16 16 0 8.832 7.16 15.992 16 15.992s16-7.16 16-15.992c0-8.84-7.16-16-16-16zM16-0.008c-8.832 0-16 7.16-16 16s7.168 15.992 16 15.992 16-7.16 16-15.992c0-8.84-7.16-16-16-16z"></path>
  </svg></svg>

  <ul class="more-icons">
    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="START CONVERSATION" class="olymp-comments-post-icon"><svg id="olymp-comments-post-icon" viewBox="0 0 36 32" width="100%" height="100%">
        <title>comments-post-icon</title>
        <path d="M32 0h-28c-2.21 0-4 1.792-4 4v18c0 2.208 1.792 4 4 4 0 0 0.75 0 2 0v-4h-2v-18h28v22c2.208 0 4-1.792 4-4v-18c0-2.208-1.792-4-4-4zM18 26h2v-4h-2v4zM24 26h4v-4h-4v4zM8 12h20v-4h-20v4zM8 18h12v-4h-12v4z"></path>
        <path d="M18 22l-8 4.282v-4.282h-4v10l12-6v-4z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="ADD TO CONVERSATION" class="olymp-add-to-conversation-icon"><svg id="olymp-add-to-conversation-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>add-to-conversation-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.4 9.6h-3.2v-3.2h-3.2v3.2h-3.2v3.2h3.2v3.2h3.2v-3.2h3.2z"></path>
      </svg></svg>
    </li>

    <li>
      <svg data-toggle="tooltip" data-placement="top" data-original-title="BLOCK FROM CHAT" class="olymp-block-from-chat-icon"><svg id="olymp-block-from-chat-icon" viewBox="0 0 35 32" width="100%" height="100%">
        <title>block-from-chat-icon</title>
        <path d="M32 0h-28.8c-1.768 0-3.2 1.434-3.2 3.2v16c0 1.766 1.434 3.2 3.2 3.2 0 0 0.6 0 1.6 0v-3.2h-1.6v-16h28.8v19.2c1.766 0 3.2-1.434 3.2-3.2v-16c0-1.766-1.434-3.2-3.2-3.2zM20.8 22.4h1.6v-3.2h-1.6v3.2zM25.6 22.4h3.2v-3.2h-3.2v3.2z"></path>
        <path d="M17.6 19.2l-9.6 6.626v-6.626h-3.2v12.8l12.8-9.6h3.2v-3.2z"></path>
        <path d="M22.125 8.938l-2.262-2.262-2.262 2.262-2.262-2.262-2.264 2.262 2.262 2.262-2.262 2.264 2.264 2.262 2.262-2.262 2.262 2.262 2.262-2.262-2.262-2.264z"></path>
      </svg></svg>
    </li>
  </ul>

</div>
</li>
</ul>

</div>

<div class="search-friend inline-items">
  <form class="form-group">
    <input class="form-control" placeholder="Search Friends..." value="" type="text">
  </form>

  <a href="#" class="settings">
    <svg class="olymp-settings-icon"><svg id="olymp-settings-icon" viewBox="0 0 32 32" width="100%" height="100%">
      <title>settings-icon</title>
      <path d="M7.111 3.881v-3.881h-3.556v3.883c-2.068 0.734-3.556 2.686-3.556 5.006s1.488 4.272 3.556 5.006v10.994h3.556v-10.996c2.068-0.734 3.556-2.686 3.556-5.004s-1.488-4.272-3.556-5.008zM7.111 10.667h-3.556v-3.556h3.556v3.556zM28.444 3.881v-3.881h-3.556v3.883c-2.066 0.734-3.556 2.686-3.556 5.006s1.49 4.27 3.556 5.006v18.105h3.556v-18.107c2.066-0.734 3.556-2.686 3.556-5.004s-1.49-4.272-3.556-5.008zM28.444 10.667h-3.556v-3.556h3.556v3.556zM17.778 18.105v-18.105h-3.556v18.105c-2.068 0.734-3.556 2.686-3.556 5.006 0 2.318 1.488 4.27 3.556 5.006v3.883h3.556v-3.883c2.066-0.736 3.556-2.69 3.556-5.006 0-2.32-1.49-4.272-3.556-5.006zM17.778 24.887h-3.556v-3.554h3.556v3.554zM3.556 32h3.556v-3.556h-3.556v3.556z"></path>
    </svg></svg>
  </a>

  <a href="#" class="js-sidebar-open">
    <svg class="olymp-close-icon"><svg id="olymp-close-icon" viewBox="0 0 32 32" width="100%" height="100%">
      <title>close-icon</title>
      <path d="M14.222 17.778h3.556v-3.556h-3.556v3.556zM31.084 3.429l-2.514-2.514-10.057 10.057 2.514 2.514 10.057-10.057zM0.916 28.571l2.514 2.514 10.057-10.055-2.516-2.514-10.055 10.055zM18.514 21.029l10.057 10.055 2.514-2.514-10.057-10.055-2.514 2.514zM0.916 3.431l10.057 10.055 2.516-2.514-10.059-10.057-2.514 2.516z"></path>
    </svg></svg>
  </a>


</div>

<a href="#" class="olympus-chat inline-items">

  <h6 class="olympus-chat-title">OLYMPUS CHAT</h6>
  <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
    <title>chat---messages-icon</title>
    <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
  </svg></svg>
</a>

</div>
</div>

<!-- ... end Fixed Sidebar Right -->

<!-- Fixed Sidebar Right -->

<div class="fixed-sidebar right fixed-sidebar-responsive">

  <div class="fixed-sidebar-right sidebar--small" id="sidebar-right-responsive">

    <a href="accueil.php" value="1" class="olympus-chat inline-items js-chat-open">
      <svg class="olymp-chat---messages-icon"><svg id="olymp-chat---messages-icon" viewBox="0 0 40 32" width="100%" height="100%">
        <title>chat---messages-icon</title>
        <path d="M24.381 7.621h-21.333c-1.378 0-3.048 1.606-3.048 3.046v13.716c0 1.443 1.67 3.048 3.048 3.048v4.57l12.19-4.568v-3.051l-9.143 3.051v-3.051h-3.048v-13.714h21.333v16.763c1.378 0 3.048-1.605 3.048-3.048v-13.716c0-1.44-1.67-3.046-3.048-3.046zM18.286 27.432h3.048v-3.048h-3.048v3.048zM6.095 16.763h15.238v-3.046h-15.238v3.046zM6.095 21.336h9.143v-3.048h-9.143v3.048zM15.238 3.051h24.381c0-1.443-1.67-3.049-3.048-3.049h-21.333c-1.378 0-3.048 1.606-3.048 3.049v1.527h3.048v-1.527zM36.571 16.763l-4.571-0.002v3.051l-3.048-1.016v3.301l6.095 2.284v-4.568c0.779 0 1.524 0 1.524 0 1.378 0 3.048-1.606 3.048-3.049v-4.571h-3.048v4.571zM36.571 9.144h3.048v-3.048h-3.048v3.048z"></path>
      </svg></svg>
    </a>

  </div>

</div>
