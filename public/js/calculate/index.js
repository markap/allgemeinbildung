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
			var result	  = calculate(numberOne, numberTwo, operator);

			// check if there are some children
			var div 	= $(this).parent();
			var childs 	= div[0].id;

			for (var i = 0; i < childs; i++) {
				var operator  = values[3 + i].id;
				var numberTwo = values[4 + i].id;
				result = calculate(result, numberTwo, operator);
			}  
			
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


	var calculate = function (numberOne, numberTwo, operator) {
		numberOne = parseInt(numberOne);
		numberTwo = parseInt(numberTwo);
		var result = 0;
		switch (operator) {
			case '+':
				result = numberOne + numberTwo;
			break;
			case '-':
				result = numberOne - numberTwo;
			break;
			case '*':
				result = numberOne * numberTwo;
			break;
			case '/':
				result = numberOne / numberTwo;
			break;
		}
		return result;
	}

});
