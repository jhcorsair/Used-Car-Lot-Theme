<?php

/**
 * Template Name: Add Car Processor
 * Description: A Page for Custom Coding
 */

get_header(); ?>


    <div id="container">
			<!--<div id="content">-->

        <?php

require_once 'theme_functions.php';

//print_r($_FILES);
//Makes foldername if adding car
if (isset($_POST['year'])) {
    $time = date('h-i-sa', current_time('timestamp', 0));
    $post = $_POST['year'] . "-" . $_POST['make'] . "-" . $_POST['body_style'];
    $folder_name = $post . "-" . $time;
    $dir = get_stylesheet_directory();
    $structure = $dir . "/images/" . $folder_name;
    if (!mkdir($structure, 0777)) {
        error('Failed to create folders...');
    }
}

$page_title = 'Upload';
$link = my_get_page_link($page_title);

// make a note of the directory that will recieve the uploaded file
if (isset($_POST['year'])) {
    $uploadsDirectory = ABSPATH . "wp-content/themes/used-car-lot/images/" . $folder_name .
        '/';
} else {
    $uploadsDirectory = ABSPATH . "wp-content/themes/used-car-lot/images/" . $_POST['detail_folder_name'] .
        '/';
}

// fieldname used within the file <input> of the HTML form

if (isset($_FILES['file'])) {
    foreach ($_FILES as $key => $value) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        //$file_type = $_FILES['file']['type'];
        $file_error = $_FILES['file']['error'];

        // Now let's deal with the upload

        // check for PHP's built-in uploading errors
        ($file_error == 0) or error($file_error, $link);

        // check that the file we are working on really was the subject of an HTTP upload
        @is_uploaded_file($file_tmp) or error('not an HTTP upload', $link);

        // validation... since this is an image upload script we should run a check
        // to make sure the uploaded file is in fact an image. Here is a simple check:
        // getimagesize() returns false if the file tested is not an image.
        @getimagesize($file_tmp) or error('only image uploads are allowed', $link);

        //removes # (numbers sign) from image filename below before temp filename is created
        // (Inventory tab will not display images with "#" in filename)
        $file_name = str_replace("#", "", $file_name);

        // make a unique filename for the uploaded file and check it is not already
        // taken... if it is already taken keep trying until we find a vacant one
        // sample filename: 1140732936-filename.jpg
        $prefix = 'main-';
        $now = time();
        while (file_exists($uploadFilename = $uploadsDirectory . $prefix . $now . '-' .
            $file_name)) {
            $now++;
        }

        // adds the image to the Wordpress Media Library
        // Check that the nonce is valid
        $attachment_id = null;
        if (isset($_POST['my_image_upload_nonce'], $_POST['post_id']) && wp_verify_nonce
            ($_POST['my_image_upload_nonce'], 'file')) {
            // The nonce was valid and the user has the capabilities, it is safe to continue.

            // These files need to be included as dependencies when on the front end.
            require_once (ABSPATH . 'wp-admin/includes/image.php');
            require_once (ABSPATH . 'wp-admin/includes/file.php');
            require_once (ABSPATH . 'wp-admin/includes/media.php');

            // Let WordPress handle the upload.
            // Remember, 'file' is the name of our file input in our form above.
            $attachment_id = media_handle_upload('file', $_POST['post_id']);

            if (is_wp_error($attachment_id)) {
                echo "There was an error uploading the image.";
                unset($_POST['post_id']);
                unset($_POST['my_image_upload_nonce']);
                unset($_POST['_wp_http_referer']);
            } else {
                echo "The image was uploaded successfully!";
                unset($_POST['post_id']);
                unset($_POST['my_image_upload_nonce']);
                unset($_POST['_wp_http_referer']);
            }

        } else {

            echo "Is detail image upload";
        }
        $image1 = NULL;
        // creates image filename for database
        $image1 = $prefix . $now . '-' . $file_name;
        //var_dump($image);

        //removes # (numbers sign) from image filename before adding it to the database below
        $image2 = str_replace("#", "", $image1);
        //var_dump($image1);

        //adds dashes to replace blank spaces in image file name
        $image3 = str_replace(" ", "-", $image2);

        //adds image name to $new_array
        $new_array['image_name'] = $image3;

        //gets WP attachment file upload path
        if (isset($attachment_id)) {
            $fullsize_path = get_attached_file($attachment_id);
            copy($fullsize_path, $uploadFilename);
        }

        //can't add data to a $_POST so make another array
        unset($_POST['submit']);
        foreach ($_POST as $key => &$value) {

            $new_array[$key] = $value;
            //var_dump($image1);

        }
        //adds date to $new_array
        $date = date('Y-m-d', current_time('timestamp', 0));
        $new_array['date'] = $date;
        
        $new_array['detail_folder_name'] = $folder_name;
        
        //var_dump($new_array);
        
        global $wpdb;

        //var_dump( isset( $wpdb ) );
        $date = date("Y-m-d");
        $table = $wpdb->prefix."cars";
        $wpdb->insert($table, $new_array);
    }
} elseif (isset($_FILES['files'])) {
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['files']['name'][$key];
        $file_tmp = $_FILES['files']['tmp_name'][$key];
        //$file_type = $_FILES['files']['type'][$key];
        $file_error = $_FILES['files']['error'][$key];

        $uploadsDirectory = ABSPATH . "wp-content/themes/used-car-lot/images/" . $_POST['detail_folder_name'] .
        '/';

        // Now let's deal with the upload

        // check for PHP's built-in uploading errors
        ($file_error == 0) or error($file_error, $link);

        // check that the file we are working on really was the subject of an HTTP upload
        @is_uploaded_file($file_tmp) or error('not an HTTP upload', $link);

        // validation... since this is an image upload script we should run a check
        // to make sure the uploaded file is in fact an image. Here is a simple check:
        // getimagesize() returns false if the file tested is not an image.
        @getimagesize($file_tmp) or error('only image uploads are allowed', $link);

        //removes # (numbers sign) from image filename below before temp filename is created
        // (Inventory tab will not display images with "#" in filename)
        $file_name = str_replace("#", "", $file_name);

        // make a unique filename for the uploaded file and check it is not already
        // taken... if it is already taken keep trying until we find a vacant one
        // sample filename: 1140732936-filename.jpg
        $prefix = 'detail-';
        $now = time();
        while (file_exists($uploadFilename = $uploadsDirectory . $prefix . $now . '-' .
            $file_name)) {
            $now++;
        }


        move_uploaded_file($file_tmp, $uploadFilename) or error('receiving directory insufficient permission',
            $link);

        $image4 = NULL;
        // creates image filename for database
        $image4 = $prefix . $now . '-' . $file_name;
        //var_dump($image);

        //removes # (numbers sign) from image filename before adding it to the database below
        $image5 = str_replace("#", "", $image4);
        //var_dump($image1);

        //adds dashes to replace blank spaces in image file name
        $image6 = str_replace(" ", "-", $image5);

        //adds image name to $new_array
        $new_array['image_name'] = $image6;

        //gets WP attachment file upload path

        //can't add data to a $_POST so make another array
        unset($_POST['submit']);
        foreach ($_POST as $key => &$value) {

            $new_array[$key] = $value;
            //var_dump($strp);

        }

        //adds date and detail_folder_name to $new_array
        $date = date('Y-m-d', current_time('timestamp', 0));
        $new_array['date'] = $date;
        $new_array['detail_folder_name'] = $_POST['detail_folder_name'];

        //var_dump($new_array);
        //die;
        global $wpdb;

        //var_dump( isset( $wpdb ) );
        $date = date("Y-m-d");
        if (isset($new_array['year'])) {
            
            $table = $wpdb->prefix."cars";
            
            } else {
            
            $table = $wpdb->prefix."cars_detail_image";
            
        }
        $wpdb->insert($table, $new_array);
    }
}
// The following function is an error handler which is used
// to output an HTML error page if the file upload fails
$page_title = 'Inventory';
$link = my_get_page_link($page_title);
function error($error)
{

    echo "
        <div id='Upload'><br /> 
            <h1>Upload failure</h1><br /> 
            <p>An error has occurred:<br /> 
            <span class='red'> $error </span><br /> 
             The upload form is reloading</p><br /> 
         </div> 
    ";
    exit;
} // end error handler
echo "<META http-equiv='refresh' content='2;URL=$link'>
        Upload Successfull";


?>

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>

