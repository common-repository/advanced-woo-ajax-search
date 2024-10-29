(function( $ ) {
	'use strict';

	 (function ($) {
		'use strict';
	
		/* get all searched product title */
		$(document).on('keyup', '#live_ajaxsearch_title_input_id', function () {
			var searchKey = $(this).val();
	
			//set searchKey send to ajax method
			var searchInfo = {
				action: 'awas_woo_search_product_title_action',
				searchKey: searchKey,
			};
			var $data = $(this).closest('.live-ajax-woo-search-widget').find('#live_ajaxsearch_title_sec');
	
			//Search Data Pass on Ajax Title Filter
			$.post(awas_woo_current_wp_home_url.ajax_url, searchInfo, function (msg) {
				var searchedResult = msg.searchResult; //search result
				var searchedItemParmalinks = msg.permalinks; // search items permalinks
				// get DOM node to be parent of child list nodes
				$data.empty();
				//when search result is not empty
				if (searchedResult !== '') {
					var output = '';
					var item_permalink = '';
					var count = 0;
					searchedResult.forEach(function (item) {
						item_permalink = searchedItemParmalinks[count];
						output += '<li><a href="' + item_permalink + '"  class="live_ajax_woo_search">' + item.post_title + '</a></li>';
						$data.html(output);
						count++;
					});
				}
			}, 'json');
		});
	
	})(jQuery);

})( jQuery );
