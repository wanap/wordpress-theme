<?php get_header();?>
<div class="main-body">
    <div class="container main-container clearfix">
        <div class="left-content">
        	<div class="crumbs">
        		当前位置：<?php echo get_breadcrumbs(); ?>
        	</div>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php setPostViews(get_the_ID()); ?>
					<div class="post-detail" id="post-<?php the_ID(); ?>">
						<h4 class="post-title">
							<?php the_title();?> 
							<?php if(get_post_custom_values("title")){ 
								$values = get_post_custom_values("title");
								echo '<span>'.$values[0].'</span>';
							}?>
						</h4>
						<div class="post-meta">
							<span class="time">
							<?php $u_time = get_the_time('U'); 
								$u_modified_time = get_the_modified_time('U');	
								if ($u_modified_time != $u_time) {
									the_modified_time('Y年n月j日 H:i');
								} else {
									the_time('Y年n月j日 H:i');
								}?>
							</span>
							<div class="tags">标签：<?php echo get_the_tag_list('','',''); ?></div>
						</div>
						<div class="post-content">
							<?php if(get_post_custom_values("thumbnail")){ 
	                    		$values = get_post_custom_values("thumbnail"); 
	                    		echo "<div class='thumbnail'>"; 
								echo '<img src="'.$values[0].'" alt="">';
								echo "</div>";
	                    	}?>
							<div class="output">
								<?php the_content();?>
							</div>
						</div>
						<div class="post-go">
							<a rel="nofollow" href="<?php echo home_url().'/go/'.get_the_ID().'/'; ?>" target="_blank">去看看<i>&gt;</i></a>
						</div>
					</div>
				<?php endwhile; ?>

				<div class="widget-box">
					<?php
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
							$first_tag = $tags[0]->term_id;
							$args=array(
								'tag__in' => array($first_tag),
								'post__not_in' => array($post->ID),
								'showposts'=>4
							);
							$my_query = new WP_Query($args);
							if( $my_query->have_posts() ) {
					?>
						<h3><span>相关推荐</span></h3>
						<ul class="similar-list clearfix">
							<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
								<li class="similar-item">
									<a href="<?php the_permalink(); ?>" target="_blank">
										<div class="similar-img">
										<?php if(get_post_custom_values("thumbnail")){ 
				                    		$values = get_post_custom_values("thumbnail"); 
				                    		echo '<img src="'.$values[0].'" alt="">';
				                    	}?>
										</div>
										<p class="similar-title"><?php the_title();?></p>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
					<?php } } wp_reset_query(); ?>
				</div>

				<?php comments_template('', ture); ?>

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