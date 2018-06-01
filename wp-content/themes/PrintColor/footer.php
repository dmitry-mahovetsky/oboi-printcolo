			<footer>
				<div class="bg_holder_top">
					<div class="row_top">
						<div class="col-xs-offset-4 col-sm-offset-2 col-sm-4">
							<div class="bot_menu_holder">
								<?php wp_nav_menu( array('theme_location' => 'pw_footer_menu','menu'=>'Нижнее меню','container_class'=>'menu-menyu-podvala-container') ); ?>
							</div>
						</div>
						<div class="col-xs-offset-4  col-sm-offset-2 col-sm-4">
							<div class="contacts_holder">
								<ul>
									<li><a href="mailto:printcolor45@gmail.com"><i class="fa fa-envelope"></i>printcolor45@gmail.com</a></li>
									<li><a href="tel:+380957140305"><i class="fa fa-phone"></i>+380957140305</a></li>
									<li><a href="tel:+380984259984"><i class="fa fa-phone"></i>+380984259984</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="bg_holder_bottom">
					<div class="row_bottom">
						<div class="col-xs-offset-4 col-sm-offset-2 col-sm-4">
							<div class="copy_block">
                                <?php dynamic_sidebar( 'copy-side' ); ?>
							</div>
						</div>
						<div class="col-xs-offset-4 col-sm-offset-2 col-sm-4">
							<div class="soc_bottom_block">
								<ul>
									<li>
										<a href="https://www.facebook.com/oboi.printcolor/" rel="nofollow" target="_blank" class='fa-stack'>
											<i class="fa fa-facebook fa-stack-1x"></i>
											<i class="fa fa-2x fa-circle-thin fa-stack-2x"></i>
										</a>
									</li>
									<li>
										<a href="skype:printcolor45gmail.com?chat" class='fa-stack'>
											<i class="fa fa-skype fa-stack-1x"></i>
											<i class="fa fa-2x fa-circle-thin fa-stack-2x"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>





				<!-- meta begin -->
				<link itemprop="url" href="https://oboi-printcolor.com">
					<meta itemprop="name"
						content="PrintColor">
					<meta itemprop="telephone"
						content="+38 (095) 714-03-05">
					<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" >
						<meta itemprop="addressLocality"
							content="Харьков">
						<meta itemprop="streetAddress"
							content="ул. Пушкинская, 45">
					</span>
				<img class="disable" src="<?php echo get_template_directory_uri(); ?>/image/logo.png" id="_image2" itemprop="logo" alt="PrintColor"/>
				<!-- meta end -->
			</footer>
		</div>


<a href="#header" class="scroll_top" title="Наверх"><i class="fa fa-arrow-up"></i></a>
<div class="popup_parent">
	<div class="popup_window">
	  <div class="popup_close"><i class="fa fa-close"></i></div>
	  <h3 class="textform text-center">Спасибо, Ваша заявка принята!</h3>
	</div>
	<img src="<?php echo get_template_directory_uri(); ?>/img/preloader.gif" alt="" id="preload">
</div>

<div class="popup_parent_call_back">
	<div class="popup_window_call_back">
		<div class="popup_close_call_back"><i class="fa fa-close"></i></div>
		<h3 class="textform text-center">Введите свой номер телефона</h3>
		<form method="post" action="" id="call_back" onsubmit="ga('send', 'event', 'ObratZvonok', 'Submit'); yaCounter31728511.reachGoal('call_back');">
		  <input placeholder="Ваш номер" required="required" name="phone" type="tel" id="call_back_input">
		  <button type="submit" name="call_back">Отправить</button>
		</form>
	</div>
</div>


    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.mosaicflow.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/crop/jquery.waitforimages.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/crop/jquery.imgareaselect.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/crop/general.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/price.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.maskedinput-1.2.2.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ajax.js"></script>
            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/favourites.js"></script>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.css"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.js"></script>

            <!--            добавил-->
            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/init.js"></script>
            <!--            добавил-->

            <script src="<?php echo get_template_directory_uri(); ?>/rating_jquery/js/jquery.raty.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/rating_jquery/js/raty.js"></script>

            </div>
            <script>
                window.wp_user_id = {"ajax_user":"<?php echo ip(); ?>"};
            </script>
	</body>
	<?php wp_footer();?>
</html>