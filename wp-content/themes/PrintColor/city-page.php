<?php
/*
Template Name: city-page
*/

$args = array(
    'parent' => 0,
    'hide_empty' => 0,
    'exclude' => '163,150,148,162,160,149,152,151,161,159,158', // ID рубрики, которую нужно исключить
    'number' => '0',
    'taxonomy' => 'category', // таксономия, для которой нужны изображения
    'pad_counts' => true
);
$catlist1 = get_categories($args); // получаем список рубрик

unset($args['exclude']);
$args['include'] = '163,150,148,162,160,149,152,151,161,159,158';
$catlist2 = get_categories($args); // получаем список рубрик

$terms = apply_filters('taxonomy-images-get-terms', '', array(
    'taxonomy' => 'category' // таксономия, для которой нужны изображения
)); // получаем данные из плагина Taxonomy Images

if (empty($terms)) {
    $terms = array();
}
?>
<?php get_header(); ?>
<div class = "pw_content_wraper" id = "pw_galery">
<?php if (file_exists(TEMPLATEPATH . '/sidebar-left.php')) {
    require(TEMPLATEPATH . '/sidebar-left.php');
} ?>
    <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
        <h1 class = "page_main_header"><?php the_title(); ?></h1>
        <noindex>
            <div class="pw_main_pictures">
                <!-- galery begin -->
                <div class="product_box">
                    <div class="all_category_box">
                        <div class='mosaicflow grid'>
                        <?php foreach ($catlist1 as $categories_item) : ?>
                        <?php foreach ($terms as $term) : ?>
                        <?php if ($term->term_id == $categories_item->term_id) :  // выводим изображение рубрики ?>
                            <div class="mosaicflow__item product_item grid-item"><a href="<?= esc_url(get_term_link($term, $term->taxonomy)) ?>" nofollow><span><?= $categories_item->cat_name ?></span>
                            <?= wp_get_attachment_image($term->image_id, 'normal') ?>
                            </a></div>
                        <?php endif ?>
                        <?php endforeach ?>
                        <?php endforeach ?>
                        </div>
                    </div>
                    <div class="all_category_box">
                        <h2 class="text-center">По типу помещения</h2>
                        <div class='mosaicflow grid'>
                        <?php foreach ($catlist2 as $categories_item) : ?>
                        <?php foreach ($terms as $term) : ?>
                        <?php if ($term->term_id == $categories_item->term_id) :  // выводим изображение рубрики ?>
                            <div class="mosaicflow__item product_item grid-item"><a href="<?= esc_url(get_term_link($term, $term->taxonomy)) ?>" nofollow><span><?= $categories_item->cat_name ?></span>
                            <?= wp_get_attachment_image($term->image_id, 'normal') ?>
                            </a></div>
                        <?php endif ?>
                        <?php endforeach ?>
                        <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <!-- galery end -->
            </div>
        </noindex>
<!-- text for page -->
        <div class="text_for_page">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile ?>
        <?php endif ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
