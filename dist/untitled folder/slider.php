              <!-- slider -->
              <div class="slick__slider">
                <?php /*
                $posts = wp_most_popular_get_popular( array( 'limit' => 5, 'post_type' => 'post', 'range' => 'all_time' ) );
                global $post;
                if ( count( $posts ) > 0 ): foreach ( $posts as $post ):
                setup_postdata( $post );
                ?>
                <div class="slide">
                  <div class="container">
                    <a class="category__slider__title" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" href="<?php the_permalink();?>">
                      <h1><?php the_title();?></h1>
                    </a>
                    <div class="category__slider__date row wrap"><?php the_category(); ?> / <?php the_time('F Y'); ?></div>
                  </div>
                </div>
                <?php
                endforeach; endif;
                */ ?> 
                <?php /* dynamic_sidebar('Самое читаемое'); */?>
                <?php dynamic_sidebar('Топ 5 постов'); ?>
              </div>