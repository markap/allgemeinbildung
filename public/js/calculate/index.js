$(document).ready(function() {

	$('.right').hide();
	$('.wrong').hide();

	$('.textfield').live('keydown', function(e) { 
		var me = $(this);
 		var keyCode = e.keyCode || e.which; 

  		if (keyCode == 9) { 
			var input  = $(this).val();

			var values = $(this).parent().children();
			var numberOne = values[0].id;
			var operator  = values[1].id;
			var numberTwo = values[2].id;
			var result	  = parseInt(numberOne) + parseInt(numberTwo);
			
			if (result == input) {
				$(this).parent().children('.right').show();
			} else {
				$(this).parent().children('.wrong').show();
			}	

			me.attr('readOnly', true);

			if (this.id == 'last') {
				$('#calculate-form').submit();
			}
    	} 
    });


});
