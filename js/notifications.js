$(function(){
	function notifier(){
		setTimeout( function(){
			$.ajax({
				url: 'notifs.php',
				type: 'POST'
			})
			.done(function(data) {
				// console.log(data);
				var myObject = JSON.parse(data);
				for (var i = 0; i <= myObject.length - 1; i++) {
					$("."+myObject[i]['identifiant']).find('.label-avatar').html(myObject[i]['nombre']);
					$("."+myObject[i]['identifiant']).find('.label-avatar').show();
				}
			})
			notifier();
		}, 500);
	}
	notifier();
})