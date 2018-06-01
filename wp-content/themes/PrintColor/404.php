<?php get_header();?>
<div class = "pw_content_wraper" id = "pw_galery">
<?php if (file_exists(TEMPLATEPATH.'/sidebar-left.php')) {require(TEMPLATEPATH.'/sidebar-left.php');}; ?>
<div class="pw_gallery_holder"><?php dynamic_sidebar('top-sidebar-info'); ?>
<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
            <div class="error404">
                <h1>Ошибка 404</h1>
                <h2 class="text-center">Страница не найдена!</h2>

                <p>Извините, но страница которую вы ищете, перемещена или удалена.</p>

                <a class="button" href="<?php echo get_home_url(); ?>">на главную</a>
            </div>
	</div>
</div>
<?php get_footer();?>