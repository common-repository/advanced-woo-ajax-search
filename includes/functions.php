<?php
if (!function_exists('advanced_woo_product_title')) {
	function advanced_woo_product_title() {
		if(isset($_POST['searchKey'])) {

			//get product category
			$searchKey = sanitize_text_field( $_POST['searchKey'] );
		}
		global $wpdb;
		global $wp_query;
		$q = $wp_query->query_vars;
		$n = !empty($q['exact']) ? '' : '%';
		if(!empty($searchKey)) {

		$sql = $wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE {$wpdb->posts}.post_type = 'product'
			AND post_title LIKE %s", '%'. $wpdb->esc_like($searchKey) .'%');
		$myposts = $wpdb->get_results( $sql);

			//get permalinks in an array
			$permalinks = array();
			if($myposts) {
				foreach($myposts as $mypost) {
					$post_id = $mypost->ID;
					$permalink = get_permalink( $post_id );
					array_push($permalinks,$permalink);
				}
			}
		}else{
			$permalinks = array();
			$myposts = "";
		}
		echo json_encode( array( 'searchResult' => $myposts,'permalinks' => $permalinks ), JSON_PRETTY_PRINT );
		exit();	
	}

}
	
add_action('wp_ajax_awas_woo_search_product_title_action','advanced_woo_product_title');
add_action('wp_ajax_nopriv_awas_woo_search_product_title_action','advanced_woo_product_title');