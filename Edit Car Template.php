<?php

/**
 * Template Name: Edit Car
 * Description: A Page for Custom Coding
 */

get_header(); ?>


    <div id="container">
			<!--<div id="content">-->

       <?php if (current_user_can('manage_options')) {
    $table = $wpdb->prefix."cars";
    $myrows = $wpdb->get_results("SELECT * FROM $table WHERE id = '$_POST[id]'",
        ARRAY_A);

    foreach ($myrows as $v) { ?>
<br />



	<link rel="stylesheet" type="text/css" href="<?php echo
get_stylesheet_directory_uri(); ?>/cars.css" />
	
<table id="body">
<form name="input" action="<?php echo get_stylesheet_directory_uri(); ?>/wp.update_car.php" method="post" enctype="multipart/form-data">
<body id="body"><h2 id="h2"><input type="hidden" name="id" size="4" readonly="readonly" value="<?php echo
$v['id']; ?>" /></h2>
<tr>
<td id="td">Year: <input type="text" name="year" value="<?php echo $v['year']; ?>"/></td>
<td id="td">Make: <input type="text" name="make" value="<?php echo $v['make']; ?>"/></td>
<td id="td">Body Style: <input type="text" name="body_style" value="<?php echo $v['body_style']; ?>"/></td>
<td id="td">Drivetrain: <input type="text" name="drivetrain" value="<?php echo $v['drivetrain']; ?>"/></td>

</tr>
<tr>
<td id="td">Trans: <input type="text" name="trans" value="<?php echo $v['trans']; ?>"/></td>
<td id="td">Engine: <input type="text" name="engine" size="15" value="<?php echo
$v['engine'] ?>" /></td>
<td id="td">Ext Color: <input  type="text" name="ext_color" size="15" value="<?php echo
$v['ext_color']; ?>"/></td>
<td id="td">Int Color: <input type="text" name="int_color" size="15" value="<?php echo
$v['int_color']; ?>"/></td>

</tr>
<tr>
<td id="td">Mileage: <input type="text" name="mileage" size="15" value="<?php echo
$v['mileage']; ?>"/></td>
<td id="td">Vin Number: <input type="text" name="vin" size="15" value="<?php echo
$v['vin']; ?>"/></td>
<td id="td">Price: <input type="text" name="sale_price" size="15" value="<?php echo
$v['sale_price']; ?>"/></td>
<td id="td">Sold: <input type="text" name="sold" size="15" value="<?php echo $v['sold']; ?>"/> 
</tr>
</table><br />
<div id="update">
<input type="submit" name="submit" value="Update"/>
</div>
<br />
</form>
</body>
</html>
<?php }
} else {
    echo "<b>You are not Authorized to access this page</b>";
} ?>


            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>

