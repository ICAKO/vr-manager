<?php
function ara_vm__setup() {
 	global $wpdb;
	
	// Find VR logo
	if(!empty($_GET) AND array_key_exists('vrlogo', $_GET)) {
		if($_GET['vrlogo'] == 1) {
			$return_arr_logo = array(
				// Logo URL
				'logo_url' => 'http://yahoo.com',
				'logo_img' => 'http://vr.asitora.com/wp-content/plugins/vr-video/assets/img/vrvideo-logo.png'
			);
			
			echo json_encode($return_arr_logo);
			exit;
		}	
	}
	
	// Find info for website by HOST name.
	if(!empty($_GET) AND array_key_exists('vrinfo', $_GET)) {
		
		$site_hostname = trim($_GET['vrinfo']);
		$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $site_hostname . "'" );
		
		$premium = get_post_meta($postid,'vrsite_makepremium',true);
		$flag = get_post_meta($postid,'vrsite_flag',true);
		
		$return_arr = array(
			// If site is premium
			'premium' => $premium,
			
			// Banner URL
			'anchor' => 'http://google.bg',
			
			// Banner Image
			'banner' => 'https://www.seoclerk.com/pics/trade2551-1nYUMO1413350536.png',
			
			// Alt Title
			"alt" => 'test title'
		); 
		
		if($flag == 1) {
			$return_arr['anchor'] = "http://alibaba.com";
			$return_arr['banner'] = "https://www.seoclerk.com/pics/trade2551-1nYUMO1413350536.png";
			$return_arr['alt'] = "test title flagg";
		}
		
		echo json_encode($return_arr);	
		exit;
	}
	
	// Active & Stop Plugin
	if(!empty($_GET) AND array_key_exists('vrvideo', $_GET) AND !empty($_GET['vrvideo'])) {
		
		if($_GET['vrvideo'] == "remove") {
			$args = array(
				'post_type' => 'vrmanager',
			    's' => $_GET['url'],
			    'post_status' => 'publish',
			    'orderby'     => 'title', 
			    'order'       => 'ASC'        
			);
			$wp_query = new WP_Query($args);
			
			if(count($wp_query->posts) > 0) {
				wp_delete_post($wp_query->posts[0]->ID,true);
			}
		}
		
		else if ( $_GET['vrvideo'] == "add") {
			wp_insert_post(array(
				'post_type' => 'vrmanager',
				'post_title' => $_GET['url'],
				'post_status' => 'publish'
			));
		}
	}
		
 }
 
 add_action('init','ara_vm__setup');

  // Add Meta Box to Post VRSITES & VR Manager
  function ara__vrmanager__metabox() {
	add_meta_box( 'vrsite-metabox', __( 'VR Site Setting', 'vrmanager' ), 'ara__vrmanager__metabox_callback', 'vrmanager' );
  }
  
  add_action( 'add_meta_boxes', 'ara__vrmanager__metabox' );
  
  // Meta Box Info.
  function ara__vrmanager__metabox_callback() {
  	global $post;
	
  	$premium = get_post_meta($post->ID,'vrsite_makepremium',true);
	$flag = get_post_meta($post->ID,'vrsite_flag',true);
	
  	?>
  	<label>
  		<input type="checkbox" name="vrsite_makepremium" <?php if($premium == 1) { ?>checked="checked"<?php } ?> />
		<?php _e('Make this site premium.','vrmanager'); ?>
  	</label>
  	
  	<br /><br />
  	
  	<label>
  		<input type="checkbox" name="vrsite_flag" <?php if($flag == 1) { ?>checked="checked"<?php } ?> />
		<?php _e('Flag this site.','vrmanager'); ?>
  	</label>
  	
  	<?php
  }
  
  // Save Settings Site.
  add_action('save_post','ara__vrmanager_savepost');
  
  function ara__vrmanager_savepost($post_id) {
  	
	$post_type = get_post_type($post_id);
	
	if($post_type != "vrmanager") return;
	
	
	// Make Premium
	(isset($_POST['vrsite_makepremium'])) ? update_post_meta($post_id,'vrsite_makepremium',1) : update_post_meta($post_id,'vrsite_makepremium',0);
	
	// Make Flag
	(isset($_POST['vrsite_flag'])) ? update_post_meta($post_id,'vrsite_flag',1) : update_post_meta($post_id,'vrsite_flag',0);
	
  }
  