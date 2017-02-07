 <?php
  $post = $wp_query->post;
 
  if (in_category('video')) { //slug  категории
      include(TEMPLATEPATH.'/content-video.php');
  } else {
	  include(TEMPLATEPATH.'/single-default.php');
  }
?>