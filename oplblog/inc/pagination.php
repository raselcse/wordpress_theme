<?php 
// Numbered Pagination

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('Previous'),
    'next_text'       => __('Next'),
    'type'            => 'array',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if( is_array( $paginate_links ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<div class="table-pagination-lower"><nav class="pagination-primary"><span class="pager-left disabled"></span><ul class="pages">';
        foreach ( $paginate_links as $page ) {
                echo "<li>$page</li>";
        }
       echo '</ul></div>';
        }

}

// function opl_pagination() {

// global $wp_query;

// $big = 999999999; // need an unlikely integer

// $pages = paginate_links( array(
        // 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        // 'format' => '?paged=%#%',
        // 'current' => max( 1, get_query_var('paged') ),
        // 'total' => $wp_query->max_num_pages,
        // 'type'  => 'array',
		// 'prev_text'       => __('Previous'),
		// 'next_text'       => __('Next'),
		// 'add_args'        => false,
		// 'add_fragment'    => ''
    // ) );
    // if( is_array( $pages ) ) {
        // $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        // echo '<div class="table-pagination-lower"><nav class="pagination-primary"><span class="pager-left disabled"></span><ul class="pages">';
        // foreach ( $pages as $page ) {
                // echo "<li>$page</li>";
        // }
       // echo '</ul></div>';
        // }
// }
?>