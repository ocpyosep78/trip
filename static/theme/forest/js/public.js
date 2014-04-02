// search
$('#form-header').submit(function(e){
	e.preventDefault();
	window.location = web.base + 'search';
});

// datepicker
if ($('.datepicker').length > 0) {
	$('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
}