<?php /* Template name: contacts.php */ ?>
<?php get_header(); ?>
  <body class="page">
    <div class="page__wrapper">
      <?php include 'head.php';?>
      <section class="page__contacts">
        <div class="contacts">
          <div class="contacts-wrapper">
            <div class="container">
              <div class="contacts__title">Обратная связь</div>
              <div class="contacts__content">
                <?php
                if (have_posts()):
                   while (have_posts()):
                       the_post();
                       the_content();
                   endwhile;
                   endif;
                ?> 
              </div>
              <div class="contacts__form">
	            <?php echo do_shortcode( '[contact-form-7 id="197" title="Контактная форма 1"]' ); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php get_footer();?>