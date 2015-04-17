<?php
  
  global $der_framework;
  
  $der_framework->in_footer = true;
  
  if ($der_framework->option_bool('enable_twitterbar')) {

    $twitterbar_username = $der_framework->option('twitterbar_username');
    $twitterbar_tweet_count = (int) $der_framework->option('twitterbar_tweet_count');
  
    if ($twitterbar_username && $twitterbar_tweet_count > 0) {

      $twitterbar_options = array(
        'username' => preg_replace('/^@/', '', $twitterbar_username),
        'count' => $twitterbar_tweet_count,
        'autoplay' => $der_framework->option_bool('twitterbar_autoplay'),
        'delay' => $der_framework->option('twitterbar_delay'),
        'pauseOnHover' => $der_framework->option_bool('twitterbar_pause_on_hover')
      );

?>

<section id="twitter-bar" <?php echo theme_options_attr("data-twitterbar-options", $twitterbar_options); ?>>
  <div class="container tooltips clearfix">
    <a class="twitter-icon" target="_blank" href="http://twitter.com/<?php echo $twitterbar_username ?>" title="<?php printf(__("Follow %s on Twitter", "theme"), $twitterbar_username) ?>"><i class="icon-twitter"></i></a>
    <p class="tweet"> <i class="icon-spinner icon-spin"></i> </p>
  </div><!-- .container -->
</section><!-- twitter-bar -->
<?php

    } // If enough data to proceed
  
  } // If twitterbar enabled

?>

<footer role="contentinfo">
<?php

  $widgets_enabled = $der_framework->option_bool('footer_widgets_enabled');

  $der_framework->layout->container_columns = 3;

  if ($widgets_enabled) {

?>
  <div class="container">
    <div class="row">
      
      <div class="footer-left widget-column item span3">
        
<?php dynamic_sidebar("Footer C1"); ?>
        
      </div><!-- .widget-column -->
      
      <!-- + -->
      
      <div class="footer-menu widget-column item span3">
        
<?php dynamic_sidebar("Footer C2"); ?>
        
      </div><!-- .widget-column -->
      
      <!-- + -->
      
      <div class="footer-right  widget-column item span3">
        
<?php dynamic_sidebar("Footer C3"); ?>
        
      </div><!-- .widget-column -->
      
      <!-- + -->
      
      <div class="widget-column item span3">

<?php dynamic_sidebar("Footer C4"); ?>

      </div><!-- .widget-column -->
      
    </div><!-- .row -->
  </div><!-- .container -->
<?php

  } // If footer widgets are enabled

?>
  <!-- + -->
  
  <div class="bottom-bar<?php echo (!$widgets_enabled) ? ' extra-padding' : '' ?>">
    
    <div class="container">
<?php

  if ($der_framework->option_bool("footer_social_icons")) {

    $social_icons = $der_framework->get_option("social_data");

    if ($social_icons) {

      $social_color = $der_framework->color_theme_option('footer_social_icons_color', 'white');
    
      $social_icon_tooltips = $der_framework->option_bool("footer_social_tooltips");
    
?> 
      <ul class="social-icons-mono<?php echo ($social_icon_tooltips) ? " tooltips" : "" ?> clearfix" data-tooltip-options="animation: false, container: false, delay.show: 250, delay.hide: 80">
<?php foreach ($social_icons as $id => $item) { ?>
        <li><a<?php if ($social_icon_tooltips): ?> title="<?php echo isset($item['title']) ? esc_html($item['title']) : '' ?>"<?php endif; ?> class="social-<?php echo $social_color; ?>-24 <?php echo $id; ?>" href="<?php echo isset($item['url']) ? $item['url'] : '' ?>"></a></li>
<?php } ?>
      </ul>
<?php

    } // If there are social icons

  } // If social icons are enabled

  $footer_copyright = $der_framework->option('footer_copyright');
  
  if (empty($footer_copyright)) {
    
    $footer_copyright = 'Copyright &copy;2013 <a href="'. home_url() .'">'. get_bloginfo('name') .'</a>
&nbsp;|&nbsp; A WordPress theme by <a href="http://themeforest.net/user/der?ref=der">der</a> 
&nbsp;|&nbsp; Proudly powered by <a href="http://wordpress.org">WordPress</a>';

  } else {
    $footer_copyright = theme_mini_shortcode($footer_copyright);
  }
  
?>
      <p><?php echo $footer_copyright; ?></p>
      
    </div><!-- .container -->
    
  </div><!-- .bottom-bar -->
  
</footer>

<?php wp_footer(); ?>

</body>
</html>