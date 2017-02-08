      <!-- head -->
      <header class="header">
        <div class="header__top"></div>
        <div class="header__bottom header__bottom_soft">
          <div class="container">
            <div class="row">
              <div class="header__bottom__left-col static">
                <div class="header__bottom__logo">
                  <a class="header-logo" href="http://www.crimeabusiness.ru/">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/background/logo.jpg" alt="" />
                  </a>
                </div>
              </div>
              <div class="header__bottom__right-col auto__width">
                <div class="row end">
                  <div class="header__bottom__sing-in">
	                <?php if (is_user_logged_in()) { ?>
	                    <a class="button button_white" href="<?php echo wp_logout_url( home_url() ); ?>">Выход</a>
						<?php } else { ?>            	
						<a class="button button_white" href="#" data-remodal-target="enter">Вход</a>
					<?php } ?>
                  </div>
                </div>
                <div class="row between header__bottom__row center">
                  <div class="header__bottom__main-menu">
                    <button class="toggle-menu jsMobileDropdown sandwitch">
                      <div class="sandwitch">
                        <span class="sw-topper"></span>
                        <span class="sw-bottom"></span>
                        <span class="sw-footer"></span>
                      </div>
                    </button>
					<?php clean_custom_menu("top");?>
                  </div>
                  <div class="header__bottom__search">
                    <div class="header-search">
                      <button class="header-search__icon" data-remodal-target="modal1"></button>
                      <div class="modal modal_90" data-remodal-id="modal1">
                        <div class="modal-wrapper">
                          <div class="modal__content">
                            <div class="header-search__form">
                               <?php include 'searchform.php';?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>