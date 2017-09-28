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
				$.ajax({
					url: 'chat.php',
					type: 'POST',
					data: {lu: 'test', id_graph_emet: id_emet}
				})
				.done(function(data) {
					$("."+id_emet).find('.label-avatar').hide();
					// console.log(data);
					$(".ajout_"+id_emet).find('ul.chat-message-field').empty();
					$(".ajout_"+id_emet).find('ul.chat-message-field').append(data);
					// var bot = JSON.parse(data);
					var gars_du_chat = $(".lemet").val();
					$(".ajout_"+id_emet).find(".title").html(gars_du_chat);
					var calcul_y = 250 * 1 - $(".chat-message-field").css('height').replace('px', '') * 1;
					// var calcul_x = $(".chat-message-field").css('height').replace('px', '') * 1 - 150* 1 ;
					// console.log(calcul_x);
					// console.log(calcul_y);
					// $(".chat-message-field").css('position','relative');
					// $(".chat-message-field").css('top', calcul_y+'px');
					// $(".ps__scrollbar-y-rail").css('top', calcul_x+'px');
					// $(".ps__scrollbar-y").css('top', '130px');
					// $(".ps__scrollbar-x").css('top', '130px');
					// console.log(data);
					// $('.mCustomScrollbar').perfectScrollbar('suppressScrollY': true);
					
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
		}, 100);
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
			var $target = $('.scc'); 
			$target.animate({scrollTop: $(".chat-message-field").height()}, 200);
		})
	})

	$(".lemess").keypress(function(e) {
		if(e.which == 13) {
			$(".options-message").click();
		}
	});

})