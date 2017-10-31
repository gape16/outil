$(function(){

	function charger(){
		setTimeout( function(){



			if($(".popup-chat").is('[class*="open-chat"]')){
				var check="ajout_";
				var cls = $(".popup-chat").attr('class').split(' ');
				for (var i = 0; i < cls.length; i++) {
					if (cls[i].indexOf(check) > -1) {
						var id_emet = cls[i].slice(check.length, cls[i].length);
					}
				}
				var last_message = $(".chat-message-field").find("li").last().attr('class');
				var last_message_id = $(".chat-message-field").find("li").last().attr('id');
				$.ajax({
					url: 'chat.php',
					type: 'POST',
					data: {ajout_message: id_emet, recep: last_message, id_last: last_message_id}
				})
				.done(function(data) {
					$("."+id_emet).find('.label-avatar').hide();
					// console.log(data);
					if(data==""){
						console.log('test');
					}else if(data.match("^<li")){
						$(".chat-message-field").append(data);
					}else{
						$(".chat-message-field").find("li").last().find(".notification-date").remove();
						$(".chat-message-field").find("li").last().find('.notification-event').append(data);
					}
				})
			}

			$.ajax({
				url: 'chat.php',
				type: 'POST',
				data: {attente: 'test'},
			})
			.done(function(data) {
				// console.log(data);
				var myObject = JSON.parse(data);
				for (var i = 0; i <= myObject.length - 1; i++) {
					$("."+myObject[i]['identifiant']).find('.label-avatar').html(myObject[i]['nombre']);
					$("."+myObject[i]['identifiant']).find('.label-avatar').show();
				}
			})
			charger();
		}, 500);
	}

	charger();


	$(".options-message").on('click', function(){
		var check="ajout_";
		var messs=$(this).parent().parent().find("textarea").val();
		var cls = $(".popup-chat").attr('class').split(' ');
		for (var i = 0; i < cls.length; i++) {
			if (cls[i].indexOf(check) > -1) {
				var id_emet = cls[i].slice(check.length, cls[i].length);
			}
		}
		$.ajax({
			url: 'chat.php',
			type: 'POST',
			data: {envoi: id_emet, mess: messs},
		})
		.done(function(data) {
			$(".options-message").parent().parent().find("textarea").val('');
			console.log(data);
			var $target = $('.scc'); 
			$target.animate({scrollTop: $(".chat-message-field").height()}, 200);
		})
	})

	$(".lemess").keypress(function(e) {
		if(e.which == 13) {
			$(".options-message").trigger( "click" );
		}
	});

	$(".js-chat-open").on('click', function(){
		var check="ajout_";
		var cls = $(".popup-chat").attr('class').split(' ');
		for (var i = 0; i < cls.length; i++) {
			if (cls[i].indexOf(check) > -1) {
				var id_emet = cls[i].slice(check.length, cls[i].length);
			}
		}
		// console.log(id_emet);
		$.ajax({
			url: 'chat.php',
			type: 'POST',
			data: {lu: 'test', id_graph_emet: id_emet}
		})
		.done(function(data) {
			$("."+id_emet).find('.label-avatar').hide();
			console.log(data);
			$(".ajout_"+id_emet).find('ul.chat-message-field').empty();
			$(".ajout_"+id_emet).find('ul.chat-message-field').append(data);
					// var bot = JSON.parse(data);
					var gars_du_chat = $(".lemet").val();
					$(".ajout_"+id_emet).find(".title").html(gars_du_chat);
				})
	})

})