<?php

  add_shortcode('title_heading', 'meteor_title_heading');
  add_shortcode('skill', 'meteor_skillset');
  add_shortcode('accordion', 'meteor_accordion');
  add_shortcode('tab', 'meteor_tabs');
  add_shortcode('quote', 'meteor_quote');
  add_shortcode('toggle', 'meteor_toggle');
  add_shortcode('clear', 'meteor_styling_shortcodes');
  add_shortcode('push', 'meteor_styling_shortcodes');
  add_shortcode('hidden', 'meteor_visibility_shortcode');
  add_shortcode('visible', 'meteor_visibility_shortcode');
  add_shortcode('container', 'meteor_container_shortcode');
  
  function meteor_container_shortcode($atts, $content='', $code='') { global $der_framework;
    return '<div class="container">' . "\n" . $der_framework->shortcode($content) . "\n" . '</div><!-- .container -->';
  }

  function meteor_visibility_shortcode($atts, $content='', $code='') { global $der_framework;

    $atts = (array) $atts;

    $defaults = array(
      'on' => null,
      'margin' => null,
      'padding' => null
    );
    
    $args = shortcode_atts($defaults, $atts);
    
    $args['mode'] = $code;
    $args['content'] = $der_framework->shortcode(remove_br($content));
    
    foreach (array('margin', 'padding') as $opt) {
      if (isset($args[$opt])) {
        $args[$opt] = preg_replace('/\;$/', '', $args[$opt]);
        if (preg_match('/^[\-]*\d+$/', $args[$opt])) $args[$opt] .= 'px';
      }
    }
    
    return $der_framework->render_template('meteor-visibility.mustache', $args);
    
  }

  function meteor_styling_shortcodes($atts, $content='', $code='') { global $der_framework;

    $atts = (array) $atts;
    $out = null;

    switch ($code) {
      
      case 'clear':
        $out = '<div class="clear"></div>';
        break;
        
      case 'push':
      
        $args = shortcode_atts(array(
          'height' => '1em',
          'margin' => null,
          'class' => null
        ), $atts);
        
        if (preg_match('/^\d+$/', $args['height'])) $args['height'] .= 'px';
        if (isset($args['margin'])) $args['margin'] = preg_replace('/\;$/', '', $args['margin']);
        if (isset($args['class'])) $args['class'] = ' ' . $args['class'];
        
        $out = sprintf('<div class="push%s" style="height: %s !important; margin: %s !important;"></div>', $args['class'], $args['height'], $args['margin']);
        
        break;
      
    }
    
    return $out . "\n";
    
  }
  

  function meteor_toggle($atts, $content='', $code='') { global $der_framework;

    $atts = (array) $atts;

    $defaults = array(
      'title' => null,
      'icon' => null
    );

    $args = wp_parse_args($atts, $defaults);

    $args['title'] = theme_mini_shortcode($args['title']);
    $args['title'] = apply_filters('the_title', $args['title']);
    $args['content'] = $der_framework->content($content);
    
    if (in_array('active', $atts)) {
      $args['active'] = true;
    }
    
    if (in_array('medium', $atts)) {
      $args['size'] = 'medium';
    } else if (in_array('small', $atts)) {
      $args['size'] = 'small';
    } else {
      $args['size'] = 'large';
    }

    return $der_framework->render_template('meteor-toggle.mustache', $args);
    
  }

  function meteor_quote($atts, $content='', $code='') { global $der_framework;
  
    $defaults = array(
      'author' => null,
      'description' => null,
      'url' => null,
      'content' => null
    );

    $args = wp_parse_args($atts, $defaults);
    
    if (empty($content) && isset($args['content'])) {
      $content = $args['content'];
    }
    
    $content = theme_mini_shortcode(remove_br($content));
    
    $args['content'] = $der_framework->content($content, false);
  
    return $der_framework->render_template('meteor-quote.mustache', $args);
  
  }

  function meteor_tabs($atts, $content='', $code='') { global $der_framework;
    
    $atts = (array) $atts;
    
    $defaults = array(
      'title' => null,
      'icon' => null
    );
    
    $args = wp_parse_args($atts, $defaults);
    
    if (in_array('active', $atts)) $args['active'] = true;
    if (in_array('first', $atts)) $args['first'] = true;
    if (in_array('last', $atts)) $args['last'] = true;
    
    $args['content'] = $der_framework->content(remove_br($content));
    
    return $der_framework->render_template('meteor-tabs.mustache', $args);
    
  }
  

  function meteor_accordion($atts, $content='', $code='') { global $der_framework;

    $atts = (array) $atts;
    
    $defaults = array(
      'title' => null
    );
    
    $args = wp_parse_args($atts, $defaults);
    
    if (in_array('active', $atts)) $args['active'] = true;
    if (in_array('first', $atts)) $args['first'] = true;
    if (in_array('last', $atts)) $args['last'] = true;
    
    $args['content'] = $der_framework->content(remove_br($content));
    
    return $der_framework->render_template('meteor-accordion.mustache', $args);
    
  }
  

  function meteor_skillset($atts, $content='', $code='') { global $der_framework;
    
    $atts = (array) $atts;
    
    $defaults = array(
      'title' => $content,
      'percent' => '5',
      'icon' => null
    );
    
    $args = wp_parse_args($atts, $defaults);

    if (in_array('first', $atts)) {
      $args['first'] = true;
    } else if (in_array('last', $atts)) {
      $args['last'] = true;
    }

    $args['title'] = theme_mini_shortcode($args['title']);
    $args['percent'] = (int) $args['percent'];
    $args['icon'] = preg_replace('/^icon-/', '', $args['icon']);
    
    return $der_framework->render_template('meteor-skills.mustache', $args);

  }


  function meteor_title_heading($atts, $content='', $code='') { global $der_framework;
    
    $defaults = array(
      'text' => $content
    );
    
    $args = wp_parse_args($atts, $defaults);
    
    $content = theme_mini_shortcode(esc_html($args['text']));
    
    return sprintf('<h2 class="title-heading">%s</h2>', $content);
    
  }

  
  function shortcode_template($atts, $content='', $code='') { global $der_framework;
    
    $atts = (array) $atts;
    
    $defaults = array(

    );
    
    $args = wp_parse_args($atts, $defaults);
    
    return $der_framework->render_template('.mustache', $args);
    
  }

?>