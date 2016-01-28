<?php

/**
 * Template Name: Display Cars
 * Description: A Page for Custom Coding
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/cars.css" />
<?php
  
 require_once'core/init.php';
 



//$DB = DB::getInstance();
//var_dump($DB);

$table1 = $wpdb->prefix."cars";
$myrows = $wpdb->get_results("SELECT * FROM $table1 WHERE sold = 'no'",ARRAY_A);
   if($myrows != false){
foreach ($myrows as $v){ 
     ?>
	
<div id="carswrapper">

    <div id="carsfonttop"><?php echo $v['year']." "; echo $v['make']." "; echo $v['body_style']; ?> </div>
    <div id="carsinnerwrapper">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $v['detail_folder_name'] ?>/<?php echo $v['image_name']; ?>"alt="Smiley face" height="100" width="150" />
    
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
    <?php echo $v['vin']; ?><br />
    
        
    </div>
    <div class="carsc3">
    <?php echo $v['sale_price']; ?><br /><br />
    <?php 
    if (current_user_can('read')) {
$page_title1 = 'Detail Display';  
 $page = get_page_by_title( $page_title1 );
 $link1 = $page->guid;  ?>
 <form action="<?php echo $link1;?>" method="post">
<input type="hidden" name="folder_name" value="<?php echo $v['detail_folder_name']; ?>" />
<input type="hidden" name="id" value="<?php echo $v['detail_folder_name']; ?>"/><input type="submit" value="Details" />
</form>
<?php }  ?>
  
<?php if (current_user_can('read')) {
 $page_title = 'Contact';
$page = get_page_by_title($page_title);
 $link = $page->guid; ?>    
<form action="<?php echo $link;?>" method="post">
<input type="hidden" name="id" value="<?php echo $v['id']; ?>"/><input type="submit" value="Inquire" />
</form>
  <?php  }   ?>
   </div>
    </div>
    <div id="carsfontbottom"></div>
</div><br />
<?php  } } else {
    
     
 $date = 'Y-m-d';
 
 $datas = array(    
        
        $data = array(
        'year' => '1970',
        'make' => 'Dart',
        'body_style' => 'Swinger',
        'engine' => '340 ci',
        'trans' => '4 speed',
        'drivetrain' => '2wd',
        'ext_color' => 'Red',
        'int_color' => 'Black',
        'mileage' => '35',
        'vin' => '32165653',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
        Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through 
        the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" 
        (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. 
        The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',
        'detail_folder_name' => '70-Dart-Swinger-11-33-52pm',
        'image_name' => 'dart.jpg',
        'purchase_price' => '15000',
        'sale_price' => '17500',
        'sold' => 'no',
        'date' => $date = 'Y-m-d'),
          

        $data = array(
        'year' => '1968',
        'make' => 'Pontiac',
        'body_style' => 'GTO',
        'engine' => '400 ci',
        'trans' => '4 speed',
        'drivetrain' => '2wd',
        'ext_color' => 'Green',
        'int_color' => 'Black',
        'mileage' => '50000',
        'vin' => '32165653',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
        Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through 
        the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" 
        (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. 
        The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',
        'detail_folder_name' => '1968-pontiac-gto',
        'image_name' => 'L-GTO-1968.jpg',
        'purchase_price' => '12000',
        'sale_price' => '14995',
        'sold' => 'no',
        'date' => $date = 'Y-m-d'),
    
        $data = array(
        'year' => '1970',
        'make' => 'Plymouth',
        'body_style' => 'Cuda',
        'engine' => '340 Magnum',
        'trans' => '4 speed',
        'drivetrain' => '2wd',
        'ext_color' => 'Midnight Blue',
        'int_color' => 'Black',
        'mileage' => '50000',
        'vin' => '32165653',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
        Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through 
        the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" 
        (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. 
        The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',
        'detail_folder_name' => '1970-plymouth-cuda',
        'image_name' => 'Plymouth-Hemi-Cuda-1.jpg',
        'purchase_price' => '20000',
        'sale_price' => '39000',
        'sold' => 'no',
        'date' => $date = 'Y-m-d'),

        
        $data = array(
        'year' => '1970',
        'make' => 'Plymouth',
        'body_style' => 'Superbird',
        'engine' => '440 ci',
        'trans' => '4 speed',
        'drivetrain' => '2wd',
        'ext_color' => 'Orange',
        'int_color' => 'Black',
        'mileage' => '50',
        'vin' => '32165653',
        'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
        Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through 
        the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" 
        (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. 
        The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.',
        'detail_folder_name' => '1970-plymouth-superbird',
        'image_name' => 'superbird.jpg',
        'purchase_price' => '100000',
        'sale_price' => '139000',
        'sold' => 'no',
        'date' => $date = 'Y-m-d')

     );
     
     $table1 = $wpdb->prefix."cars";
          
     foreach($datas as $data){
                       
         $db = DB::getInstance()->insert($table1, $data);
     }
       
       $date = 'Y-m-d';
    $detail_folder_load = array(
    
        $file = array(
            'detail_folder_name' => '70-Dart-Swinger-11-33-52pm',
            'image_name' => 'detail-1451071980-dart.jpg',
            'date' => $date = 'Y-m-d'),
    
        $file = array(
            'detail_folder_name' => '70-Dart-Swinger-11-33-52pm',
            'image_name' => 'detail-1451071980-dart2.jpg',
            'date' => $date = 'Y-m-d'),
        
        $file = array(
            'detail_folder_name' => '1968-pontiac-gto',
            'image_name' => 'detail-1451072484-pontiac1.jpg',
            'date' => $date = 'Y-m-d'),
            
        $file = array(
            'detail_folder_name' => '1968-pontiac-gto',
            'image_name' => 'detail-1451072484-pontiac2.jpg',
            'date' => $date = 'Y-m-d'),
        $file = array(
            'detail_folder_name' => '1970-plymouth-cuda',
            'image_name' => 'detail-1451091758-cuda1.jpg',
            'date' => $date = 'Y-m-d'),
        $file = array(
            'detail_folder_name' => '1970-plymouth-cuda',
            'image_name' => 'detail-1451091758-cuda2.jpg',
            'date' => $date = 'Y-m-d'),
        $file = array(
            'detail_folder_name' => '1970-plymouth-superbird',
            'image_name' => 'detail-1451093608-superbird1.jpg',
            'date' => $date = 'Y-m-d'),
        $file = array(
            'detail_folder_name' => '1970-plymouth-superbird',
            'image_name' => 'detail-1451093608-superbird2.jpg',
            'date' => $date = 'Y-m-d'),
        
 );
    $table2 = $wpdb->prefix."cars_detail_image";
        
     foreach($detail_folder_load as $file){
                       
         $db = DB::getInstance()->insert($table2, $file);
     }
    
    
$page_title = 'Inventory';
$uploadpage = get_page_by_title($page_title);
$link = $uploadpage->guid;

echo "<META http-equiv='refresh' content='2;URL=$link'>
        Demo Loaded Successfully"; 

}
?>

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

