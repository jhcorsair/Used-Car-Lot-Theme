<?php

/**
 * Template Name: Detail Img Upload
 * Description: A Page for Custom Coding
 */

get_header(); ?>


    <div id="container">
			<!--<div id="content">-->

        <?php if ( current_user_can('manage_options') ) {   
$page_title = 'Upload Car Processor';
$page = get_page_by_title( $page_title );

        $link = $page->guid; ?>
<div style="text-align: center; color: #000;"><h2>Select Detail Image</h2> </div><br />        
<form action="<?php echo $link;?> " method="post" enctype="multipart/form-data" >
<?php $table = $wpdb->prefix."cars";
    $cars = $wpdb->get_results("SELECT * FROM $table WHERE id = '$_POST[id]'",ARRAY_A);

foreach($cars as $v){ ?>
<input type="hidden" name="detail_folder_name" value="<?php echo $v['detail_folder_name']; } ?>" />
      

<div style="width: 100%; ">
<div style="width: 800px; text-align: center; margin: auto; color: #000; ">
<label id="label" for="file">Image File:</label>
<input type="file" name="files[]" id="file" multiple="" /><br /><br /> 
<input type="submit" name="submit" value="Upload"/><br /><br />

</form>
</div>
</div>
<?php } ?>

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

