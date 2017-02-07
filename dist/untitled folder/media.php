<?php /* Template name: media.php */ ?>
<?php get_header();?>
 <body class="page">
    <div class="page__wrapper">
      <?php include 'head.php';?>
      <section class="page__gallery">
        <div class="gallery">
          <div class="gallery-wrapper">
            <div class="container">
              <div class="row center-c">
                <span class="gallery__title">Галерея</span>
              </div>
              <div class="gallery__items f__row">
 <?php
                            if (have_posts()):
                            while (have_posts()):
                                the_post();
                                the_content();
                            endwhile;
                            endif;
                        	?>              
              </div>
            </div>
          </div>
        </div>
      </section>
<?php get_footer();?>