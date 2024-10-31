(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	
	$(document).ready(function() {
		var getPostID = $('#post_ID').val();

		$('#shortcode_portfolio_to_copy').html('[portfolio_awesome id="'+getPostID+'"]');

		$('li a[href*="post-new.php?post_type=portfolio-awesome"]').css('display', 'none');

		var setWidthContent = $('[name="carbon_fields_compact_input[_portfolio_awesome_single_width]"]').val();
		if(setWidthContent === '') {
			$('[name="carbon_fields_compact_input[_portfolio_awesome_single_width]"]').attr("value", "1200");
		}
	});

	if ($('.select-image-layout').length) {
		$('input:radio[name="carbon_fields_compact_input[_portfolio_awesome_showcase_style_main]"]').change(
	    function(){
	        if ($(this).is(':checked')) {
	            alert($(this).val());
	        }
	    });
	}

})( jQuery );
