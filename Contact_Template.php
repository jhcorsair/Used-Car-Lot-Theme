<?php

/**
 * Template Name: Contact
 * Description: A Page for Custom Coding
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <?php $current_user = wp_get_current_user();
 
     $opt = get_option( 'admin_email', false);
//    echo($opt)."<br />";

if( isset($_POST['id'])){
$id = $_POST['id']; }         
         
global $wpdb;

$table1 = $wpdb->prefix."cars";
   
 $wpdb->get_row("SELECT * FROM $table1 WHERE id=" . $_POST['id'], ARRAY_A);   
        
        //echo"<pre>";
//        print_r($wpdb);
//        echo "</pre>";
$page_title = 'Email';
$page = get_page_by_title($page_title);
$link = $page->guid;
?> 

<section style="text-align: left; width: 575px; margin: auto; color: #000;">
<form action="<?php echo $link; ?>" method="post">
To: <?php echo $opt; ?><br />
From: <?php echo $current_user->user_firstname." ".$current_user->user_lastname; ?><br />
<?php $table1 = $wpdb->prefix."cars";
$cars = $wpdb->get_results("SELECT * FROM $table1 WHERE `id`=" .$_POST['id'], ARRAY_A);
        foreach($cars as $car) { ?>
Subject: <?php echo $car['year']." ".$car['make']." ".$car['body_style'];  ?><br />
Message: <br /><textarea name="msg" cols="100" rows="10" style="border: 1px solid black;"> </textarea><br />
<input type="submit" name="submit" value="Send" />
<input type="hidden" name="subject" value="<?php echo $car['year']." ".$car['make']." ".$car['body_style'];} ?>" />
<input type="hidden" name="to_admin_email" value="<?php echo $opt; ?>" /><br />
<input type="hidden" name="from_user_fn" value="<?php echo $current_user->user_firstname; ?>" />
<input type="hidden" name="from_user_ln" value="<?php echo $current_user->user_lastname; ?>"  /><br />
<input type="hidden" name="from_user_email" value="<?php echo $current_user->user_email; ?>"  /><br />

</form>


</section><br /><br />
<?php ?>

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

