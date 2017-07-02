<?php
class Su_Admin_Views {
	function __construct() {}

	public static function examples( $field, $config ) {
		$output = array();
		$examples = Su_Data::examples();
		$preview = '<div style="display:none"><div id="su-examples-window"><div id="su-examples-preview"></div></div></div>';
		$open = ( isset( $_GET['example'] ) ) ? sanitize_text_field( $_GET['example'] ) : '';
		$open = '<input id="su_open_example" type="hidden" name="su_open_example" value="' . $open . '" />';
		foreach ( $examples as $group ) {
			$items = array();
			if ( isset( $group['items'] ) ) foreach ( $group['items'] as $item ) {
					$code = ( isset( $item['code'] ) ) ? $item['code'] : plugins_url( 'inc/examples/' . $item['id'] . '.example', SU_PLUGIN_FILE );
					$id = ( isset( $item['id'] ) ) ? $item['id'] : '';
					$items[] = '<div class="su-examples-item" data-code="' . $code . '" data-id="' . $id . '" data-mfp-src="#su-examples-window" style="visibility:hidden"><i class="fa fa-' . $item['icon'] . '"></i> ' . $item['name'] . '</div>';
				}
			$output[] = '<div class="su-examples-group su-clearfix"><h2 class="su-examples-group-title" style="visibility:hidden">' . $group['title'] . '</h2>' . implode( '', $items ) . '</div>';
		}
		su_query_asset( 'css', array( 'magnific-popup', 'animate', 'font-awesome', 'su-options-page' ) );
		su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'su-options-page' ) );
		return '<div id="su-examples-screen">' . implode( '', $output ) . '</div>' . $preview . $open;
	}

}
