(function($) {
	$(document).ready(function(){
		$('.allow-default-structured-data').on('change', function(){
			if($(this).val() == 'disallow') {
				$('.structured-data-field').attr('readonly', true);
				$('.structured-data-radio').each(function(){
					if($(this).is(':checked')){
						return;
					} else {
						$(this).attr('disabled', true);
					}
				})
			} else {
				$('.structured-data-field').attr('readonly', false);
				$('.structured-data-radio').attr('disabled', false);
			}
		});

		$('.allow-default-local-business-structured-data').on('change', function(){
			if($(this).val() == 'disallow') {
				$('.local-business-structured-field').attr('readonly', true);
			} else {
				$('.local-business-structured-field').attr('readonly', false);
			}
		})

		$('.allow-common-values').on('change', function(){
			if($(this).val() == 'disallow') {
				$('.creator').attr('readonly', false);
				$('.structured-data-radio.creator').attr('disabled', false);
			} else {
				$('.creator').attr('readonly', true);
				$('.structured-data-radio.creator').each(function(){
					if($(this).is(':checked')){
						return;
					} else {
						$(this).attr('disabled', true);
					}
				})
			}
		});

		$(document).on('click', '.local-business-wrapper-header', function(){
			$(this).siblings('.local-business-structured-data-inner-block-wrapper').slideToggle('slow');
		})

		$(document).on('click', '.add-block', function(){
			$(this).parent().parent().clone().appendTo('.local-business-structured-data-outer-block-wrapper').find("input[type='text']").val('');

			let offices_number = $('.local-business-object-wrapper').length;

			$('.local-business-object-wrapper:last').find('.local-business-wrapper-header').find('.office-number').text(offices_number);

			let object_count = parseInt($('.local-business-objects-count').val());
			$('.local-business-objects-count').val(object_count+1);
			if($('.local-business-objects-count').val() > 0){
				$('.remove-block').attr('disabled', false).css({'background-color':'red'});
			}
		});

		$(document).on('click', '.remove-block', function(){
			$(this).parent().parent().remove();

			let object_count = parseInt($('.local-business-objects-count').val());
			$('.local-business-objects-count').val(object_count-1);
			if($('.local-business-objects-count').val() == 0){
				$('.remove-block').attr('disabled', true).css({'background-color':'grey'});
			}
		});	

		$('.allow-local-business-structured-data').on('change', function(){
			if($(this).val() == 'false') {
				$('.local-business-structured-data-outer-block-wrapper').slideToggle('slow');
			} else {
				$('.local-business-structured-data-outer-block-wrapper').slideToggle('slow');
			}
		});

		$('.allow-structured-data').on('change', function(){
			if($(this).val() == 'false') {
				$('.structured-data-fields-wrapper').slideToggle('slow');
			} else {
				$('.structured-data-fields-wrapper').slideToggle('slow');
			}
		});

		$('.use-default-basic-structured-data').on('change', function(){
			if($(this).val() == 'allow') {
				$('.structured-data-info-wrapper').slideToggle('slow');
			} else {
				$('.structured-data-info-wrapper').slideToggle('slow');			
			}
		})

		$('.post-author-switch').on('change', function(){
			$('.author-name').toggleClass('invisible');
			if($(this).val() == "post author"){
				$('.custom-author-name').attr('disabled', true);
				$('.post-author-name').attr('disabled', false);
			}

			if($(this).val() == "custom author"){
				$('.custom-author-name').attr('disabled', false);
				$('.post-author-name').attr('disabled', true);
			}
		})

		$('.post-creator-switch').on('change', function(){
			$('.creator-name').toggleClass('invisible');
			if($(this).val() == "post creator"){
				$('.custom-creator-name').attr('disabled', true);
				$('.post-creator-name').attr('disabled', false);
			}

			if($(this).val() == "custom creator"){
				$('.custom-creator-name').attr('disabled', false);
				$('.post-creator-name').attr('disabled', true);
			}
		})

		$('.author-phones, .author-phone-types').blur(function(){
			contacts_length_match_validation($(this), ['.author-phones', '.author-phone-types']);
		});

		$('.author-emails, .author-email-types').blur(function(){
			contacts_length_match_validation($(this), ['.author-emails', '.author-email-types']);			
		});

		$('.publisher-phones, .publisher-phone-types').blur(function(){
			contacts_length_match_validation($(this), ['.publisher-phones', '.publisher-phone-types']);
		});

		$('.publisher-emails, .publisher-email-types').blur(function(){
			contacts_length_match_validation($(this), ['.publisher-emails', '.publisher-email-types']);			
		});

		$('.creator-phones, .creator-phone-types').blur(function(){
			contacts_length_match_validation($(this), ['.creator-phones', '.creator-phone-types']);
		});

		$('.creator-emails, .creator-email-types').blur(function(){
			contacts_length_match_validation($(this), ['.creator-emails', '.creator-email-types']);			
		});
	});

	function contacts_length_match_validation(blured_field, fields_names) {
		let contacts_list = $(fields_names[0]).val().split(',');
		let contact_types_list = $(fields_names[1]).val().split(',');

		if(contacts_list.length != contact_types_list.length) {
			if(blured_field.parent().find('.error').length == 0) {
				blured_field.parent().append('<span class="error" style="color:red">Number of contact points and their types should match</span>');
				if($('.structured-data-field').siblings('.error').length != 0){
					$('.submit > input, input[name="save"]').attr('disabled', true);
				}
			}
		} else {;
			$(fields_names[0]).parent().find('.error').remove();
			$(fields_names[1]).parent().find('.error').remove();
			if($('.structured-data-field').siblings('.error').length == 0) {
				$('.submit > input, input[name="save"]').attr('disabled', false);
			};
		}
	}
})(jQuery);