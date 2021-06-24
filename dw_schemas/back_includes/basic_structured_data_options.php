<?php 

add_action('admin_init', 'dw_render_basic_schemas_settings');

function dw_render_basic_schemas_settings() {
	/**
	 * Section to provide controls for allowing/disallowing default structured data and switch to use "common values" for some fields
	 */
	add_settings_section('allow_default_structured_data_section', 'Allow Default Structured Data', 'dw_render_allow_default_structured_data_section_description', 'schemas_settings');
	add_settings_field('allow_structured_data_field', 'Allow Structured Data?', 'dw_render_allow_default_structured_data_field', 'schemas_settings', 'allow_default_structured_data_section');
	add_settings_field('default_common_values_field', 'Use author\'s data for other fields', 'dw_render_default_common_values_field', 'schemas_settings', 'allow_default_structured_data_section');

	/**
	 * Section to provide controls for defining posts/pages' structured data types 
	 */
	add_settings_section('default_schemas_type_section', 'Default Schema Type', 'dw_render_default_schemas_type_section_description', 'schemas_settings');
	add_settings_field('default_posts_type_field', 'Default Posts Type', 'dw_render_default_posts_type_field', 'schemas_settings', 'default_schemas_type_section');
	add_settings_field('default_pages_type_field', 'Default Pages Type', 'dw_render_default_pages_type_field', 'schemas_settings', 'default_schemas_type_section');

	/**
	 * Section to provide author data for structured data markup
	 */
	add_settings_section('default_schemas_structured_data_author_section', 'Default Structured Data Author', 'dw_render_default_structured_data_author_settings_section_description', 'schemas_settings');
	add_settings_field('default_author_type_field', 'Default Author Type', 'dw_render_default_author_type_field', 'schemas_settings', 'default_schemas_structured_data_author_section');	
	add_settings_field('default_author_field', 'Default Author', 'dw_render_default_author_field', 'schemas_settings', 'default_schemas_structured_data_author_section');
	add_settings_field('default_author_image_field', 'Default Author Image', 'dw_render_default_author_image_field', 'schemas_settings', 'default_schemas_structured_data_author_section');
	add_settings_field('default_author_phones_field', 'Default Author Phones', 'dw_render_default_author_phones_field', 'schemas_settings', 'default_schemas_structured_data_author_section');
	add_settings_field('default_author_phone_type_field', 'Default Author Phone Types', 'dw_render_default_author_phones_types_field', 'schemas_settings', 'default_schemas_structured_data_author_section');
	add_settings_field('default_author_emails_field', 'Default Author Emails', 'dw_render_default_author_emails_field', 'schemas_settings', 'default_schemas_structured_data_author_section');
	add_settings_field('default_author_email_type_field', 'Default Author Email Types', 'dw_render_default_author_emails_types_field', 'schemas_settings', 'default_schemas_structured_data_author_section');

	/**
	 * Section to provide publisher data for structured data markup
	 */
	add_settings_section('default_schemas_structured_data_publisher_section', 'Default Structured Data Publisher', 'dw_render_default_structured_data_publisher_settings_section_description', 'schemas_settings');
	add_settings_field('default_publisher_type_field', 'Default Publisher Type', 'dw_render_default_publisher_type_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');	
	add_settings_field('default_publisher_field', 'Default Publisher', 'dw_render_default_publisher_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');
	add_settings_field('default_publisher_image_field', 'Default Publisher Image', 'dw_render_default_publisher_image_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');
	add_settings_field('default_publisher_phones_field', 'Default Publisher Phones', 'dw_render_default_publisher_phones_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');
	add_settings_field('default_publisher_phone_type_field', 'Default Publisher Phone Types', 'dw_render_default_publisher_phones_types_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');
	add_settings_field('default_publisher_emails_field', 'Default publisher Emails', 'dw_render_default_publisher_emails_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');
	add_settings_field('default_publisher_email_type_field', 'Default publisher Email Types', 'dw_render_default_publisher_emails_types_field', 'schemas_settings', 'default_schemas_structured_data_publisher_section');

	/**
	 * Section to provide creator data for structured data markup
	 */
	add_settings_section('default_schemas_structured_data_creator_section', 'Default Structured Data Creator', 'dw_render_default_structured_data_creator_settings_section_description', 'schemas_settings');
	add_settings_field('default_creator_type_field', 'Default Creator Type', 'dw_render_default_creator_type_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');	
	add_settings_field('default_creator_field', 'Default creator', 'dw_render_default_creator_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');
	add_settings_field('default_creator_image_field', 'Default Creator Image', 'dw_render_default_creator_image_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');
	add_settings_field('default_creator_phones_field', 'Default Creator Phones', 'dw_render_default_creator_phones_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');
	add_settings_field('default_creator_phone_type_field', 'Default Creator Phone Types', 'dw_render_default_creator_phones_types_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');
	add_settings_field('default_creator_emails_field', 'Default Creator Emails', 'dw_render_default_creator_emails_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');
	add_settings_field('default_creator_email_type_field', 'Default Creator Email Types', 'dw_render_default_creator_emails_types_field', 'schemas_settings', 'default_schemas_structured_data_creator_section');

}

/**
 * Set of functions to render allow/disallow section of settings page
 */
function dw_render_allow_default_structured_data_section_description() {
	echo '<p>Do you want to use default structured mark up for all post and pages</p>';
}

function dw_render_allow_default_structured_data_field() {
	$schemas_options = get_option('schemas_options');

	$options = ['Allow', 'Disallow'];

	foreach ($options as $option) :
		$checked = ($schemas_options['allow_default_structured_data'] == strtolower($option)) ? "checked='checked'" : "";
		$value = trim(strtolower($option));
		echo "<input 
				type='radio' 
				class='allow-default-structured-data' 
				name='schemas_options[allow_default_structured_data]' 
				value='$value' $checked 
			/><span>$option</span>"; 
	endforeach;
}

function dw_render_default_common_values_field() {
	$schemas_options = get_option('schemas_options');

	$options = ['Allow', 'Disallow'];

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	foreach ($options as $option) :
		$checked = ($schemas_options['structured_data']['allow_common_values'] == strtolower($option)) ? "checked='checked'" : ""; 
		$value = strtolower($option);
		$disabled = ($schemas_options['structured_data']['allow_common_values'] <> $value && $schemas_options['allow_default_structured_data'] == 'disallow') ? 'disabled="disabled"' : '';
		echo "<input  
				type='radio'
				$read_only
				$disabled 
				class='structured-data-field allow-common-values structured-data-radio' 
				name='schemas_options[structured_data][allow_common_values]' 
				value='$value' $checked
			/><span>$option</span>"; 
	endforeach;
}

/**
 * 
 */
function dw_render_default_schemas_type_section_description() {
	$schemas_options = get_option('schemas_options');
 
	echo "<p class='default-content-structured-data-header structured-data-header'>Choose default structured data type for post and pages.</p>";
}

function dw_render_default_posts_type_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text'
			$read_only
			class='structured-data-field' 
			name='schemas_options[default_posts_structured_data_schema]' 
			value='".$schemas_options['default_posts_structured_data_schema']."'
		/>";
}

function dw_render_default_pages_type_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text'
			$read_only; 
			class='structured-data-field' 
			name='schemas_options[default_pages_structured_data_schema]' 
			value='".$schemas_options['default_pages_structured_data_schema']."'
		/>";
}

function dw_render_default_structured_data_settings_section_description() {
	$schemas_options = get_option('schemas_options'); 

	echo "<p class='set-structured-data-header structured-data-header'>Set default structured data </p>";
}

function dw_render_default_structured_data_author_settings_section_description() {
	echo "<p class='structured-data-header default-author-section-description'>Set Default Structured Data for Author</p>";
}

function dw_render_default_author_type_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	$types = ['Person', 'Organization'];
	foreach ($types as $type) :
		$value = strtolower($type);
		$checked = ($schemas_options['structured_data']['author_type'] == $value) ? "checked='checked'" : "";
		$disabled = ($schemas_options['structured_data']['author_type'] <> $value && $schemas_options['allow_default_structured_data'] == 'disallow') ? 'disabled="disabled"' : '';

		echo "<input  
				type='radio'
				$read_only
				$disabled
				class='structured-data-field structured-data-radio' 
				name='schemas_options[structured_data][author_type]' 
				value='$value' $checked
			/><span>$type</span>"; 
	endforeach;	
}

function dw_render_default_author_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input
			type='text' 
			$read_only
			class='structured-data-field' 
			name='schemas_options[structured_data][author_name]' 
			value='".$schemas_options['structured_data']['author_name']."'
		/>";
}

function dw_render_default_author_image_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field' 
			name='schemas_options[structured_data][author_image]' 
			value='".$schemas_options['structured_data']['author_image']."'
		/>";
}

function dw_render_default_author_phones_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			class='structured-data-field author-phones' 
			type='text' 
			name='schemas_options[structured_data][author_contact_phones]' 
			value='".$schemas_options['structured_data']["author_contact_phones"]."'
		/>";	
}

function dw_render_default_author_phones_types_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field author-phone-types' 
			name='schemas_options[structured_data][author_contact_phone_types]' 
			value='".$schemas_options['structured_data']['author_contact_phone_types']."'
		/>";	
}

function dw_render_default_author_emails_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field author-emails' 
			name='schemas_options[structured_data][author_contact_emails]' 
			value='".$schemas_options["structured_data"]["author_contact_emails"]."'
		/>";	
}

function dw_render_default_author_emails_types_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field author-email-types' 
			name='schemas_options[structured_data][author_contact_email_types]' 
			value='".$schemas_options['structured_data']['author_contact_email_types']."'
		/>";	
}

function dw_render_default_structured_data_publisher_settings_section_description() {
	echo "<p class='structured-data-header default-publisher-section-description'>Set Default Structured Data for Publisher</p>";
}

function dw_render_default_publisher_type_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	$types = ['Organization'];
	foreach ($types as $type) :
		$value = strtolower($type);
		$checked = ($schemas_options['structured_data']['publisher_type'] == $value) ? "checked='checked'" : "";
		$disabled = ($schemas_options['structured_data']['publisher_type'] <> $value && $schemas_options['allow_default_structured_data'] == 'disallow') ? 'disabled="disabled"' : '';
		echo "<input 
				type='radio' 
				class='structured-data-field structured-data-radio' 
				name='schemas_options[structured_data][publisher_type]' 
				value='$value' 
				$checked
			/><span>$type</span>"; 
	endforeach;	
}

function dw_render_default_publisher_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			class='structured-data-field' 
			$read_only 
			name='schemas_options[structured_data][publisher_name]' 
			value='".$schemas_options['structured_data']['publisher_name']."'
		/>";	
}

function dw_render_default_publisher_image_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			class='structured-data-field' 
			$read_only name='schemas_options[structured_data][publisher_image]' 
			value='".$schemas_options['structured_data']['publisher_image']."'
		/>";
}

function dw_render_default_publisher_phones_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			class='structured-data-field publisher-phones' 
			$read_only 
			name='schemas_options[structured_data][publisher_contact_phones]' 
			value='".$schemas_options["structured_data"]["publisher_contact_phones"]."'
		/>";	
}

function dw_render_default_publisher_phones_types_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			$read_only 
			class='structured-data-field publisher-phone-types' 
			name='schemas_options[structured_data][publisher_contact_phone_types]' 
			value='".$schemas_options['structured_data']['publisher_contact_phone_types']."'
		/>";	
}

function dw_render_default_publisher_emails_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			class='structured-data-field publisher-emails' 
			$read_only 
			name='schemas_options[structured_data][publisher_contact_emails]' 
			value='".$schemas_options['structured_data']["publisher_contact_emails"]."'
		/>";	
}

function dw_render_default_publisher_emails_types_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	echo "<input 
			type='text' 
			class='structured-data-field publisher-email-types' 
			$read_only 
			name='schemas_options[structured_data][publisher_contact_email_types]' 
			value='".$schemas_options['structured_data']['publisher_contact_email_types']."'
		/>";	
}

function dw_render_default_structured_data_creator_settings_section_description() {
	echo "<p class='structured-data-header default-creator-section-description'>Set Default Structured Data for Creator</p>";
}

function dw_render_default_creator_type_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow') ? 'readonly="readonly"' : '';

	$types = ['Person', 'Organization'];
	foreach ($types as $type) :
		$value = strtolower($type);
		$checked = ($schemas_options['structured_data']['creator_type'] == $value) ? "checked='checked'" : "";
		$disabled = ($schemas_options['structured_data']['creator_type'] <> $value && ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow')) ? 'disabled="disabled"' : '';

		echo "<input 
				$read_only 
				$disabled 
				type='radio' 
				class='structured-data-field creator structured-data-radio'
				name='schemas_options[structured_data][creator_type]' 
				value='$value' $checked 
			/><span>$type</span>"; 
	endforeach;	
}

function dw_render_default_creator_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator' 
			name='schemas_options[structured_data][creator_name]' 
			value='".$schemas_options['structured_data']['creator_name']."'
		/>";	
}

function dw_render_default_creator_image_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator' 
			name='schemas_options[structured_data][creator_image]' 
			value='".$schemas_options['structured_data']['creator_image']."'
		/>";
}

function dw_render_default_creator_phones_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';
	
	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator creator-phones' 
			name='schemas_options[structured_data][creator_contact_phones]' 
			value='".$schemas_options['structured_data']["creator_contact_phones"]."'
		/>";	
}

function dw_render_default_creator_phones_types_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator creator-phone-types' 
			name='schemas_options[structured_data][creator_contact_phone_types]' 
			value='".$schemas_options['structured_data']['creator_contact_phone_types']."' 
		/>";	
}

function dw_render_default_creator_emails_field() {
	$schemas_options = get_option('schemas_options');
	
	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator creator-emails' 
			name='schemas_options[structured_data][creator_contact_emails]' 
			value='".$schemas_options["structured_data"]["creator_contact_emails"]."'
		/>";	
}

function dw_render_default_creator_emails_types_field() {
	$schemas_options = get_option('schemas_options');

	$read_only = ($schemas_options['allow_default_structured_data'] == 'disallow' || $schemas_options['structured_data']['allow_common_values'] == 'allow') ? 'readonly="readonly"' : '';

	echo "<input 
			$read_only 
			type='text' 
			class='structured-data-field creator creator-email-types' 
			name='schemas_options[structured_data][creator_contact_email_types]' 
			value='".$schemas_options['structured_data']['creator_contact_email_types']."'
		/>";	
}