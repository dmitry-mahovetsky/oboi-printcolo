<?php get_header();?>
<div class = "pw_content_wraper" id = "pw_galery">
<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
				<?php if(have_posts()) :?>
				<?php while(have_posts()) : the_post();?>
				<?php if(!(is_home() OR is_page('25'))){
					$title = get_the_title();
					echo '<h1 class = "page_main_header">'.$title.'</h1>';
				} ?>
				<div class="news_holder">
				<?php the_content(); ?>
				<?php $postID = get_the_ID(); ?>
				</div>
				<?php endwhile;?>
				<?php endif;?>
	</div>
</div>
<?php get_footer();?>