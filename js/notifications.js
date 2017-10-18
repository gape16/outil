$(function(){
	function notifier(){
		setTimeout( function(){
			$.ajax({
				url: 'notifs.php',
				type: 'POST'
			})
			.done(function(data) {
				var myObject = JSON.parse(data);
				$(".label_notifs").html(myObject.length);
				$(".notif_list").empty();
				var liste="";
				for (var i = 0; i < myObject.length; i++) {
					liste+= '<li><div class="author-thumb"><img src="'+myObject[i]["photo"]+'" alt="author">';
					liste+= '</div><div class="notification-event">';
					liste+= '<a href="explore.php?id_code=1" class="h6 notification-friend">'+myObject[i]["titre"]+'</a>';
					liste+= '<span class="chat-message-item">'+myObject[i]["description"]+'</span>';
					liste+= '</div><span class="notification-icon">'+myObject[i]["categorie_code"]+'</span></li>';
				}
				$(".notif_list").append(liste);
			})
			notifier();
		}, 3000);
	}
	notifier();
})