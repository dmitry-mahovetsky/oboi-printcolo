<?php get_header(); ?>
<div class = "pw_content_wraper" id = "pw_galery">
	<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
	<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
    <?php if(is_front_page() && !is_paged()) : ?>
        <?php if ( function_exists('meteor_slideshow') ) { meteor_slideshow(); } ?>
		<div class="box_icon_set">
			<a href="<?= get_site_url() ?>/dostavka" class="col-sm-4 text-center">Доставка по всей Украине</a>
			<a href="<?= get_site_url() ?>/ekspress-zakaz-fotooboev" class="col-sm-4 text-center">Печать за 24 часа</a>
			<a href="<?= get_site_url() ?>/vizualizatsiya" class="col-sm-4 text-center">Бесплатная визуализация</a>
		</div>
    <?php endif ?>
		<h1>Фотообои на заказ</h1>

        <div class="pw_main_pictures">
			<!-- galery begin -->
			<div  class="product_box mosaicflow grid">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts( array('category__not_in' => array(1,115),'post_type' => 'post','paged' => $paged) );
				?>
				<?php if(have_posts()) :?>
				<?php while(have_posts()) : the_post();?>
				<div class = "product_item mosaicflow__item grid-item" id="post-<?php the_ID(); ?>">
					<?php
						$custom_fields = get_post_custom();
						$numid = $custom_fields['номер картинки ID'];
						$iNumber = count($numid);
					if ( $iNumber > 0 ) {
						foreach ( $numid as $key => $file_description )
							$discript = $file_description;
					}
						$aPics = $custom_fields['фото_для_карточки'];
						$iNumber2 = count($aPics);
						if ( $iNumber2 > 0 ) {
						foreach ( $aPics as $key => $value )
                            echo '
                              <a class="product_img" data-lightbox="example-set" data-title="'.get_the_title().'" href="'.get_post_image().'" data-sLink="'.get_permalink().'">
                                <img src="'.$value.'" alt="фотообои '.get_the_title().' '.$file_description.'" />
                              </a>';
                        } else { 
                            echo '
                              <a class="product_img" data-lightbox="example-set" data-title="'.get_the_title().'" href="'.get_post_image().'" data-sLink="'.get_permalink().'">
                                <img src="'.get_post_image().'" alt="фотообои '.get_the_title().' '.$file_description.'" />
                              </a>';
                        }
                        ?>
                              <div class="product_text_info">
                                  <div class="name">
                                      <h4 class="product_title text-center">
                                          <?php trim_title_chars(33, '...'); ?>
                                      </h4>
                                      <div class="like">
                                          <a>
											<span class="infoCardThe">
												Добавить <br> в избранное
											</span>
                                              <i class="fa fa-heart" aria-hidden="true"></i>
                                          </a>
                                      </div>
                                  </div>
                                  <div class="row">
                              	<div class="col-xs-4">
									<?php echo '<div class="product_numb">'.$file_description.'</div>';?>
                              	</div>
                              	<div class="col-xs-8 text-right">
                              		<a class="readMore order_button"
                                       href="<?php  the_permalink(); ?>"
                                       onclick="ga('send', 'event', 'UznatCenu', 'Click');
                                       yaCounter31728511.reachGoal('uznat_cenu');">
                                        Узнать цену</a>
                              	</div>
                              	</div>
                              </div>
				</div>
				<?php endwhile; //wp_reset_postdata(); wp_reset_query();?>
				<?php else : ?>
				<?php endif; ?>
			</div>
			<!-- galery end -->
        </div>

		<!-- begin paginations -->
          <nav class="text-center">
            <div class="pagination">
              <?php
                $args = array(
                  'show_all'     => False, // показаны все страницы участвующие в пагинации
                  'end_size'     => 2,     // количество страниц на концах
                  'mid_size'     => 1,     // количество страниц вокруг текущей
                  'prev_next'    => True,  // выводить ли боковые ссылки "предыдуща¤/следующа¤ страница".
                  'prev_text'    => __('&laquo;'),
                  'next_text'    => __('&raquo;'),
                  'add_args'     => False,
                  'add_fragment' => '',     // текст который добавитьс¤ ко всем ссылкам.
                  'screen_reader_text' => __( 'Навигация по Галерее' ),
                );
              the_posts_pagination($args);
              wp_reset_postdata(); 
              ?>
            </div>
          </nav>
		<!-- end paginations -->
<!-- text for page -->
          <div class="text_for_page">
            <p>Помните, насколько модно было клеить фотообои в гостиную в 60-70-х годах прошлого века? Сложно найти квартиру, которую обошел подобный дизайнерский изыск. Однако тогда они не получили должную популярность из-за шаблонности изображений, тусклых красок и ненадежности материала.
            Сегодня вы можете заказать обои с индивидуальным рисунком, который не выцветет с годами и будет продолжать радовать глаз своими сочными оттенками.
            <h2 style="text-align: center;">Преимущества заказа фотообоев</h2>
            <p>Только представьте на минутку, какие огромные возможности открывают для каждого из нас современные обои. Если оформить заказ на печать изображения продукции компании, можно стильно украсить зал заседаний, моментально получив расположение потенциальных партнеров. Это же относится и к ресторанам, кафе, барам. Разместив на стене тематическую картинку, вы гарантируете своему заведению индивидуальность и привлекательность. Уникальность по-особенному ценится среди клиентов.
            Нетрадиционные фотообои под заказ могут также стать чудным украшением и домашнего интерьера. Природа, моря и острова, привычные глазу со времен старых советских квартир, будут выглядеть совершенно иначе, если их выполнить по индивидуальному макету из ваших собственных фотографий. Приятные воспоминания о счастливых моментах – это же так здорово!
            При заказе фотообоев с индивидуальным рисунком, вы получаете неоспоримые преимущества:
            <ul>
              <li>абсолютно оригинальный дизайн стен;</li>
              <li>возможность визуально расширить пространство в маленькой комнате;</li>
              <li>качественное, яркое, экологически чистое полотно;</li>
              <li>привлекательный интерьер и уют в доме.</li>
            </ul>
            <p>Фотообои на заказ подходят для оформления любого интерьера. Обозначьте необходимый размер при покупке, и они станут чудным украшением как для небольшой квартиры в старой хрущевке, так и для величественного помещения в сталинке.
            Не будем таить, такие обои имеют один существенный недостаток – цена. Однако подобная стоимость совершенно себя оправдывает. Высококлассная краска и современные технологии нанесения изображения на полотно позволяют получить действительно хорошую, долговечную и надежную продукцию.
            <h2 style="text-align: center;">Избавьтесь от привычных штампов с уникальными фотообоями</h2>
            <p>Фотообои, созданные под заказ, могут обеспечить комфорт и уют в доме на долгие года. И вы в силах создать привлекательную обстановку, самостоятельно подобрав рисунок, цвет, текстуру. Все остальное компания PrintColor берет на себя.
            Мы готовы создать оригинальные обои по вашим макетам или макетам наших дизайнеров. Компания гарантирует 100% качество материала, на который будет нанесен рисунок, его полную экологичность и соответствие всем нормам безопасности.
            Уменьшить или увеличить помещение, изящно скрыть с глаз дефект на стене, оформить дверь шкафа купе, наполнить дом комфортом и душой – со всем этим легко справляются обои, выполненные на заказ.
            Свяжитесь с нами, чтобы узнать более детальную информацию. Мы всегда рады новым клиентам и постоянным покупателям.
          </div>

        <!-- begin comments -->
          <div class="last_comments_holder">
              <h2 class="uppercase text-center">Отзывы</h2>
              <div id="carousel-comments" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                      <div class="img_holder text-center">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/comm_1.png" width="125" height="125" alt="">
                      </div>
                    <div class="carousel-caption">
                      <span class="author_name">Михаил</span>
                      <p>Спасибо большое за фотообои. Мы с женой долго выбирали рисунок, определялись с текстурой и , честно говоря, морочили голову ребятам-дизайнерам.Спасибо отдельное им за их выдержку:))) После поклейки фотообоев квартира преобразилась. СУПЕР !!!</p>
                    </div>
                  </div>

                  <div class="item">
                      <div class="img_holder text-center">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/comm_2.png" width="125" height="125" alt="">
                      </div>
                    <div class="carousel-caption">
                      <span class="author_name">Алина</span>
                      <p>Отличные фотообои, качество супер! Клеятся быстро и без проблем (главное внимательно читать инструкцию). Теперь у меня не кухня а солнечная Греция!)). Спасибо компании за работу, помогли с изображением, дали ответ на все волнующие меня вопросы, все отлично. Спасибо!</p>
                    </div>
                  </div>

                  <div class="item">
                      <div class="img_holder text-center">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/comm_3.png" width="125" height="125" alt="">
                      </div>
                    <div class="carousel-caption">
                      <span class="author_name">Максим</span>
                      <p>На днях забрал обои, спасибо большое за работу! Отдельное спасибо менеджеру (имя не припомню) было очень приятно работать, все рассказали, показали и быстро выполнили заказ.</p>
                    </div>
                  </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-comments" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-comments" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <a href="<?php echo get_site_url() ?>/otzyivyi-nashih-klientov" class="button">Все отзывы</a>
          </div>
        <!-- end comments -->

        <!-- begin our sites -->
      <!--   <div class="site_holder">
            <div class="col-xs-12 text-center">
                <h2 class="uppercase">Наши сайты</h2>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="text-center title_site">Кухонные фартуки скинали</div>
                    <div class="wrap_site">
                        <a class="uppercase" href="http://skinali-printcolor.com" rel="noindex, nofollow" target="_blank">Перейти на сайт</a>
                        <div class="img_wrap">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/skinali_site.png" height="220" width="475" alt="skinali PrintColor">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="text-center title_site">Интерьерные наклейки</div>
                    <div class="wrap_site">
                        <a class="uppercase" href="http://www.stickers-printcolor.com" rel="noindex, nofollow" target="_blank">Перейти на сайт</a>
                        <div class="img_wrap">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/stickers_site.png" height="220" width="475" alt="stickers PrintColor">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- end sites -->
	</div>
</div>
<?php echo do_shortcode("[uptolike]"); ?>
<?php get_footer(); ?>