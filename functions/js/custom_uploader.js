jQuery(function($) {
	var uploadInput = null;
	var customUploader = wp.media.frames.file_frame = wp.media({
		title: 'Choose Image',
		button: {
			text: 'Choose Image'
		},
		multiple: false
	});
	
	customUploader.on('select', function() {
		var attachment = customUploader.state().get('selection').first().toJSON();
		uploadInput.val(attachment.url);
	});
	
	$('.upload_image_button').on('click', function(e) {
		e.preventDefault();
		
		uploadInput = $(this).parent().parent().find('input.upload_input');
		customUploader.open();
	});
});