<form id="search_form" method="get" action="<?php echo home_url( '/' ); ?>">
 
 <input type="text" class="search-field"
 placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
 value="<?php echo get_search_query() ?>" name="s"
 title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
 </label>
 <input class="search-submit" type="submit" value="search">
 

</form>