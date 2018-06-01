<?php get_header(); ?>

        <div class = "pw_content_wraper" id = "pw_galery">
          <?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
          <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

              <?php 
              // Получим ID категории
              $category_id = get_cat_ID( 'Новости' );
              $cat = array($category_id);
              $showposts = 0; // -1 shows all posts
              $do_not_show_stickies = 1; // 0 to show stickies
              $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1; // определяем текущую страницу блога
              $posts_per_page = 0;
              $args=array(
                 'category__in' => $cat,
                 'showposts' => $showposts,
                 'caller_get_posts' => $do_not_show_stickies,
                 'posts_per_page' => $posts_per_page, // значение по умолчанию берётся из настроек, но вы можете использовать и собственное
                 'paged' => $current_page // текущая страница
                 );
              $my_query = new WP_Query($args); 
              ?>

              <h1 class="page_main_header">Новости</h1>
              <div class="news_holder">
                <?php if ($my_query->have_posts()) : ?>
                <?php  while($my_query->have_posts()) : $my_query->the_post();?>
                <?php 
                  //necessary to show the tags 
                  global $wp_query;
                  $wp_query->in_the_loop = true;
                ?>
                <div class="news_item_holder">
                  <div class="col-sm-5 col-md-4">
                    <div class="news_img_prev">
                      <?php if ( has_post_thumbnail()) { ?>
                        <?php  the_post_thumbnail('thumbnail'); ?>
                        <?php  } else{ echo '<img src="'.get_post_image().'" />';} ?>
                    </div>
                  </div>
                  <div class="col-sm-7 col-md-8">
                    <div class="news_text">
                      <h3><?php the_title();?></h3>
                      <?php echo "<p>".mb_substr( strip_tags( get_the_excerpt() ), 0, 150 ); echo "..." ?>
                      <div class="col-md-12 text-right">
                        <span><?php the_time('d.m.Y'); ?></span>
                      </div>
                      <div class="col-md-12">
                        <a href="<?php the_permalink();?>" class="button pull-right">Читать</a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endwhile;?>
                <?php endif;?>
              </div>

              <!-- navigation begin -->
              <div class="pagination_holder text-center">
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
              <!-- navigation end -->
            </div>


  </div>
</div>

<?php get_footer(); ?>