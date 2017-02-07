<?
	
/*
	// Remove category from url
	add_filter('category_link', create_function('$a', 'return str_replace("category/", "", $a);'), 9999);
*/


	// Register menu
	register_nav_menus(array(
		'top' => 'top_menu',
		'bottom' => 'bottom_menu',
	));
	
	
	// THumbs
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1190, 644, true );
	}
	
	
	// Sidebars
	if (function_exists('register_sidebars')) 
		register_sidebar( array('name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<p class="widgettitle">',
	'after_title'   => '</p>' ));
	
	
	// Excerpt length
	wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
	function new_excerpt_length($length) {
		return 30;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	function new_excerpt_more($more) {
		return '...';
	}
	
	
	// add custom class to tag
	function add_class_the_tags($html){
    	$postid = get_the_ID();
		$html = str_replace('<a','<a class="single__article__link"',$html);
		return $html;
	}
	add_filter('the_tags','add_class_the_tags');
	
	
	// add custom class to category link
	function add_class_the_category($html){
    	$postid = get_the_ID();
		$html = str_replace('<a','<a class="single__article__top__link"',$html);
		return $html;
	}
	add_filter('the_category','add_class_the_category');
	
	
	// Excerpt custom
	function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }
	
	
	// Sidedbar
	if (function_exists('register_sidebars')) 
		register_sidebar( array('name' => 'Top 5 постов',
		'before_widget' => '',
	    'after_widget'  => '',
	    'before_title'  => '',
	    'after_title'   => '' 
	));
	
	
	// Sidebar
	if (function_exists('register_sidebars')) 
		register_sidebar( array('name' => 'Самое читаемое',
		'before_widget' => '',
	    'after_widget'  => '',
	    'before_title'  => '',
	    'after_title'   => '' 
	));
	
	
	// Thumbs custom size
	add_image_size( 'top_thumb', 690, 553, true);
	add_image_size( 'main_thumb', 690, 389, true);
	add_image_size( 'add_thumb', 190, 190, true);
	
	
	// Shortcode youtube
	function youtube_shortcode($atts) {
    ob_start();
    ?>
        <div id="video" class='container__video'>
            <div class="videoWrapper">
                <iframe src="https://www.youtube.com/embed/<?php echo $atts['src']; ?>" frameborder="0" allowfullscreen>
                </iframe>
            </div>
        </div>
    <?php
    return ob_get_clean();
	}
	add_shortcode('youtube', 'youtube_shortcode');
	


	// Intented to use with locations, like 'primary'
	// clean_custom_menu("primary");
 
	#add in your theme functions.php file
 
	function clean_custom_menu( $theme_location ) {
    	if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        	$menu = get_term( $locations[$theme_location], 'nav_menu' );
			$menu_items = wp_get_nav_menu_items($menu->term_id);
 
			$menu_list  = '<nav class="main-menu">' ."\n";
			$menu_list .= '<ul class="row between">' ."\n";
 
			$count = 0;
			$submenu = false;
			$counter = 0;
         
			foreach( $menu_items as $menu_item ) {
             
            	$link = $menu_item->url;
				$title = $menu_item->title;
             
				if ( !$menu_item->menu_item_parent ) {
	            	$counter++;
					$parent_id = $menu_item->ID;
                 
					$menu_list .= '<li class="main-menu__item">' ."\n";
					$menu_list .= '<a data-remodal-target="'.$counter.'" href="'.$link.'" class="title main-menu__link">'.$title.'</a>' ."\n";

            	}

 
				if ( $parent_id == $menu_item->menu_item_parent ) {
 
                	if ( !$submenu ) {
                    	$submenu = true;
						$menu_list .= '<ul class="main-menu__sub-menu animated fadeIn">
                    	<div class="modal main-menu__modal-wrapper" data-remodal-id="'.$counter.'">
                    		<button class="button_close" data-remodal-action="close"></button>
							<div class="modal-wrapper">
                              <div class="modal__content">
                                <ul class="main-menu__sub-menu animated fadeIn">' ."\n";
                	}
 
					$menu_list .= '<li class="main-menu__sub-menu__item">' ."\n";
					$menu_list .= '<a href="'.$link.'" class="main-menu__sub-menu__link">'.$title.'</a>' ."\n";
					$menu_list .= '</li>' ."\n";
                     
 
					if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                	    $menu_list .= '</ul></div></div></div></ul>' ."\n";
                	    $submenu = false;
                	}
 
            	}
 
				if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                	$menu_list .= '</li>' ."\n";      
					$submenu = false;
            	}
 
				$count++;
        	}
         
			$menu_list .= '</ul>' ."\n";
			$menu_list .= '</nav>' ."\n";
 
    	} else {
        	$menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    	}
		echo $menu_list;
	}

	
	// Custom gallery hoock
	add_filter('post_gallery', 'dco_post_gallery', 10, 3);

	function dco_post_gallery($output, $attr, $instance) {
    	$_attachments = get_posts(array('include' => $attr['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $attr['order'], 'orderby' => $attr['orderby']));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
        $attachments[$val->ID] = $_attachments[$key];
    }

    if (empty($attachments)) {
        return '';
    }

    ob_start();
    foreach ($attachments as $id => $attachment) :
        $full = wp_get_attachment_image_url($id, 'large');
        $thumbnail = wp_get_attachment_image_url($id, 'thumbnail');
        $alt = $attachment->post_excerpt;
        ?>
        <a class="gallery__item f__col" href="<?php echo $full; ?>">
            <img src="<?php echo $thumbnail; ?>" class="gallery__item__img" alt="<?php echo esc_attr($alt); ?>" />
        </a>
        <?php
    endforeach;
    return ob_get_clean();
	}
	
?>