<?php if (is_category(array('Новости'))) : ?>
    <?php include(TEMPLATEPATH . '/category-news.php'); ?>
<?php else : ?>

    <?php
    $str = get_field("img_cat", get_category($cat));
    $category = get_the_category();

    if (is_category()) {
        $this_category = get_category($cat);
        if ($this_category->category_parent) {
            $this_category = wp_list_categories('orderby=name&show_count=0&title_li=&use_desc_for_title=0&child_of=' . $this_category->category_parent . "&echo=0");
        } else {
            $this_category = wp_list_categories('orderby=name&depth=1&show_count=0&title_li=&use_desc_for_title=0&child_of=' . $this_category->cat_ID . "&echo=0");
        }
    } elseif (is_single()) {
        if ($category[0]->category_parent) {
            $this_category = wp_list_categories('orderby=name&show_count=0&title_li=&use_desc_for_title=0&child_of=' . $category[0]->category_parent . "&echo=0");
        } else {
            $this_category = wp_list_categories('orderby=name&show_count=0&title_li=&use_desc_for_title=0&child_of=' . $category[0]->cat_ID . "&echo=0");
        }
    }

    global $query_string;

    query_posts($query_string . '&orderby=rand');

    $args = array('show_all' => False, // показаны все страницы участвующие в пагинации
        'end_size' => 2,     // количество страниц на концах
        'mid_size' => 1,     // количество страниц вокруг текущей
        'prev_next' => True,  // выводить ли боковые ссылки "предыдуща¤/следующа¤ страница".
        'prev_text' => __('&laquo;'), 'next_text' => __('&raquo;'), 'add_args' => False, 'add_fragment' => '',     // текст который добавитьс¤ ко всем ссылкам.
        'screen_reader_text' => __('Навигация по Галерее'),);

    $category_description = category_description();
    ?>

    <?php get_header(); ?>
    <div class="pw_content_wraper" id="pw_galery">
        <?php if (file_exists(TEMPLATEPATH . '/sidebar-left.php')) : ?>
            <?php require(TEMPLATEPATH . '/sidebar-left.php'); ?>
        <?php endif ?>
        <div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
            <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            <h1>Фотообои: <?php single_cat_title(); ?></h1>
            <!-- add description for category -->
            <?php if (!empty($str)) : ?>
                <?php if (file_exists(TEMPLATEPATH . '/templates/text_for_category.php')) : ?>
                    <?php require(TEMPLATEPATH . '/templates/text_for_category.php'); ?>
                <?php endif ?>
            <?php endif ?>
            <!-- end description -->
            <div class="sec_cat_holder">
                <ul>
                    <?php echo $this_category; ?>
                </ul>
            </div>


            <div id="pw_main_pictures">
                <!-- galery begin -->
                <div  class="product_box mosaicflow grid">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : ?>
                            <?php the_post(); ?>
                            <div class="product_item mosaicflow__item grid-item" id="post-<?php the_ID(); ?>">
                                <?php
                                $custom_fields = get_post_custom();
                                $numid = $custom_fields['номер картинки ID'];
                                $iNumber = count($numid);

                                if ($iNumber > 0) {
                                    foreach ($numid as $key => $file_description) {
                                        $discript = $file_description;
                                    }
                                }

                                $aPics = $custom_fields['фото_для_карточки'];
                                $iNumber2 = count($aPics);

                                if ($iNumber2 > 0) : ?>
                                    <?php foreach ($aPics as $key => $value) : ?>
                                        <a class="product_img" data-lightbox="example-set"
                                           data-title="<?php echo get_the_title(); ?>"
                                           href="<?php echo get_post_image() ?>"
                                           data-sLink="<?php echo get_permalink() ?>">
                                            <img src="<?php echo $value; ?>"
                                                 alt="фотообои <?php echo get_the_title() . ' ' . $file_description; ?>">
                                        </a>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <a class="product_img" data-lightbox="example-set"
                                       data-title="<?php echo get_the_title() ?>" href="<?php echo get_post_image() ?>"
                                       data-sLink="<?php echo get_permalink() ?>">
                                        <img src="<?php echo get_post_image() ?>"
                                             alt="фотообои <?php echo get_the_title() . ' ' . $file_description ?>">
                                    </a>
                                <?php endif ?>
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
                                            <div class="product_numb"><?php echo $file_description; ?></div>
                                        </div>
                                        <div class="col-xs-8 text-right">
                                            <a class="readMore order_button" href="<?php the_permalink(); ?>"
                                               onclick="ga('send', 'event', 'UznatCenu', 'Click'); yaCounter31728511.reachGoal('uznat_cenu');">
                                                Узнать цену
                                            </a>
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
                    <?php the_posts_pagination($args);
                    wp_reset_postdata(); ?>
                </div>
            </nav>
            <!-- end paginations -->
            <!-- begin category descr -->
            <?php if (!empty($category_description)) : ?>
                <div class="category_descr_holder">
                    <?php echo $category_description; ?>
                </div>
            <?php endif ?>
            <!-- end descr -->
        </div>
    </div>

    <?php get_footer(); ?>
<?php endif ?>