<?php

  add_shortcode('meteor_gallery', 'meteor_gallery_shortcode');

  function meteor_gallery_shortcode($atts, $content='', $code='') { global $der_framework;

    $atts = (array) $atts;

    $defaults = array(
      'id' => null,
      'columns' => 3,
      'limit' => null,
      'thumb_crop' => 'c',
      'thumb_height' => null,
      'thumb_aspect_ratio' => 'thumb_height',
      'show_title' => true,
      'title_align' => 'left',
      'title_icon' => null,
      'show_description' => true,
      'thumb_options' => array(), // (permalink|lightbox|gallery)
      'click_behavior' => null, // (follow|lightbox)
      'return' => false
    );

    if ($code == 'meteor_gallery') {
      $defaults['thumb_options'] = array('lightbox', 'gallery');
      $defaults['click_behavior'] = 'lightbox';
      if (array_key_exists('permalink_button', $atts)) $defaults['thumb_options'][] = 'permalink';
    }

    $id = $out = null;
    
    // Not using shortcode_atts since we need to allow layout-specific properties
    $args = wp_parse_args($atts, $defaults);
    
    $args['width'] = $der_framework->layout->get_column_width(12/$args['columns']);
    
    // Set thumb height based on aspect ratio
    theme_set_thumb_aspect_ratio($args);
    
    foreach (array('show_title', 'show_description') as $opt) {
      $args[$opt] = str2bool($args[$opt]);
    }
    
    foreach ($atts as $val) {
      if (is_string($val)) {
        $val = trim($val);
        if (preg_match('/^\d+$/', $val)) {
          $id = (int) $val;
        }
      }
    }
    
    if ($args['title_icon']) {
      $args['title_icon'] = 'icon-' . preg_replace('/^icon-/', '', $args['title_icon']);
    }
    
    if (isset($args['id'])) {
      
      $data = theme_gallery_standalone(array(), array(
        'id' => $args['id'],
        'slots' => $der_framework->layout->container_columns,
        'columns' => $args['columns'],
        'limit' => $args['limit'],
        'thumb_crop' => $args['thumb_crop'],
        'thumb_height' => $args['height'],
        'show_title' => $args['show_title'],
        'title_align' => $args['title_align'],
        'title_icon' => $args['title_icon'],
        'show_description' => $args['show_description']
      ));
      
      $thumb_options = $args['thumb_options'];
      $data['opt_permalink'] = in_array('permalink', $thumb_options);
      $data['opt_lightbox'] = in_array('lightbox', $thumb_options);
      $data['opt_gallery'] = in_array('gallery', $thumb_options);
      
      $data['click_behavior'] = $args['click_behavior'];
      
      foreach (array('title_heading', 'slots', 'container_class', 'visibility', 'inline_css') as $opt) {
        if (isset($args[$opt])) $data[$opt] = $args[$opt];
      }
      
      if ($data['click_behavior'] === 'lightbox') {
        $data['click_behavior_lightbox'] = true;
      }
      
      $out = $der_framework->render_template('meteor-gallery.mustache', $data);
      
    }
    
    return $out;
    
  }
  
?>