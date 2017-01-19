<?php
include_once('include/post-panel.php');
include_once('include/wpcomments.php');

//add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

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

function get_breadcrumbs(){
    if (!is_home()) {
        // Add the Home link
        echo '<a href="'. get_settings('home') .'" class="crumbs-cate">首页</a>';
        if (is_single()) {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );
            echo '<i class="arrow">&gt;</i>'. get_category_parents( $category_id, true, '<i class="arrow">&gt;</i>').'文章详情';
        }
    }
}


function tagText(){
    global $post;
    $gettags = get_the_tags($post->ID);
    if ($gettags) {
        foreach ($gettags as $tag) {
            $posttag[] = '<a class="tag">'.$tag->name.'</a>';
	    }
	    $tags = implode('', $posttag);
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

/*使用admin-ajax.php实现wordpress的ajax请求*/
add_action('wp_ajax_nopriv_myajax_submit', 'myajax_submit');
add_action('wp_ajax_myajax_submit', 'myajax_submit');

function myajax_submit() {
    $postID = $_GET['id'];
    $buy_link = get_post_meta($postID, 'url', true);;
    $response = json_encode(
        array(
            'success' => true,
            'data' => array(
                'href' => $buy_link,
            )
        )
    );
    header( "Content-Type: application/json" );
    echo $response;
    // 这个很关键啊有木有: 别忘记 "exit"
    exit;
}


/*站内链接跳转到外部链接 http://xxx.com/go/xx*/

//为不带http的地址添加 http
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/************模板载入规则****************/
function wap_template_redirect(){
    global $wp_query;
    if(!isset($wp_query->query_vars['my_custom_page_type'])) {
        return;
    }
    $reditect_page =  $wp_query->query_vars['my_custom_page_type'];
    if ($reditect_page == "buy_page"){
        include(get_template_directory().'/go.php');
        //include(get_template_directory().'/go-ajax.php');
        exit;
    }
}
/*********刷新重写规则***************/
function wap_flush_rewrite_rules() {
    global $pagenow, $wp_rewrite;
    if ('themes.php' == $pagenow && isset( $_GET['activated'] )) {
        $wp_rewrite->flush_rules();
    }
}

/************添加重写规则*************/
/*注意后台设置->固定连接不能是http://localhost/wordpress/?p=123*/
function wap_rewrite_rules($wp_rewrite){
    $new_rules = array(
        'go/?([0-9]{1,})/?$' => 'index.php?my_custom_page_type=buy_page&pid='.$wp_rewrite->preg_index(1),
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

/********添加query变量************/
function wap_query_vars($public_query_vars) {
    $public_query_vars[] = 'my_custom_page_type';
    $public_query_vars[] = 'pid';
    return $public_query_vars;
}

add_action('load-themes.php', 'wap_flush_rewrite_rules'); //启用主题的时候
add_action('generate_rewrite_rules', 'wap_rewrite_rules' ); //添加重写规则
add_action('query_vars', 'wap_query_vars');
add_action("template_redirect", 'wap_template_redirect');

?>