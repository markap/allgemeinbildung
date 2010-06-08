$(document).ready(function() {
	
	$('.setActive').click(function() {
		var questionId = this.id;
		$(this).parents(".question").animate({opacity: "hide"}, "slow");

		$.post("/createquestion/setactive"
			+ "/questionid/" + questionId
		, function (response) {
			$("#success").html(response);
		},
		"text"
		);	
	});

});

