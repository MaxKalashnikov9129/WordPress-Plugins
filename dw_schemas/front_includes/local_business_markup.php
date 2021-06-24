<?php  
add_action('wp_head', 'dw_add_local_business_schema_markup');
function dw_add_local_business_schema_markup() {
	/**
	 * contains logic responsible for fetching data for actual structured data markup
	 */
	include __DIR__.'/local_business_markup_data.php';
?>
	<?php if(!is_archive() && !is_home()): ?>
		<?php if(
			($schemas_local_business_options['allow_default_local_business_structured_data'] == 'allow' || $schemas_local_business_metas['allow_local_business_structured_data'] == 'true')): ?>
			<?php for ($i=0; $i <= (count($schemas_local_business_data['structured_data'])-1); $i++) : 
				$office_address = explode(',', $schemas_local_business_data['structured_data'][$i]['office_address']);
				$business_days = explode(',', $schemas_local_business_data['structured_data'][$i]['office_business_days_full']);
				$business_hours = explode('-', $schemas_local_business_data['structured_data'][$i]['office_business_hours']);
				$index = 0;
			?>
				<script type="application/ld+json">
				{
					"@context":"https://schema.org",
					"@type": "LocalBusiness",
					"name": "<?php echo $schemas_local_business_data['structured_data'][$i]['office_name']; ?>",
					"image":"<?php echo site_url()."/".$schemas_local_business_data['structured_data'][$i]['office_logo']; ?>",
					"email":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_contact_email']; ?>",
					"telephone":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_contact_phone']; ?>",
					"url":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_url']; ?>",
					"openingHours":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_business_days_short']." ".$schemas_local_business_data['structured_data'][$i]['office_business_hours']; ?>",
					"paymentAccepted":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_payment_accepted']; ?>",
					"priceRange":"<?php echo $schemas_local_business_data['structured_data'][$i]['office_price_range']; ?>",
					"address": {
						"@type":"postalAddress",
						"streetAddress": "<?php echo trim($office_address[0]) ?>",
						"addressLocality":"<?php echo trim($office_address[1]) ?>",
						"addressRegion":"<?php echo trim($office_address[2]) ?>",
						"postalCode":"<?php echo trim($office_address[3]) ?>"
					},
					"openingHoursSpecification": {
						"@type":"OpeningHoursSpecification",
						"dayOfWeek": [
							<?php foreach ($business_days as $business_day): ?>
								"<?php echo trim($business_day) ?>"<?php echo (++$index === count($business_days)) ? ""  : ","?>
							<?php endforeach ?>
						],
						"opens":"<?php echo trim($business_hours[0]) ?>",
						"closes":"<?php echo trim($business_hours[1]) ?>"
					}
				}
				</script>
			<?php endfor ?>
		<?php endif; ?>
	<?php endif; ?>
<?php } ?>