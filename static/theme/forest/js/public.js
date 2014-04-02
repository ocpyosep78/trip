// search
$('#form-header').submit(function(e){
	e.preventDefault();
	window.location = web.base + 'search';
});

// datepicker
$(document).ready(function () {
	if ($('.datepicker').length > 0) {
		// jquery ui
		// $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
		
		// bootsrap
		$('.datepicker').datepicker({ format: 'dd-mm-yyyy' });
	}
});