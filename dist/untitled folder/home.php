<?php get_header();?>
  <body class="page">
    <div class="page__wrapper">
      <?php include 'head.php';?>
      <section class="page__main">
        <div class="main">
          <div class="main-top-wrapper">
            <div class="main__top">
              <div class="container">
	            <?php
                $query = new WP_Query('cat=-83&showposts=1');
                $category = get_the_category();
                if( $query->have_posts() ){
                while( $query->have_posts() ){ $query->the_post();
                ?>
				<div class="row main__top__row">
                  <div class="main__top__left ta-center">
                    <span class="main__top__subtitle"><?php echo get_post_meta($post->ID, 'Subtitle', 'value');
 ?></span>
                    <h1 class="main__top__title"><?php the_title();?></h1>
                    <span class="main__top__date"><?php the_time('F j');?> </span>
                    <p class="main__top__excerpt"><?php echo excerpt(25); ?></p>
                    <a class="button button_transparent" href="<?php the_permalink();?>">Узнать больше</a>
                  </div>
                  <div class="main__top__right auto__width between row">
	                <?php the_post_thumbnail(
		                'top_thumb',
		                array('class' => 'main__top__img'
		                ));?>
                    <div class='main__top__category-title-wrapper'>
	                  <h2 class="main__top__category-title"><?php echo $category[0]->cat_name;?></h2>
                    </div>
                  </div>
                </div>
                <?php
                }
                wp_reset_postdata();
                } 
                else echo ' Записей нет.';
                ?>
              </div>
            </div>
          </div>
          <div class="main-item-wrapper">
            <div class="main__item">
              <div class="container">
                <div class="main__item__content" id="Новости">
	              <h2 class="main__item__category-titl">Новости</h2>
	              <?php
                  $query = new WP_Query('cat=47&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
                <div class="main__item__content" id="Мероприятия">
                  <h2 class="main__item__category-titl">Мероприятия</h2>
	              <?php
                  $query = new WP_Query('cat=51&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
                <div class="main__item__content" id="Правоваяинформация">
                  <h2 class="main__item__category-titl">Правовая информация</h2>
	              <?php
                  $query = new WP_Query('cat=53&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
                <div class="main__item__content" id="ОбАссоциации">
                  <h2 class="main__item__category-titl">Об Ассоциации</h2>
	              <?php
                  $query = new WP_Query('cat=57&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
                <div class="main__item__content" id="Медиа">
                  <h2 class="main__item__category-titl">Медиа</h2>
	              <?php
                  $query = new WP_Query('cat=69&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
				<div class="main__item__content" id="Сервисы">
                  <h2 class="main__item__category-titl">Сервисы</h2>
	              <?php
                  $query = new WP_Query('cat=72&showposts=4&offset=1');
                  if( $query->have_posts() ){
                  while( $query->have_posts() ){ $query->the_post();
                  ?>
                  <div class="main__item__single row">
                    <div class="main__item__left static col_margin">
	                  <?php the_post_thumbnail(
	                	'main_thumb',
	                	array('class' => 'main__item__img')
	                  ); ?>
                    </div>
                    <div class="main__item__right auto__width">
                      <div class="row center">
                        <span class="main__item__icon"></span>
                        <?php foreach((get_the_category()) as $category) {?>
	                      <a class="main__item__category" href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                            <?
                          }  ?>
                      </div>
                      <h2>
                        <a class="main__item__title" href="<?php the_permalink();?>"><?php the_title();?></a>
                      </h2>
                      <span class="main__item__excerpt"><?php echo excerpt(25); ?></span>
                      <a
                        class="main__item__more" href="<?php the_permalink();?>">подробнее</a>
                    </div>
                  </div>
                  <?php
                  }
                  wp_reset_postdata();
                  } 
                  else echo 'Записей нет.';
                  ?>
                </div>
				  <?php include 'adds.php';?>
              </div>
            </div>
          </div>
          <div class="main__dots row column">
            <a class="main__dots__link" href="#Новости">
              <span class="main__dots__span">Новости</span>
            </a>
            <a class="main__dots__link" href="#Мероприятия">
              <span class="main__dots__span">Мероприятия</span>
            </a>
            <a class="main__dots__link" href="#Правоваяинформация">
              <span class="main__dots__span">Правовая информация</span>
            </a>
            <a class="main__dots__link" href="#ОбАссоциации">
              <span class="main__dots__span">Об Ассоциации</span>
            </a>
            <a class="main__dots__link" href="#Медиа">
              <span class="main__dots__span">Медиа</span>
            </a>
            <a class="main__dots__link" href="#Сервисы">
              <span class="main__dots__span">Сервисы</span>
            </a>
          </div>
        </div>
      </section>
      <?php get_footer();?>