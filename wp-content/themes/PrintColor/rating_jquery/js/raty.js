$(document).ready(function(){
	$('.rate1').raty({
		click: function(score, evt) {
			$('#user_stars').val(score)
	 }
	});

});
