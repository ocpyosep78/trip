$(document).ready(function () {
	// search
	$('#form-header').submit(function(e){
		e.preventDefault();
		
		// redirect
		var namelike = Func.GetName($('#form-header [name="namelike"]').val());
		window.location = web.base + 'search/' + namelike;
	});

	// datepicker
	if ($('.datepicker').length > 0) {
		// jquery ui
		// $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
		
		// bootsrap
		$('.datepicker').datepicker({ format: 'dd-mm-yyyy' });
	}

	// language
	$('.change-language').click(function() {
		Func.ajax({
			url: web.base + 'service/setting',
			param: { action: 'change_language', code: $(this).data('code') },
			callback: function(result) {
				window.location = window.location.href;
			}
		});
	});
});