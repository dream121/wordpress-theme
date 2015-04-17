<?php 

  ////////////////////////////////////
  // DERDESIGN WORDPRESS FRAMEWORK
  ////////////////////////////////////

  if (!defined('ABSPATH')) die();
  
  // Theme debug setting.
  define('THEME_DEBUG', false);

  // Framework load path
  $framework_load = get_template_directory() . '/framework/load.php';

  // Bootstrap the framework
  if (THEME_DEBUG) {
    if (!isset($_GET['noload'])) require($framework_load);
  } else {
    require($framework_load);
  }

/*------------- Custom Code -----------------*/
#Add CSS to Admin Area
add_action('admin_head', 'my_custom_css');
function my_custom_css() {
  echo '<style>
    #toplevel_page_layout-editor {
			display: none;
		}
		#wpfooter{display:none;}
		
		#acf-use_a_layout .label {
			cursor: move;
			font-size: 14px;
			line-height: 1.4;
			margin: 0;
			padding: 8px 12px;
			background: none repeat scroll 0 0 #fff;
			border: 1px solid #e5e5e5;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
			min-width: 255px;
			position: relative;
		}
		.acf-radio-list.radio.vertical > li {
    display: none;
		}
		#acf-use_a_layout > div
		{
    width:840px;
    height:700px;
    overflow:scroll;     
    overflow-x:hidden;   
    -webkit-resize:vertical; 
    -moz-resize:vertical;
    resize:vertical;
		}
		iframe#myIframe{    
			margin-left:-39px;
			margin-top:-56px;
			overflow-x:hidden;
		}
		#myIframe body { display: none; }
  </style>';
}
add_action( 'admin_init', 'my_remove_menu_pages', 999 );
 
function my_remove_menu_pages() {
	 global $submenu;
	if( !is_plugin_active( 'custom_layout/custom_layout.php' ) && $_REQUEST['page'] == 'layout-editor' ) {

	add_action('admin_notices', 'permissions_admin_notice'); 
	echo '<style>
    #layout-editor {
			display: none;
		}

  </style>';
	}
	
}
// functions.php
function permissions_admin_notice()  
{
  // use the class "error" for red notices, and "update" for yellow notices
  echo "<div id='permissions-warning' class='error fade'><p><strong>".__('You do not have sufficient permissions to access this page.')."</strong></p></div>";
}


/** Layout Radio Button**/
add_action('admin_head', 'my_custom_js');

function my_custom_js() {
	global $post;
	$pid = $post->ID;
  echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/custom_jquery.js"></script><link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /><script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  
	<script type="text/javascript">
	jQuery(document).ready(function(){
	jQuery("#myIframe").addClass("'.$pid.'");
	jQuery("#dialog").dialog({ 
    autoOpen: false,
    modal: true,
    height: 710,
		width: 830,
    open: function(ev, ui){
             jQuery("#myIframe").attr("src","'.site_url().'/wp-admin/admin.php?page=layout-editor&id='.$pid.'");
          }
		});
	
	jQuery("#acf-field-use_a_layout-1").click(function(){
		jQuery( "#postdivrich" ).prop("disabled", true);
		//var path = window.location + "";
		//var res=path.split("?post=");
		//var res2 = res[1].split("&");
		//var postid = res2[0];
		//get layout name
		jQuery("<div></div>").appendTo("#acf-use_a_layout");
		jQuery("<iframe />", {
		name: "myFrame",
		id:   "myIframe",
		width: 875,
		height: 710,
		frameborder:"0",
		allowTransparency: "true",
		src: "'.site_url().'/wp-admin/admin.php?page=layout-editor&id='.$pid.'"
	}).appendTo("#acf-use_a_layout > div");
	});
	jQuery("#acf-field-use_a_layout-0").click(function(){
		jQuery( "#acf-use_a_layout > div" ).remove();
		jQuery( "#postdivrich" ).prop("disabled", false);
	});
	//add css within iframe only
	jQuery("#myIframe").load(function() {
		jQuery("#myIframe").contents().find(".links").css("display","none");
		jQuery("#myIframe").contents().find("#adminmenuwrap").css("display","none");
	});

	jQuery(".save-layout").click(function(){
		var path = window.location + "";
		var res=path.split("id=");
		var ids = jQuery("#myIframe").attr("class");
		var layt = jQuery(".sections-list .active").attr("data-layout");
		var pid = res[1];
			jQuery.ajax({
				type: "post",
				url: "'.site_url().'/wp-admin/admin-ajax.php",
				dataType:"text",
				async:false,
					data:{action:"add_postmeta",poid:pid, layout:layt},
				success: function(response) {
				//alert(response);
				}
			});
	});
		//show / hide radio button
		jQuery("#acf-use_a_layout .label").click(function(){
			jQuery( ".acf-radio-list.radio.vertical > li" ).slideToggle( "slow" );
		});
		/*jQuery("#laylist").change(function() {
		 var selected = jQuery("#laylist option:selected").text();
		});*/
	});

	function closebt() {
	jQuery.fancybox.close();
		jQuery( ".btn-icon.copy" ).click();
	}

	//location manager user profile fields
	var usepath = window.location + "";
	var res=usepath.split("wp-admin/");
	var res2=res[1].split("?");

	if(res2[0] =="user-edit.php" || res2[0] =="user-new.php" ){
		jQuery.ajax({
				type: "post",
				url: "'.site_url().'/wp-admin/admin-ajax.php",
				dataType:"text",
				async:false,
				data:{action:"get_location"},
				success: function(response) {
				//alert(response);
				jQuery("#acf-field-location_managed").html(response);
				}
			});
	}
  </script>';
	echo '<div id="layedit" style="display:none;"><div id="dialog" style="overflow: hidden;"><div id="dialog2" class="'.$pid.'">
    <iframe style="overflow-x:hidden; border: 0px none; width: 875px; height: 710px; margin-left: -51px; margin-top: -69px;" id="myIframe" src=""></iframe>
</div></div></div>';
	
	//$lay = get_option( '_meteor_layouts');
	//echo '<pre>';
	//print_r($lay);
	//echo '</pre>';<option value="">Filter by Location</option><option value="Canton" >Canton</option><option value="West Cobb" >West Cobb</option>
}


add_action( 'wp_ajax_add_postmeta', 'add_postmeta');
function add_postmeta(){
	global $wpdb;
	if (isset($_POST['poid']) && isset($_POST['layout'])) {
		$id = $_POST['poid'];
		$layout = $_POST['layout'];
		$key = '_meteor_layout';
		$themeta = get_post_meta($id, $key, TRUE);
		if($themeta == '') {
			add_post_meta($id, $key, $layout);
		}
		else{
			update_post_meta($id, $key, $layout);
		}
		
		/*if ($count == 1) {		
			echo '1';
		} 
		else{ 
			echo '0';
		}	*/
	}
}


add_action( 'wp_ajax_get_location', 'get_location');
function get_location(){
	global $wpdb;
	$cats = $wpdb->get_results("select * from wp_posts where post_type ='flamingo_inbound'", ARRAY_A);
	if( $cats ){
		echo '<select id="acf-field-location_managed" class="select" name="fields[field_5486d2eecc3cd]">';
		foreach( $cats as $cat ){
			$themeta = get_post_meta($cat['ID'], '_field_location', TRUE);
			$selected = '';
			if( $_GET['location'] == $themeta ){
				$selected = ' selected = "selected"';   
			}
			if( $themeta != '' ){

				echo '<option value="' . $themeta . '" '. $selected . '>' .  $themeta . '</option>';

			}
		}
		echo '</select>';
	}
}



add_action( 'wp_ajax_get_layout', 'get_layout');
function get_layout(){
	global $wpdb;
	if (isset($_POST['pid'])) {
		$id = $_POST['pid'];
		$meta_values = get_post_meta( $id, '_meteor_layout', true );
		
		echo $meta_values;
		exit;
	}
}


add_action( 'save_post', 'wpse41912_save_post' );
function wpse41912_save_post()
{
    global $post;
		global $wpdb;
		$post_id = $post->ID;
		$key = '_meteor_layout';
		$meta_values = get_post_meta( $post_id, $key, true );
		$lay = get_option( '_meteor_layouts');
		$content = $lay[$meta_values];
		if(!empty($content)){
			foreach($content as $val){
				/*if($val[0]['c']['s'] == 'content' || $val[0]['c']['s'] == 'content_fullwidth'){
					$data .= $val[0]['c']['o']['content'].'<br>';
				} */
				
				$conlayout =$val[0]['c']['o']['content'];
				$data = $conlayout;
			}

			$cont = mysql_real_escape_string($data);
			$table = $wpdb->prefix . "posts";
			//echo "UPDATE $table SET `post_content` = '$cont' where ID = $post_id";
			$update = "UPDATE $table SET `post_content` = '$cont' where ID = $post_id";
			$exicute = $wpdb->query($update);
			//echo '<pre>';
			//print_r($content);
			//echo '</pre>';
			//exit;
		}
}
add_filter('gettext', 'rename_admin_menu_items');
add_filter('ngettext', 'rename_admin_menu_items');

function rename_admin_menu_items( $menu ) {
	
	// $menu = str_ireplace( 'original name', 'new name', $menu );
	$menu = str_ireplace( 'Flamingo', 'Responses', $menu );
	
	// return $menu array
	return $menu;
}
add_action('user_new_form', 'add_extra_social_links');
add_action( 'show_user_profile', 'add_extra_social_links' );
add_action( 'edit_user_profile', 'add_extra_social_links' );

function add_extra_social_links( $user )
{
	global $wpdb;
	$user = get_current_user_id();
	$userid = $_REQUEST['user_id'];
	$loca = get_usermeta($userid,'user_location');
	if($user == 1 ) {
    ?>
        <h3>Location</h3>

        <table class="form-table">
            <tr>
			<th>Location Managed</th>
			<td>
         <?php
		 $cats = $wpdb->get_results("select * from wp_posts where post_type ='flamingo_inbound'", ARRAY_A);	
        if( $cats ){
            ?>
            <select name="location" class="ewc-filter-cat">
               <option value="">-Select Location-</option>
			   <optgroup label="Alabama">
			   <option <?php if($loca == "Birmingham"){ print 'selected '; } ?>value="Birmingham">Birmingham</option></optgroup>
			   <optgroup label="Georgia">
			   <option <?php if($loca == "Augusta") { print ' selected '; } ?> value="Augusta">Augusta</option>
			   <option <?php if($loca == "Canton") { print ' selected '; } ?> value="Canton">Canton</option>
			   <option <?php if($loca == "Decatur") { print ' selected '; } ?> value="Decatur">Decatur</option>
			   <option <?php if($loca == "Fayetteville") { print ' selected '; } ?> value="Fayetteville">Fayetteville</option>
			   <option <?php if($loca == "Lawrenceville") { print ' selected '; } ?> value="Lawrenceville">Lawrenceville</option>
			   <option <?php if($loca == "Newnan") { print ' selected '; } ?> value="Newnan">Newnan</option>
			   <option <?php if($loca == "West Cobb") { print ' selected '; } ?> value="West Cobb">West Cobb</option></optgroup>
			   <optgroup label="Florida">
			   <option <?php if($loca == "Tallahassee") { print ' selected '; } ?> value="Tallahassee">Tallahassee</option></optgroup>
			   <optgroup label="Texas">
			   <option <?php if($loca == "Austin Central") { print ' selected '; } ?> value="Austin Central">Austin Central</option>
			   <option <?php if($loca == "Dallas") { print ' selected '; } ?> value="Dallas">Dallas</option>
			   <option <?php if($loca == "Houston") { print ' selected '; } ?> value="Houston">Houston</option>
			   <option <?php if($loca == "San Antonio") { print ' selected '; } ?> value="San Antonio">San Antonio</option></optgroup>
            </select>
            <?php   
        }
        ?>  <td>
            </tr>

            
        </table>
		
    <?php
	}
}
add_action( 'personal_options_update', 'save_extra_social_links' );
add_action( 'edit_user_profile_update', 'save_extra_social_links' );
add_action('user_register', 'save_extra_social_links');

function save_extra_social_links( $user_id ) {
	$userid = $_REQUEST['user_id'];
	$loca = get_usermeta($userid,'user_location');
	//print_r($loca);
	if($_REQUEST['user_id'] != ''){
		if($loca != ' '){
			update_user_meta( $userid,'user_location',  $_POST['location'] );
		} else {
			add_user_meta( $userid,'user_location',  $_POST['location'] );
		}
	}
	else {
	add_user_meta( $user_id,'user_location',  $_POST['location'] );
	}
}