<?php
/*
Plugin Name: WP-Choose-Thumb
Plugin URI: http://daveligthart.com
Description: Choose thumbnail to display in post.
Version: 1.3.3
Author: Dave Ligthart
Author URI: http://daveligthart.com
*/
include_once(dirname(__FILE__) . '/com.daveligthart.php');

$wct_plugin_url = trailingslashit(get_bloginfo('wpurl') ).PLUGINDIR.'/'. dirname( plugin_basename(__FILE__) );

wp_enqueue_script('jquery');

add_action('plugins_loaded', create_function('', 'wct_load_textdomain();') );

/**
 * Load text domain.
 * @access public
 */
function wct_load_textdomain() {
	$locale = get_locale();
	if ( empty($locale) ){
		$locale = 'en_US';
	}
	$mofile = dirname (__FILE__)."/resources/locale/$locale.mo";
	load_textdomain ('wct', $mofile);
}

/**
 * Display thumb. For use in theme.
 * @param string $style style=""
 * @param integer $pid optional post id
 * @access public
 */
function wct_display_thumb($style = '', $pid = '') {
	global $post;
	if('' == $pid){
		if(null != $post) {
			$pid = $post->ID;
		} else {
			return;
		}
	}
	
	$src = trim(get_post_meta($pid, 'wct_thumb',true));
	
	$alt = 'thumbnail';
	
	$hasThumb = ('' != $src);
	
	if($hasThumb) {
		echo '<img alt="'.$alt.'" src="'. $src .'" class="alignleft" '.$style.'/>';
	}
	
	return $hasThumb;
}

/**
 * Admin header.
 * @access public
 */
function wct_admin_head() {
	global $post;
	global $wct_plugin_url;
?>

<script type="text/javascript" language="javascript">
<!-- WP-Choose-Thumb Javascript. dligthart - http://daveligthart.com
var wct_cur_offset = 0;
var wct_offset = 1;
function wct_load_thumb_next(){
	wct_loading();
	wct_cur_offset = wct_cur_offset + wct_offset;
	wct_load();
}
function wct_load_thumb_prev() {
	if(wct_cur_offset >= wct_offset) {
		wct_loading();
		wct_cur_offset = wct_cur_offset - wct_offset;
		wct_load();
	}
}
function wct_load() {
	wct_load_thumbs(<?php global $post; echo $post->ID; ?>);
}
function wct_loading() {
	jQuery('#wct_loading').show();
}
function wct_loaded() {
	jQuery('#wct_loading').hide();

	if(wct_cur_offset > 0) {
		jQuery('#wct_prev').hide(); //;"show()";
	} else {
		jQuery('#wct_prev').hide();
	}
}
function wct_load_thumbs(offset) {
	<?php //id=' . $post->ID . '&
	?>
	<?php /*jQuery("#wct_thumbs").load("<?php echo $wct_plugin_url . '/wct-thumb-loader.php?offset='; ?>" + offset,"",
		function (responseText, textStatus, XMLHttpRequest) {
			wct_loaded();
		}
	);*/?>

	if(offset > 0) {
		jQuery("#wct_thumbs").load("<?php echo $wct_plugin_url . '/wct-thumb-loader.php?id='; ?>" + offset,"",
			function (responseText, textStatus, XMLHttpRequest) {
				wct_loaded();
			}
		);
	}
}

function wct_init() {
	wct_load_thumbs(<?php global $post; echo $post->ID; ?>);
	if(wct_cur_offset == 0) {
		jQuery('#wct_prev').hide();
	}
}
jQuery(document).ready(function(){
  wct_init();
});
//-->
</script>
<?php
}

/**
 * Init.
 */
function wct_init() {
	if(function_exists('add_meta_box')){
		add_meta_box('wct_div', __('WP-Choose-Thumb'), 'wct_metabox', 'post', 'side');
	} else {
		//_e('function add_meta_box does not exist');
	}
}

/**
 * Edit post hook.
 * @param integer $pid post  id
 * @access public
 */
function wct_edit_post($pid = '') {
	$c = (trim($_POST['wct_thumb']));
	if('' != $pid && '' != $_POST['wct_thumb']) {
		$temp = (trim(get_post_meta($pid,'wct_thumb',true)));
		if($c != $temp) { // should not be the same otherwise update is useless and a performance hog.
			delete_post_meta($pid, 'wct_thumb'); // Delete first then re-add to circumvent WP's built in post meta handling.
			update_post_meta($pid, 'wct_thumb', $c, true);
		}
	}
}


/**
 * Create metabox.
 */
function wct_metabox() {
	global $post;
	global $wct_plugin_url;

?>
<p class="sub">
<?php _e('Choose thumbnail for post','wct'); ?>.
<div class="navigation" style="padding-bottom:10px;padding-left:5px;">
	<a id="wct_prev" href="" onclick="javascript:wct_load_thumb_prev(); return false;" title="previous thumbs" class="alignleft" style="margin-right:5px;display:none;"><?php _e('previous', 'wct'); ?></a>
	<a id="wct_next" href="" onclick="javascript:wct_load_thumb_next(); return false;" title="next thumbs" class="alignright" style="display:none;"><?php _e('next','wct'); ?></a>
	<a id="wct_refresh" href="" onclick="javascript:wct_load(); return false;" title="refresh thumbs"><?php _e('refresh', 'wct'); ?></a>
</div>
</p>
<p id="wct_thumbs"><?php _e('Waiting for publish', 'wct'); ?>
	<div align="center" id="wct_loading">
		<img src="<?php echo $wct_plugin_url . '/resources/images/ajax-loader.gif'; ?>" alt="loading" />
	</div>
</p>
<?php
}
add_action('admin_head', 'wct_admin_head');
// Menu init.
add_action('admin_menu', 'wct_init');
// On post.
add_action('publish_post', 'wct_edit_post');
// On edit.
add_filter('edit_post', 'wct_edit_post');
?>