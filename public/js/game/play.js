$(document).ready(function() {

	$('.answer').click(function() {
		$.post("/game/answerrequest"
			+ "/answer/" + this.id
		,
		function(response) {
			$("#answer_score").html(response);	
		},
		"text"
		);
	});
});
