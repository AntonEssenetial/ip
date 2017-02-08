    <!-- footer -->
      <footer class="footer">
        <div class="footer__top">
          <div class="container">
            <div class="row">
              <div class="footer__top__left static col_margin">
                <img src="<?php bloginfo('template_url'); ?>/assets/images/background/ipad.png" alt="" />
              </div>
              <div class="footer__top__right width__auto stc-subscribe-wrapper well">
                <span class="footer__subscribe">ПОДПИСКА НА НОВОСТНУЮ РАССЫЛКУ</span>
				<?php dynamic_sidebar('Sidebar'); ?>
                
                <span class="footer__top__right__span">Подпишитесь прямо сейчас и получите: актуальную информацию о специальных акциях и предложениях, самые свежие новости о правовой информации, а также о ближайших мероприятиях.</span>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__menu">
          <div class="container">
	          <div class="footer-nav">
	        	<?php wp_nav_menu( array( 
		        	'menu' => 'footer-nav-menu' , 
		        	'container' => 'false' , 
		        	'menu_class' => 'footer-nav-menu' 
		        ) ); ?>
            </div>
          </div>
        </div>
        <div class="footer__bottom">
          <div class="container">
            <div class="row">
              <div class="footer__bottom__left col__60">
                <div class="row center">
	              <?php if (is_user_logged_in()) { ?>
	                    <a class="footer__bottom__link" href="<?php echo wp_logout_url( home_url() ); ?>">Выход</a>
						<?php } else { ?>            	
						<a class="footer__bottom__link" href="#" data-remodal-target="enter">Вход</a>
					<?php } ?>
                  <a class="footer__bottom__link" href="/obratnaya-svyaz/">Обратная связь</a>
                  <div class="footer__bottom__link">Горячая линия
                    <span>8 (800) 800 00 00</span>
                  </div>
                </div>
                <div class="footer__copy">©2017 Все права защищены.
                  <br> Любое копирование информации, автором которой является APRKC.UA , без указания источника и автора запрещено! Копирование дизайна, скриптов, любого оформление влечет за собой нарушение авторских прав.</div>
              </div>
              <div class="footer__bottom__right col__40 row column">
                <div class="row end footer__bottom__soc">
                  <a class="footer__bottom__soc-link vk" target='_blank' href="https://vk.com/crimeabusiness_ru"></a>
                  <a class="footer__bottom__soc-link fb" target='_blank' href="https://www.facebook.com/crimeabusiness.ru/"></a>
                  <a class="footer__bottom__soc-link tw" target='_blank' href="https://twitter.com/CrimeaBusiness"></a>
                </div>
                <span>Разработано командой
                  <a class="footer__bottom__link" href="http://new-level.by/">NEW LEVEL</a>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="footer__up">
          <a class="footer__up__link" href="">
            <img src="<?php bloginfo('template_url'); ?>/assets/images/background/up.png" alt="" />
          </a>
        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>
    <?php include 'registration.php';?>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/plugins.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/assets/js/main.js"></script>
  </body>
</html>