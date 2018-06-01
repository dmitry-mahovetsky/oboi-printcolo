<aside class="pw_category_holder">

    <form action="" id="send-image-form" class="send-image-form" method="post">
        <div class="form-group upload-form-group">
            <div class="upload-form-group-messages">
                <div class="message message-success"></div>
            </div>
            <div id="drop-zone" class="drop-zone">
                <div id="drop-text" class="drop-text">
                    <div class="message message-error"></div>

                    <div class="drop-text_m">
                        Перетащите сюда свое изображение
                    </div>

                </div>
            </div>
            <button class="button button-upload"><i class="fa fa-image fa-lg"></i>Загрузить</button>
            <input type="file" name="image" id="user-image" accept="image/*">
        </div>

        <div class="send-image-form-field hidden">
            <div class="form-group">
                <input type="text" class="text-input" name="name" id="user-name" value="" placeholder="Имя">
            </div>
            <div class="form-group">
                <input type="text" class="text-input" name="contact" id="user-contact" value="" placeholder="Телефон или Email">
            </div>
            <div class="form-group">
                <input type="text" class="text-input" name="comment" id="user-comment" value="" placeholder="Ваш комментарий">
            </div>
            <button type="submit" class="button">Отправить</button>
        </div>

    </form>


    <div class="selectedSelector <?php
    if (count($ARRAY_CONTENT) == 0) {
        echo ' hidden';
    }

    if (!array_key_exists(ip(), $ARRAY_CONTENT)) {
                echo ' hidden';
    }

    if (count($ARRAY_CONTENT[ip()]['link']) == 0) {
        echo ' hidden';
    }

    ?>">

        <div class="title">
            Избранное
        </div>
        <div class="selectedSelector-wrapp">
            <div class="row">
                <?php

                for ($i = 0; $i < count($ARRAY_CONTENT[ip()]['img']); $i++) {
                    echo "
<div class='card'>
                    <a href='". $ARRAY_CONTENT[ip()]['link'][$i] ."' title='Перейти'>
                        <img src='". $ARRAY_CONTENT[ip()]['img'][$i] ."'>
                    </a><a class='del' title='Удалить'>
                        <img src='/wp-content/themes/PrintColor/img/icons/delete.png'></a>
                        </div>
";
                }

                ?>

            </div>
        </div>
        <button class="btnLink">Очистить все</button>
    </div>

    <div class="pw_pic_search_holder visible-md visible-lg">
        <form action="<?php bloginfo('home'); ?>" id="searchform" method="get" role="search">
            <fieldset>
                <input type="text" id="s" name="s" value="" placeholder="Поиск по названию">
                <input type="submit" id="searchsubmit" value="">
            </fieldset>
        </form>
    </div>
    <a href="<?php echo get_site_url(); ?>/katalog-fotooboev" class="all_category_link button">Каталог фотообоев</a>
    <?php
      dynamic_sidebar('Left-sidebar');
    ?>
    <a href="#" id="nav-cities-toggle-button" class="button button-cities">Города</a>
    <div class="sk_cat_holder">
        <?php
            wp_nav_menu(array('menu' => 'goroda'));
        ?>
    </div>
    <div class="pw_color_selectors">
        <div class="sk_category_name">По цвету</div>
        <div class="pw_color_holder">
            <div class="pw_color_row_1">
                <a href="<?php bloginfo('home'); ?>?s=красный" rel="nofollow" title="красный" alt="красный"></a>
                <a href="<?php bloginfo('home'); ?>?s=оранжевый" rel="nofollow" title="оранжевый" alt="оранжевый"></a>
                <a href="<?php bloginfo('home'); ?>?s=желтый" rel="nofollow" title="желтый" alt="желтый"></a>
                <a href="<?php bloginfo('home'); ?>?s=зеленый" rel="nofollow" title="зеленый" alt="зеленый"></a>
                <a href="<?php bloginfo('home'); ?>?s=голубой" rel="nofollow" title="голубой" alt="голубой"></a>
                <a href="<?php bloginfo('home'); ?>?s=синий" rel="nofollow" title="синий" alt="синий"></a>
            </div>
            <div class="pw_color_row_2">
                <a href="<?php bloginfo('home'); ?>?s=фиолетовый" rel="nofollow" title="фиолетовый" alt="фиолетовый"></a>
                <a href="<?php bloginfo('home'); ?>?s=розовый" rel="nofollow" title="розовый" alt="розовый"></a>
                <a href="<?php bloginfo('home'); ?>?s=коричневый" rel="nofollow" title="коричневый" alt="коричневый"></a>
                <a href="<?php bloginfo('home'); ?>?s=серый" rel="nofollow" title="серый" alt="серый"></a>
                <a href="<?php bloginfo('home'); ?>?s=черный" rel="nofollow" title="черный" alt="черный"></a>
                <a href="<?php echo get_site_url();?>?s=белый" rel="nofollow" title="белый" alt="белый"></a>
            </div>
        </div>
    </div>
    <?php
      dynamic_sidebar('Left-sidebar-rooms');
    ?>

<!-- right sidebar begin -->
    <div class="right_sidebar_holder">
        <?php dynamic_sidebar('right-sidebar-info'); ?>
    </div>
<!-- right sidebar end -->

</aside>
