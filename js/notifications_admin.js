$(function(){
	function notifier(){
		setTimeout( function(){
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {code_admin:'code'} 
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				if(myObject.length==0){
					$(".label_notifs").hide();
				}else{
					$(".label_notifs").show();
					$(".label_notifs").html(myObject.length);
				}
				$(".notif_list").empty();
				var liste="";
				for (var i = 0; i < myObject.length; i++) {
					liste+= '<li><div class="author-thumb"><img src="../'+myObject[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="code.php?id_code='+myObject[i]["id_code"]+'" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["categorie_code"]+'</span></li>';
				}
				$(".notif_list").append(liste);
			})
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {veille_admin:'code'} 
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				if(myObject.length==0){
					$(".label_veille").hide();
				}else{
					$(".label_veille").show();
					$(".label_veille").html(myObject.length);
				}
				
				$(".veille_list").empty();
				var liste="";
				for (var i = 0; i < myObject.length; i++) {
					liste+= '<li><div class="author-thumb"><img src="../uploads/veille/'+myObject[i]["file"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="veille.php" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["categorie"]+'</span></li>';
				}
				$(".veille_list").append(liste);
			})
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {achat_admin:'code'} 
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				if(myObject.length==0){
					$(".label_achat").hide();
				}else{
					$(".label_achat").show();
					$(".label_achat").html(myObject.length);
				}
				$(".veille_achat").empty();
				var liste="";
				for (var i = 0; i < myObject.length; i++) {
					liste+= '<li><div class="author-thumb"><img src="../'+myObject[i]["photo_avatar"]+'" alt="author" style="border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="achat_photos_admin.php" class="h6 notification-friend">'+myObject[i]["id_client"]+'</a><br>';
					liste+= '<span class="chat-message-item">'+myObject[i]["categorie"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["etat"]+'</span></li>';
				}
				$(".veille_achat").append(liste);
			})
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {aide_admin:'code'} 
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				if(myObject.length==0){
					$(".label_aide").hide();
				}else{
					$(".label_aide").show();
					$(".label_aide").html(myObject.length);
				}
				$(".veille_aide").empty();
				var liste="";
				for (var i = 0; i < myObject.length; i++) {
					liste+= '<li><div class="author-thumb"><img src="../'+myObject[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="help.php" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["id_client"]+'</span></li>';
				}
				$(".veille_aide").append(liste);
			})
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {rem_admin:'code'} 
			})
			.done(function(data) {
				$.ajax({
					url: '../notifs.php',
					type: 'POST',
					data: {rem_news:'code'} 
				}).done(function(news_data) {
					$.ajax({
						url: '../notifs.php',
						type: 'POST',
						data: {rem_news_bis:'code'} 
					}).done(function(news_data_bis) {
						var myObject = JSON.parse(data);
						var myObject_news = JSON.parse(news_data);
						var myObject_news_bis = JSON.parse(news_data_bis);
						var toto = myObject.length * 1 + myObject_news.length * 1 + myObject_news_bis.length * 1;
						if(toto==0){
							$(".label_remontee").hide();
						}else{
							$(".label_remontee").show();
							$(".label_remontee").html(toto);
						}

						$(".veille_rem").empty();
						var liste="";
						for (var i = 0; i < myObject.length; i++) {
							liste+= '<li><div class="author-thumb"><img src="../'+myObject[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
							liste+= '</div><div class="notification-event">';
							liste+= '<a href="remontees.php#'+myObject[i]["ref"]+'" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
							liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
							liste+= '</div><span class="notification-icon">'+myObject[i]["categorie_remontees"]+'</span></li>';
						}
						for (var i = 0; i < myObject_news.length; i++) {
							liste+= '<li><div class="author-thumb"><img src="../'+myObject_news[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
							liste+= '</div><div class="notification-event">';
							liste+= '<a href="remontees.php#'+myObject_news[i]["ref"]+'" class="h6 notification-friend">Nouveau commentaire</a>';
							liste+= '<span class="chat-message-item">'+myObject_news[i]["titre"]+'</span>';
							liste+= '</div><span class="notification-icon">'+myObject_news[i]["categorie_remontees"]+'</span></li>';
						}
						for (var i = 0; i < myObject_news_bis.length; i++) {
							liste+= '<li><div class="author-thumb"><img src="../'+myObject_news_bis[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
							liste+= '</div><div class="notification-event">';
							liste+= '<a href="remontees.php#'+myObject_news_bis[i]["ref"]+'" class="h6 notification-friend">Nouveau commentaire</a>';
							liste+= '<span class="chat-message-item">'+myObject_news_bis[i]["titre"]+'</span>';
							liste+= '</div><span class="notification-icon">'+myObject_news_bis[i]["categorie_remontees"]+'</span></li>';
						}
						$(".veille_rem").append(liste);
					})
				})
			})
			$.ajax({
				url: '../notifs.php',
				type: 'POST',
				data: {anniv:'code'} 
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				if(myObject.length==0){
					$(".label_anniv").hide();
				}else{
					$(".label_anniv").show();
					$(".label_anniv").html(myObject.length);
				}
				$(".veille_anniv").empty();
				var liste="";
				var currentYear = (new Date).getFullYear();
				for (var i = 0; i < myObject.length; i++) {
					var madate = currentYear+jQuery.trim(myObject[i]["date_naissance"]).substring(4, 10);
					var countDownDate = new Date(madate).getTime();
					var now = new Date().getTime();
					var distance = countDownDate - now;
					var days = Math.floor(distance / (1000 * 60 * 60 * 24)) +1;
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					if(days == 0){
						j="Aujourd'hui";
					}else{
						j='Dans '+days+' jours';
					}
					liste+= '<li><div class="author-thumb"><img src="../'+myObject[i]["photo_avatar"]+'" alt="author" style="width:100%;border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="help.php" class="h6 notification-friend">'+myObject[i]["prenom"]+' '+myObject[i]["nom"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["nom_statut"]+'</span>';
					liste+= '</div><span class="notification-icon">'+j+'</span></li>';
				}
				$(".veille_anniv").append(liste);
			})
			notifier();
		}, 3000);
}
notifier();
})