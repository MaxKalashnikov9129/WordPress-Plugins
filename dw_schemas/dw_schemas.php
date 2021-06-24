<?php 
/**
 *	Plugin Name: Schemas
 *  Description: Плагин для вывода ld+json разметки типа WebPage/Article постов и записей, а так же размещения разметки типа Local Business
 *  Author: DrezorWarlock
 *  Version: 1.0
 */
add_action('admin_enqueue_scripts', 'dw_schemas_add_assets');
/**
 * function to include external css/js assets
 */
function dw_schemas_add_assets() {
	wp_enqueue_script('schemas-admin-js', '/wp-content/plugins/dw_schemas/assets/scripts.js');
	wp_enqueue_style('schemas-admin-css', '/wp-content/plugins/dw_schemas/assets/styles.css');
}
/**
 * function to call when plugin is being activated
 */
register_activation_hook(__FILE__, 'dw_schemas_activate');
/**
 * callback function to use when plugin is being activated
 */
function dw_schemas_activate() {
	/**
	 * default basic structured data options
	 */
	$schemas_options_array = [
		'allow_default_structured_data' => 'disallow',
		'default_posts_structured_data_schema' => '',
		'default_pages_structured_data_schema' => '',
		'structured_data' => [
			'allow_common_values' => "disallow",
			'author_type' => 'person',
			'author_name' => '',
			'author_image' => '',
			'author_contact_phones' => '',
			'author_contact_phone_types' => '',
			'author_contact_emails' => '',
			'author_contact_email_types' => '',
			'publisher_type' => 'organization',
			'publisher_name' => '',
			'publisher_image' => '',
			'publisher_contact_phones' => '',
			'publisher_contact_phone_types' => '',
			'publisher_contact_emails' => '',
			'publisher_contact_email_types' => '',
			'creator_type' => 'person',
			'creator_name' => '',
			'creator_image' => '',
			'creator_contact_phones' => '',
			'creator_contact_phone_types' => '',
			'creator_contact_emails' => '',
			'creator_contact_email_types' => ''
		]
	];
	update_option('schemas_options', $schemas_options_array);
	/**
	 * default local business structured data options
	 */
	$schemas_local_business_options_array = [
		'allow_default_local_business_structured_data' => 'disallow',
		'structured_data' => [
			[
				'office_name' => '',
				'office_address' => '',
				'office_logo' => '',
				'office_contact_phone' => '',
				'office_contact_email' => '',
				'office_url' => '',
				'office_business_days_full' => '',
				'office_business_days_short' => '',
				'office_business_hours' => '',
				'office_payment_accepted' => '',
				'office_price_range' => ''
			]
		]
	];
	update_option('schemas_local_business_options', $schemas_local_business_options_array);
}
register_uninstall_hook(__FILE__, 'dw_schemas_uninstall');
function dw_schemas_uninstall() {
	delete_option('schemas_options');
	delete_option('schemas_local_business_options');
	delete_metadata('post', '', '_schemas_structured_data', '', true);
	delete_metadata('post', '', '_schemas_local_business_structured_data', '', true);
}
/**
 * contains logic to add meta boxes to defined screens and contexts as well as metas sanitizing
 */
include __DIR__.'/back_includes/metas.php';
/**
 * contains logic to register settings well as options sanitizing
 */
include __DIR__.'/back_includes/settings.php';
/**
 * contains logic to add options page/tabs as well options page/tabs' markup
 */
include __DIR__.'/back_includes/menu_markup.php';
/**
 * contains basic structured data markup
 */
include __DIR__.'/front_includes/basic_markup.php';
/**
 * contains local business structured data markup
 */
include __DIR__.'/front_includes/local_business_markup.php';