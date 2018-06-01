<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<div class = "pw_content_wraper" id = "pw_galery">
<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
<h1 class="post-title">Карта сайта</h1>
<div class="site_map">
<div class="box-1">
<ul class="bloklinks">
<?php
wp_list_pages('exclude=795,9999&title_li=<h2>'. __('Страницы').'</h2>'); //***вВ данное поле расположите через запятую ID страниц, которые желаете исключить.Если исключать никакие страницы не следует то и поле соответственно оставляем пустым.
?>
</ul>

<h2>Категории</h2>
<ul class="bloklinks">
<?php wp_list_categories('title_li='); ?>
</ul>                   
<h2>Архивы</h2>
<ul class="bloklinks">
<?php wp_get_archives('type=monthly&show_post_count=0'); ?>
</ul>
</div>
<div class="box-2">
                
<h2>Статьи по категориям</h2>
<?php
$cats = get_categories();
foreach ( $cats as $cat ) {
query_posts( 'posts_per_page=-1&cat=' . $cat->cat_ID );
?>
<h3><?php echo $cat->cat_name; ?></h3>
<ul class="bloklinks">   
<?php while ( have_posts() ) { the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php } wp_reset_query(); ?>
</ul>
<?php } ?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>