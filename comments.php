<?php
	if(isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die('please do not load this page directly. Thanks!');
?>

<?php if (comments_open()) : ?>
	<div class="widget-box">
		<h3><span>我要评论</span></h3>
		<div class="respond-box" id="respond">
			<?php
				if (get_option('comment_registration') && !is_user_logged_in()) :
			?>
				<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
			<?php else : ?>
				<form id="commentform" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
				<?php if(is_user_logged_in()) :?>
					<p>您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></p>
				<?php else : ?>	
					<p><input type="text" class="comment-input" name="author" value="<?php echo $comment_author; ?>" tabindex="1" required /><label>您的昵称（*）</label></p>
					<p><input type="email" class="comment-input" name="email" value="<?php echo $comment_author_email; ?>" tabindex="2" required /><label>您的邮箱（*）</label></p>
					<p><input type="text" class="comment-input" name="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /><label>您的网址</label></p>
				<?php endif; ?>	
					<p><textarea name="comment" id="comment" tabindex="4" required ></textarea></p>
					<div class="comment-action">
						<?php cancel_comment_reply_link(); ?>
						<input type="submit" name="submit" class="submit" value="发表评论" tabindex="5" />
					</div>
					<?php comment_id_fields(); ?>
					<?php do_action('comment_form',$post->ID);?>
				</form>
			<?php endif; ?>
		</div>
	</div>
<?php endif;?>

<?php if ( have_comments() ) : ?>
	<div class="widget-box">
		<h3><span>全部评论</span></h3>
		<ol class="comment-list">
			<?php wp_list_comments('type=comment&callback=leonhere_comment');?>
		</ol>
	</div>

<?php endif; ?>