$(document).ready(function() {

	$('.content').hide();

	$('.head').click(function() {
		$(this).next().toggle();
		return false;
	}).next().hide();
});
