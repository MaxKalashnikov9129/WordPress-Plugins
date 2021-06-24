<?php 
add_action('admin_init', 'dw_schemas_settings_register');
function dw_schemas_settings_register()
{
	register_setting('schemas_settings_group', 'schemas_options', 'dw_schemas_sanitize_options');
}
/**
 * function for field values sanitizing of basic structured data options
 */
function dw_schemas_sanitize_options($input) {
	$input['allow_default_structured_data'] = sanitize_text_field(strtolower($input['allow_default_structured_data']));
	$input['default_posts_structured_data_schema'] = sanitize_text_field($input['default_posts_structured_data_schema']);
	$input['default_pages_structured_data_schema'] = sanitize_text_field($input['default_pages_structured_data_schema']);
	$input['structured_data']['author_type'] = sanitize_text_field($input['structured_data']['author_type']);
	$input['structured_data']['author_name'] = sanitize_text_field($input['structured_data']['author_name']);
	$input['structured_data']['author_image'] = sanitize_text_field($input['structured_data']['author_image']);
	$input['structured_data']['author_contact_phones'] = sanitize_text_field($input['structured_data']['author_contact_phones']);
	$input['structured_data']['author_contact_phone_types'] = sanitize_text_field($input['structured_data']['author_contact_phone_types']);
	$input['structured_data']['author_contact_emails'] = sanitize_text_field($input['structured_data']['author_contact_emails']);
	$input['structured_data']['author_contact_email_types'] = sanitize_text_field($input['structured_data']['author_contact_email_types']);
	$input['structured_data']['publisher_type'] = sanitize_text_field($input['structured_data']['publisher_type']);
	$input['structured_data']['publisher_name'] = sanitize_text_field($input['structured_data']['publisher_name']);
	$input['structured_data']['publisher_contact_phones'] = sanitize_text_field($input['structured_data']['publisher_contact_phones']);
	$input['structured_data']['publisher_contact_phone_types'] = sanitize_text_field($input['structured_data']['publisher_contact_phone_types']);
	$input['structured_data']['publisher_contact_emails'] = sanitize_text_field($input['structured_data']['publisher_contact_emails']);
	$input['structured_data']['publisher_contact_email_types'] = sanitize_text_field($input['structured_data']['publisher_contact_email_types']);
	$input['structured_data']['creator_type'] = sanitize_text_field($input['structured_data']['creator_type']);
	$input['structured_data']['creator_name'] = sanitize_text_field($input['structured_data']['creator_name']);
	$input['structured_data']['creator_image'] = sanitize_text_field($input['structured_data']['creator_image']);
	$input['structured_data']['creator_contact_phones'] = sanitize_text_field($input['structured_data']['creator_contact_phones']);
	$input['structured_data']['creator_contact_phone_types'] = sanitize_text_field($input['structured_data']['creator_contact_phone_types']);
	$input['structured_data']['creator_contact_emails'] = sanitize_text_field($input['structured_data']['creator_contact_emails']);
	$input['structured_data']['creator_contact_email_types'] = sanitize_text_field($input['structured_data']['creator_contact_email_types']);
	return $input;
}
add_action('admin_init', 'dw_schemas_local_business_settings_register');
function dw_schemas_local_business_settings_register()
{
	register_setting('schemas_local_business_settings_group', 'schemas_local_business_options', 'schemas_local_business_sanitize_options');
}
/**
 * function for field values sanitizing of local business structured data options
 */
function dw_schemas_local_business_sanitize_options($input) {
	$input['allow_default_local_business_structured_data'] = sanitize_text_field(strtolower($input['allow_default_local_business_structured_data']));
	$input['structured_data'][0]['office_name'] = sanitize_text_field($input['structured_data'][0]['office_name']);
	$input['structured_data'][0]['office_address'] = sanitize_text_field($input['structured_data'][0]['office_address']);
	$input['structured_data'][0]['office_logo'] = sanitize_text_field($input['structured_data'][0]['office_logo']);
	$input['structured_data'][0]['office_contact_phone'] = sanitize_text_field($input['structured_data'][0]['office_contact_phone']);
	$input['structured_data'][0]['office_contact_email'] = sanitize_text_field($input['structured_data'][0]['office_contact_email']);
	$input['structured_data'][0]['office_url'] = sanitize_text_field($input['structured_data'][0]['office_url']);
	$input['structured_data'][0]['office_business_days_full'] = sanitize_text_field($input['structured_data'][0]['office_business_days_full']);
	$input['structured_data'][0]['office_business_days_short'] = sanitize_text_field($input['structured_data'][0]['office_business_days_short']);
	$input['structured_data'][0]['office_payment_accepted'] = sanitize_text_field($input['structured_data'][0]['office_payment_accepted']);
	$input['structured_data'][0]['office_price_range'] = sanitize_text_field($input['structured_data'][0]['office_price_range']);
	return $input;
}