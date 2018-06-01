<?php get_header(); ?>

<div class = "pw_content_wraper" id = "pw_galery">
  <?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
  <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

    <h1 class="page_title text-center">
      Поиск: <?php $allsearch = &new WP_Query("s=$s"); 
      $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e(''); 
      echo $key; _e(''); ?>
    </h1>



        <div id="pw_main_pictures">
          <!-- galery begin -->
          <div class="product_box mosaicflow grid">
            <?php if (have_posts()) : ?>
            <?php $myquery = new WP_Query($s); while (have_posts()) : the_post(); include('templates/search-lop.php'); endwhile; //wp_reset_query(); ?>

          <!-- galery end -->
          </div>
          </div>

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
              ?>
            </div>
          </nav>
          <!-- конец поиск по имени -->


          <!-- поиск по цвету включающий свою собственную пагинацию -->
          <?php
          else :
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          //$page_offset=($paged-1)*3;
          //$argscol = array('paged' =>$paged,'offset' => $_GET['offset']);
          $argscol = array(
            'meta_query' => array(
              'relation' => 'OR',
              array(
                'key' => 'Основной цвет',
                'value' => $s,
                'compare' => 'LIKE'
              )
            ),'category__not_in' => array(1,20),'post_type' => 'post','paged' => $paged,'offset' => $_GET['offset']
          );
          $myquery = new WP_Query($argscol);
          query_posts($argscol);

          if(have_posts()) : while(have_posts()) : the_post(); include('templates/search-lop.php'); endwhile;  //$post = $temp_post;?>


  </div>
</div>
    <!-- begin paginations -->
        <nav class="text-center">
          <div class="pagination">
            <nav class="navigation pagination">
              <div class="nav-links">
                <?php
                //wp_reset_postdata();
                // echo 'found_posts='.$myquery->found_posts.'</br>';
                // echo 'post_count='.$myquery->post_count.'</br>';
                // echo 'max_num_pages='.$myquery->max_num_pages.'</br>';
                $perpag=ceil($myquery->found_posts/$myquery->max_num_pages);
                $countpag=$myquery->max_num_pages;
                for($i=1;$i<$countpag+1;$i++){
                 if(((($i-1)*$perpag)==(int)$_GET['offset'])||(($i==1)&&$_GET['offset']=='')){
                   echo '<span class="page-numbers current">'.$i.'</span>';
                    }else{ 
                    echo '<a class="page-numbers" href="/?&s='.$s.'&offset='.(($i-1)*$perpag).'">'.$i.'</a>';
                 }
                }
                echo "</div></div>";
                 else: ?>
                <div class = "not_found">По Вашему запросу ничего не найдено. Попробуйте переформулировать запрос и повторить поиск.</div>
            </div>
        </div>
                <?php
                  endif;
                  endif;
                  //wp_reset_query();
                ?>

              </div>
            </nav>
          </div>
        </nav>
    <!-- end paginations -->



<?php get_footer(); ?>