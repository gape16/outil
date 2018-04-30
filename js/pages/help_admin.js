
$(function(){

	$('.search').keyup(function(){
		var search = $(this).val();
		if(search.length >= 3){
			$.ajax({
				url: '../../formulaire.php',
				type: 'POST',
				data: {admin_help_search: search},
			})
			.done(function(data) {
				console.log(data);
				$('table.event-item-table tbody').html('');
				$(data).appendTo('table.event-item-table tbody');
			})
		}else{
			$.ajax({
				url: '../../formulaire.php',
				type: 'POST',
				data: {admin_help_search_empty: search},
			})
			.done(function(data) {
				$('table.event-item-table tbody').html('');
				$(data).appendTo('table.event-item-table tbody');
			})
		}
	});
	var idleTime = 0;
	$(document).ready(function () {
                        //Increment the idle time counter every minute.
                         var idleInterval = setInterval(timerIncrement, 1000); // 1 minute

                        //Zero the idle timer on mouse movement.
                        $(this).mousemove(function (e) {
	        idleTime = 0;
    });
    $(this).keypress(function (e) {
	        idleTime = 0;
    });
});

	function timerIncrement() {
		    idleTime = idleTime + 1;
    if (idleTime > 300) { // 5 minutes
	        window.location.reload();
    }
}
})