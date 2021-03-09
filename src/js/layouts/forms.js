var mf,
moduleForms = {
	settings: {
		mainDoc: $(document),
		formEls: $('.gform_wrapper form'),
		fieldPaymentFrequency: $('.gform_wrapper li.frequency'),
		fieldChooseDonationAmountText: $('.gform_wrapper li.choose-amount label').first().text(),
		fieldTotalDonationAmount: $('.gform_wrapper li.total-amount'),
		fieldTotalDonationAmountText: $('.gform_wrapper li.total-amount label').first().text()
	},
	init: function() {
		mf = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.mf = mf;
		$.expose.randomQuote = moduleForms;
		console.log('moduleForms loaded!');
	},
	bindUIActions: function() {

		$(document).on('click', '.gform_wrapper li.frequency [type=radio]~label', function() {
			console.log('You clicked the frequency button');
			moduleForms.setTotalText( $(this) );
		});
		mf.mainDoc.bind('gform_post_render', function() {
			moduleForms.enableSubmits();
			moduleForms.stickyFields();
			moduleForms.setTotalText( $('.gform_wrapper li.frequency [type=radio]:checked~label') );
			moduleForms.creditCardName();

			// Amount Edit button
			if ( $('.gform_wrapper.newdonate_wrapper').length > 0 ) {
				// Getting the form id
				var formID = $('.gform_wrapper.newdonate_wrapper').attr('id');
				// Getting the form id #, removing all characters
				formID = formID.replace(/\D/g, '');
				// Creating an edit button, referencing the back/next button format
				var editButton = '<input type="button" id="gform_edit_button_' + formID + '_57" class="gform_edit_button" value="Edit" onclick="jQuery(&quot;#gform_target_page_number_' + formID + '&quot;).val(&quot;1&quot;);  jQuery(&quot;#gform_' + formID + '&quot;).trigger(&quot;submit&quot;,[true]); " onkeypress="if( event.keyCode == 13 ){ jQuery(&quot;#gform_target_page_number_' + formID + '&quot;).val(&quot;1&quot;);  jQuery(&quot;#gform_' + formID + '&quot;).trigger(&quot;submit&quot;,[true]); } ">';
				// Appending the edit button to the total donation amount fields
				$('.newdonate_wrapper .total-amount .ginput_container_total').append(editButton);

				// Add class to labels for radio button fields
				var radioBtnFields = $('.newdonate_wrapper .gfield_label + .ginput_container_radio');
				if (radioBtnFields.length > 0) {
					radioBtnFields.each(function() {
						$(this).prev().addClass('no-fancy-label');
					});
				}
				// Add class to labels for calculation fields
				var calculationFields = $('.newdonate_wrapper .gfield_label + .ginput_container.ginput_container_product_calculation');
				if (calculationFields.length > 0) {
					calculationFields.each(function() {
						$(this).prev().addClass('no-fancy-label');
					});
				}
			}

			moduleForms.creditCardLabels();
		});
		mf.mainDoc.on('submit', '.gform_wrapper form', function(){
			moduleForms.disableSubmits($(this).find('input[type=submit]'));
		});
		moduleForms.emailNotification();
	},
	creditCardLabels: function() {
		// Adding a label to credit card expiration year field
        var yearField = $('.newdonate_wrapper .ginput_container_creditcard .ginput_card_expiration_container.ginput_card_field .ginput_card_expiration_year');
		var yearFieldID = yearField.attr('id');
		var yearLabel = '<label for="' + yearFieldID + '" class="label-expiration-year">Year</label>';
		$(yearLabel).insertBefore('.newdonate_wrapper .ginput_container_creditcard .ginput_card_expiration_container.ginput_card_field .ginput_card_expiration_year');
		// Make first option of selects empty
		$('.newdonate_wrapper .ginput_container_creditcard .ginput_card_expiration_container.ginput_card_field .ginput_card_expiration_month > option:first-child').text('');
		$('.newdonate_wrapper .ginput_container_creditcard .ginput_card_expiration_container.ginput_card_field .ginput_card_expiration_year > option:first-child').text('');
	},
	setTotalText: function(el) {
		if(el.text() == 'Monthly'){
			console.log('Clicked on the Monthly frequency');
			$('.gform_wrapper li.choose-amount').find('label').first().text('Choose Monthly Donation Amount*');
		} else {
			console.log('Clicked on the Give Once frequency');
			$('.gform_wrapper li.choose-amount').find('label').first().text(mf.fieldChooseDonationAmountText);
		}
	},
	stickyFields: function() {
		console.log('Sticky form fields');
		var donatePaymentFrequency = document.querySelector('.newdonate_wrapper li.frequency');
		// var donateAmount = document.querySelector('.newdonate_wrapper li.total-amount');
		var donateFormBody = document.querySelector('.newdonate_wrapper .gform_body');
		if (donatePaymentFrequency) {
			// donateFormBody.insertBefore(donateAmount, donateFormBody.childNodes[0]);
			donateFormBody.insertBefore(donatePaymentFrequency, donateFormBody.childNodes[0]);
		}
		// Reorder the fields in Andar Account
		var andarFName = document.querySelector('.newdonate_wrapper .gform_body .personal-information .andar_first_name');
		var andarLName = document.querySelector('.newdonate_wrapper .gform_body .personal-information .andar_last_name');
		var andarAccount = document.querySelector('.newdonate_wrapper .gform_body .personal-information .ginput_container_andaraccount');
		if (andarFName && andarLName) {
			andarAccount.insertBefore(andarLName, andarAccount.childNodes[0]);
			andarAccount.insertBefore(andarFName, andarAccount.childNodes[0]);
		}
	},
	enableSubmits: function(){
		console.log('Enabling Submit');
		mf.formEls.find('input[type=submit]').removeAttr('disabled');
		$('.newdonate_wrapper .gform_page').removeClass('overlay');
	},
	disableSubmits: function(el){
		console.log('Disabling Submit');
		el.attr('disabled', 'true');
		$('.newdonate_wrapper .gform_page').addClass('overlay');
	},
	emailNotification: function() {
		console.log('Andar email notifications');
		if (mf.formEls.length > 0) {
			mf.formEls.each(function(){
				// Get Andar email input field
				var andarEmail = $('.ginput_container_andaremail input');
				// Get the hidden email input field
				var hiddenEmail = $('.ginput_container_email input');
				// For each form, check for the Andar email input field
				if ( andarEmail.length ) {
					// console.log('An Andar email field exists');
					andarEmail.on('blur', function() {
						// console.log('Blur event');
						var andarEmailVal = andarEmail.val();
						// console.log('The Andar email is ' + andarEmailVal);
						// Set the hidden email input value
						hiddenEmail.val(andarEmailVal);
					});
				}
			});
		}
	},
	creditCardName: function() {
		// Use a form-wide class to only target particular forms.
		var fnameInput = $('.newdonate_wrapper .andar_first_name input');
		var lnameInput = $('.newdonate_wrapper .andar_last_name input');

		// When changing the first name or last name fields, we need to pass those values to the hidden credit card name field
		fnameInput.change(function(){
			var thisForm = $(this).parents('.gform_wrapper');
			var newNameVal = $(this).val() + ' ' + thisForm.find('.andar_last_name input').val();
			// Set the cc name field value
			thisForm.find('.ginput_container_creditcard span.ginput_full:last-child input').val(newNameVal); 
		});
		lnameInput.change(function(){
			var thisForm = $(this).parents('.gform_wrapper');
			var newNameVal = thisForm.find('.andar_first_name input').val() + ' ' + $(this).val();
			// Set the cc name field value                
			thisForm.find('.ginput_container_creditcard span.ginput_full:last-child input').val(newNameVal);
		});
	}
};
