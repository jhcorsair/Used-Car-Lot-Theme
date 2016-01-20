<?php

/**
 * Template Name: Detail Display
 * Description: A Page for Custom Coding
 */

get_header();?>


    <div id="container">
			<!--<div id="content">-->

        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/slider.css"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/java.js"></script> 
    
    

<body>
        
<?php  
 
    global $wpdb;
        
        $table1 = $wpdb->prefix."cars_detail_image";
        $files = $wpdb->get_results("SELECT * FROM $table1 WHERE detail_folder_name = '$_POST[id]'",ARRAY_A); 
            
           
            
        foreach($files as $file)  ?>
                  

<section class="demo">

  <button class="next">Next</button>
  <button class="prev">Previous</button>
  <div class="container">
  
    <div style="display: inline-block;">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $files[0]['detail_folder_name']; ?>/<?php echo $files[0]['image_name']; ?>" alt="No images to display"/>
    </div> <?php  ?>
    
    <?php $i = 0;
    
        $table1 = $wpdb->prefix."cars";
				 $files = $wpdb->get_results("SELECT * FROM $table1 WHERE detail_folder_name = '$_POST[id]'",ARRAY_A); 
            foreach($files as $file){  ?>
    <div>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/<?php echo $files[$i]['detail_folder_name']; ?>/<?php echo $files[$i]['image_name'];?>" alt="No images to display"/>
    </div> <?php $i++;  }  ?>
    
    
  </div>
</section>
	<?php $table2 = $wpdb->prefix."cars";
    $files = $wpdb->get_results("SELECT * FROM $table2 WHERE detail_folder_name = '$_POST[id]'",ARRAY_A); 
		foreach($files as $file) { ?>
<p style="color: #000;"> <?php echo wp_kses_decode_entities("$file[description]"); ?> </p> <?php } ?>

</body>
</html> <?php  
    //$page_title = 'Inventory';
//$uploadpage = get_page_by_title($page_title);
//$link = $uploadpage->guid;
//
//echo "<meta http-equiv='refresh' content='3;URL=$link'>";
//      echo "There are no images to display."; 
 ?>
 
 

            <!--</div><!-- #content -->
    </div><!-- #container -->

<?php //get_sidebar();?>
<?php get_footer(); ?>

