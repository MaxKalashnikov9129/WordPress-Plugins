<?php 
if(!is_archive() && !is_home()):
		global $post;
		$schemas_data;
		$schemas_options = get_option('schemas_options');
		$schemas_metas = get_post_meta($post->ID, '_schemas_structured_data', true);
		if(empty($schemas_metas)):
			include WP_PLUGIN_DIR.'/schemas/includes/defaults.php';
		endif;
		if(($schemas_options['allow_default_structured_data'] == 'allow' && $schemas_metas['allow_structured_data'] == 'true') ||
			($schemas_options['allow_default_structured_data'] == 'disallow' && $schemas_metas['allow_structured_data'] == 'true')
		):
			$schemas_data = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? $schemas_metas : $schemas_options;
			$author_type = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['author_type']) : ucfirst($schemas_options['structured_data']['author_type']);
			$author_name = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['author_name']) : ucfirst($schemas_options['structured_data']['author_name']);
			$author_image = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? $schemas_metas['structured_data']['author_image'] : $schemas_options['structured_data']['author_image'];
			$author_image_type = (($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow'  && $schemas_metas['structured_data']['author_type'] == 'person') || ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'allow' && $schemas_options['structured_data']['author_type'] == 'person')) ? 'image' : 'logo';
			$publisher_type = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['publisher_type']) : ucfirst($schemas_options['structured_data']['publisher_type']);
			$publisher_name = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['publisher_name']) : ucfirst($schemas_options['structured_data']['publisher_name']);
			$publisher_image = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? $schemas_metas['structured_data']['publisher_image'] : $schemas_options['structured_data']['publisher_image'];
			$creator_type = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['creator_type']) : ucfirst($schemas_options['structured_data']['creator_type']);
			$creator_name = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow') ? ucfirst($schemas_metas['structured_data']['creator_name'])  : ucfirst($schemas_options['structured_data']['creator_name']);
			$creator_image = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow' && $schemas_options['structured_data']['allow_common_values'] == 'allow') ? $author_image : (
					($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow' && $schemas_options['structured_data']['allow_common_values'] == 'disallow') ? $schemas_metas['structured_data']['creator_image'] : (
						($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'allow' && $schemas_options['structured_data']['allow_common_values'] == 'allow') ? $schemas_options['structured_data']['author_image'] : $schemas_options['structured_data']['creator_image']
				)
			);
			$creator_image_type = ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow' && $schemas_options['structured_data']['allow_common_values'] == 'allow') ? $author_image_type : (
					(($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'disallow' && $schemas_options['structured_data']['allow_common_values'] == 'disallow') && $schemas_metas['structured_data']['creator_type'] == 'person') ? 'image' : (
						(($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'allow' && $schemas_options['structured_data']['allow_common_values'] == 'allow') && $schemas_options['structured_data']['author_type'] == 'person' ) ? 'image' : (
							($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'allow' && $schemas_options['structured_data']['allow_common_values'] == 'disallow') && $schemas_options['structured_data']['creator_type'] == 'person') ? 'image' : 'logo'
				)
			);
		endif;
		if($schemas_options['allow_default_structured_data'] == 'allow' && $schemas_metas['allow_structured_data'] == 'false'):
			$schemas_data = $schemas_options;
			$author_type = ucfirst($schemas_options['structured_data']['author_type']);
			$author_name = ucfirst($schemas_options['structured_data']['author_name']);
			$author_image = $schemas_options['structured_data']['author_image'];
			$author_image_type = ($schemas_options['structured_data']['author_type'] == 'person') ? 'image' : 'logo';
			$publisher_type = ucfirst($schemas_options['structured_data']['publisher_type']);
			$publisher_name = ucfirst($schemas_options['structured_data']['publisher_name']);
			$publisher_image = $schemas_options['structured_data']['publisher_image'];
			$creator_type = ucfirst($schemas_options['structured_data']['creator_type']);
			$creator_name = ucfirst($schemas_options['structured_data']['creator_name']);
			$creator_image = ($schemas_options['structured_data']['allow_common_values'] == "allow") ? $author_image : $schemas_options['structured_data']['creator_image'];
			$creator_image_type = ($schemas_options['structured_data']['allow_common_values'] == "allow") ? $author_image_type : (($schemas_options['structured_data']['creator_type'] == 'person') ? 'image' : 'logo');
		endif;
		$index = 0;
		$author_phones_list = dw_assemble_contacts_list($schemas_data, 'author', 'phone');
		$author_emails_list = dw_assemble_contacts_list($schemas_data, 'author', 'email');
		$publisher_phones_list = dw_assemble_contacts_list($schemas_data, 'publisher', 'phone');
		$publisher_emails_list = dw_assemble_contacts_list($schemas_data, 'publisher', 'email');
		$creator_phones_list = ($schemas_options['structured_data']['allow_common_values'] == "allow") ? dw_assemble_contacts_list($schemas_data, 'author', 'phone') : dw_assemble_contacts_list($schemas_data, 'creator', 'phone');
		$creator_emails_list = ($schemas_options['structured_data']['allow_common_values'] == "allow") ? dw_assemble_contacts_list($schemas_data, 'author', 'email') : dw_assemble_contacts_list($schemas_data, 'creator', 'email');
	endif;