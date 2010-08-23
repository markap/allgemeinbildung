$(document).ready(function() {

	$('.textfield').live('keydown', function(e) { 
 	var keyCode = e.keyCode || e.which; 

  		if (keyCode == 9) { 
			var input  = $(this).val();

			var values = $(this).parent().children();
			var numberOne = values[0].id;
			var operator  = values[1].id;
			var numberTwo = values[2].id;
			var result	  = parseInt(numberOne) + parseInt(numberTwo);
			
console.log(result);
console.log(input);
			if (result == input) {
				alert('super');
			} else {
				alert('bad');
			}	
    	} 
    });


});
