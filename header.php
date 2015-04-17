<?php
  global $der_framework, $content_width;
  
  $favicon = $der_framework->option('favicon');

  $grid = $der_framework->option('content_width'); // Default is set

  switch ($grid) {
    case '960': $grid = 980; break;
    case '1170': $grid = 1200; break;
  }
  
  $boxed_layout = $der_framework->option_bool('boxed_layout');
  
  $sticky_header = ($boxed_layout === false) && $der_framework->option_bool('sticky_header');
  
?><!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9 gt8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)]><html class="ie gt8 gt9" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE)]><!--><html class="not-ie" <?php language_attributes(); ?>><!--<![endif]-->
<head>

<title><?php wp_title('&#150;',true, 'right'); bloginfo('name'); ?></title>
<meta charset="<?php bloginfo('charset'); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<?php 

  if ($favicon) {
    
?>
<link rel="shortcut icon" type="<?php echo theme_get_image_mimetype($favicon); ?>" href="<?php echo $favicon; ?>" />
<?php 

  } else { 
    
?>
<link rel="shortcut icon" type="image/png" href="<?php echo $der_framework->uri("core/images/favicon.png", THEME_VERSION); ?>" />
<?php 

  }
  
  $ios_display = $der_framework->option('ios_icon_display') == 'normal' ? "apple-touch-icon" : "apple-touch-icon-precomposed";
  
  $touch_icons = array(
    'touch_icon_57' => 57,
    'touch_icon_72' => 72,
    'touch_icon_114' => 114,
    'touch_icon_144' => 144
  );
  
  foreach ($touch_icons as $key => $size) {
    $val = $der_framework->option($key);
    if ($val) {
      printf('<link rel="%s" sizes="%dx%d" href="%s" />' . "\n", $ios_display, $size, $size, $val);
    }
  }
  
?>

<?php wp_head() ?>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri() ?>/custom_jquery-front.js'></script>
<script>
jQuery('document').ready(function(){
     jQuery('#scriptlocation').change(function(){
	    var selectval = jQuery('#scriptlocation').val();
				 jQuery('#btnscript').click(function(){
			        jQuery('#btnscript').attr('href', 'mailto:'+selectval); 
			 });
		
     });
	    jQuery('#physch').change(function(){
			
	      var selectcityval = jQuery('#physch').val();
		   var cururl = window.location.href;
		    var urlq =  cururl.slice(0,-1);
	        var result =urlq.substring(urlq.lastIndexOf("/") + 1);
		     var newurl = cururl.replace(result,selectcityval);
				 jQuery('#btnphysch').click(function(){
			        jQuery('#btnphysch').attr('href', newurl); 
			 });
		
     });
	 
});

</script>
<script type="text/javascript">
  jQuery(document).ready(function($){
  //debugger;

    //hide all inputs except the first one
    jQuery('p.hide').not(':eq(0)').hide();

    //functionality for add-file link
	  
    jQuery('a.add_file').on('click', function(e){
	   
      //show by click the first one from hidden inputs
      jQuery('p.hide:not(:visible):first').show('slow');
	  jQuery('p.hide:not(:visible):last').next('a.add_file').hide('slow');
      e.preventDefault();
	   
    });
	

    //functionality for del-file link
    jQuery('a.del_file').on('click', function(e){
      //var init
      var input_parent = jQuery(this).parent();
      var input_wrap = input_parent.find('span');
      //reset field value
      input_wrap.html(input_wrap.html());
      //hide by click
      input_parent.hide('slow');
      e.preventDefault();
    });
  });
</script>
</head>
<body <?php body_class() ?> data-widescreen="<?php echo ($grid == 1200) ? 'true' : 'false'; ?>">
  
<?php if ($boxed_layout): ?><div id="boxed-wrapper"><?php endif; ?>

<header role="banner"<?php if ($sticky_header): ?> data-sticky="true" data-sticky-distance="<?php echo $der_framework->option('sticky_distance') ?>" data-sticky-min-logo-height="<?php echo $der_framework->option('min_logo_height') ?>" data-sticky-offset="<?php echo $der_framework->option('sticky_offset') ?>" data-sticky-mobile="<?php echo $der_framework->option_bool('sticky_mobile') ? 'true' : 'false' ?>"<?php endif; ?>>

<div id="" class="tp-link">
<a href="<?php echo site_url();?>/patients/"><img src="<?php echo get_template_directory_uri(); ?>/core/images/Patient_Button.png" width="200" height="60" border="0" alt=""></a>

    <a href="<?php echo site_url();?>/physician/"><img src="<?php echo get_template_directory_uri(); ?>/core/images/Physician_Button.png" width="200" height="60" border="0" alt=""></a>
	
</div>
<!-- <a class="face-head" title="Facebook" target="_blank" href="https://www.facebook.com/ahicenters?ref=br_tf">
<img width="43px" height="43px" alt="fb" src="<?php echo get_template_directory_uri(); ?>/core/images/fb-small.png">
</a> -->
<?php

  $topbar_display = $der_framework->option_bool('topbar_display');
  
  if ($topbar_display) {
    
    $social_icons_align = $der_framework->option('topbar_social_icons_align', 'right');
  
    $social_icons_enabled = $der_framework->option_bool('topbar_social_icons_display');
  
    if ($social_icons_enabled) {
      $social_icons = $der_framework->get_option('social_data');
      if (empty($social_icons)) {
        $social_icons_enabled = false;
      } else {
        $social_icons_hover_style = $der_framework->option('header_social_icons_hover_style');
        $social_icon_tooltips = $der_framework->option_bool('topbar_social_icon_tooltips');
        $social_options = array();
        if ($social_icons_hover_style == 'simple') $social_options[] = 'nobrandcolor';
      }
    }
  
    $topbar_text = $der_framework->option_bool('topbar_text_display') ? $der_framework->option('topbar_text') : '';
  
    if ($topbar_text && $der_framework->option('topbar_text_mode') == 'text') {
      $topbar_text = esc_html($topbar_text);
    }
    
    if ($topbar_text) $topbar_text = theme_mini_shortcode($topbar_text);
    
  }

  if ( $topbar_display && ($topbar_text || ($social_icons_enabled && !empty($social_icons))) ):

    $show_toggle = !empty($topbar_text) && !empty($social_icons);
  
    if ($show_toggle) $topbar_hide_on_mobile = $der_framework->option('topbar_hide_on_mobile', 'text');
  
?>
  <section id="topbar">
    <div class="container clearfix">
      <?php if (!empty($topbar_text)): ?><aside <?php if ($show_toggle && $topbar_hide_on_mobile == 'text'): ?>class="noshow" <?php endif; ?>data-align="<?php echo $der_framework->flip_value($social_icons_align); ?>"><?php echo $topbar_text; ?></aside><?php endif; ?>
<?php 

  if ($social_icons_enabled && $social_icon_tooltips) {
    
    $tooltip_options = "placement: bottom, delay.show: 200, delay.hide: 80, container: body";
    
?>
      <ul class="social-icons tooltips clearfix<?php echo ($show_toggle && $topbar_hide_on_mobile == 'social') ? " noshow" : '';  ?>" data-align="<?php echo $social_icons_align; ?>"<?php echo theme_options_attr(" data-options", $social_options); ?> data-tooltip-options="<?php echo $tooltip_options; ?>">
<?php 

  } else if ($social_icons_enabled) {
    
?>
      <ul class="social-icons clearfix<?php echo ($show_toggle && $topbar_hide_on_mobile == 'social') ? " noshow" : '';  ?>" data-align="<?php echo $social_icons_align; ?>">
<?php 
      
  }

  if ($social_icons_enabled) {
    
    $social_color = $der_framework->color_theme_option('header_social_icons_color', 'black');
    
    foreach ($social_icons as $id => $item) {

?>
        <li<?php if ($social_icon_tooltips): ?> title="<?php echo isset($item['title']) ? esc_html($item['title']) : '' ?>"<?php endif; ?>><a class="social-<?php echo $social_color; ?>-24 <?php echo $id; ?>" href="<?php echo isset($item['url']) ? $item['url'] : '' ?>"></a></li>
<?php

    }

  }
  
?>
      <?php if ($social_icons_enabled): ?></ul><!-- .social-icons --><?php endif; ?>
    </div><!-- .container -->
  </section><!-- topbar -->
<?php
  
  endif; // Topbar display condition
  
  $logo_align = $der_framework->option('logo_align');
  
  $nav_bottom_sep = (int) $der_framework->option('navigation_bottom_sep');

?>
  <section id="nav-logo" data-nav-bottom-sep="<?php echo $nav_bottom_sep; ?>">
    <div class="container clearfix">
      <div id="logo" class="hover-effect" data-align="<?php echo $logo_align; ?>" style="<?php printf("padding: 15px 0;", (int) $der_framework->option('logo_padding')); ?>">
<?php

  $logo_image = $der_framework->option('logo_image');
  $retina_logo_image = $der_framework->option('retina_logo_image');
  
  if (empty($logo_image) && $retina_logo_image) {

    $size = $der_framework->get_option('retina_logo_image_size');
    
    $size[0] = floor($size[0]/2);
    $size[1] = floor($size[1]/2);
    
?>
        <a href="<?php echo home_url(); ?>"><img alt="<?php bloginfo('name') ?>" style="<?php theme_dimstyle($size[0], $size[1]); ?>" src="<?php echo $retina_logo_image; ?>" /></a>
<?php

  } else if ($logo_image && empty($retina_logo_image)) {
    
    $size = $der_framework->get_option('logo_image_size');
    
?>
        <a href="<?php echo home_url(); ?>"><img alt="<?php bloginfo('name') ?>" style="<?php theme_dimstyle($size[0], $size[1]); ?>" src="<?php echo $logo_image; ?>" /></a>
<?php

  } else if ($logo_image && $retina_logo_image) {

    $size = $der_framework->get_option('logo_image_size');
    $size_retina = $der_framework->get_option('retina_logo_image_size');

?>
        <a href="<?php echo home_url(); ?>"><img alt="<?php bloginfo('name') ?>" style="<?php theme_dimstyle(floor($size_retina[0]/2), floor($size_retina[1]/2)); ?>" src="<?php echo $retina_logo_image; ?>" /></a>
<?php 

  } else {
    
?>
        <a href="<?php echo home_url(); ?>"><img alt="<?php bloginfo('name') ?>" style="<?php theme_dimstyle(142, 27); ?>" src="<?php echo $der_framework->uri("core/images/logo-hd.png", THEME_VERSION); ?>" /></a>
<?php 

  }
  
  $show_search = $der_framework->option_bool('show_header_search');
  
?>
      </div><!-- logo -->
      
    </div><!-- .container -->
			
<div id="nav-container" class="clearfix" data-align="<?php echo $der_framework->flip_value($logo_align); ?>"<?php echo ($logo_align == "center") ? sprintf(' style="padding-bottom: %dpx;"', $nav_bottom_sep) : '' ?>>
<div class="menu-lft"> </div>
<div class="menu-mid">
	<ul id="navigation" class="hidden-phone fallback <?php echo $show_search ? "" : "search-disabled " ?>clearfix" data-align="<?php echo $der_framework->flip_value($logo_align); ?>">
	<?php
	if ($show_search && $logo_align == 'right') echo theme_header_search();

	echo $der_framework->menu('header-navigation');
	echo '<li class="MyRadLink">
<a id="myRadimage" class="top_link" title="My Rad" target="_blank" href="https://viztek.ahicenters.com/Viztek.RIS.PatientPortal/Default.aspx">
<img title="My RAD" alt="My RAD" src="'.get_template_directory_uri().'/core/images/MyRAD.png">
</a>
</li>';
	if ($show_search && ($logo_align == 'left' || $logo_align == 'center')) echo theme_header_search();

	?>
	</ul><!-- navigation -->
	</div>
	<div class="menu-rht"> </div>
	</div><!-- nav-container -->

  </section><!-- nav-logo -->
<div id="hm-slider" class="">
	<?php 	
	if (is_front_page() || is_home()) {
	}
	//Get Featured image for page.
	if(get_the_post_thumbnail( $posts[0]->ID, 'full' )){
		echo get_the_post_thumbnail( $posts[0]->ID, 'full' );
	}
	
	?>
</div>
</header>