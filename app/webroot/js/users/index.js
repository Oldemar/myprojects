$('.wedit').click(function(){
	alert('pedasdfro');
	

	var theid = $( this ).attr('id').split('_');

	alert(theid[1]);

	$('#wedit_'+theid[1]).hide();
	
});
