<?php//评论function leonhere_comment($comment, $args, $depth) {   	$GLOBALS['comment'] = $comment; ?>	<li id="comment-<?php comment_ID(); ?>">		<div class="comment-con">			<div class="comment-meta">				<div class="author"><?php comment_author() ?></div>				<span><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>				<span><?php echo get_comment_time('Y-m-d'); ?></span>			</div>			<div class="comment-text">			<?php if($comment->comment_approved =='0') : ?>			<em>你的评论正在审核，稍后会显示出来！</em>			<?php endif;?>			<?php comment_text(); ?>			</div>		</div><?php } ?>