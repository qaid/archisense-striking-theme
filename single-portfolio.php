<?php
/**
 * The Template for displaying all portfolio posts.
 *
 * @package Striking
 */

$blog_page = theme_get_option('blog','blog_page');
$post_id = get_queried_object_id();
if($blog_page == $post->ID){
	return load_template(THEME_DIR . "/template_blog.php");
}
$layout = theme_get_inherit_option($post_id, '_layout', 'portfolio','layout');

get_header(); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
			<?php echo theme_generator('breadcrumbs',$post_id);?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php get_template_part('content','portfolio');?>
<?php if(theme_get_option('portfolio','enable_comment')) comments_template( '', true ); ?>
<?php endwhile; // end of the loop.?>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
	<div id="page_bottom"></div>
</div>
<?php get_footer(); ?>