$(document).ready(function(){
	$('.btn-add-attribute').click(function() {
		$('.attributes-form').removeClass('hidden');
		$(".attributes-form-block.hidden").clone(true).removeClass('hidden').appendTo(".attributes-form");
	});
});