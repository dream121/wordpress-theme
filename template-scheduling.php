<?php
  /**
 * Template Name: Scheduling Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

  if (!defined('ABSPATH')) die();

  global $der_framework; 
  
  get_header('scheduling'); ?>
<div id="locations" class="">
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