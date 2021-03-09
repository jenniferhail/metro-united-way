var mn,
modalNotification = {
	settings: {
		button: $('.notification-toggle'),
		close: $('.notification-close'),
		mobileButton: $('.notification-toggle-mobile'),
		mobileClose: $('.notification-toggle-mobile'),
		container: $('#notification'),
		notificationID: $('#notification').data('notification-id'),
		body: $('body')
	},
	init: function() {
		mn = this.settings;
		console.log('modalNotification loaded!');
		if (mn.container.length > 0) {
			console.log('#notification has length');
			this.bindUIActions();
		}
	},
	bindUIActions: function() {

		// Initial setting of transform origin, so the notification opens from the right location
		modalNotification.setOrigin();

		// Update transform origin when window is resized
		$(window).resize(function(){
			modalNotification.setOrigin();
		});

		// Remove hidden class from popup if the cookie does not yet exist
		var popupCookie = document.cookie;
		if (popupCookie.indexOf('notification=') >= 0) {
			var popupCookieString = popupCookie.split('notification=');
			popupCookieString = popupCookieString[1].split(';');
			popupCookieString = popupCookieString[0];
			if (popupCookieString != mn.notificationID && mn.body.hasClass('home') ) {
				mn.container.removeClass('hidden');
				// Add the closeOutside function here
				modalNotification.closeOutside();
			}
		} else if ( mn.body.hasClass('home') ) {
			mn.container.removeClass('hidden');
			// Add the closeOutside function here
			modalNotification.closeOutside();
		}

		// Open the notification
		mn.button.click(function(evt){
			evt.preventDefault();
			modalNotification.toggleNotification();
		});

		// Open the notification on mobile
		mn.mobileButton.click( function(evt){
			evt.preventDefault();
			modalNotification.toggleNotification();
		});

		// Close the notification
		mn.close.click( function(evt) {
			evt.preventDefault();
			document.cookie = 'notification=' + mn.notificationID;
			modalNotification.toggleNotification();
		});

	},
	toggleNotification: function() {
		modalNotification.setOrigin();
		mn.container.toggleClass('hidden');
		modalNotification.closeOutside();
	},
	closeOutside: function() {
		$('#notification').click( function(evt) {
			// console.log('You clicked on #notification');
			var target = $( evt.target );
			// console.log(target);
			if ( !target.is( '.notification-link' ) ) {
				// Do nothing
				document.cookie = 'notification=' + mn.notificationID;
				modalNotification.setOrigin();
				mn.container.addClass('hidden');
			}
		});
	},
	setOrigin: function() {
		var windowWidth = $(window).width();
		if (windowWidth > 1015) {
			var buttonWidth = mn.button.width();
			var buttonOffset = mn.button.offset();
		} else {
			var buttonWidth = mn.mobileButton.width();
			var buttonOffset = mn.mobileButton.offset();
		}
		var diffX = buttonOffset.left + buttonWidth*0.5;

		if ($('.header').hasClass('reveal')) {
			var diffY = '35';
		} else {
			var diffY = '50';
		}
		var transform = diffX + 'px ' + diffY + 'px';
		mn.container.css({transformOrigin: transform});

	}
}
