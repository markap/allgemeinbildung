$(document).ready(function() {

	$("#send").click(function() {
		var checkboxes = $("input[type=checkbox]");
		var doSubmit = false;
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked == true) doSubmit = true;
		}

		if (doSubmit) {
			$("#form").submit();
		} else {
			$(".error").show();
		}
	});


	$(".category").click(function() {
		var check = $(this).children("input[type=checkbox]").attr('checked');
		$(this).children("input[type=checkbox]").attr('checked', !check);
	});

});
