<?php get_header();?>

<div class="main-body">
    <div class="container main-container clearfix">
        <div class="left-content">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="mod" id="post-<?php the_ID(); ?>">
                        <h2 class="mod-title">
                            <a href="<?php the_permalink(); ?>" target="_blank">
                                <?php the_title();?>
                                <?php if(get_post_custom_values("title")){ 
                                    $values = get_post_custom_values("title"); 
                                    echo '<span>'.$values[0].'</span>';
                                }?>
                            </a>
                        </h2>
		                <div class="mod-img">
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
		                <div class="mod-info">
                            <div class="mod-top">
                                <div class="mod-time">
                                    <?php $u_time = get_the_time('U'); 
                                        $u_modified_time = get_the_modified_time('U');
                                        if ($u_modified_time != $u_time) {
                                            the_modified_time('Y年n月j日 H:i');
                                        } else {
                                            the_time('Y年n月j日 H:i');
                                        }
                                    ?>
                                </div>
                                <span>标签：</span>
                                <?php the_category(' '); ?>
                            </div>
		                    <p class="mod-desc">
                                <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "……"); ?>
                                <a href="<?php the_permalink(); ?>" class="mod-read" target="_blank">阅读全文</a>
                            </p>
		                    <div class="mod-ft clearfix">
                                <span class="mod-tips">推荐人：<a href="#" class="mod-author" target="_blank">樱桃爸爸</a></span>
		                        <span class="mod-tips">阅读(<?php if(function_exists('the_views')) { the_views(); } else { echo '200';} ?>)</span>
		                        <div class="mod-buy">
		                        	<?php if(get_post_custom_values("mall")){ 
                                        $values = get_post_custom_values("mall"); 
                                        echo '<span class="mall">'.$values[0].'</span>';
                                    }?>
		                        	<a href="<?php echo home_url().'/go/'.get_the_ID().'/'; ?>" class="buy-link" target="_blank">直达链接&gt;</a>
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