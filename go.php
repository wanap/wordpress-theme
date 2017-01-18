<?php      
/*******跳转模板*******/
global $wp_query;
//从请求的地址中获取文章ID
if( isset($wp_query->query_vars['pid']) && $wp_query->query_vars['pid']!='' ) {
    $post_id = $wp_query->query_vars['pid'];
} else {
    $post_id = 0;
}

if( $post_id ){
    //通过文章ID获取要跳转的站外链接--自定义字段      
    $buy_link = get_post_meta($post_id, 'url', true);
    $buy_link = htmlspecialchars_decode($buy_link);//将html实体换回预定义字符
    $buy_link = addhttp(trim($buy_link));
    if($buy_link){
        echo '<script type="text/javascript">window.location.href="'.$buy_link.'";</script>';
        //或者使用302跳转 header("location:".$buy_link);
    } else {
        echo '<script type="text/javascript">window.location.href="'.home_url().'";</script>';
    }
} else {
    echo '<script type="text/javascript">window.location.href="'.home_url().'";</script>';
}

?>