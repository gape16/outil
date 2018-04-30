$('.create_code').on('click', function(){
	window.location.href = "code.php";
})

$('.sorting-item').each(function(){
	var id_code = $(this).find('input.id_code').val();
	if ($(this).is('[href$=id_code=]')){
		$(this).on('click', function(){
			$(this).find('a.opencode').attr('href', function(){
				return this.href + '?id_code=' + id_code + '';
			})
		})
	}
});

$('.search').keyup(function(){
	var search = $(this).val();
	$('.sorting-menu').css('display', 'none');
	if(search.length >= 3){
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {search_code: search},
		})
		.done(function(data) {
			$('#wrapper_code').html('');
			$(data).appendTo('#wrapper_code');
		})
	}else{
		$('.sorting-menu').css('display', 'block');
		$.ajax({
			url: '../../formulaire.php',
			type: 'POST',
			data: {search_code_empty: search},
		})
		.done(function(data) {
			$('#wrapper_code').html('');
			$(data).appendTo('#wrapper_code');
		})
	}
});


$('.sorting-item').each(function(){
	var id_code = $(this).find('input.id_code').val();
	if ($(this).is('[href$=id_code=]')){
		$(this).on('click', function(){
			$(this).find('a.opencode').attr('href', function(){
				return this.href + '?id_code=' + id_code + '';
			})
		})
	}
});

$('.accept_code').on('click', function(){
	var id_code = $('.id_code').val();
	console.log(id_code);
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {clic_accept: 'value1', id_code: id_code},
	})
	.done(function() {
		swal('Code accepté !').then(function(){
			location.reload();
		})
	})		
})

$('.deny_code').on('click', function(){
	var id_code = $('.id_code').val();
	console.log(id_code);
	$.ajax({
		url: '../../formulaire.php',
		type: 'POST',
		data: {clic_deny: 'value1', id_code: id_code},
	})
	.done(function() {
		swal('Code supprimé !').then(function(){
			location.reload();
		})
	})		
})


$('time.published').each(function(){
	var date = $(this).html();
	var newDate = date.split(' ');

//spaces are required
if (newDate[5] === 'moiss													') {
	$(this).html('Il Y A ' + newDate[0, 4] + ' mois')
}
})