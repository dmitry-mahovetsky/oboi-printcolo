<?php get_header(); ?>

<div class = "pw_content_wraper" id = "pw_galery">
  <?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
  <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>

    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

    <h1><?php the_title(); ?></h1>
        <div id="pw_main_pictures">
          <!-- galery begin -->
          <div class="product_box mosaicflow">
            <?php if(have_posts()) :?>
            <?php while(have_posts()) : the_post();?>
            <div class = "product_item mosaicflow__item" id="post-<?php the_ID(); ?>">
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
                                  <a class="product_img" data-lightbox="example-set" data-title="'.get_the_title().'" href="'.get_post_image().'">
                                    <img src="'.$value.'" alt="фотообои '.get_the_title().' '.$file_description.'" />
                                  </a>';
                            } else {
                                echo '
                                  <a class="product_img" data-lightbox="example-set" data-title="'.get_the_title().'" href="'.get_post_image().'">
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
                                      <a class="readMore order_button" href="<?php  the_permalink(); ?>" onclick="ga('send', 'event', 'UznatCenu', 'Click')">Узнать цену</a>
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
    <!-- begin category descr -->
        <?php
          $category_description = category_description();
          if ( ! empty( $category_description ) )
            echo '<div class="category_descr_holder">' . $category_description . '</div>';
        ?>
    <!-- end descr -->
  </div>
</div>
<?php echo do_shortcode("[uptolike]"); ?>
<?php get_footer(); ?>
<?php } ?>