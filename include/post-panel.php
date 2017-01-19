<?php

    $new_meta_boxes =

    array(        

	    "title" => array( 

            "name" => "title",

            "std" => "", 

            "title" => "标题红色部分", 

            "type"=>"text"),

	    "mall" => array( 

            "name" => "mall",

            "std" => "", 

            "title" => "购买商城", 

            "type"=>"text"),

        "thumbnail" => array( 

            "name" => "thumbnail",

            "std" => "", 

            "title" => "缩略图", 

            "type"=>"text"),

	    "url" => array( 

            "name" => "url",

            "std" => "", 

            "title" => "直达链接", 

            "type"=>"text"),

    );

    function new_meta_boxes() { 

        global $post, $new_meta_boxes; 

        foreach($new_meta_boxes as $meta_box) { 

            //获取保存的是 

            $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);   

            if($meta_box_value != "")

                $meta_box['std'] = $meta_box_value;//将默认值替换为以保存的值               



            echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';   



            //通过选择类型输出不同的html代码   



            switch ( $meta_box['type'] ){   



                case 'title':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                    break;   



                case 'text':   



                    echo'<h4 style="margin-top:10px;">'.$meta_box['title'].'</h4>';   



                    echo '<input style="margin:10px; width:90%; height:32px; line-height:32px;" type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /><br />';   



                    break;   



                case 'textarea':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                    echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';   



                    break;   



                case 'dropdown':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                    if($meta_box['subtype'] == 'cat'){   



                        $select = 'Select category';   



                        $entries = get_categories('title_li=&orderby=name&hide_empty=0');//获取分类   



                    }   



                    echo '<p><select name="'.$meta_box['name'].'"> ';   



                    echo '<option value="">'.$select .'</option>  ';   



                    foreach ($entries as $key => $entry){   



                        $id = $entry->term_id;   



                        $title = $entry->name;   



                        if ( $meta_box['std'] == $id ){   



                            $selected = "selected='selected'";   



                        }else{   



                            $selected = "";   



                        }   



                        echo "<option $selected value='". $id."'>". $title."</option>";   



                    }   



                    echo '</select><br />';   



                    break;   



                case 'radio':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                    $counter = 1;   



                    foreach( $meta_box['buttons'] as $radiobutton ) {   



                        $checked ="";   



                        if(isset($meta_box['std']) && $meta_box['std'] == $counter) {   



                            $checked = 'checked = "checked"';   



                        }   



                        echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'"/>'.$radiobutton;   



                        $counter++;   



                    }   



                    break;   



                case 'checkbox':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                    if( isset($meta_box['std']) && $meta_box['std'] == 'true' )   



                        $checked = 'checked = "checked"';   



                    else  



                        $checked  = '';    



                    echo '<input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';   



                    break;   



                //编辑器   



                case 'editor':   



                    echo'<h4>'.$meta_box['title'].'</h4>';   



                  /* wp_editor( $meta_box['std'], $meta_box['name'] );*/



                    //带配置参数   



                   wp_editor($meta_box['std'],$meta_box['name'], $settings = array(quicktags=>0,//取消html模式



                        tinymce=>0,//可视化模式  



                        media_buttons=>0,//取消媒体上传  



                        textarea_rows=>5,//行数设为5  



                        editor_class=>"textareastyle") );



                break;                   



            }             



        }      



    }      



    function create_meta_box() {      



        global $theme_name;         



        if ( function_exists('add_meta_box') ) {      



            add_meta_box( 'new-meta-boxes', '自定义文章', 'new_meta_boxes', 'post', 'normal', 'high' );      



        }      



    }   



    function save_postdata( $post_id ) {      



        global $post, $new_meta_boxes;         



        foreach($new_meta_boxes as $meta_box) {      



            if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {      



                return $post_id;      



            }



            if ( 'page' == $_POST['post_type'] ) {      



                if ( !current_user_can( 'edit_page', $post_id ))      



                    return $post_id;      



            }       



            else {      



                if ( !current_user_can( 'edit_post', $post_id ))      



                    return $post_id;      



            }         



            $data = $_POST[$meta_box['name']];         



            if(get_post_meta($post_id, $meta_box['name']) == "")      



                add_post_meta($post_id, $meta_box['name'], $data, true);      



            elseif($data != get_post_meta($post_id, $meta_box['name'], true))      



                update_post_meta($post_id, $meta_box['name'], $data);      



            elseif($data == "")      



                delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));      



        }      



    }      



    add_action('admin_menu', 'create_meta_box');      



    add_action('save_post', 'save_postdata');   



?>