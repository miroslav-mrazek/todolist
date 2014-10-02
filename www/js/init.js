$(function () {
	$.nette.init();
	$.nette.ext('history').cache = false;
});

//this jQuery code for AJAX
$(document).on('click', '.ajax:not(form)', function(e) {
	e.preventDefault();
	$.get($(this).attr('href'));
});