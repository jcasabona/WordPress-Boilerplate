<?php

$$cptprefix= 'prefix_';
$cptType= 'type';
$cptLabel= 'label';
$cptSingleLabel= 'single label';
$cptSlug= 'slug';
$cptSupports= array('title', 'editor', 'comments');

$cptMetaID= 'assignments-meta';

/*********

Do a find/replace to replace CPTF_ with the proper function name

**********/

/** Create the Custom Post Type**/
add_action('init', $cptprefix.'register');  
  
 
function CPTF_register() {  
    
    //Arguments to create post $cptType.
    $args = array(  
        'label' => __($cptLabel),  
        'singular_label' => __($cptSingleLabel),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => true,  
        'has_archive' => true,
        'supports' => $cptSupports,
        'rewrite' => array('slug' => SLUG, 'with_front' => false),
       );  
  
  	//Register $cptType and custom taxonomy for $cptType.
    register_post_type( $cptType , $args );   
    
    //register_taxonomy("course", array("businesses"), array("hierarchical" => true, "label" => "Business $cptTypes", "singular_label" => "Business $cptType", "rewrite" => true, "slug" => 'business-$cptType'));
}  
 

$cpt_meta= $cptprefix.'meta_box';
$cpt_meta = array(
    'id' => $cptMetaID,
    'title' => __($cptSingleLabel. ' Information'),
    'page' => $cptType,
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => __('Due Date'),
            'desc' => __('When is it due?'),
            'id' => 'duedate',
            '$cptType' => 'text',
            'std' => ""
        ),	
       array(
			'name'	=> __('Course'),
			'desc'	=> __('Select the coruse the list (if you do not see a trainer, make sure you have added one from the Trainers tab).'),
			'id'	=> 'course',
			'$cptType'	=> 'post_list',
			'std' => ""
		),
    )
);

add_action('admin_menu', $cptprefix.'_meta');


// Add meta box
function CPTF_meta() {
    global $cpt_meta;
    
    add_meta_box($cpt_meta['id'], $cpt_meta['title'], $cptprefix.'_show_meta', $cpt_meta['page'], $cpt_meta['context'], $cpt_meta['priority']);
}

// Callback function to show fields in meta box
function CPTF_show_meta() {
    global $cpt_meta, $post;
    
    // Use nonce for verification
    echo '<input $cptType="hidden" name="'.$cptprefix.'_meta_nonce2" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($cpt_meta['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['$cptType']) {
            case 'text':
                echo '<input $cptType="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '<br />', $field['desc'];
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
            case 'post_list':  
			$items = get_posts( array (  
				'post_$cptType' => 'courses',  
				'posts_per_page' => -1  
			));  
				echo '<select name="', $field['id'],'" id="'.$field['id'],'"> 
						<option value="">Select One</option>'; // Select One  
					foreach($items as $item) {  
						echo '<option value="'.$item->ID.'"', $metas == $item->ID ? ' selected="selected"' : '','> '.$item->post_title.'</option>';  
					} // end foreach  
				echo '</select><br />'.$field['desc'];  
			break; 
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

// get current post meta data

add_action('save_post', $cptprefix.'_save_data');

// Save data from meta box
function CPTF_save_data($post_id) {
    global $cpt_meta;
    
    // verify nonce
    if (!wp_verify_nonce($_POST[$cptprefix.'_meta_nonce2'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    foreach ($cpt_meta['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// check autosave
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
 return $post_id;
}




?>