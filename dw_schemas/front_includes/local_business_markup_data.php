<?php 
if(!is_archive() && !is_home()):
	global $post;
	$schemas_local_business_data;
	$schemas_local_business_options = get_option('schemas_local_business_options');
	$schemas_local_business_metas = get_post_meta($post->ID, '_schemas_local_business_structured_data', true);
	if(empty($schemas_local_business_metas)):
		include WP_PLUGIN_DIR.'/schemas/includes/defaults.php';
	endif;
	if($schemas_local_business_options['allow_default_local_business_structured_data'] == 'allow' && $schemas_local_business_metas['allow_local_business_structured_data'] == 'false'):
		$schemas_local_business_data = $schemas_local_business_options;		
	elseif(($schemas_local_business_options['allow_default_local_business_structured_data'] == 'allow' && $schemas_local_business_metas['allow_local_business_structured_data'] == 'true') || ($schemas_local_business_options['allow_default_local_business_structured_data'] == 'disallow' && $schemas_local_business_metas['allow_local_business_structured_data'] == 'true')):
		$schemas_local_business_data = $schemas_local_business_metas;
	endif;
endif;