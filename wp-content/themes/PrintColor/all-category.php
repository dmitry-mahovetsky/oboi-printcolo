<?php
/*
Template Name: all_category
*/
?>
<?php get_header(); ?>
<?php echo do_shortcode("[uptolike]"); ?>
<div class = "pw_content_wraper" id = "pw_galery">
    <?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
    <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
        <h1 class = "page_main_header"><?php the_title(); ?></h1>

        <div class="pw_main_pictures">
            <!-- galery begin -->
            <div class="product_box">
              <div class="all_category_box">

                <?php echo "<div class='mosaicflow grid'>"; ?>
                <?php 

                $args = array(
                  'parent' => 0,
                  'hide_empty' => 0,
                  'exclude' => '163,150,148,162,160,149,152,151,161,159,158', // ID рубрики, которую нужно исключить
                  'number' => '0',
                  'taxonomy' => 'category', // таксономия, для которой нужны изображения
                  'pad_counts' => true
                );
                $catlist = get_categories($args); // получаем список рубрик
                 
                foreach($catlist as $categories_item)
                  {
                  // получаем данные из плагина Taxonomy Images
                  $terms = apply_filters('taxonomy-images-get-terms', '', array(
                    'taxonomy' => 'category' // таксономия, для которой нужны изображения
                  ));
                  if (!empty($terms))
                    {
                    foreach((array)$terms as $term)
                      {
                      if ($term->term_id == $categories_item->term_id)
                        {
                        // выводим изображение рубрики
                          echo "<div class='mosaicflow__item product_item grid-item'><a href='" . esc_url(get_term_link($term, $term->taxonomy)) . "'><span>" . $categories_item->cat_name . "</span>";
                          echo''. wp_get_attachment_image($term->image_id, 'normal');
                          echo "</a></div>";
                        }
                      }
                    }
                  }
                 ?>
                <?php echo "</div>"; ?>
              </div>



              <div class="all_category_box">
                <h2 class="text-center">По типу помещения</h2>

                <?php echo "<div class='mosaicflow grid'>"; ?>
                <?php 

                $args = array(
                  'parent' => 0,
                  'hide_empty' => 0,
                  'include' => '163,150,148,162,160,149,152,151,161,159,158', // ID рубрики
                  'number' => '0',
                  'taxonomy' => 'category', // таксономия, для которой нужны изображения
                  'pad_counts' => true
                );
                $catlist = get_categories($args); // получаем список рубрик
                 
                foreach($catlist as $categories_item)
                  {
                  // получаем данные из плагина Taxonomy Images
                  $terms = apply_filters('taxonomy-images-get-terms', '', array(
                    'taxonomy' => 'category' // таксономия, для которой нужны изображения
                  ));
                  if (!empty($terms))
                    {
                    foreach((array)$terms as $term)
                      {
                      if ($term->term_id == $categories_item->term_id)
                        {
                        // выводим изображение рубрики
                          echo "<div class='mosaicflow__item product_item grid-item'><a href='" . esc_url(get_term_link($term, $term->taxonomy)) . "'><span>" . $categories_item->cat_name . "</span>";
                          echo''. wp_get_attachment_image($term->image_id, 'normal');
                          echo "</a></div>";
                        }
                      }
                    }
                  }
                 ?>
                <?php echo "</div>"; ?>
              </div>


            </div>
            <!-- galery end -->
        </div>
<!-- text for page -->
      <div class="text_for_page">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
</div>
<?php get_footer(); ?>