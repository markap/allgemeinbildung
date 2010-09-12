$(document).ready(function() {

	var timeRequest = true;

	// multiple choice buttons
	$('.answer').click(function() {
		$('.answer').attr('disabled', true);
		timeRequest = false;
		sendRequest('answerrequest', this.id);
	});

	// no multiple choice button
	$('#send_answer').click(function() {
		if ($('#input_answer').val() === '') return;
		$('#send_answer').attr('disabled', true);
		$('#input_answer').attr('disabled', true);
		timeRequest = false;
		sendRequest('answerrequest', $('#input_answer').val());
	});

	// send textfield with button click
	$('#input_answer').keydown(function(e) {
		if (e.keyCode === 13) {		// Enter
			if ($('#input_answer').val() === '') return; 
			$('#send_answer').attr('disabled', true);
			$('#input_answer').attr('disabled', true);
			timeRequest = false;
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
		if (timeRequest == true) {
			$('.answer').attr('disabled', true);
			$('#input_answer').attr('disabled', true);
			$('#send_answer').attr('disabled', true);
			sendRequest('timeover', 1);
		}
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


	// bigger image
	$('a#big-img').fancybox({
		titleShow: false,
		scrolling: 'yes',
		centerOnScroll: true
	});


	// sorter question
	//
	//
	var order = '';

	$('#sorter-table').tableDnD({
		onDrop: function(table, row) {
			var rows  = table.tBodies[0].rows;
			order = '';
			for (var i = 0; i < rows.length; i++) {
				order += rows[i].id + "trtrtrtr";
			}
		}
	});

	$('#send_sort_answer').click(function() {
		if ($('.sorter-textfield')) {
			var textfields = $('.sorter-textfield');
			$.each(textfields, function() {
				order += $(this).val() + "trtrtrtr";
			});
		}	
		sendRequest('answerrequest', order);
	});

});
