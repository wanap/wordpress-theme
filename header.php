<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"><meta http-equiv="X-UA-Compatible" content="IE=Edge"><link rel="shortcut icon"  href="<?php bloginfo('template_url');?>/images/favicon.ico" type="image/x-icon"/><title><?php if ( $paged > 1 ) { echo ('第'); echo ($paged); echo '页_';}?><?php if (is_home () ) {	bloginfo('name');echo "_"; bloginfo('description');} elseif ( is_category() ) { 	single_cat_title(); echo "_"; bloginfo('name'); } elseif (is_single() || is_page() ) { 	single_post_title(); echo "_"; bloginfo('name'); } elseif (is_search() ) { 	bloginfo('name'); echo "search results:"; echo wp_specialchars($s); } else { wp_title('',true); echo "_"; bloginfo('name'); } ?></title><?php 	if(is_home()){ 		if(get_option('leonhere_keywords')) { 			$keywords = get_option('leonhere_keywords'); 		} else { 			$keywords = get_bloginfo('name');		} 		echo '<meta name="keywords" content="'.$keywords.'"/>';		?>		<?php 		if(get_option('leonhere_description')) { 			$description = get_option('leonhere_description'); 		} else { 			$description = get_bloginfo('description');		} 		echo '<meta name="description" content="'.$description.'"/>';	}	else if(is_category()){ 		$cat_des = strip_tags(category_description()); 		$cat_des = str_replace(PHP_EOL, '', $cat_des); 		echo '<meta name="description" content="'.$cat_des.'"/>';	}	else if(is_single()) {		$description = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 110,'...');		$description=str_replace("\n","",$description);		?>		<meta name="keywords" content="<?php tagtext();?>"/>		<?php echo '<meta name="description" content="'.$description.'"/>'; 	}?><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" /><script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="<?php bloginfo('template_url');?>/js/index.js"></script></head><body <?php body_class(); ?>>    <div class="header">        <div class="container header-top clearfix">            <div class="header-logo">                <img src="<?php bloginfo('template_url');?>/images/logo.png" alt="logo" width="100" height="100">            </div>            <div class="header-slogan">                <h4 class="header-title">哆啦A梦</h4>                <p class="header-desc">我不像哆啦A梦吗？</p>            </div>            <div class="header-search">                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">                    <input type="text" class="search-input" placeholder="妙用搜索，找到更多惊喜" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">                    <input type="submit" class="search-btn" value="搜索">                </form>            </div>        </div>        <div class="header-menu">            <div class="container">                <?php wp_nav_menu(                    array(                    'theme_location' =>'header-menu',                    'container' => 'ul',                    'menu_class' => 'header-menu-list',                    'depth' => 2                     )                ); ?>            </div>        </div>    </div>    <div class="category-container">        <div class="container category-inner">            <div class="category-sidebar">                <h4 class="category-title">分类筛选</h4>                <?php wp_nav_menu(                    array(                    'theme_location' =>'side-menu',                    'container' => 'ul',                    'menu_class' => 'category-list',                    'depth' => 0                     )                ); ?>            </div>        </div>    </div>