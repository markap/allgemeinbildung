$(document).ready(function() {

	$('.answer').click(function() {
		$.post("/question/questionrequest"
			+ "/answer/" + this.id
		,
		function(response) {
			$("#answer").html(response);	
		},
		"text"
		);
	});
});
