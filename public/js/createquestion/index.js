$(document).ready(function() {
	
	$('#imageText-element').click(function(){ 
		$.openDOMWindow({ 
			loader:1, 
			loaderImagePath:'animationProcessing.gif', 
			loaderHeight:16, 
			loaderWidth:17, 
			windowSourceID:'#imagePicker' 
		}); 
		return false; 
	}); 

    $('#imageName').keyup(function(event){
		var name = $('#imageName').val();
		$.post("/createquestion/showimages"
			+ "/name/" + name
		, function (response) {
			$("#images").html(response);
		},
		"text"
		);	
		return false;
    });

	$('.image').click(function() {
		$.closeDOMWindow({});
		$('#imageText').val(this.id);
	});
});
