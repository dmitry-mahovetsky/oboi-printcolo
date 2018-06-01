<?php get_header(); ?>

<div class = "pw_content_wraper" id = "pw_galery">
	<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
	<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		<?php
			$imgid='';
			$custom_fields = get_post_custom();
			$my_custom_field2 = $custom_fields['номер картинки ID'];
			$iNumber = count($my_custom_field2);
			if ( $iNumber > 0 ) {
			foreach ( $my_custom_field2 as $key => $value )
			$imgid = $value;}
		?>
		<h1>Фотообои: <?php the_title(); ?> &#8470; <?php echo $imgid; ?></h1>

		<div itemscope itemtype="http://schema.org/Product" id="pw_main_pictures">
            <span itemprop="name" class="hidden">Oboi-Printcolor</span>
			<form itemprop="review" itemscope itemtype="http://schema.org/Review" id="order_page" method="post" class="order_page" onsubmit="ga('send', 'event', 'Zakaz', 'Submit'); yaCounter31728511.reachGoal('order_button');">
				<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
				<div class="row">
				  <div class="col-md-7">
					<div class="prod_img_holder">
                        <div class="rowBreakCheck">
                            <label for="showBreakLine">
                                <input id="showBreakLine" type="checkbox" class="key">
                                <span class="psevdoCheckbox"></span>
                                <span class="text">Показать деление на полосы</span>
                            </label>
                        </div>
					  <div class="main-image">
						<div id="image_cutter" class="image_cutter">
						  <div class="main-image-holder">
							<div class="texture-box"> </div>
							  <?php echo'<img id = "selected-image" src = "'.get_post_image().'" title = "'.get_the_title().'" alt = "Фотообои '.get_the_title().' '.$file_description.'"/>' ?>
							  <input type="hidden" value="<?php echo $imgid; ?>" id="imgid"  name="imgid"/>
							  <input type="hidden" value="<?php echo get_the_title(); ?>" id="imgtitle"  name="imgtitle"/>
							  <input type="hidden" value="<?php echo get_post_image(); ?>" id="selimg"  name="selimg"/>
							  <input type="hidden" value="100 | 100 | 100 | 100" id="crop_dimentions" name="crop_dimentions">
							</div>
						  </div>
					  </div>
					  <div class="img_options">
						<ul>
                            <li class="img_options__item"><input id="mirror_opt" name="mirror" value="mirror_yes" class="img_opt" type="checkbox"><label
                                        for="mirror_opt">Отзеркалить</label></li>
                            <li class="img_options__item"><input id="bw_opt" name="bw" value="bw_yes" class="img_opt" type="checkbox"
                                       name="color_opt"><label for="bw_opt">Черно-белое</label></li>
                            <li class="img_options__item"><input id="sepia_opt" name="sepia" value="sepia_yes" class="img_opt" type="checkbox"
                                       name="color_opt"><label for="sepia_opt">Сепия</label></li>
                            <li class="img_options__item--btn">
                                <div id="resetFilter" class="img_options--btn">Сбросить фильтры</div>
                            </li>
                        </ul>
					  </div>
					</div>
				  </div>

				  <div class="col-md-5 wp_options">


                      <div class="sizeCard">
                          <h4>1. Введите размер фотообоев</h4>
                          <div class="row sizeCard__row">
                              <div class="col-md-5 text-center">
                                  <label for="img_height">Высота (см)</label>
                                  <input id="itemH" type="text" value="" name="itemH" autocomplete="off" class="item_size">
                                  <input type="hidden" class="max-size-height">
                              </div>
                              <div class="col-md-5 text-center">
                                  <label for="img_width">Ширина (см)</label>
                                  <input id="itemW" type="text" value="" name="itemW" autocomplete="off" class="item_size">
                                  <input type="hidden" class="max-size-width">
                              </div>
                          </div>
                      </div>


                      <?php

                      $argus = array(
                          'taxonomy' => 'exchange_rate',
                          'hide_empty' => false,
                          'orderby' => 'modified'
                      );
                      $course = 1;
                      $termse = get_terms($argus);
                      $counte = count($termse);

                      if ( $counte > 0 ){
                          foreach ( $termse as $term ) {
                              $result = get_term_meta($term->term_id, 'checkbox_field_id');
                              if ($result[0] == 'on') {
                                  $text = get_term_meta($term->term_id, 'text_field_id');
                                  $course = $text[0];
                              }
                          }
                      }

                      if (preg_match('/\,/i', $course)) {
                          $course = preg_replace('/\,/',  '.', $course);
                      }

                      $args = array(
                          'taxonomy' => 'type_wallpaper_tax',
                          'hide_empty' => false,
                          'orderby' => 'modified'
                      );
                      $terms = get_terms( $args );
                      ?>

                      <div class="typeCard">
                          <h4>2. ТИП ФОТООБОЕВ</h4>
                          <div class="fieldGroup">
                              <?php $a = 0; foreach ($terms as $item => $value): ?>
                                  <label for="def-<?php echo $value->term_id; ?>">
                                      <input type="radio" name="type"
                                             id="def-<?php echo $value->term_id; ?>"
                                             data-type="<?php echo $value->name; ?>"
                                             value="<?php echo tax_value($value->term_id) * $course ?>"
                                             <?php echo ($a == 1 ? 'checked' : ''); ?>>
                                      <span class="psevdoCircle" data-index="<?php echo $a ?>"></span>
                                      <span><?php echo $value->name; ?></span>
                                  </label>
                              <?php $a++; endforeach; ?>
                          </div>
                      </div>

                      <div class="materialCard">
                          <h4>3. ВЫБЕРИТЕ МАТЕРИАЛЫ</h4>
                          <div class="fieldGroup">
                              <div id="selector" class="materialSelector selectZ">
                                  <select name="" id="">
                                      <?php
                                      $arg = array(
                                          'taxonomy' => 'red_book_tax',
                                          'hide_empty' => false,
                                          'orderby' => 'modified'
                                      );
                                      $terms = get_terms($arg);
                                      $array = array();
                                      $count = count($terms);
                                      if ( $count > 0 ){
                                          $b = 0;
                                          foreach ( $terms as $term ) {

                                              //использовался специальный плагин для метополей таксономики
//                                              https://github.com/bainternet/Tax-Meta-Class

                                              $width = get_term_meta($term->term_id,'width_field_id');
                                              $price = get_term_meta($term->term_id,'text_field_id');
                                              $img = get_term_meta($term->term_id,'image_field_id');
                                              if($term->parent == 0){
                                                  //выводим родителей текстур, материалы
                                                  echo <<<HTML
                                              <option 
                                              data-id="{$term->term_id}"
                                             data-price="{$price[0]}"
                                              data-width="{$width[0]}">{$term->name}</option>
HTML;
                                              } else {



                                                  //создаем массив текстур, наследники от материалов
                                                  $array[$b] = array(
                                                      'parent' => $term->parent,
                                                      'name' => $term->name,
                                                      'price' => $price[0],
                                                      'img' => $img[0]
                                                  );
                                                  $b++;
                                              }
                                          }
                                      } else {
                                          echo <<<HTML
                                              <option 
                                              data-price="0" 
                                              data-id="0"
                                              data-width="0">Данных нет</option>
HTML;
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="texturaCard">
                          <h4>4. Выберите текстуру</h4>
                          <div class="fieldGroup">
                              <div id="selector2" class="texturaSelector selectZ">
                                  <select name="" id=""></select>
                              </div>
                          </div>
                      </div>

                      <div class="resultCard">
                          <h4>Ваш заказ</h4>
                          <div class="row">
                              <div class="col allSize">
                                  <div class="name">Площадь</div>
                                  <span><psevdo id="area_of_square"></psevdo> м<sup>2</sup></span>
                              </div>
                              <div class="col countAll">
                                  <div class="name">Количество полос</div>
                                  <span id="number_of_rolls"></span>
                              </div>
                              <div class="col allPrice">
                                  <div class="name">Стоимость</div>
                                  <div  class="resultPrice"></div>
                              </div>
                          </div>
                      </div>
				  </div>
				</div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="rowWarning">
                            Цвета на мониторе отличаються от цветопередачи печати для точного совпадения цветов
                            заказывайте цветопробу!
                        </div>
                    </div>
                </div>

				<div class="row">
				  <div class="col-sm-12">
					<div class="form-horizontal">
					  <h4 class='text-center'>3. Оформите заказ</h4>

<!--                        площадь-->
                        <input id="areaInp" type="hidden" name="area">

<!--                        цена-->
                        <input id="price" type="hidden" name="price">

<!--                        материал-->
                        <input id="material" type="hidden" name="material">

<!--                        текстура-->
                        <input id="vinil_type" type="hidden" name="vinil_type">

<!--                        тип фотообоев-->
                        <input id="typePhoto" type="hidden" name="typePhoto">

<!--                        количество рулонов-->
                        <input id="numberWallpapers" type="hidden" name="numberWallpapers">

					  <div class="col-md-6">
						<div class="form-group">
						  <label for="user_name" class="col-sm-4 control-label">Имя:</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="user_name" placeholder="Обязательное поле" required="required" name="user_name">
						  </div>
						</div>
						<div class="form-group">
						  <label for="user_phone" class="col-sm-4 control-label">Телефон:</label>
						  <div class="col-sm-8">
							<input type="tel" class="form-control" id="user_phone" placeholder="Обязательное поле" required="required" name="user_phone">
						  </div>
						</div>
<!-- 						<div class="form-group">
						  <label for="user_city" class="col-sm-4 control-label">Город:</label>
						  <div class="col-sm-8">
							<input type="text" class="form-control" id="user_city" placeholder="Ваш город" name="user_city">
						  </div>
						</div> -->
						<div class="form-group">
						  <label for="user_mail" class="col-sm-4 control-label">Email:</label>
						  <div class="col-sm-8">
							<input type="email" class="form-control" id="user_mail" placeholder="Email" name="user_mail">
						  </div>
						</div>
					  </div>
					  <div class="col-md-6">
						<div class="form-group">
						  <label for="user_mail" class="col-sm-4 control-label">Комментарий:</label>
						  <div class="col-sm-8">
							<textarea id="comments" class="form-control" rows="8" placeholder="" name="user_comments"></textarea>
						  </div>
						</div>
						<div class="form-group">
						  <div class="col-sm-12">
							<button type="submit" class="button" id="order_button">Отправить</button>
						  </div>
						</div>
					</div>
				  </div>
				</div>


				<?php endwhile; ?>
				<?php else : ?>
				<?php endif; ?>

                    <span itemprop="name" class="hidden">Printcolor</span>
                    <span itemprop="author" class="hidden">Oboi-Printcolor</span>
                    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="hidden">
                        <span itemprop="ratingValue">5</span>
                        <span itemprop="bestRating">5</span>
                    </div>

			</form>


		</div>
	</div>
</div>
</div>


<?php echo do_shortcode("[uptolike]"); ?>


    <script>
        //обьект текстур
        $typeWallpaper = <?php echo json_encode( $array );?>;

    </script>
<?php get_footer(); ?>