<?php 

	function dw_render_basic_structured_data_metabox($post, $box) { ?>

	<?php
		$schemas_metas = get_post_meta($post->ID, '_schemas_structured_data', true);
		
		/**
		 * if specified post meta is empty/doesn't exist: assign default values to $schemas_metas variable: required to escape all kind of warning and errors on post/page edit screen if there is no meta data
		 */
		if(empty($schemas_metas)):
			include WP_PLUGIN_DIR.'/schemas/includes/defaults.php';
		endif;
	 	wp_nonce_field( plugin_basename(__FILE__), 'schemas_save_meta_box' ); 
	 ?>

	<div class="allow-structured-data-wrapper">
		<div class="allow-structured-data-header"><h4>Allow Structured Data?</h4></div>
		<div class="allow-structured-data-controls">
			<input 
				type="radio" 
				class="allow-structured-data"
				name="_schemas_allow_structured_data" 
				value="true" 
				<?php echo checked($schemas_metas['allow_structured_data'], "true") ?> 
				/><span>Allow</span>
			<input 
				type="radio" 
				class="allow-structured-data" 
				name="_schemas_allow_structured_data" 
				value="false" 
				<?php echo checked($schemas_metas['allow_structured_data'], "false") ?> 
			/><span>Disallow</span>
		</div>
	</div>
	<div 
		class="structured-data-fields-wrapper
		<?php echo ($schemas_metas['allow_structured_data'] == 'false') ? 'disallowed' : '' ?>">
		<div class="structured-data-type-wrapper">
			<div class="structured-data-type-header">
				<h4>Structured Data Type</h4>
			</div>
			<div class="structured-data-type">
				<input 
					type="text" 
					class="structured-data-field" 
					name="_schemas_structured_data_type" 
					value="<?php echo $schemas_metas['structured_data']['structured_data_type'] ?>"
				/>
			</div>
		</div>
		<div class="structured-data-keywords-wrapper">
			<div class="structured-data-keywords-header">
				<h4>
					Structured Data Keywords
				</h4>
			</div>
			<div class="structured-data-keywords">
				<input 
					type="text" 
					class="structured-data-field" 
					name="_schemas_structured_data_keywords" 
					value="<?php echo $schemas_metas['structured_data']['structured_data_keywords'] ?>"
				/>
			</div>
		</div>
		<div class="structured-data-text-wrapper">
			<div class="structured-data-text-header">
				<h4>
					Structured Data Text
				</h4>
			</div>
			<div class="structured-data-text">
				<input 
					type="text" 
					class="structured-data-field" 
					name="_schemas_structured_data_text" 
					value="<?php echo $schemas_metas['structured_data']['structured_data_text'] ?>" 
				/>
			</div>
		</div>
		<div class="use-default-basic-structured-data-wrapper">
			<div class="use-default-basic-structured-data-header"><h4>Use Default Basic Structured Data?</h4></div>
			<div class="use-default-basic-structured-data-controls">
				<input 
					type="radio" 
					class="use-default-basic-structured-data"
					name="_schemas_use_default_basic_structured_data" 
					value="allow" 
					<?php echo checked($schemas_metas['structured_data']['use_default_basic_structured_data'], "allow") ?> 
				/><span>Allow</span>
				<input 
					type="radio" 
					class="use-default-basic-structured-data" 
					name="_schemas_use_default_basic_structured_data" 
					value="disallow" 
					<?php echo checked($schemas_metas['structured_data']['use_default_basic_structured_data'], "disallow") ?> 
				/><span>Disallow</span>
			</div>
		</div>
		<div 
			class="structured-data-info-wrapper 
			<?php echo ($schemas_metas['structured_data']['use_default_basic_structured_data'] == 'allow') ? 'disallowed' : '' ?>">
			<div class="structured-data-post-author-header">
				<h4>
					Structured Data Author Type
				</h4>
			</div>
			<div class="structured-data-post-author-switcher">
				<?php $author_types = ['Person', 'Organization']; ?>
				<?php foreach ($author_types as $author_type) : ?>
					<input 
						type="radio" 
						class="structured-data-field" 
						name="_schemas_structured_data_author_type" 
						<?php checked($schemas_metas['structured_data']['author_type'], strtolower($author_type)) ?> value="<?php echo strtolower($author_type); ?>" 
					/><span><?php echo $author_type ?></span>
				<?php endforeach ?>
			</div>			
			<div class="structured-data-post-author-header">
				<h4>
					Structured Data Post Author
				</h4>
			</div>
			<div class="structured-data-post-author-switcher">
				<?php $post_author_types = ['Post Author', 'Custom Author']; ?>
				<?php foreach ($post_author_types as $post_author_type) : ?>
					<input 
						type="radio" 
						class="post-author-switch structured-data-field" 
						name="_schemas_structured_data_post_author_type" 
						<?php checked($schemas_metas['structured_data']['post_author_type'], strtolower($post_author_type)) ?> 
						value="<?php echo strtolower($post_author_type); ?>" 
					/><span><?php echo $post_author_type ?></span>
				<?php endforeach ?>
			</div>			
			<div class="structured-data-post-author-name-wrapper">
				<div class="structured-data-post-author-name-header">
					<h4>
						Structured Data Post Author Name
					</h4>
				</div>
				<div class="structured-data-post-author-name">
					<?php 
						$post_author = get_the_author_meta('display_name', get_post_field('post_author')); 
						$disabled = ($schemas_metas['structured_data']['post_author_type'] == 'custom author');
					?>
					<div class="author-name <?php echo ($disabled) ? 'invisible' : '' ?>">
						<span>Author: </span><?php echo $post_author ?>
					</div>
					<input 
						type="hidden" 
						class="post-author-name" 
						<?php echo ($disabled) ? "disabled='disabled'" : "" ?> 
						name="_schemas_structured_data_author_name" 
						value="<?php echo $post_author?>" 
					/>
					<?php $disabled = ($schemas_metas['structured_data']['post_author_type'] == 'post author') ? "disabled='disabled'" : "" ?>
					<div class="structured-data-custom-post-author-name">
						<input 
							type="text" 
							<?php echo $disabled; ?> 
							class="author-name custom-author-name structured-data-field <?php echo ($disabled) ? 'invisible' : '' ?>" 
							name="_schemas_structured_data_author_name" value="<?php echo $schemas_metas['structured_data']['author_name'] ?>"
						/>
					</div>
				</div>
			</div>
			<div class="structured-data-author-image-wrapper">
				<div class="structured-data-author-image-header">
					<h4>
						Structured Data Author Image
					</h4>
				</div>
				<div class="structured-data-author-image">
					<input 
						type="text" 
						class="structured-data-field" 
						name="_schemas_structured_data_author_image" 
						value="<?php echo $schemas_metas['structured_data']['author_image'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-author-contact-phones-wrapper">
				<div class="structured-data-author-contact-phones-header">
					<h4>
						Structured Data Author Contact Phones
					</h4>
				</div>
				<div class="structured-data-author-contact-phones">
					<input 
						type="text" 
						class="structured-data-field author-phones" 
						name="_schemas_structured_data_author_contact_phones" 
						value="<?php echo $schemas_metas['structured_data']['author_contact_phones'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-author-contact-phone-types-wrapper">
				<div class="structured-data-author-contact-phone-types-header">
					<h4>
						Structured Data Author Contact Phone Types
					</h4>
				</div>
				<div class="structured-data-author-contact-phone-types">
					<input 
						type="text" 
						class="structured-data-field author-phone-types" 
						name="_schemas_structured_data_author_contact_phone_types" 
						value="<?php echo $schemas_metas['structured_data']['author_contact_phone_types'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-author-contact-emails-wrapper">
				<div class="structured-data-author-contact-emails-header">
					<h4>
						Structured Data Author Contact Emails
					</h4>
				</div>
				<div class="structured-data-author-contact-emails">
					<input 
						type="text" 
						class="structured-data-field author-emails" 
						name="_schemas_structured_data_author_contact_emails" 
						value="<?php echo $schemas_metas['structured_data']['author_contact_emails'] ?>"
					/>
				</div>
			</div>
			<div class="structured-data-author-contact-email-types-wrapper">
				<div class="structured-data-author-contact-email-types-header">
					<h4>
						Structured Data Author Contact Email Types
					</h4>
				</div>
				<div class="structured-data-author-contact-email-types">
					<input 
						type="text" 
						class="structured-data-field author-email-types" 
						name="_schemas_structured_data_author_contact_email_types" 
						value="<?php echo $schemas_metas['structured_data']['author_contact_email_types'] ?>"
					/>
				</div>
			</div>
			<div class="structured-data-publisher-name-wrapper">
				<div class="structured-data-publisher-name-header">
					<h4>
						Structured Data Publisher Name
					</h4>
				</div>
				<div class="structured-data-publisher-name">
					<input 
						type="text" 
						class="structured-data-field" 
						name="_schemas_structured_data_publisher_name" 
						value="<?php echo $schemas_metas['structured_data']['publisher_name'] ?>"
					/>
				</div>
			</div>
			<div class="structured-data-publisher-image-wrapper">
				<div class="structured-data-publisher-image-header">
					<h4>
						Structured Data Publisher Image
					</h4>
				</div>
				<div class="structured-data-publisher-image">
					<input 
						type="text" 
						class="structured-data-field" 
						name="_schemas_structured_data_publisher_image" 
						value="<?php echo $schemas_metas['structured_data']['publisher_image'] ?>"
					/>
				</div>
			</div>
			<div class="structured-data-publisher-contact-phones-wrapper">
				<div class="structured-data-publisher-contact-phones-header">
					<h4>
						Structured Data Publisher Contact Phones
					</h4>
				</div>
				<div class="structured-data-publisher-contact-phones">
					<input 
						type="text" 
						class="structured-data-field publisher-phones" 
						name="_schemas_structured_data_publisher_contact_phones" 
						value="<?php echo $schemas_metas['structured_data']['publisher_contact_phones'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-publisher-contact-phone-types-wrapper">
				<div class="structured-data-publisher-contact-phone-types-header">
					<h4>
						Structured Data Publisher Contact Phone Types
					</h4>
				</div>
				<div class="structured-data-publisher-contact-phone-types">
					<input 
						type="text" 
						class="structured-data-field publisher-phone-types" 
						name="_schemas_structured_data_publisher_contact_phone_types" 
						value="<?php echo $schemas_metas['structured_data']['publisher_contact_phone_types'] ?>"
					/>
				</div>
			</div>
			<div class="structured-data-publisher-contact-emails-wrapper">
				<div class="structured-data-publisher-contact-emails-header">
					<h4>
						Structured Data Publisher Contact Emails
					</h4>
				</div>
				<div class="structured-data-publisher-contact-emails">
					<input 
						type="text" 
						class="structured-data-field publisher-emails" 
						name="_schemas_structured_data_publisher_contact_emails" 
						value="<?php echo $schemas_metas['structured_data']['publisher_contact_emails'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-publisher-contact-email-types-wrapper">
				<div class="structured-data-publisher-contact-email-types-header">
					<h4>
						Structured Data Publisher Contact Email Types
					</h4>
				</div>
				<div class="structured-data-publisher-contact-email-types">
					<input 
						type="text" 
						class="structured-data-field publisher-email-types" 
						name="_schemas_structured_data_publisher_contact_email_types" 
						value="<?php echo $schemas_metas['structured_data']['publisher_contact_email_types'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-post-creator-type-wrapper">
				<div class="structured-data-post-creator-type-header">
					<h4>
						Structured Data Creator Type
					</h4>
				</div>
				<div class="structured-data-post-creator-switcher">
					<?php $creator_types = ['Person', 'Organization']; ?>
					<?php foreach ($creator_types as $creator_type) : ?>
						<input 
							type="radio" 
							class="structured-data-field" 
							name="_schemas_structured_data_creator_type" 
							<?php checked($schemas_metas['structured_data']['creator_type'], strtolower($creator_type)) ?> 
							value="<?php echo strtolower($creator_type); ?>" 

						/><span><?php echo $creator_type ?></span>
					<?php endforeach ?>
				</div>			
			</div>
			<div class="structured-data-post-creator-wrapper">
				<div class="structured-data-post-creator-header">
					<h4>
						Structured Data Post Creator
					</h4>
				</div>
				<div class="structured-data-post-creator-switcher">
					<?php $post_creator_types = ['Post Creator', 'Custom Creator']; ?>
					<?php foreach ($post_creator_types as $post_creator_type) : ?>
						<input 
							type="radio" 
							class="post-creator-switch structured-data-field" 
							name="_schemas_structured_data_post_creator_type" 
							<?php checked($schemas_metas['structured_data']['post_creator_type'], strtolower($post_creator_type)) ?> 
							value="<?php echo strtolower($post_creator_type); ?>" 
						/><span><?php echo $post_creator_type ?></span>
					<?php endforeach ?>
				</div>			
			</div>
			<div class="structured-data-post-creator-name-wrapper">
				<div class="structured-data-post-creator-name-header">
					<h4>
						Structured Data Post Creator Name
					</h4>
				</div>
				<div class="structured-data-post-creator-name">
					<?php 
						$post_creator = get_the_author_meta('display_name', get_post_field('post_author')); 
						$disabled = ($schemas_metas['structured_data']['post_creator_type'] == 'custom creator');
					?>
					<div class="creator-name <?php echo ($disabled) ? 'invisible' : '' ?>">
						<span>Creator: </span><?php echo $post_creator ?>
					</div>
					<input 
						type="hidden" 
						class="post-creator-name" 
						<?php echo ($disabled) ? "disabled='disabled'" : "" ?> 
						name="_schemas_structured_data_creator_name" 
						value="<?php echo $post_creator?>" 
					/>
					<?php $disabled = ($schemas_metas['structured_data']['post_creator_type'] == 'post creator') ? "disabled='disabled'" : "" ?>
					<div class="structured-data-custom-post-creator-name">
						<input 
							type="text" 
							<?php echo $disabled; ?> 
							class="creator-name custom-creator-name structured-data-field <?php echo ($disabled) ? 'invisible' : '' ?>" 
							name="_schemas_structured_data_creator_name" 
							value="<?php echo $schemas_metas['structured_data']['creator_name'] ?>" 
						/>
					</div>
				</div>
			</div>
			<div class="structured-data-creator-image-wrapper">
				<div class="structured-data-creator-image-header">
					<h4>
						Structured Data Creator Image
					</h4>
				</div>
				<div class="structured-data-creator-image">
					<input 
						type="text" 
						class="structured-data-field" 
						name="_schemas_structured_data_creator_image" 
						value="<?php echo $schemas_metas['structured_data']['creator_image'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-creator-contact-phones-wrapper">
				<div class="structured-data-creator-contact-phones-header">
					<h4>
						Structured Data Creator Contact Phones
					</h4>
				</div>
				<div class="structured-data-creator-contact-phones">
					<input 
						type="text" 
						class="structured-data-field creator-phones" 
						name="_schemas_structured_data_creator_contact_phones" 
						value="<?php echo $schemas_metas['structured_data']['creator_contact_phones'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-creator-contact-phone-types-wrapper">
				<div class="structured-data-creator-contact-phone-types-header">
					<h4>
						Structured Data Creator Contact Phone Types
					</h4>
				</div>
				<div class="structured-data-creator-contact-phone-types">
					<input 
						type="text" 
						class="structured-data-field creator-phone-types" 
						name="_schemas_structured_data_creator_contact_phone_types" 
						value="<?php echo $schemas_metas['structured_data']['creator_contact_phone_types'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-creator-contact-emails-wrapper">
				<div class="structured-data-creator-contact-emails-header">
					<h4>
						Structured Data Creator Contact Emails
					</h4>
				</div>
				<div class="structured-data-creator-contact-emails">
					<input 
						type="text" 
						class="structured-data-field creator-emails" 
						name="_schemas_structured_data_creator_contact_emails" 
						value="<?php echo $schemas_metas['structured_data']['creator_contact_emails'] ?>" 
					/>
				</div>
			</div>
			<div class="structured-data-creator-contact-email-types-wrapper">
				<div class="structured-data-creator-contact-email-types-header">
					<h4>
						Structured Data Creator Contact Email Types
					</h4>
				</div>
				<div class="structured-data-creator-contact-email-types">
					<input 
						type="text" 
						class="structured-data-field creator-email-types" 
						name="_schemas_structured_data_creator_contact_email_types" 
						value="<?php echo $schemas_metas['structured_data']['creator_contact_email_types'] ?>"
					/>
				</div>
			</div>
		</div>
	</div>
<?php } ?>