<div class="product_item mosaicflow__item" id="post-<?php the_ID(); ?>">
    <?php
    $custom_fields = get_post_custom();
    $numid = $custom_fields['номер картинки ID'];
    $iNumber = count($numid);
    if ($iNumber > 0) {
        foreach ($numid as $key => $file_description) $discript = $file_description;
    }
    $aPics = $custom_fields['фото_для_карточки'];
    $iNumber2 = count($aPics);
    if ($iNumber2 > 0) {
        foreach ($aPics as $key => $value) echo '
                    <a class="product_img" data-lightbox="example-set" data-title="' . get_the_title() . '" href="' . get_post_image() . '" data-sLink="' . get_permalink() . '">
                      <img src="' . $value . '" alt="фотообои ' . get_the_title() . ' ' . $file_description . '" />
                    </a>';
    } else {
        echo '
                    <a class="product_img" data-lightbox="example-set" data-title="' . get_the_title() . '" href="' . get_post_image() . '" data-sLink="' . get_permalink() . '">
                      <img src="' . get_post_image() . '" alt="фотообои ' . get_the_title() . ' ' . $file_description . '" />
                    </a>';
    } ?>
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
                <?php echo '<div class="product_numb">' . $file_description . '</div>'; ?>
            </div>
            <div class="col-xs-8 text-right">
                <a class="readMore order_button" href="<?php the_permalink(); ?>"
                   onclick="ga('send', 'event', 'UznatCenu', 'Click')">Узнать цену</a>
            </div>
        </div>
    </div>
</div>