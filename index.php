<?php get_header();?>

<div class="main-body">
    <div class="container main-container clearfix">
        <div class="left-content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="item" id="post-<?php the_ID(); ?>">
		                <div class="item-img">
		                    <a href="<?php the_permalink(); ?>" target="_blank">
		                    	<?php if(get_post_custom_values("thumbnail")){ 
		                    		$values = get_post_custom_values("thumbnail"); 
		                    		echo '<img src="'.$values[0].'" alt="">';
		                    		} else { 
										echo '<img src="'.get_bloginfo('template_url').'/images/related-img.jpg">'; 
									}
								?>
		                    </a>
		                </div>
		                <div class="item-info">
		                    <h4><a href="<?php the_permalink(); ?>" target="_blank" class="item-title"><?php the_title();?></a></h4>
		                    <p class="item-desc"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "……"); ?></p>
		                    <div class="item-ft">
		                        <span class="fr">阅读(<?php if(function_exists('the_views')) { the_views(); } else { echo '200';} ?>)</span>
		                        <div class="item-time">
		                        	<span>
		                        		<?php $u_time = get_the_time('U'); 
		                        			$u_modified_time = get_the_modified_time('U');
                                            if ($u_modified_time != $u_time) {
		                        				the_modified_time('Y年n月j日 H:i');
		                        			} else {
		                        				the_time('Y年n月j日 H:i');
		                        			}
		                        		?>
		                        	</span>
		                        	<span class="divider">|</span>
		                        	<?php the_category(' &bull; '); ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
				<?php endwhile; ?>
				<div class="page-nav">
					<?php boke8_net_pagenavi(6);?>
				</div>
			<?php else : ?>
				<div class="not-fountd">你要找的页面已删除或不存在</div>
			<?php endif;?>
        </div>
        <div class="right-sidebar">
        	<?php get_sidebar();?>
        </div>
    </div>
</div>

<?php get_footer();?>