$(document).ready(function(){
  $('#tablaEstudios').on('click', 'tbody tr', function(event) {
  		$(".error").hide();
  		$(this).addClass('highlight');
  		$('tbody tr').removeClass('highlight');
  		$(this).addClass('highlight');
  	});
});
