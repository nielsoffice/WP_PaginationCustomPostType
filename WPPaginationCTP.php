<?php 

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 
  $args = [
	        'posts_per_page' => 12,
		    'post_type'      => 'blog',
            'paged'          => $paged,
	        'orderby'        => 'modified',
            'order'          => 'DESC',
	  
      ];

  $customPostQuery = new WP_Query($args);
   
   echo ('<div class="sb-row">');

   if($customPostQuery->have_posts() ): 
			
      while($customPostQuery->have_posts()) :
                   
	     $customPostQuery->the_post();
					   
		 global $post;  // BEGIN ?>

    <div class='oxy-post sb-col'>
    
     <?php  if (has_post_thumbnail()) { ?> <a href='<?php the_permalink(); ?>'><img src='<?php the_post_thumbnail_url(); ?>' class='oxy-post-image' /></a> <?php } ?>
	
	 <a class='oxy-post-title' href='<?php the_permalink(); ?>'><?php the_title(); ?></a>

	<div class='oxy-post-content'> <?php 
		
		$excerpt = get_the_excerpt(); 

        $excerpt = substr( $excerpt, 0, 197 ); // Only display first 260 characters of excerpt
        $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
        echo $result.'[...]';
		
		?> </div>

	  	<div class='oxy-post-meta'>

  		<div class='oxy-post-meta-date oxy-post-meta-item'> <?php the_time(get_option('date_format')); ?> </div>

		<div class='oxy-post-meta-author oxy-post-meta-item'> <?php the_author(); ?> </div>

    </div>
	
	<a href='<?php the_permalink(); ?>' class='oxy-read-more'>Read More</a>

    </div>

    <?php // END	

     endwhile; 
			
	 endif; 
	 
	 wp_reset_query();

     echo('</div>');

     function wp_pagination($pages = '', $range = 4)
     {
        
        $showitems = ($range * 2)+1;
        global $paged;

        if(empty($paged)) $paged = 1;
  
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        if(1 != $pages)
        {
            echo "<nav aria-label='Page navigation'>  <ul class='pagination'>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class=\"page-item active\"><a class='page-link'>".$i."</a></li>":"<li class='page-item'> <a href='".get_pagenum_link($i)."' class=\"page-link\">".$i."</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\">i class='flaticon flaticon-back'></i></a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'><i class='flaticon flaticon-arrow'></i></a></li>";
            echo "</ul></nav>\n";
        }
  }

  if (function_exists("wp_pagination")) { wp_pagination($customPostQuery->max_num_pages);  }

?>
