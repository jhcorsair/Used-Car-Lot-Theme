<?php

/**
 * @author James Haney
 * @copyright 12/2015
 */

//register_nav_menus( array(
//'primary' => __( 'Primary Navigation', 'test' ),
//) );

//gets email server options 
$options = get_option('cars_options');
//var_dump($options);



/**
 * Creates Nav Bar by passing page titles in an array
 * 
 **/

function navbar($post_type)
{
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 0,
        'post_type' => $post_type,
        'post_status' => 'publish');
    $pages = get_pages($args);
	//var_dump($pages);
    $html = '<div class="menu-header"><ul>';
    foreach ($pages as $post) {

        $html .= '<li> <a href="' . $post->guid . '" />' . $post->post_title .
            '</a></li>';
    }

    $html .= '</ul></div>';
    echo $html;
}

//Sets selected pages status to publish if admin on login
function admin_publish_pages($user_login, $user)
{

    $user = get_user_by('login', $user_login);
    if ($user->has_cap('manage_options')) {

        $page1 = get_page_by_title('Add Detail Image');

        $post1 = array('ID' => $page1->ID, 'post_status' => 'Publish');
        wp_update_post($post1);

        $page2 = get_page_by_title('Edit Inventory');

        $post2 = array('ID' => $page2->ID, 'post_status' => 'Publish');
        wp_update_post($post2);

        $page3 = get_page_by_title('Upload');

        $post3 = array('ID' => $page3->ID, 'post_status' => 'Publish');
        wp_update_post($post3);
    }
}
add_action('wp_login', 'admin_publish_pages', 10, 2);

//Sets selected pages status to draft on logout for all users
function private_pages()
{

    $page1 = get_page_by_title('Add Detail Image');

    $post1 = array('ID' => $page1->ID, 'post_status' => 'Draft');
    wp_update_post($post1);

    $page2 = get_page_by_title('Edit Inventory');

    $post2 = array('ID' => $page2->ID, 'post_status' => 'Draft');
    wp_update_post($post2);

    $page3 = get_page_by_title('Upload');

    $post3 = array('ID' => $page3->ID, 'post_status' => 'Draft');
    wp_update_post($post3);
    
    
}

add_action('wp_logout', 'private_pages');


