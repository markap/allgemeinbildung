$(document).ready(function() {
	
	$('.setActive').click(function() {
		var questionId = this.id;

		$.post("/createquestion/setactive"
			+ "/questionid/" + questionId
		, function (response) {
			$("#" + questionId).html(response);
		},
		"text"
		);	
	});

});

