<?php
/*
Template Name: Comments
*/
?>
<?php get_header();?>
<div class = "pw_content_wraper" id = "pw_galery">
<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
	<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		<?php 
			$title = get_the_title();
			echo'<h1 class = "page_main_header">'.$title.'</h1>' 
		?>
		<div class="comments_holder">
			<button class="new_recall_button">Добавить отзыв</button>
			<?php comments_template(); ?>
		</div>
	</div>
</div>
<?php get_footer();?>