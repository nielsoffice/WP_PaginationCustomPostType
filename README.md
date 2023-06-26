# WP_PaginationCustomPostType
WP Page Pagination CustomPostType

```PHP

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 

$args  = array(
    'paged'          => $paged, 
    'posts_per_page' => 3 
);
		
  $wp_query = new WP_Query($args);

   if($wp_query->have_posts() ): 
			
      while($wp_query->have_posts()) :  $wp_query->the_post();
    				   
	      print(wp_strip_all_tags(get_the_title()) . "<br />"); 
        
      endwhile; 

   endif; 
	 
   wp_reset_query();

/* ------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'wp_pagination' ) ) :

    function wp_pagination( $paged = '', $max_page = '' ) {
        $big = 999999999; // need an unlikely integer
        if( ! $paged ) {
            $paged = get_query_var('paged');
        }

        if( ! $max_page ) {
            global $wp_query;
            $max_page = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
        }

        echo paginate_links( array(
            'base'       => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'     => '?paged=%#%',
            'current'    => max( 1, $paged ),
            'total'      => $max_page,
            'mid_size'   => 1,
            'prev_text'  => __( '«' ),
            'next_text'  => __( '»' ),
            'type'       => 'list'
        ) );
    }
 endif;
 
 wp_pagination( $paged, $sb_nl_query->max_num_pages);

```

<a href="https://njengah.com/wordpress-custom-post-type-pagination/#:~:text=Create%20WordPress%20Custom%20Post%20Pagination%20Function%201%20Call,Type%20Pagination%20Styles%20...%203%20Final%20Thoughts%20">Link Reference 1</a>
<br />
<a href="https://codex.wordpress.org/Pagination">Link Reference 2</a>
<br /><a href="https://wordpress.stackexchange.com/questions/154360/pagination-custom-query">Link Reference 3</a>
