$(document).ready(function() {
	$('.whats-next').tooltip({
		delay: 0
	});
	$('input').tooltip({
		delay: 0
	});

	$('h2#whats-next-head').tooltip({
		delay: 0
	});
	
	$.post("/index/next",
		function(response) {
			$("#next").html(response);	
		},
		"text"
		);

});
