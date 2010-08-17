$(document).ready(function() {

	$("#send").click(function() {
		$("input[type=checkbox][checked]").each(submit);
		setTimeout(error, 1000);
	});

	var submit = function() {
		$("#form").submit();
	}

	var error = function() {
		$(".error").show();
	}

	$(".category").click(function() {
		var check = $(this).children("input[type=checkbox]").attr('checked');
		$(this).children("input[type=checkbox]").attr('checked', !check);
	});

});
