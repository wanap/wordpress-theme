<?php
include_once('include/post-panel.php');
include_once('include/wpcomments.php');

add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

register_nav_menus(
    array(
        'header-menu' => __( '顶部导航菜单' ),
    )
);
register_nav_menus(
    array(
        'side-menu' => __( '分类筛选' ),
    )
);


if( function_exists('register_sidebar') ) {

	register_sidebar(array(

		'name' => '边栏',		

		'before_widget' => '<div class="widget">',

		'after_widget' => '</div>',

		'before_title' => '<h3>',

		'after_title' => '</h3>'

	));

}


function tagtext(){

	global $post;

	$gettags = get_the_tags($post->ID);

	if ($gettags) {

		foreach ($gettags as $tag) {

		$posttag[] = $tag->name;

	}

	$tags = implode( ',', $posttag );

		echo $tags;

	}

}

function boke8_net_pagenavi($range = 9){

	global $paged, $wp_query;

	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}

	if($max_page > 1){if(!$paged){$paged = 1;}

	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'><span class='text'>首页</span></a>";}

	previous_posts_link("<span class='text'>&lt;上一页</span>");

    if($max_page > $range){
		if($paged < $range){
            for($i = 1; $i <= ($range + 1); $i++){
                if($i == $paged) {
                    echo "<strong><span class='num'>$i</span></strong>";
                } else {
                    echo "<a href='" . get_pagenum_link($i) ."'><span class='num'>$i</span></a>";
                }
            }
        }elseif($paged >= ($max_page - ceil(($range/2)))){
    		for($i = $max_page - $range; $i <= $max_page; $i++){
                if($i == $paged) {
                    echo "<strong><span class='num'>$i</span></strong>";
                } else {
                    echo "<a href='" . get_pagenum_link($i) ."'><span class='num'>$i</span></a>";
                }
            }
        }elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
    		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
                if($i == $paged) {
                    echo "<strong><span class='num'>$i</span></strong>";
                } else {
                    echo "<a href='" . get_pagenum_link($i) ."'><span class='num'>$i</span></a>";
                }
            }
        }
    } else {
        for($i = 1; $i <= $max_page; $i++){
            if($i == $paged) {
                echo "<strong><span class='num'>$i</span></strong>";
            } else {
                echo "<a href='" . get_pagenum_link($i) ."'><span class='num'>$i</span></a>";
            }
        }
    }

    next_posts_link('<span class="text">下一页&gt;</span>');

    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'><span class='text'>末页</span></a>";}}

}

function copyrightDate() {

	global $wpdb;

	$copyright_dates = $wpdb->get_results("

		SELECT

			YEAR(min(post_date_gmt)) AS firstdate,

			YEAR(max(post_date_gmt)) AS lastdate

		FROM

			$wpdb->posts

		WHERE post_status = 'publish'

	");

	if($copyright_dates) {

		$date = date('Y-m-d');

		$date = explode('-', $date);

		$copyright = "Copyright &copy; " . $copyright_dates[0]->firstdate;

		if($copyright_dates[0]->firstdate != $date[0]) {

			$copyright .= '-' . $date[0];

		}

		echo $copyright;

	}

}


//文章点击数
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

?>