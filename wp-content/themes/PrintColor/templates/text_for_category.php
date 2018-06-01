<?php
$variable = single_cat_title('', false);
$arg = array('taxonomy' => 'category', 'hide_empty' => false, 'name__like' => $variable, 'orderby' => 'modified');
$terms = get_terms($arg);
$count = count($terms);

$a = 0;

?>

<div class="page_description">
    <div class="top_image_holder">
        <div class="rowAboutCategory">
            <?php
            foreach ($terms as $term):

                $url = get_term_meta($term->term_id, 'text_field_id');
                $textarea = get_term_meta($term->term_id, 'textarea_field_id');

                if ($url[0] !== null || $textarea[0] !== null):
                    echo <<<HTML
                        <div class="col-left">
                            <p class="text">
                            {$textarea[0]}
                            </p>
                        </div>
                        <div class="col-right">
                            <div class="videoRecall data-fancybox"
                               href="{$url[0]}"
                               data-rel="media">
                                <img src="/wp-content/themes/PrintColor/img/youtubeVideo.png" alt="">
                            </div>
                        </div>
HTML;
                    $a++;
                endif;
            endforeach;
            if($a < 1):
                if ($img_cat = get_field("img_cat", get_category($cat))):
                    echo <<<HTML
                                <img class="cat_image" src="{$img_cat}"/>
HTML;
                endif;
            endif;
            ?>
        </div>
    </div>
</div>