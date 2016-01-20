<?php

/**
 * Template Name: Add Detail Image
 * 
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cars.css" />
<?php
if ( current_user_can('manage_options') ) {   

$table = $wpdb->prefix."cars";
    
$myrows = $wpdb->get_results("SELECT * FROM $table WHERE sold = 'no'",ARRAY_A);

foreach ($myrows as $v){ ?>
	
<div id="carswrapper">

    <div id="carsfonttop"><?php echo $v['year']." "; echo $v['make']." "; echo $v['body_style']; ?> </div>
    <div id="carsinnerwrapper">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $v['detail_folder_name']; ?>/<?php echo $v['image_name']; ?>" alt="Smiley face" height="100" width="150" />
    
    <div class="carsc1">
    Engine:<br />
    Transmission:<br />
    Drivetrain:<br />
    Mileage:<br />
    </div>
    <div class="carsc2">
    <?php echo $v['engine']; ?><br />
    <?php echo $v['trans']; ?><br />
    <?php echo $v['drivetrain']; ?><br />
    <?php echo $v['mileage']; ?>
    </div>
    <div class="carsc1">
    Ext. Color:<br />
    Int. Color:<br />
    Vin #: <br />
    
    </div>
    <div class="carsc2">
    <?php echo $v['ext_color']; ?><br />
    <?php echo $v['int_color']; ?><br />
    <?php echo $v['vin']; ?>
        
    </div>
    <div class="carsc3">
    $<?php echo $v['sale_price']; ?><br /><br />
<?php $page_title = 'Detail Image Upload';
$page = get_page_by_title($page_title);
 $link = $page->guid; ?>    
<form action="<?php echo $link;?>" method="post">
<input type="hidden" name="id" value="<?php echo $v['id']; ?>"/><input type="submit" value="Add Detail Image" />
</form>
    </div>
    </div>
    <div id="carsfontbottom"></div>
</div><br />
<?php  } }?>
 



            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

