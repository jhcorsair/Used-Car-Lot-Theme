<?php

/**
 * Template Name: Email
 * Description: A Page for Custom Coding
 */

if (current_user_can('manage_options')) {    get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <?php unset($_POST['submit']);

//gets email server options 
//$options = get_option('cars_options');
//print_r($options);


$to = "$_POST[to_admin_email]";
$subject = "$_POST[subject]";
$message = "$_POST[msg]";
$i = wp_mail( $to, $subject, $message ); 
    if($i){
    echo "<meta http-equiv='refresh' content='2;URL=http:$_SERVER[SERVER_NAME]/wordpress'>"; 
    echo "Mail Sent";}
    else { echo "Mail Send Failed";} ?>
    
    

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); } ?>

