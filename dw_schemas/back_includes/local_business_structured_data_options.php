<?php 
add_action('admin_init', 'dw_render_local_business_schemas_settings');
function dw_render_local_business_schemas_settings() { 
	/**
	 * Section to provide controls for allowing/disallowing default local business structured data and setting categories/post types to use local business structured data
	 */
	add_settings_section('allow_default_local_business_structured_data_section', 'Allow Default Local Business Structured Data', 'dw_render_allow_default_local_business_structured_data_section_description', 'schemas_local_business_settings');
	add_settings_field('allow_local_business_structured_data_field', 'Allow Local Business Structured Data?', 'dw_render_allow_default_local_business_structured_data_field', 'schemas_local_business_settings', 'allow_default_local_business_structured_data_section');
	/**
	 * Section to provide info for structured data markup
	 */
	add_settings_section('default_local_business_structured_data_section', 'Default Local Business Structured Data', 'dw_render_default_local_business_structured_data_section_description', 'schemas_local_business_settings');
	add_settings_field('local_business_structured_data_office_name_field', 'Local Business Structured Data: Office Name', 'dw_render_default_local_business_structured_data_office_name_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_address_field', 'Local Business Structured Data: Office Address', 'dw_render_default_local_business_structured_data_office_address_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_logo_field', 'Local Business Structured Data: Office Logo', 'dw_render_default_local_business_structured_data_office_logo_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_phone_field', 'Local Business Structured Data: Office Phone', 'dw_render_default_local_business_structured_data_office_contact_phone_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_email_field', 'Local Business Structured Data: Office Email', 'dw_render_default_local_business_structured_data_office_contact_email_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_url_field', 'Local Business Structured Data: Office Url', 'dw_render_default_local_business_structured_data_office_contact_url_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_business_days_full_field', 'Local Business Structured Data: Office Business Days (Full)', 'dw_render_default_local_business_structured_data_office_business_days_full_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_business_days_short_field', 'Local Business Structured Data: Office Business Days (Short)', 'dw_render_default_local_business_structured_data_office_business_days_short_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_business_hours_field', 'Local Business Structured Data: Office Business Hours', 'dw_render_default_local_business_structured_data_office_business_hours_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_payment_accepted_field', 'Local Business Structured Data: Office Payment Accepted', 'dw_render_default_local_business_structured_data_office_payment_accepted_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
	add_settings_field('local_business_structured_data_office_price_range_field', 'Local Business Structured Data: Office Price Range', 'dw_render_default_local_business_structured_data_office_price_range_field', 'schemas_local_business_settings', 'default_local_business_structured_data_section');
}
/**
 * Set of functions to allow/disallow local business structured data and categories/post types to use it
 */
function dw_render_allow_default_local_business_structured_data_section_description() {
	echo '<p>Do you want to use default local business structured mark up for all post and pages</p>';
}
function dw_render_allow_default_local_business_structured_data_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$options = ['Allow', 'Disallow'];
	foreach ($options as $option) :
		$checked = ($schemas_local_business_options['allow_default_local_business_structured_data'] == strtolower($option)) ? "checked='checked'" : "";
		$value = trim(strtolower($option));
		echo "<input type='radio' class='allow-default-local-business-structured-data' name='schemas_local_business_options[allow_default_local_business_structured_data]' value='$value' $checked /><span>$option</span>"; 
	endforeach;
}
function dw_render_categories_local_business_structured_data() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='categories-local-business-structured-data local-business-structured-field' 
			name='schemas_local_business_options[local_business_categories]'
			value='".$schemas_local_business_options['local_business_categories']."' 
		/>"; 
}
function dw_render_post_types_local_business_structured_data() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='categories-local-business-structured-data local-business-structured-field' 
			name='schemas_local_business_options[local_business_post_types]'
			value='".$schemas_local_business_options['local_business_post_types']."' 
		/>"; 
}
/**
 * Set of function dw_to provide info for local business structured data
 */
function dw_render_default_local_business_structured_data_section_description() {
	echo '<p>Default local business structured data fields</p>';
}
function dw_render_default_local_business_structured_data_office_name_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-name local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_name]'
			value='".$schemas_local_business_options['structured_data'][0]['office_name']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_address_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only 
			class='default-local-business-structured-data-office-address local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_address]'
			value='".$schemas_local_business_options['structured_data'][0]['office_address']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_logo_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only 
			class='default-local-business-structured-data-office-logo local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_logo]'
			value='".$schemas_local_business_options['structured_data'][0]['office_logo']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_contact_phone_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only 
			class='default-local-business-structured-data-office-contact-phone local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_contact_phone]'
			value='".$schemas_local_business_options['structured_data'][0]['office_contact_phone']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_contact_email_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-contact-email local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_contact_email]'
			value='".$schemas_local_business_options['structured_data'][0]['office_contact_email']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_contact_url_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-contact-url local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_url]'
			value='".$schemas_local_business_options['structured_data'][0]['office_url']."' />"; 
}
function dw_render_default_local_business_structured_data_office_business_days_full_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-business-days-full local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_business_days_full]'
			value='".$schemas_local_business_options['structured_data'][0]['office_business_days_full']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_business_days_short_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-business-days-short local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_business_days_short]'
			value='".$schemas_local_business_options['structured_data'][0]['office_business_days_short']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_business_hours_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-business-hours local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_business_hours]'
			value='".$schemas_local_business_options['structured_data'][0]['office_business_hours']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_payment_accepted_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only 
			class='default-local-business-structured-data-office-payment-accepted local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_payment_accepted]'
			value='".$schemas_local_business_options['structured_data'][0]['office_payment_accepted']."' 
		/>"; 
}
function dw_render_default_local_business_structured_data_office_price_range_field() {
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$read_only = ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';
	echo "<input 
			type='text'
			$read_only
			class='default-local-business-structured-data-office-price-range local-business-structured-field' 
			name='schemas_local_business_options[structured_data][0][office_price_range]'
			value='".$schemas_local_business_options['structured_data'][0]['office_price_range']."' 
		/>"; 
}
?>