<?php
/*
Plugin Name: PPM FAQ
Plugin URI: http://perfectpointmarketing.com/plugins/ppm-faq
Description: This plugin will add a expand collapse FAQ in post or page. 
Author: Perfect Point Marketing
Author URI: http://perfectpointmarketing.com
Version: 1.1
*/


/*Some Set-up*/
define('PPM_FAQ_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


/* Adding Latest jQuery from Wordpress */
function ppm_faq_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'ppm_faq_latest_jquery');

/* Adding plugin javascript active file */
wp_enqueue_script('ppm-faq-plugin-script-active', PPM_FAQ_PLUGIN_PATH.'js/ppm-faq-active.js', array('jquery'));

/* Adding Plugin custm CSS file */
wp_enqueue_style('ppm-faq-plugin-style', PPM_FAQ_PLUGIN_PATH.'css/ppm-faq-plugin-style.css');



/* Add Slider Shortcode Button on Post Visual Editor */
function ppmfaq_button_function() {
	add_filter ("mce_external_plugins", "ppmfaq_button_js");
	add_filter ("mce_buttons", "ppmfaq_button");
}

function ppmfaq_button_js($plugin_array) {
	$plugin_array['ppmfaqs'] = plugins_url('js/custom-button.js', __FILE__);
	return $plugin_array;
}

function ppmfaq_button($buttons) {
	array_push ($buttons, 'ppmfaqs');
	return $buttons;
}
add_action ('init', 'ppmfaq_button_function'); 


/*Files to Include*/
require_once('faq-type.php');

/* FAQ Loop */
function ppm_get_faq(){
	$ppmfaq= '<div id="accordion">';
	query_posts('post_type=ppm-faq&posts_per_page=-1');
	if (have_posts()) : while (have_posts()) : the_post(); 
		$faqtitle= get_the_title(); 
		$faqcontent= get_the_content(); 
		$ppmfaq.='<p class="news-title"><span>'.$faqtitle.'</span></p><div class="news_text">'.$faqcontent.'</div>';		
	endwhile; endif; wp_reset_query();
	$ppmfaq.= '</div>';
	return $ppmfaq;
}


/**add the shortcode for the FAQ- for use in editor**/
function ppm_insert_faq($atts, $content=null){
	$ppmfaq= ppm_get_faq();
	return $ppmfaq;
}
add_shortcode('ppm_faq', 'ppm_insert_faq');

/**add template tag- for use in themes**/
function ppm_faq(){
	print ppm_get_faq();
}
?>