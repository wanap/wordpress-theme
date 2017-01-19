<?php
/**
 *
 * Template name: picture wallterfall
 * The template for displaying homepage.
 *
 */
?>

<?php get_header();?>
<div class="container">
    <?php
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1
        );
        $my_query = new WP_Query($args);
        if( $my_query->have_posts() ) {
    ?>
        <div class="picwall clearfix">
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <div class="picwall-item">
                    <a href="<?php the_permalink(); ?>" target="_blank" class="picwall-img">
                        <?php if(get_post_custom_values("thumbnail")){ 
                            $values = get_post_custom_values("thumbnail"); 
                            echo '<img src="'.$values[0].'" alt="">';
                        }?>
                    </a>
                    <div class="picwall-title">
                        <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title();?></a>
                    </div>
                    <div class="picwall-ft">
                        <span class="num"><?php echo getPostViews(get_the_ID()); ?>人想买</span>
                        <a href="<?php echo home_url().'/go/'.get_the_ID().'/'; ?>" class="btn-buy" target="_blank">直达链接<i>&gt;</i></a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php  } wp_reset_query(); ?>
</div>
<?php get_footer();?>