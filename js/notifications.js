$(function(){
	function notifier(){
		setTimeout( function(){
			$.ajax({
				url: 'notifs.php',
				type: 'POST',
				data: {code:'code'} 
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
					liste+= '<li><div class="author-thumb"><img src="'+myObject[i]["photo"]+'" alt="author">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="code.php?id_code='+myObject[i]["id_code"]+'" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["categorie_code"]+'</span></li>';
				}
				$(".notif_list").append(liste);
			})
			$.ajax({
				url: 'notifs.php',
				type: 'POST',
				data: {veille:'code'} 
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
					liste+= '<li><div class="author-thumb"><img src="uploads/veille/'+myObject[i]["file"]+'" alt="author" style="border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="veille.php" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["categorie"]+'</span></li>';
				}
				$(".veille_list").append(liste);
			})
			$.ajax({
				url: 'notifs.php',
				type: 'POST',
				data: {achat:'code'} 
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
					liste+= '<li><div class="author-thumb"><img src="'+myObject[i]["photo"]+'" alt="author" style="border-radius:0% !important;height:100% !important;">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="achat_photos.php" class="h6 notification-friend">'+myObject[i]["id_client"]+'</a><br>';
					liste+= '<span class="chat-message-item">'+myObject[i]["categorie"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["etat"]+'</span></li>';
				}
				$(".veille_achat").append(liste);
			})
			notifier();
		}, 3000);
	}
	notifier();
})