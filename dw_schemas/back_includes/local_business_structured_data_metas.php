<?php 
	function dw_render_local_business_structured_data_metabox($post, $box) { ?>
	<?php
		/**
		 * get local business meta data from DB
		 */
		$schemas_local_business_metas = get_post_meta($post->ID, '_schemas_local_business_structured_data', true);
		/**
		 * if required metadata is empty or doesn't exist - set default values for a single iteration
		 */
		if(empty($schemas_local_business_metas)):
			include WP_PLUGIN_DIR.'/schemas/includes/defaults.php';
		endif;
	 	wp_nonce_field( plugin_basename(__FILE__), 'schemas_save_meta_box' ); 
	 ?>
	<div class="allow-structured-data-wrapper">
		<div class="allow-structured-data-header">
			<h4>Allow Local Business Structured Data?</h4>
		</div>
		<div class="allow-structured-data-controls">
			<input type="radio" class="allow-local-business-structured-data" class="" name="_schemas_allow_local_business_structured_data" value="true" <?php echo checked($schemas_local_business_metas['allow_local_business_structured_data'], "true") ?>><span>Allow</span>
			<input type="radio" class="allow-local-business-structured-data" name="_schemas_allow_local_business_structured_data" value="false" <?php echo checked($schemas_local_business_metas['allow_local_business_structured_data'], "false") ?>><span>Disallow</span>
		</div>
	</div>
	<div class="local-business-structured-data-outer-block-wrapper <?php echo ($schemas_local_business_metas['allow_local_business_structured_data'] == 'false') ? 'disallowed' : '' ?>">		
		<?php foreach ($schemas_local_business_metas['structured_data'] as $key => $local_business_schemas_value): ?>
			<div class="local-business-object-wrapper">
				<div class="local-business-wrapper-header">				
					Office #<span class="office-number"><?php echo $key+1 ?></span>
				</div>
				<div class="local-business-structured-data-inner-block-wrapper">
					<div class="structured-data-office-name-wrapper">
						<div class="structured-data-office-name-header">
							<h4>Local Business Structured Data: Office Name</h4>
						</div>
						<div class="structured-data-office-name-controls">
							<input 
								type="text" 
								class="structured-data-office-name"  
								name="_local_business_schemas_structured_data_office_name[]" 
								value="<?php echo $local_business_schemas_value['office_name'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-address-wrapper">
						<div class="structured-data-office-address-header">
							<h4>Local Business Structured Data: Office Address</h4>
						</div>
						<div class="structured-data-office-address-controls">
							<input 
								type="text" 
								class="structured-data-office-address" 
								name="_local_business_schemas_structured_data_office_address[]" 
								value="<?php echo $local_business_schemas_value['office_address'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-logo-wrapper">
						<div class="structured-data-office-logo-header">
							<h4>Local Business Structured Data: Office Logo</h4>
						</div>
						<div class="structured-data-office-logo-controls">
							<input 
								type="text" 
								class="structured-data-office-logo" 
								name="_local_business_schemas_structured_data_office_logo[]" 
								value="<?php echo $local_business_schemas_value['office_logo'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-contact-phone-wrapper">
						<div class="structured-data-office-contact-phone-header">
							<h4>Local Business Structured Data: Office Contact Phone</h4>
						</div>
						<div class="structured-data-office-contact-phone-controls">
							<input 
								type="text" 
								class="structured-data-office-contact-phone" 
								name="_local_business_schemas_structured_data_office_contact_phone[]" 
								value="<?php echo $local_business_schemas_value['office_contact_phone'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-contact-email-wrapper">
						<div class="structured-data-office-contact-email-header">
							<h4>Local Business Structured Data: Office Contact Email</h4>
						</div>
						<div class="structured-data-office-contact-email-controls">
							<input 
								type="text" 
								class="structured-data-office-contact-email"
								name="_local_business_schemas_structured_data_office_contact_email[]" 
								value="<?php echo $local_business_schemas_value['office_contact_email'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-url-wrapper">
						<div class="structured-data-office-url-header">
							<h4>Local Business Structured Data: Office Url</h4>
						</div>
						<div class="structured-data-office-url-controls">
							<input 
								type="text" 
								class="structured-data-office-url"
								name="_local_business_schemas_structured_data_office_url[]" 
								value="<?php echo $local_business_schemas_value['office_url'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-business-days-full-wrapper">
						<div class="structured-data-office-business-days-full-header">
							<h4>Local Business Structured Data: Office Business Days Full</h4>
						</div>
						<div class="structured-data-office-business-days-full-controls">
							<input 
								type="text" 
								class="structured-data-office-business-days-full" 
								name="_local_business_schemas_structured_data_office_business_days_full[]" 
								value="<?php echo $local_business_schemas_value['office_business_days_full'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-business-days-short-wrapper">
						<div class="structured-data-office-business-days-short-header">
							<h4>Local Business Structured Data: Office Business Days Short</h4>
						</div>
						<div class="structured-data-office-business-days-short-controls">
							<input 
								type="text" 
								class="structured-data-office-business-days-short"
								name="_local_business_schemas_structured_data_office_business_days_short[]" 
								value="<?php echo $local_business_schemas_value['office_business_days_short'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-business-hours-wrapper">
						<div class="structured-data-office-business-hours-header">
							<h4>Local Business Structured Data: Office Business Hours</h4>
						</div>
						<div class="structured-data-office-business-hours-controls">
							<input 
								type="text" 
								class="structured-data-office-business-hours" 
								name="_local_business_schemas_structured_data_office_business_hours[]" 
								value="<?php echo $local_business_schemas_value['office_business_hours'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-payment-accepted-wrapper">
						<div class="structured-data-office-payment-accepted-header">
							<h4>Local Business Structured Data: Office Payment Accepted</h4>
						</div>
						<div class="structured-data-office-payment-accepted-controls">
							<input 
								type="text" 
								class="structured-data-office-payment-accepted"
								name="_local_business_schemas_structured_data_office_payment_accepted[]" 
								value="<?php echo $local_business_schemas_value['office_payment_accepted'] ?>" 
							/>
						</div>
					</div>
					<div class="structured-data-office-price-range-wrapper">
						<div class="structured-data-office-price-range-header">
							<h4>Local Business Structured Data: Office Price Range</h4>
						</div>
						<div class="structured-data-office-price-range-controls">
							<input 
								type="text" 
								class="structured-data-office-price-range" 
								name="_local_business_schemas_structured_data_office_price_range[]" 
								value="<?php echo $local_business_schemas_value['office_price_range'] ?>" 
							/>
						</div>
					</div>
				</div>
				<div class="control-buttons">
					<button class="add-block" type="button"></button>
					<button class="remove-block <?php echo ((count($schemas_local_business_metas['structured_data'])-1) == 0) ? 'disabled' : ''; ?>" <?php echo ((count($schemas_local_business_metas['structured_data'])-1) == 0) ? 'disabled="disabled"' : ''; ?> type="button"></button>				
				</div>
			</div>
		<?php endforeach ?>
	</div>
	<input type="hidden"  class="local-business-objects-count" name="local_business_objects_count" value="<?php echo (count($schemas_local_business_metas['structured_data'])-1); ?>">
<?php } ?>