<?php get_header();?>
<body class="page">
    <div class="page__wrapper">
      <?php include 'head.php';?>
      <section class="page__category">
        <div class="category">
          <div class="category-slider-wrapper">
            <div class="category__slider">
              <div class="container">
                <span class="category__slider__top">ТОП 5 НОВОСТей</span>
              </div>
              <?php include 'slider.php';?>
            </div>
          </div>
          <div class="category-item-wrapper">
            <div class="container">
	          <div class="row center-c">
                <span class="gallery__title">Результаты поиска</span>
              </div>
	          <div class='search__content'>
		          <?php /* Search Count */ 
		          $allsearch = &new WP_Query("s=$s&showposts=-1"); 
		          $key = wp_specialchars($s, 1); 
		          $count = $allsearch->post_count; _e(''); 
		          echo "По запросу" . ' ';
		          _e('<b class="search-terms">'); 
		          echo $key; _e('"</b>'); 
		          _e(' найдено ');
		          echo $count . ' '; 
		          _e(''); wp_reset_query(); 
		          ?>
	          </div>
              <div class="f__row wrap">
	            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="category__item f__col">
                  <a class="category__item__link" href="<?php the_permalink();?>">
	                <?php the_post_thumbnail(
	                  'thumbnail',
	                  array('class' => 'category__item__img')
	                ); ?>
                  </a>
                  <a class="category__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                  <span class="category__item__date"><?php the_time('F j');?> / <?php the_time('Y');?></span>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php get_footer();?>