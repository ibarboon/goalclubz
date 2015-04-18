$(function(){
	var elementForm = 'form :text, select, button';
	if ($('form').length > 0) {
		var formAction = $('form').attr('action');
		if (formAction.indexOf('do_update') > 0) {
			$(elementForm).prop('disabled', true);
		} else {
			$('.btn-group').hide();
		}
	}
	
	$('.btn-edit, .btn-cancel').on('click', function(){
		var propValue = ($(this).text() == 'Cancel')? true: false;
		$(elementForm).prop('disabled', propValue);
	});
	
	$('#input-match-date').datepicker({
		dateFormat: 'yy-mm-dd'
	});
	
	$('[name=radio-team]').change(function(){
		var radioValue = $(this).val();
		$('[name=select-player-id] option').hide();
		$(radioValue).show();
	});
});