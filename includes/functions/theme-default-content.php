<?php

  function theme_default_content() { global $der_framework;
    if (is_page_template('locations.php')) {
      echo meteor_section_title(array(
        'display_as_desc' => 'description'
      ));
        
      $der_framework->open_section();
      
      $der_framework->layout->container_columns = 8;
       meteor_location_left_sidebar();
      echo meteor_single_post(array(
        'thumb_options' => array('lightbox', 'permalink'),
        'click_behavior' => 'lightbox',
        'show_post_tags' => false,
        'show_nextprev_nav' => false,
        'show_share_links' => false,
        'show_author_bio' => false,
        'show_comments' => false,
        'slots' => 8,
        'container_class' => "span8",
        'inline_css' => 'padding-right: 8px;'
      ));
        meteor_location_right_sidebar();
     
        
      $der_framework->close_section();
		}
	  else if (is_page_template('full-width-page.php')) {
		  echo meteor_section_title(array(
			'display_as_desc' => 'description'
		  ));
        
		$der_framework->open_section();
      
		$der_framework->layout->container_columns = 8;
       //meteor_location_left_sidebar();
		echo meteor_single_post(array(
        'thumb_options' => array('lightbox', 'permalink'),
        'click_behavior' => 'lightbox',
        'show_post_tags' => false,
        'show_nextprev_nav' => false,
        'show_share_links' => false,
        'show_author_bio' => false,
        'show_comments' => false,
        'slots' => 8,
        'container_class' => "span8",
        'inline_css' => 'padding-right: 8px;'
      ));
        //meteor_location_right_sidebar();
     
        
      $der_framework->close_section();
		}
    else if (is_single()) {
      
      // SINGLE POST
      
      echo meteor_section_title(array(
        'display_as_desc' => 'choose',
        'display_options' => array('date', 'author', 'comments', 'categories', 'tags')
      ));
        
      $der_framework->open_section();
      
      $der_framework->layout->container_columns = 8;
      meteor_default_sidebar();
      echo meteor_single_post(array(
        'slots' => 8,
        'thumb_options' => array('lightbox', 'permalink'),
        'click_behavior' => 'lightbox',
        'container_class' => "span8",
        'inline_css' => 'padding-right: 8px;'
      ));
        
      
        
      $der_framework->close_section();
      
    } else if (is_page()) {
      
      // PAGE
      
      echo meteor_section_title(array(
        'display_as_desc' => 'description'
      ));
        
      $der_framework->open_section();
      
      $der_framework->layout->container_columns = 8;
       meteor_default_sidebar();
      echo meteor_single_post(array(
        'thumb_options' => array('lightbox', 'permalink'),
        'click_behavior' => 'lightbox',
        'show_post_tags' => false,
        'show_nextprev_nav' => false,
        'show_share_links' => false,
        'show_author_bio' => false,
        'show_comments' => false,
        'slots' => 8,
        'container_class' => "span8",
        'inline_css' => 'padding-right: 8px;'
      ));
        
     
        
      $der_framework->close_section();
      
    }else if (is_archive() || is_search()) {
      
      // ARCHIVE
      
      echo meteor_section_title(array(
        'display_as_desc' => 'description'
      ));
        
      $der_framework->open_section();
      
      $der_framework->layout->container_columns = 8;
      meteor_default_sidebar();
      echo meteor_blog_posts(array(
        'pagination' => true,
        'show_thumb' => true,
        'thumb_options' => array('lightbox', 'permalink'),
        'click_behavior' => 'lightbox',
        'display_options' => array('date', 'author', 'comments', 'categories', 'tags'),
        'slots' => 8,
        'container_class' => 'span8',
        'inline_css' => 'padding-right: 8px;'
      ), '', 'query_posts');
      
      

      $der_framework->close_section();
      
    } else if (is_404()) {
      
      // 404 PAGE
      
      echo meteor_section_title(array(
        'display_as_desc' => 'description'
      ));
      
      $der_framework->open_section();
      
      echo meteor_404();
      
      $der_framework->close_section();
      
    }
    
  }
  
  function meteor_default_sidebar($columns=4) { global $der_framework;
    
    $der_framework->layout->container_columns = $columns;
    
    echo "\n" .'<div class="sidebar span'. $columns .'">' . "\n";
    
    dynamic_sidebar("Blog");
    
    echo "\n" . '</div><!-- .sidebar -->' . "\n";
    
  }

	function meteor_location_right_sidebar($columns=4) { global $der_framework;
    
    $der_framework->layout->container_columns = $columns;
    
    echo "\n" .'<div class="sidebar span'. $columns .'">' . "\n";
    
    dynamic_sidebar("Location Right Sidebar Widget");
    
    echo "\n" . '</div><!-- .sidebar -->' . "\n";
    
  }
	function meteor_location_left_sidebar($columns=4) { global $der_framework;
    
    $der_framework->layout->container_columns = $columns;
    
    echo "\n" .'<div class="sidebar span'. $columns .'">' . "\n";
    
    dynamic_sidebar("Location Left Sidebar Menu Widget");
	dynamic_sidebar("Location Left Sidebar Form Widget");
    
    echo "\n" . '</div><!-- .sidebar -->' . "\n";
    
  }

?>