<?php 
add_action('add_meta_boxes', 'dw_schemas_meta_box_init');
function dw_schemas_meta_box_init() {
	add_meta_box('basic_structured_data', 'Structured Data Settings', 'dw_render_basic_structured_data_metabox', ['post', 'page'], 'advanced', 'default');
} 
include __DIR__.'/basic_structured_data_metas.php';
add_action('save_post', 'dw_schemas_save_meta_box');
/**
 * function for nonce verification and field values sanitizing of basic structured data metas
 */
function dw_schemas_save_meta_box($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	wp_verify_nonce(plugin_basename(__FILE__), 'dw_schemas_save_meta_box');
	$basic_structured_data_array = [
		'allow_structured_data' => (empty($_POST['_schemas_allow_structured_data'])) ? 'false' : sanitize_text_field($_POST['_schemas_allow_structured_data']), 
		'use_default_basic_structured_data' => (empty($_POST['_schemas_use_default_basic_structured_data'])) ? 'true' : sanitize_text_field($_POST['_schemas_use_default_basic_structured_data']),
		'structured_data' => [
		'structured_data_type' => sanitize_text_field($_POST['_schemas_structured_data_type']),
		'structured_data_keywords' => sanitize_text_field($_POST['_schemas_structured_data_keywords']),
		'structured_data_text' => sanitize_text_field($_POST['_schemas_structured_data_text']),
		'use_default_basic_structured_data' => (empty($_POST['_schemas_use_default_basic_structured_data'])) ? 'allow' : sanitize_text_field($_POST['_schemas_use_default_basic_structured_data']),
		'author_type' => (empty($_POST['_schemas_structured_data_author_type'])) ? 'person' : sanitize_text_field($_POST['_schemas_structured_data_author_type']),
		'post_author_type' => (empty($_POST['_schemas_structured_data_post_author_type'])) ? 'post author' :sanitize_text_field($_POST['_schemas_structured_data_post_author_type']),
		'author_name' => sanitize_text_field($_POST['_schemas_structured_data_author_name']),
		'author_image' => sanitize_text_field($_POST['_schemas_structured_data_author_image']),
		'author_contact_phones' => sanitize_text_field($_POST['_schemas_structured_data_author_contact_phones']),
		'author_contact_phone_types' => sanitize_text_field($_POST['_schemas_structured_data_author_contact_phone_types']),
		'author_contact_emails' => sanitize_text_field($_POST['_schemas_structured_data_author_contact_emails']),
		'author_contact_email_types' => sanitize_text_field($_POST['_schemas_structured_data_author_contact_email_types']),
		'publisher_type' => (empty($_POST['_schemas_structured_data_publisher_type'])) ? 'organization' : sanitize_text_field($_POST['_schemas_structured_data_publisher_type']),
		'publisher_name' => sanitize_text_field($_POST['_schemas_structured_data_publisher_name']),
		'publisher_image' => sanitize_text_field($_POST['_schemas_structured_data_publisher_image']),
		'publisher_contact_phones' => sanitize_text_field($_POST['_schemas_structured_data_publisher_contact_phones']),
		'publisher_contact_phone_types' => sanitize_text_field($_POST['_schemas_structured_data_publisher_contact_phone_types']),
		'publisher_contact_emails' => sanitize_text_field($_POST['_schemas_structured_data_publisher_contact_emails']),
		'publisher_contact_email_types' => sanitize_text_field($_POST['_schemas_structured_data_publisher_contact_email_types']),
		'creator_type' => (empty($_POST['_schemas_structured_data_creator_type'])) ? 'person' :sanitize_text_field($_POST['_schemas_structured_data_creator_type']),
		'post_creator_type' => (empty($_POST['_schemas_structured_data_post_creator_type'])) ? 'post creator' :sanitize_text_field($_POST['_schemas_structured_data_post_creator_type']),
		'creator_name' => sanitize_text_field($_POST['_schemas_structured_data_creator_name']),
		'creator_image' => sanitize_text_field($_POST['_schemas_structured_data_creator_image']),
		'creator_contact_phones' => sanitize_text_field($_POST['_schemas_structured_data_creator_contact_phones']),
		'creator_contact_phone_types' => sanitize_text_field($_POST['_schemas_structured_data_creator_contact_phone_types']),
		'creator_contact_emails' => sanitize_text_field($_POST['_schemas_structured_data_creator_contact_emails']),
		'creator_contact_email_types' => sanitize_text_field($_POST['_schemas_structured_data_creator_contact_email_types'])
		]
	];
	update_post_meta($post_id, '_schemas_structured_data', $basic_structured_data_array);
}
include __DIR__.'/local_business_structured_data_metas.php';
add_action('add_meta_boxes', 'dw_local_business_schemas_meta_box_init');
function dw_local_business_schemas_meta_box_init() {
	add_meta_box('allow_local_business_structured_data', 'Local Business Structured Data Settings', 'dw_render_local_business_structured_data_metabox', ['post', 'page'], 'advanced', 'default');
}
add_action('save_post', 'dw_schemas_local_business_save_meta_box');
/**
 * function for nonce verification and field values sanitizing of local business structured data metas
 */
function dw_schemas_local_business_save_meta_box($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	wp_verify_nonce(plugin_basename(__FILE__), 'dw_schemas_save_meta_box');
	$local_business_data_array = [];
	for ($i=0; $i <= $_POST['local_business_objects_count']; $i++) :
		$local_business_data_array[$i]['office_name'] = (empty($_POST['_local_business_schemas_structured_data_office_name'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_name'][$i]);
		$local_business_data_array[$i]['office_address'] = (empty($_POST['_local_business_schemas_structured_data_office_address'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_address'][$i]);
		$local_business_data_array[$i]['office_logo'] = (empty($_POST['_local_business_schemas_structured_data_office_logo'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_logo'][$i]);
		$local_business_data_array[$i]['office_contact_phone'] = (empty($_POST['_local_business_schemas_structured_data_office_contact_phone'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_contact_phone'][$i]);
		$local_business_data_array[$i]['office_contact_email'] = (empty($_POST['_local_business_schemas_structured_data_office_contact_email'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_contact_email'][$i]);
		$local_business_data_array[$i]['office_url'] = (empty($_POST['_local_business_schemas_structured_data_office_url'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_url'][$i]);
		$local_business_data_array[$i]['office_business_days_full'] = (empty($_POST['_local_business_schemas_structured_data_office_business_days_full'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_business_days_full'][$i]);
		$local_business_data_array[$i]['office_business_days_short'] = (empty($_POST['_local_business_schemas_structured_data_office_business_days_short'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_business_days_short'][$i]);
		$local_business_data_array[$i]['office_business_hours'] = (empty($_POST['_local_business_schemas_structured_data_office_business_hours'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_business_hours'][$i]);
		$local_business_data_array[$i]['office_payment_accepted'] = (empty($_POST['_local_business_schemas_structured_data_office_payment_accepted'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_payment_accepted'][$i]);
		$local_business_data_array[$i]['office_price_range'] = (empty($_POST['_local_business_schemas_structured_data_office_price_range'][$i])) ? '' : sanitize_text_field($_POST['_local_business_schemas_structured_data_office_price_range'][$i]);
	endfor;
	$local_business_structured_data_array = [
		'allow_local_business_structured_data' => (empty($_POST['_schemas_allow_local_business_structured_data'])) ? 'false' : sanitize_text_field($_POST['_schemas_allow_local_business_structured_data']),
		'structured_data' => $local_business_data_array
	];
	update_post_meta($post_id, '_schemas_local_business_structured_data', $local_business_structured_data_array);
}