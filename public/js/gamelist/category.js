$(document).ready(function() {

	$("#send").click(function() {
		$("input[type=checkbox][checked]").each(submit);
		setTimeout(error, 1000);
	});

	var submit = function() {
		$("#form").submit();
	}

	var error = function() {
		$("#error").text('Bitte wähle mindestens eine Kategorie aus');
	}
});
