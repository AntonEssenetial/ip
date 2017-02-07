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
                <span class="gallery__title"><?php single_cat_title();?></span>
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