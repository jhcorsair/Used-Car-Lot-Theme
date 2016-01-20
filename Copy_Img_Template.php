<?php

/**
 * Template Name: Copy Img
 * Description: A Page for Custom Coding
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <?php

/**
 * @author James Haney
 * @copyright 2012
 */
 //Maximize script execution time
//$themeroot = wp_get_theme();
ini_set('max_execution_time', 0);

//Initial settings, Just specify Source and Destination Image folder.
$ImagesDirectory    = 'C:/xampp/htdocs/wordpress/wp-content/themes/used-car-lot/uploaded_files/'; //Source Image Directory End with Slash
$DestImagesDirectory    = 'C:/xampp/htdocs/wordpress/wp-content/Cimy_Header_Images/0/'; //Destination Image Directory End with Slash
$NewImageWidth      = 500; //New Width of Image
$NewImageHeight     = 200; // New Height of Image
$Quality        = 80; //Image Quality

//Open Source Image directory, loop through each Image and resize it.
if($dir = opendir($ImagesDirectory)){
    while(($file = readdir($dir))!== false){

        $imagePath = $ImagesDirectory.$file;
        $destPath = $DestImagesDirectory.$file;
        $checkValidImage = @getimagesize($imagePath);

        if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
        {
            //Image looks valid, resize.
            if(resizeImage($imagePath,$destPath,$NewImageWidth,$NewImageHeight,$Quality))
            {
                echo $file.' resize Success!<br />';
                /*
                Now Image is resized, may be save information in database?
                */

            }else{
                echo $file.' resize Failed!<br />';
            }
        }
    }
    closedir($dir);
}

//Function that resizes image.
function resizeImage($SrcImage,$DestImage, $MaxWidth,$MaxHeight,$Quality)
{
    list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);
    $ImageScale             = min($MaxWidth/$iWidth, $MaxHeight/$iHeight);
    $NewWidth               = ceil($ImageScale*$iWidth);
    $NewHeight              = ceil($ImageScale*$iHeight);
    $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);

    switch(strtolower(image_type_to_mime_type($type)))
    {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            $NewImage = imagecreatefromjpeg($SrcImage);
            break;
        default:
            return false;
    }

    // Resize Image
    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
    {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}

?>



            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

