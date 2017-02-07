                   <!-- ads -->
                   <div class="main__blocks">
                    <div class="row between">
	                  <?php
                      $query = new WP_Query('cat=83&showposts=6');
                      if( $query->have_posts() ){
                      while( $query->have_posts() ){ $query->the_post();
                      ?>
                      <div class="main__blocks__item">
                        <a class="main__blocks__item__link" href="<?php echo excerpt(25); ?>" target='_blank'>
                          <?php the_post_thumbnail(
	                	    'add_thumb',
	                	     array('class' => 'main__blocks__item__img')
	                      ); ?>
                          <?php the_title();?></a>
                      </div>
                      <?php
                      }
                      wp_reset_postdata();
                      } 
                     else echo 'Записей нет.';
                     ?>
                    </div>
                  </div>