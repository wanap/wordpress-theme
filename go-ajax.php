<?php 
    if( isset($wp_query->query_vars['pid']) && $wp_query->query_vars['pid']!='' ) {
        $post_id = $wp_query->query_vars['pid'];
    } else {
        $post_id = 0;
    }
?>
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    jQuery.ajax({
        type: 'GET',
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: {
            id: "<?php echo $post_id ?>",
            action: "myajax_submit"
        },
        success: function(res) {
            window.location.href = res.data.href;
        }
    });
</script>