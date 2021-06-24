<?php  
add_action('wp_head', 'dw_add_basic_schema_markup');
/**
 * function to process arrays of contact points (phones/emails) and their types: returns array with types as keys and contact points as values
 */
function dw_assemble_contacts_list($option, $schema_field, $contact_means) {
	$contact_types_list = explode(',', $option['structured_data'][$schema_field.'_contact_'.$contact_means.'_types']);
	$contact_values_list = explode(',', $option['structured_data'][$schema_field.'_contact_'.$contact_means.'s']);
	return array_combine($contact_types_list, $contact_values_list);
}
function dw_add_basic_schema_markup() {
	/**
	 * contains logic responsible for fetching data for actual structured data markup
	 */
	include __DIR__.'/basic_markup_data.php';
?>
	<?php if(!is_archive() && !is_home()): ?>
		<?php if($schemas_options['allow_default_structured_data'] == 'allow' || $schemas_metas['allow_structured_data'] == 'true'): ?>
			<script type="application/ld+json">
			{
				"@context":"https://schema.org",
				"@type": "<?php echo ($schemas_metas['allow_structured_data'] == 'true') ? $schemas_metas['structured_data']['structured_data_type'] : $schemas_options['default_'.get_post_type().'s_structured_data_schema'] ?>",
				"url": "<?php echo (is_front_page()) ? site_url() : get_permalink(); ?>",
				"headline": "<?php the_title(); ?>",
				<?php if($post->post_content || ($schemas_metas['allow_structured_data'] == 'true' && !empty($schemas_metas['structured_data']['structured_data_text'])) ): ?>
					"text": "<?php echo (!empty($post->post_content)) ? strip_tags($post->post_content) : $schemas_metas['structured_data']['structured_data_text']; ?>",
				<?php endif; ?>
				"inLanguage": "<?php echo get_locale(); ?>",
				<?php if(!empty($schemas_metas['allow_structured_data'] == 'true' && $schemas_metas['structured_data']['structured_data_keywords'])): ?>
					"keywords": "<?php echo $schemas_metas['structured_data']['structured_data_keywords']; ?>",
				<?php endif; ?>
				"dateCreated": "<?php echo get_the_date("Y-m-d"."\T"."H:m:i") ?>",
				"dateModified": "<?php echo get_the_modified_date("Y-m-d"."\T"."H:m:i") ?>",
				"datePublished": "<?php echo get_the_date("Y-m-d"."\T"."H:m:i") ?>",
				"mainEntityOfPage": {
					"@type": "WebPage",
					"@id": "<?php echo (is_front_page()) ? site_url() : get_permalink(); ?>"
				},
				"image": {
					"@type": "ImageObject",
					"url": "<?php echo get_the_post_thumbnail_url(); ?>"
				},
				"author": {
					"@type": "<?php echo $author_type; ?>",
					"name": "<?php echo $author_name; ?>",
					"<?php echo $author_image_type ?>": {
						"@type": "ImageObject",
						"url": "<?php echo site_url().'/'.$author_image; ?>"
					},
					"contactPoint": [
						<?php foreach ($author_phones_list as $phone_type => $phone): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($phone_type) ?>",
							"telephone": "<?php echo trim($phone); ?>"
							<?php echo (++$index === count($author_phones_list) && !array_filter($author_emails_list)) ? "}"  : "},"?>
							<?php ($index === count($author_phones_list)) ? $index = 0 : ""  ?>
						<?php endforeach ?>
						<?php foreach ($author_emails_list as $email_type => $email): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($email_type) ?>",
							"telephone": "<?php echo $email; ?>",
							"url": "<?php echo site_url(); ?>"
							<?php echo (++$index === count($author_emails_list)) ? "}" : "},"?>
							<?php ($index === count($author_emails_list)) ? $index = 0 : ""  ?>
						<?php endforeach ?>
					]
				},
				"publisher": {
					"@type": "<?php echo $publisher_type; ?>",
					"name": "<?php echo $publisher_name ?>",
					"logo": {
						"@type": "ImageObject",
						"url": "<?php echo site_url().'/'.$publisher_image?>"
					},
					"contactPoint": [
						<?php foreach ($publisher_phones_list as $phone_type => $phone): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($phone_type) ?>",
							"telephone": "<?php echo trim($phone); ?>"
							<?php echo (++$index === count($publisher_phones_list) && !array_filter($publisher_emails_list)) ? "}" : "},"?>
							<?php ($index === count($publisher_phones_list)) ? $index = 0 : ""  ?>
						<?php endforeach ?>
						<?php foreach ($publisher_emails_list as $email_type => $email): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($email_type) ?>",
							"telephone": "<?php echo $email; ?>",
							"url": "<?php echo site_url(); ?>"
							<?php echo (++$index === count($publisher_emails_list)) ? "}" : "},"?>
							<?php ($index === count($publisher_emails_list)) ? $index = 0 : ""  ?>
						<?php endforeach ?>
					]
				},
				"creator": {
					"@type": "<?php echo ($schemas_options['structured_data']['allow_common_values'] == 'allow') ? $author_type : $creator_type ?>",
					"name": "<?php echo ($schemas_options['structured_data']['allow_common_values'] == 'allow') ? $author_name : $creator_name ?>",
					"<?php echo $creator_image_type ?>": {
						"@type": "ImageObject",
						"url": "<?php echo site_url().'/'.$creator_image; ?>"
					},
					"contactPoint": [
						<?php foreach ($creator_phones_list as $phone_type => $phone): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($phone_type) ?>",
							"telephone": "<?php echo trim($phone); ?>"
							<?php echo (++$index === $creator_phones_count && !array_filter($creator_emails_list)) ? "}" : "},"?>
							<?php ($index === $creator_phones_count) ? $index = 0 : ""  ?>
						<?php endforeach ?>
						<?php foreach ($creator_emails_list as $email_type => $email): ?>
						{
							"@type": "ContactPoint",
							"contactType": "<?php echo trim($email_type) ?>",
							"telephone": "<?php echo $email; ?>",
							"url": "<?php echo site_url(); ?>"
							<?php echo (++$creator_emails_index === count($creator_emails_list)) ? "}" : "},"?>
							<?php ($index === count($creator_emails_list)) ? $index = 0 : ""  ?>
						<?php endforeach ?>
					]
				}
			}
			</script>
		<?php endif; ?>
	<?php endif;?>
<?php } ?>