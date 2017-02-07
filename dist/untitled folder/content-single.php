<?php
	if(in_category('video')){
        get_template_part('content','category-video.php');
    }else{
        get_template_part('content','single.php');
    }
?>