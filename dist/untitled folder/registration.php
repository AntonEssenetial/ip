        <!-- registarion -->
        <div class="registration">
          <div class="registeration-popup">
            <div class="modal register__modal-wrapper" data-remodal-id="enter">
              <button class="button_close" data-remodal-action="close"></button>
              <div class="modal-wrapper">
                <div class="modal__content">
                  <div class="registration-popup-wrapper">
                    <img class="registration-popup_img" src="<?php bloginfo('template_url'); ?>/assets/images/background/logo.png" alt="" />
                    <h2 class="registration-popup_title">ПРАВАВАЯ ИНФОРМАЦИЯ
                      <br> У ВАС ПОД РУКОЙ</h2>
                    <span class="registration-popup_span">Введите данные</span>
                    <form id="login" class="ajax-auth" action="login" method="post">
						<p class="status"></p>  
						<?php wp_nonce_field('ajax-login-nonce', 'security'); ?>  
						<label for="username" class="reg__form">
							<input id="username" type="text" class="required form__input form__input_popup icon-1" name="username" placeholder="Имя">
						</label>
						<label for="password" class="reg__form">
							<input id="password" type="password" class="required form__input form__input_popup icon-2" name="password" placeholder="******">
							<!-- <a class="text-link" href="<?php echo wp_lostpassword_url(); ?>">Lost password?</a> -->
						</label>
							<input class="button button_popup" type="submit" value="Воийти">
						<div class='row between'>
							<a id="pop_signup" class='no' href="">Регистрация</a>
							<button class="no" data-remodal-action="close">Нет спасибо</button>
						</div>
					</form>

					<form id="register" class="ajax-auth"  action="register" method="post" style="display: none;">
						<p class="status"></p>
						<?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>         
						<label for="signonname" class="reg__form">
							<input id="signonname" type="text" name="signonname" class="required form__input form__input_popup icon-0"  placeholder="Имя">
						</label>
						<label for="email" class="reg__form">
							<input id="email" type="text" class="required email form__input form__input_popup icon-1" name="email"  placeholder="E-mail">
						</label>
						<label for="signonpassword" class="reg__form">
							<input id="signonpassword" type="password" class="required form__input form__input_popup icon-2" name="signonpassword"  placeholder="*******" >
						</label>
						<input class="submit_button button button_popup" type="submit" value="Подтвредить">
						<div class='row between'>
							<a id="pop_login" class='no'  href="">Войти</a>
							<button class="no" data-remodal-action="close">Нет спасибо</button>
						</div>
					</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
