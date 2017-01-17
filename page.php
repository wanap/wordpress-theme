<?php get_header();?>
<div class="main-body">
    <div class="container main-container clearfix">
        <div class="left-content">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>	
					<div class="post-detail" id="post-<?php the_ID(); ?>">
						<h4 class="post-title">
							<?php the_title();?> 
							<?php if(get_post_custom_values("title")){ 
								$values = get_post_custom_values("title");
								echo '<span>'.$values[0].'</span>';
							}?>
						</h4>
						<div class="post-content">	
							<?php the_content();?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="not-fountd">
					你要找的页面已删除或不存在
				</div>
			<?php endif;?>
		</div>
        <div class="right-sidebar">
        	<?php get_sidebar();?>
        </div>
    </div>
</div>
<?php get_footer();?>