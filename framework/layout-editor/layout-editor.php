<?php

if (!defined('ABSPATH')) die();

/* Layout Editor */

add_action('admin_menu', 'layout_editor_register_screen');
add_action('wp_ajax_layout_editor_update', 'layout_editor_update_callback');
add_action('wp_ajax_layout_editor_json', 'layout_editor_render_json');

if (isset($_GET['page']) && $_GET['page'] == 'layout-editor') {
  add_action('admin_print_scripts', 'layout_editor_print_scripts');
  add_action('admin_print_styles', 'layout_editor_print_styles');
}

/* Sends the backup to the user */

function layout_editor_backup() { global $der_framework;
  $filename = string2id(get_bloginfo('name')) . '-layouts.json';
  $data = $der_framework->get_option('layouts_json');
  header('Content-Type: application/json');
  header("Content-Disposition: attachment; filename=${filename}");
  echo $data;
  exit();
}

/* Layout Editor update action */

function layout_editor_update_callback() {
  require(TEMPLATEPATH . '/framework/layout-editor/layout-editor-action.php');
}

/* Registers the layout editor admin menu */

function layout_editor_register_screen() { global $der_framework;
  
  if (isset($_GET['backup']) && $_GET['backup'] == 1) {
    layout_editor_backup();
    exit();
  }
  
  __meteor_menu_page("Layout Editor", "Layouts", THEME_CAPABILITY, 'layout-editor', 'layout_Editor_render_page', $der_framework->uri('framework/assets/layout-editor.png', THEME_VERSION), 57);
}

/* Renders the layout editor page */

function layout_editor_render_page() { global $der_framework;
  
  if (phpversion() > '5.2.0') printf("\n".'<div id="layout-editor">');
  else printf("\n".'<div id="layout-editor" data-disabled=true>');
  
  include($der_framework->path('framework/theme-options/theme-options-interface.head.php'));
  include($der_framework->path('framework/layout-editor/layout-editor-canvas.php'));
  include($der_framework->path('framework/theme-options/theme-options-interface.foot.php'));
  printf("\n</div><!-- layout-editor -->");
}

/* Load styles */

function layout_editor_print_styles() { global $der_framework;
  wp_enqueue_style('layout-editor', $der_framework->uri('framework/layout-editor/layout-editor.css'), array(), THEME_VERSION);
}

function layout_editor_clean_utf8($some_string) {
  
  // http://magp.ie/2011/01/06/remove-non-utf8-characters-from-string-with-php/
  
  //reject overly long 2 byte sequences, as well as characters above U+10000 and replace with ?
  $some_string = preg_replace('/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]'.
   '|[\x00-\x7F][\x80-\xBF]+'.
   '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*'.
   '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})'.
   '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
   '?', $some_string );
 
  //reject overly long 3 byte sequences and UTF-16 surrogates and replace with ?
  $some_string = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]'.
   '|\xED[\xA0-\xBF][\x80-\xBF]/S','?', $some_string );
  
  return $some_string;

}

/* Load JS Scritps */

function layout_editor_render_json() { global $der_framework;
  
  $out = array();
  $json = $der_framework->get_option('layouts_json');
  
  if ($json) {
    $json = preg_replace('/<!--(\s+)?(.*?)(\s+)?-->/', '', $json);
  } else {
    $json = "{}";
  }
  
  $out['LAYOUT_DATA'] = utf8_encode(layout_editor_clean_utf8($json));
  
  // Print taxonomies
  
  $taxonomies = layout_editor_taxonomy_data();
  
  foreach ($taxonomies as $key => $arr) {
    $taxonomies[$key] = array_map(utf8_encode, $arr);
  }
  
  $out['WP_TAXONOMY_DATA'] = json_encode($taxonomies);
  
  // Print custom data
  
  $galleries = query_posts('post_type=gallery&showposts=-1'); wp_reset_query();
  $gallery_data = array();
  
  foreach ($galleries as $p) {
    $gallery_data[sprintf('%d', $p->ID)] = apply_filters('the_title', $p->post_title);
  }
  
  $data = array(
    'sidebars' => make_assoc_array(list2array($der_framework->option('sidebars')), '___'),
    'gallery-posts' => $gallery_data 
  );
  
  $data = apply_filters('layout_editor_custom_data', $data);
  
  foreach ($data as $key => $arr) {
    $data[$key] = array_map(utf8_encode, $arr);
  }
  
  $out['WP_CUSTOM_DATA'] = json_encode($data);
  
  // Send additional headers to prevent caching of resource
  // http://stackoverflow.com/questions/49547
  header('Content-Type: application/javascript;charset=utf-8');
  header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
  header('Pragma: no-cache'); // HTTP 1.0.
  header('Expires: 0'); // Proxies.
  
  $code = sprintf('(function($, window) {
  var utf8 = window.utf8 || {
    encode: function(s) {
      return unescape(encodeURIComponent(s));
    },
    decode: function(s) {
      return decodeURIComponent(escape(s));
    }
  }
  try {
    var data = %s;
    window.LAYOUT_DATA = JSON.parse(utf8.decode(data.LAYOUT_DATA));
    window.WP_TAXONOMY_DATA = JSON.parse(utf8.decode(data.WP_TAXONOMY_DATA));
    window.WP_CUSTOM_DATA = JSON.parse(utf8.decode(data.WP_CUSTOM_DATA));
  } catch(e) {
    if (window.console) console.log(e);
    $(document).ready(function() {
      $("#wpbody-content").prepend(\'<div class="updated error" style="margin: 1em 0 0;">\n\
<p>Unable to parse Layout Data. &nbsp;Please report this issue on the <a target="_blank" href="http://support.der-design.com">Support Forums</a>.</p>\n\
<p>Your Layout Data is still there. &nbsp;You can <strong>download a backup</strong> from <a href="admin.php?page=theme-options">Theme Options &rarr; Other</a>.</p>\n\
</div>\');
      $("#content-wrap ul.buttons, input:submit.save-layout, a.btn.reset-layout, #sections .actions strong").remove();
    });
    document.DO_NOT_SAVE_LAYOUTS = true;
    window.LAYOUT_DATA = {};
    window.WP_TAXONOMY_DATA = {};
    window.WP_CUSTOM_DATA = {};
  }
})(jQuery, window);', json_encode($out));
  
  echo $code;
  
  exit(0);
  
}

function layout_editor_print_scripts() { global $der_framework;
  
  wp_enqueue_script('json2');
  // wp_enqueue_script('utf8', $der_framework->uri('framework/assets/js/utf8.js'), array('jquery'), '2.0.0');
  wp_enqueue_script('jquery-ui-core');
  wp_enqueue_script('jquery-ui-draggable');
  wp_enqueue_script('jquery-ui-droppable');
  wp_enqueue_script('jquery-ui-sortable');
  wp_enqueue_script('layout-editor-json', admin_url(sprintf('admin-ajax.php?action=layout_editor_json')), array('jquery'), time()); // Add timestamp to prevent caching
  wp_enqueue_script('layout-editor-components',	$der_framework->uri('includes/layout/components.js'), array('jquery'), THEME_VERSION);
  wp_enqueue_script('layout-editor-form',	$der_framework->uri('framework/layout-editor/layout-editor-form.js'), array('jquery'), THEME_VERSION);
  wp_enqueue_script('layout-editor-interface',	$der_framework->uri('framework/layout-editor/layout-editor.js'), array('jquery'), THEME_VERSION);

}


?>