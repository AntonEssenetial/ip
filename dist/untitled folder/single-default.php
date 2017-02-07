<?php get_header();?>
  <body class="page">
    <div class="page__wrapper">
      <?php include 'head.php';?>
      <section class="page__single">
        <div class="single">
          <div class="single-wrapper">
            <div class="container">
              <div class="single__article">
                <div class="row single__article__top between">
                  <?php the_category(); ?>
                  <span class="single__article__top__date row center"><?php the_time('j F'); ?> / <?php the_time('Y'); ?></span>
                </div>
                <div class="row center-c">
                  <h1 class="single__article__title"><?php the_title();?></h1>
                </div>
                <?php the_post_thumbnail(
	                	'large',
	                	array('class' => 'single__article__img')
	                ); ?>
                <div class="single__article__content row between">
                  <div class="single__article__right col_margin"></div>
                  <div class="single__article__left">
                    <div class="single__article__left__content">
                      <?php 
				        if(have_posts()){
					    while(have_posts()){
						  the_post();
						  the_content();
					      }   
				        }  
			            ?>      
			        <div class='share'>
	                    <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter,linkedin"></div>
                    </div>
			        </div>
                    <div class="single__article__left__tags row">
                      <span class="single__article__tag">Тэги:</span>
                      <?php the_tags('','');?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="single__more">
            <div class="container">
              <div class="row center-c">
                <span class="single__more__title">Самое читаемое</span>
              </div>
              <div class="f__row wrap">
	            <?php
                $posts = wp_most_popular_get_popular( array( 'limit' => 4, 'post_type' => 'post', 'range' => 'all_time' ) );
                global $post;
                if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
                ?><div class="category__item f__col">
                  <a class="category__item__link">
	                <?php the_post_thumbnail(
	                  'thumbnail',
	                  array('class' => 'category__item__img')
	                ); ?>
                  </a>
                  <a class="category__item__title" href="<? the_permalink();?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
                  <span class="category__item__date"><?php the_time('j F'); ?> / <?php the_time('Y'); ?></span>
                </div>
                <?php
                endforeach; endif;
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php get_footer();?>