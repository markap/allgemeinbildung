$(document).ready(function() {

	$('.answer').click(function() {
		sendRequest(this.id);
		return;
	});

	$('#send_answer').click(function() {
		sendRequest($('#input_answer').val());
		return;
	});

	$('#input_answer').keydown(function(e) {
		if (e.keyCode === 13) {		// Enter
			sendRequest($('#input_answer').val());
			return;
		}
	});

	var sendRequest = function(getParam) {
		$.post("/game/answerrequest"
			+ "/answer/" + getParam
		,
		function(response) {
			$("#answer_score").html(response);	
		},
		"text"
		);

	}
});
