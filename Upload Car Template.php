<?php

/**
 * Template Name: Add Car
 * Description: A Page for Custom Coding
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <?php if ( current_user_can('manage_options') ) {    ?>
<html>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="James Haney" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory(); ?>wp-content/themes/used-car-lot/cars.css" />
    

	<title>Add Car</title>

<?php $page_title = 'Upload Car Processor';
$page = get_page_by_title( $page_title );
$link = $page->guid; ?>
<body id="background">
<h1 id="h1">Upload Form</h1><br />
<table id="body">
<form name="input" action="<?php echo $link; ?>" method="post" enctype="multipart/form-data"/>
<tr>
<td id="td">Year:<input type="text" name="year" size="20" /> </td>
<td id="td">Make:<input type="text" name="make" size="24" /></td>
<td id="td">Body Style:<input type="text" name="body_style" size="15" /></td>
<td id="td">Drivetrain:<input type="text" name="drivetrain" size="15" /> </td>

</tr>
<tr>
<td id="td">Trans:<input type="text" name="trans" size="18" /> </td>
<td id="td">Engine: <input type="text" name="engine" size="20" /></td>
<td id="td">Ext Color: <input  type="text" name="ext_color" size="15"/></td>
<td id="td">Int Color: <input type="text" name="int_color" size="15"/></td>

</tr>
<tr>
<td id="td">Mileage: <input type="text" name="mileage" size="15"/></td>
<td id="td">Vin Number: <input type="text" name="vin" size="15"/></td>
<td id="td" >Purch Price:$ <input type="text" name="purchase_price"size="15" /> </td>
<td id="td">Sale Price:$ <input type="text" name="sale_price" size="15"/></td>
</tr>
</table>
<br />
<input type="hidden" name="sold" value="no"/>
<br />
<div style="width: 100%; text-align: center;" >
<h2 style="color: #000;">Description:</h2><br />
<textarea cols="100" rows="5" name="description" style="color: #000; border: 1px solid #000;" >

</textarea>
</div><br />
<div style="text-align: center; color: #000;">
<h3 style="color: #000;">Note: An additional copy of the image is uploaded to the Wordpress Media Library. </h3><br />
<label id="label" for="file">Image File:</label>
<input type="file" name="file" id="file" /><br /><br />
<input type="hidden" name="post_id" id="post_id" value="0" /><br /> 
<?php wp_nonce_field( 'file', 'my_image_upload_nonce' ); ?>
<input type="submit" name="submit" value="Upload"/><br /><br />
</div>
</form>
</body>
</html>
<?php } ?>

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

