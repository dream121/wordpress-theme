<?php

  /* Pages */

  if (!defined('ABSPATH')) die();

  global $der_framework; 
  
  get_header(); ?>

  <div id="inner-pages" class="">
  <?php if(is_page(385)){
	  echo "<style>body .about-ahi h2{ text-align:right;width:94%}</style>";
  }else{}?>
	<?php 
		if ($der_framework->has_layout('page_layout')) {

    $der_framework->render_layout();

  } else {

    theme_default_content();
    
  }

	?>
  </div>
  <?php
  get_footer();
  
?>