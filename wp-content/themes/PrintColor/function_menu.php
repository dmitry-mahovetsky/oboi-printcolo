<?php

//include "/wp-content/plugins/Tax-Meta-Class/taxonomy-fields.php";



function  gb_custom_js_admin(){

    if( is_admin() ){
        echo <<<HTML
    <style>
   #menu-posts-red_book .wp-first-item {
    display: none;
    }
   #menu-posts-red_book .wp-submenu-wrap li:nth-child(3) {
   display: none;
   }
   .post-type-red_book .form-field.term-slug-wrap, .post-type-red_book .form-field.term-description-wrap {
    display: none;
    }
    .post-type-red_book #wpseo_meta {
    display:none;
    }
    .simplePanelImagePreview img {
    max-width: 100% !important;
    }
    .post-type-red_book .description.column-description,
    .post-type-red_book .wpseo_score.column-wpseo_score,
    .post-type-red_book .column-wpseo_score_readability,
    .post-type-red_book .slug.column-slug,
    .post-type-red_book .posts.column-posts,
    .post-type-red_book #description,
    .post-type-red_book #wpseo_score,
    .post-type-red_book #slug,
    .post-type-red_book #posts,
    .post-type-red_book  tfoot,
    .post-type-red_book td.colspanchange label:nth-child(2){
  
   display:none;
    }
    .post-type-red_book td.name.column-name {
    width: 500px
    }
    
    .post-type-red_book .text-parent {
    color: red;
    font-weight: 600;
}
    .taxonomy-type_wallpaper_tax .term-parent-wrap{
   
   display:none;
    }
    .post-type-red_book .row-actions .view {
   
   display:none;
    }
    
.taxonomy-category .form-field.term-description-wrap label:after {
content: ' в низу рубрики';
}
    .taxonomy-exchange_rate .form-field.term-parent-wrap {
    display: none;
}    
</style>
    <script >
    window.addEventListener('DOMContentLoaded',function() {
      var menu = document.querySelector('#menu-posts-red_book');
      if(menu){
         menu.querySelector('.menu-icon-red_book').setAttribute('href', '#');
      }
      var tax = document.querySelector('.taxonomy-red_book_tax');
      if(tax){
          var parent = tax.querySelector('#parent');
          var span =  document.createElement('div');
          span.className = 'text-parent';
          span.innerHTML = 'Родительская это вид материала, а дочерняя это текстуры';
          parent.parentNode.appendChild(span)
      }
    });
</script>
HTML;
    }

}
add_action('admin_head', 'gb_custom_js_admin');



if (!function_exists('red_book_cp')) {


    function red_book_cp()
    {

        $labels = array(
            'name' => _x('Материалы, цены', 'Post Type General Name', 'red_book'),
            'singular_name' => _x('Материалы, цены', 'Post Type Singular Name', 'red_book'),
            'menu_name' => __('Материалы, цены', 'red_book'),
            'parent_item_colon' => __('Родительский:', 'red_book'),
            'all_items' => __('Все записи', 'red_book'),
            'view_item' => __('Просмотреть', 'red_book'),
            'add_new_item' => __('Добавить новую запись в Красную Книгу', 'red_book'),
            'add_new' => __('Добавить новую', 'red_book'),
            'edit_item' => __('Редактировать запись', 'red_book'),
            'update_item' => __('Обновить запись', 'red_book'),
            'search_items' => __('Найти запись', 'red_book'),
            'not_found' => __('Не найдено', 'red_book'),
            'not_found_in_trash' => __('Не найдено в корзине', 'red_book'),
        );
        $args = array(
            'labels' => $labels,
            'supports' => array('title','editor'),
            'taxonomies' => array('red_book_tax'), // категории, которые мы создадим ниже
            'public' => true,
            'menu_position' => 150,
            'menu_icon' => 'dashicons-tag',
            'show_in_admin_bar' => false,

        );
        register_post_type('red_book', $args);

    }

    add_action('init', 'red_book_cp', 0); // инициализируем

}



if (!function_exists('type_wallpaper_tax')) {

    function type_wallpaper_tax()
    {

        $labels = array(
            'name' => _x('Тип обоев', 'Taxonomy General Name', 'red_book'),
            'singular_name' => _x('Тип обоев', 'Taxonomy Singular Name', 'red_book'),
            'menu_name' => __('Тип обоев', 'red_book'),
            'all_items' => __('Тип обоев', 'red_book'),
            'parent_item' => __('Родительская категория Материалы и Цены', 'red_book'),
            'parent_item_colon' => __('Родительская категория Материалы и Цены:', 'red_book'),
            'new_item_name' => __('Новая категория', 'red_book'),
            'add_new_item' => __('Тип фотообоев', 'red_book'),
            'edit_item' => __('Редактировать тип', 'red_book'),
            'update_item' => __('Обновить тип', 'red_book'),
            'search_items' => __('Найти', 'red_book'),
            'add_or_remove_items' => __('Добавить или удалить вид', 'red_book'),
            'choose_from_most_used' => __('Поиск среди популярных', 'red_book'),
            'not_found' => __('Не найдено', 'red_book'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
        );
        register_taxonomy('type_wallpaper_tax', array('red_book'), $args);

    }

    add_action('init', 'type_wallpaper_tax', 0); // инициализируем

}



if (!function_exists('red_book_tax')) {

    function red_book_tax()
    {

        $labels = array(
            'name' => _x('Виды материалов', 'Taxonomy General Name', 'red_book'),
            'singular_name' => _x('Виды материалов', 'Taxonomy Singular Name', 'red_book'),
            'menu_name' => __('Виды материалов', 'red_book'),
            'all_items' => __('Виды материалов', 'red_book'),
            'parent_item' => __('Родительская категория Материалы и Цены', 'red_book'),
            'parent_item_colon' => __('Родительская категория Материалы и Цены:', 'red_book'),
            'new_item_name' => __('Новая категория', 'red_book'),
            'add_new_item' => __('Добавить новую вид', 'red_book'),
            'edit_item' => __('Редактировать вид', 'red_book'),
            'update_item' => __('Обновить вид', 'red_book'),
            'search_items' => __('Найти', 'red_book'),
            'add_or_remove_items' => __('Добавить или удалить вид', 'red_book'),
            'choose_from_most_used' => __('Поиск среди популярных', 'red_book'),
            'not_found' => __('Не найдено', 'red_book'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
        );
        register_taxonomy('red_book_tax', array('red_book'), $args);

    }

    add_action('init', 'red_book_tax', 0); // инициализируем

}


if (!function_exists('exchange_rate')) {

    function exchange_rate()
    {

        $labels = array(
            'name' => _x('Курс валют', 'Taxonomy General Name', 'red_book'),
            'singular_name' => _x('Курс валют', 'Taxonomy Singular Name', 'red_book'),
            'menu_name' => __('Курс валют', 'red_book'),
            'all_items' => __('Курс валют', 'red_book'),
            'parent_item' => __('Родительская категория Материалы и Цены', 'red_book'),
            'parent_item_colon' => __('Родительская категория Материалы и Цены:', 'red_book'),
            'new_item_name' => __('Новый курс валют', 'red_book'),
            'add_new_item' => __('Добавить новуй курс валют', 'red_book'),
            'edit_item' => __('Редактировать курс валют', 'red_book'),
            'update_item' => __('Обновить курс валют', 'red_book'),
            'search_items' => __('Найти', 'red_book'),
            'add_or_remove_items' => __('Добавить или удалить курс валют', 'red_book'),
            'choose_from_most_used' => __('Поиск среди популярных', 'red_book'),
            'not_found' => __('Не найдено', 'red_book'),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
        );
        register_taxonomy('exchange_rate', array('red_book'), $args);

    }

    add_action('init', 'exchange_rate', 0); // инициализируем

}

/**
 * @param $id
 * @return string
 */
function tax_value($id){
    global $wpdb;
    $meta = $wpdb->get_results( "SELECT * FROM `wpc_termmeta` WHERE  `term_id`=" . $id );

    foreach ($meta as $item => $value) {
        $result = $value->meta_value;
    }

    if (preg_match('/\,/i', $result)) {
        $result = preg_replace('/\,/',  '.', $result);
    }

    return (empty($result) ? $result = 0 : $result);
}
