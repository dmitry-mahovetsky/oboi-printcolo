<?php
include_once('tinmy/add_tinymce.php');

include_once('function_menu.php');
//support thumbnails
add_theme_support( 'post-thumbnails' );

if ( function_exists('register_sidebars') ) {
    register_sidebar(array(
        'name'=>'Left-sidebar',
        'before_widget' => '<div class="sk_cat_holder">',
        'after_widget' => '</div>',
		'class' => 'sk_cat_holder',
        'before_title' => '<div class="sk_category_name">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name'=>'Left-sidebar-rooms',
        'before_widget' => '<div class="sk_cat_holder">',
        'after_widget' => '</div>',
    'class' => 'sk_cat_holder',
        'before_title' => '<div class="sk_category_name">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name'=>'top-sidebar-info',
        'before_widget' => '<div class="rowIcons">',
        'after_widget' => '</div>',
        'class' => 'rowIcons',
    ));

    register_sidebar(
        array(
            'id' => 'copy-side',
            'name' => 'Копирайт',
            'before_widget' => '<div class="copy_block">',
            'after_widget' => '</div>',
            'class' => 'copy_block',
        )
    );
}

//исключение страниц из результатов поиска start
function wph_exclude_pages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
		$query->set('category__not_in', array(1,115));
    }
    return $query;
}
add_filter('pre_get_posts','wph_exclude_pages');


//get img
function get_post_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];

if(empty($first_img)){
$img_dir = get_bloginfo('template_directory');
$first_img = $img_dir . '/img/post-default.jpg';
}
return $first_img;
}
//Заменить в тексте записей и страниц
remove_filter('the_content', 'wptexturize');
//Заменить в заголовках записей и страниц
remove_filter('the_title', 'wptexturize');
//Заменить в тексте комментариев
remove_filter('comment_text', 'wptexturize');

remove_action( 'wp_head', 'wp_generator'); 
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'feed_links', 2 );

add_action('after_setup_theme', function(){
register_nav_menus(array(
        'pw_header_menu' => 'Верхнее меню',
        'pw_footer_menu' => 'Нижнее меню',
        'pw_nav_menu' => 'Дополнительное меню'
));
});

//подключаем шаблон single для категорий по SLUG например single-foto и тд
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat )
{
if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") ) return TEMPLATEPATH . "/single-{$cat->slug}.php";
}
return $t;' ));

//хлебные крошки breadcrumbs
function dimox_breadcrumbs() {

	/* === ОПЦИИ === */
	$text['home'] = 'Главная'; // текст ссылки "Главная"
	$text['category'] = '%s'; // текст для страницы рубрики
	$text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
	$text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
	$text['author'] = 'Статьи автора %s'; // текст для страницы автора
	$text['404'] = 'Ошибка 404 '; // текст для страницы 404

	$show_current = 1; // 1 - показывать название текущей статьи/страницы/рубрики, 0 - не показывать
	$show_on_home = 1; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать
	$delimiter = ' &raquo; '; // разделить между "крошками"
	$before = '<span class="current">'; // тег перед текущей "крошкой"
	$after = '</span>'; // тег после текущей "крошки"
	/* === КОНЕЦ ОПЦИЙ === */

	global $post;
	$home_link = home_url('/');
	$link_before = '<span typeof="v:Breadcrumb">';
	$link_after = '</span>';
	$link_attr = ' rel="v:url" property="v:title"';
	$link = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			if ($cat) {
				$cats = get_category_parents($cat, TRUE, $delimiter);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;

		} elseif ( has_post_format() && !is_singular() ) {
			echo get_post_format_string( get_post_format() );
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo 'Страница ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} // end dimox_breadcrumbs()

function trim_title_chars($count, $after) {
  $title = get_the_title();
  //$title = str_replace('-','',get_the_title());
  if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
  else $after = '';
  preg_match('/-([0-9]+)$/', $title, $result); 
  $title = str_replace($result,'',$title);
  echo $title . $after;
}




function wp_comments_corenavi() {
  $pages = '';
  $max = get_comment_pages_count();
  $page = get_query_var('cpage');
  if (!$page) $page = 1;
  $a['current'] = $page;
  $a['echo'] = false;

  $total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
  $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '« Предыдущая'; //текст ссылки "Предыдущая страница"
  $a['next_text'] = 'Следующая »'; //текст ссылки "Следующая страница"

  if ($max > 1) echo '<div class="text-center"><nav class="navigation pagination">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $page . ' из ' . $max . '</span>'."\r\n";
  echo $pages . paginate_comments_links($a);
  if ($max > 1) echo '</nav></div>';
}



function js_add() {
    $variables = array(
        'ajax_url' => admin_url('admin-ajax.php')
    );
    echo '<script>window.wp_data = ' . json_encode($variables) . ';</script>';
    echo '<script src="' . get_bloginfo('template_directory') . '/js/load-image.js"></script>';
}
add_action('wp_footer','js_add');

// отправка картинки
add_action('wp_ajax_send_image', 'send_image_callback');
add_action('wp_ajax_nopriv_send_image', 'send_image_callback');

/**
 *
 */
function send_image_callback() {
    $status = true;
    
    $response = array(
        'status' => '',
        'message' => 'Успешно!'
    );

    if ($_FILES['image']['error'] > 0) {
        $status = false;
        $response['message'] = 'Ошибка: ' . $_FILES['image']['error'];
    } elseif (empty($_FILES['image']['size'])) {
        $status = false;
        $response['message'] = 'Выберите изображение!';
    } elseif ($_FILES['image']['size'] > 10485760) {
        $status = false;
        $response['message'] = 'Максимальный размер файла 10 МБ!';
    } else {
        $arr_file_type = wp_check_filetype(basename($_FILES['image']['name']));
        $uploaded_file_type = $arr_file_type['type'];
        
        $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png');
        
        if (!in_array($uploaded_file_type, $allowed_file_types)) {
            $status = false;
            $response['message'] = 'Выберите корректное изображение в формате jpeg, png или gif!';
        }
    }
    
    if ($status) {
        foreach ($_POST as $field => $value) {
            $data[htmlspecialchars($field, ENT_COMPAT, 'UTF-8')] = htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
        }
        
        if (empty($data['name'])) {
            $status = false;
            $response['message'] = 'Введите имя.';
        } elseif (empty($data['contact'])) {
            $status = false;
            $response['message'] = 'Введите email или телефон.';
        }
    }
        
    if ($status) {
        $message = "Имя: {$data['name']}\n";
        $message .= "Email/телефон: {$data['contact']}\n";
        
        if ($data['comment']) {
            $message .= "Комментарий: {$data['comment']}\n";
        }
        
        $upload_dir = wp_upload_dir();
        
        $tmp = explode(".", $_FILES['image']['name']);
        $extension = end($tmp);
        $newname = $upload_dir['path'] . '/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $newname);
        $attachments = array($newname);
        
        $status = wp_mail(get_option('admin_email'), 'Изображение пользователя', $message, '', $attachments);
        unlink($newname);
    }

    if($response['message'] == 'Успешно!'){
        $status = true;
    }
    
    $response['status'] = $status;

    echo json_encode($response['status']);
    wp_die();
}



//возвращаем ip пользователя
function ip(){
    $IP = $_SERVER['REMOTE_ADDR'];
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $IP = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
    }
    return $IP;
}

// заптись в сессию происходит в файле
// wp-content\themes\PrintColor\session\insert_session.php
// удаление из сессии происходит в файле
// wp-content\themes\PrintColor\session\delete_session.php

add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}


function object_from_file($filename)
{
    $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . $filename);
    $value = unserialize($file);
    return $value;
}
$ARRAY_CONTENT = object_from_file('/wp-content/themes/PrintColor/session/session.txt');



add_filter('comment_form_default_fields', 'extend_comment_default_fields');
function extend_comment_default_fields($fields) {

    $fields[ 'stars' ] = '<div class="form-group">
                        <label for="user_stars" class="col-sm-4 control-label">Ваша оценка</label>
                        <div class="col-sm-8">
                        <div id="ID" class="rate1"></div>
                        <input type="text" class="form-control hidden" id="user_stars" name="stars">
                        </div>
                      </div>';

    return $fields;
}
add_action( 'comment_post', 'save_extend_comment_meta_data' );
function save_extend_comment_meta_data( $comment_id ){

    if( !empty( $_POST['stars'] ) ){
        $stars = sanitize_text_field($_POST['stars']);
        add_comment_meta( $comment_id, 'stars', $stars );
    }

}


// Добавляем новый метабокс на страницу редактирования комментария
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box(){
    add_meta_box( 'title', __( 'Изменить рейтинг' ), 'extend_comment_meta_box', 'comment',
        'normal', 'low' );
}

// Отображаем наши поля
function extend_comment_meta_box( $comment ){
    $stars = get_comment_meta( $comment->comment_ID, 'stars', true );

    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>

    <p>
        <label for="stars"><?php _e( 'Рейтинг: ' ); ?></label>
        <span class="commentstarsbox">
		<?php
        for( $i=1; $i <= 5; $i++ ){
            echo '
		  <span class="commentstars">
			<input type="radio" name="stars" id="stars" value="'. $i .'" '. checked( $i, $stars, 0 ) .'/>
		  </span>';
        }
        ?>
		</span>
    </p>
    <?php
}

add_action( 'edit_comment', 'extend_comment_edit_meta_data' );
function extend_comment_edit_meta_data( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) )
        return;

    if( !empty($_POST['stars']) ){
        $rating = intval($_POST['stars']);
        update_comment_meta( $comment_id, 'stars', $rating );
    }
    else
        delete_comment_meta( $comment_id, 'stars');

}

?>