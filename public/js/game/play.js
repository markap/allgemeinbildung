$(document).ready(function() {

	// multiple choice buttons
	$('.answer').click(function() {
		sendRequest('answerrequest', this.id);
	});

	// no multiple choice button
	$('#send_answer').click(function() {
		if ($('#input_answer').val() === '') return;
		sendRequest('answerrequest', $('#input_answer').val());
	});

	// send textfield with button click
	$('#input_answer').keydown(function(e) {
		if (e.keyCode === 13) {		// Enter
			if ($('#input_answer').val() === '') return; 
			sendRequest('answerrequest', $('#input_answer').val());
		}
	});

	// ajax-call for checking the answer
	var sendRequest = function(action, getParam) {
		$.post("/game/" + action
			+ "/answer/" + getParam
		,
		function(response) {
			$("#answer_score").html(response);	
		},
		"text"
		);
	}

	// countdown
	var seconds = new Date(); 
	seconds.setSeconds(seconds.getSeconds() + 30);
	$('#countdown').countdown({
		until: seconds,
		format: 'S',
		onExpiry: timeOverRequest
	});

	function timeOverRequest() {
		sendRequest('timeover', 1);
	}

	// add to Game
	$('.addToGame').click(function() { 
		$.openDOMWindow({ 
			loader:1, 
			loaderImagePath:'animationProcessing.gif', 
			loaderHeight:16, 
			loaderWidth:17, 
			windowSourceID:'#gameAdder' 
		}); 
		return false; 
	}); 

	// save adding
	$('#saveAdding').click(function() {
		var game = $('#game').val();
		var questiontype = $('#qtype').val();

		$.post("/creategame/saveadding/game/" + 
			+ game
			+ "/qtype/" + questiontype
		,
		function(response) {
			$("#addResult").html(response);	
		},
		"text"
		);

	});
});
