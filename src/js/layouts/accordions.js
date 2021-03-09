var ac,
accordions = {
	settings: {
		accItem: $('.acc-item'),
		accContent: $('.acc-item .acc-content'),
		title: $('.acc-item .title')
	},

	init: function() {
		ac = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.ac = ac;
		$.expose.accordions = accordions;
		console.log('accordions loaded!');
		if(ac.accContent.length > 0){
		   ac.accContent.addClass('hide');
		}
	},
	bindUIActions: function() {
		ac.title.on('click', function() {
			$(this).closest('.acc-item').find('.acc-content').slideToggle( '3000', function() {
				// Animation complete.
			});
		});
	}
};

var navac,
navAccordions = {
	settings: {
		accItem: $('.nav-acc-item, #mobile-menu .menu-item-has-children'),
		accContent: $('.nav-acc-item .nav-acc-content, #mobile-menu .menu-item-has-children .sub-menu'),
		title: $('.nav-acc-item .title, #mobile-menu .menu-item-has-children > a')
	},
	init: function() {
		navac = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.navac = navac;
		$.expose.navAccordions = navAccordions;
		console.log('nav accordions loaded!');
	},
	bindUIActions: function() {
		navac.title.on('click', function(evt) {
			evt.preventDefault();
			// close all navAccordions
			navac.title.not(this).closest('.nav-acc-item').find('.nav-acc-content').slideUp( '3000', function() {
				// Animation complete.
			});
			navac.title.not(this).closest('.menu-item-has-children').find('.sub-menu').slideUp( '3000', function() {
				// Animation complete.
			});
			// once all are closed then toggle the clicked item
			$(this).closest('.nav-acc-item').find('.nav-acc-content').slideToggle( '3000', function() {
				// Animation complete.
			});
			$(this).closest('.menu-item-has-children').find('.sub-menu').slideToggle( '3000', function() {
				// Animation complete.
			});
		});
	}
};

var side,
sidebarNav = {
	settings: {
		navEls: $('.sidebar-nav-item'),
		contentEls: $('.sidebar-content-item'),
		dropdownTitle: $('.dropdown-item .title'),
		dropdownContent: $('.dropdown-content')
	},
	init: function() {
		side = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.side = side;
		$.expose.sidebarNav = sidebarNav;
		// side.dropdownContent.addClass('hide');
		console.log('Sidebar Loaded!');
	},
	bindUIActions: function() {

		var windowSize = $(window).width();

		// Get width of window on load or resize
		$(window).on('load resize', function() {
			windowSize = $(window).width();

			// side.dropdownTitle.on('click', function() {
			//    	if ( windowSize >= 769 ) {
			//    		// do nothing
			//    	} else {
			//    		$(this).closest('.dropdown-item').find('.dropdown-content').slideToggle( '3000', function() {
			//    			// Animation complete.
			//    		});
			//    	}
			// });

			if(side.dropdownContent.length > 0){
				if ( windowSize >= 769 ) {
					document.querySelector('.dropdown-content').style.display = "block";
				} else {
					document.querySelector('.dropdown-content').style.display = "none";
				}
			}
		});

		// Dropdown toggle
		side.dropdownTitle.on('click', function () {
			if ( windowSize >= 769 ) {
				// do nothing
			} else {
				$(this).closest('.dropdown-item').find('.dropdown-content').slideToggle( '3000', function() {
					// Animation complete.
				});
			}
		});

		//
		side.navEls.on('click', function () {

			var parentElement = sidebarNav.getClosest(this, '.content');

			// Remove active classes
			var navElements = parentElement.querySelectorAll('.sidebar-nav-item');
			var contentElements = parentElement.querySelectorAll('.sidebar-content-item');

			for ( var i = 0; i < navElements.length; i++ ) {
				navElements[i].classList.remove('active');
				contentElements[i].classList.remove('active');
			}

			// Add active classes to nav item clicked and corresponding content
			this.classList.add('active');
			var selectedItem = this.dataset.sidebar - 1;
			contentElements[selectedItem].classList.add('active');

		});

	},
	getClosest: function (elem, selector) {

		// Element.matches() polyfill
		if (!Element.prototype.matches) {
		    Element.prototype.matches =
		        Element.prototype.matchesSelector ||
		        Element.prototype.mozMatchesSelector ||
		        Element.prototype.msMatchesSelector ||
		        Element.prototype.oMatchesSelector ||
		        Element.prototype.webkitMatchesSelector ||
		        function(s) {
		            var matches = (this.document || this.ownerDocument).querySelectorAll(s),
		                i = matches.length;
		            while (--i >= 0 && matches.item(i) !== this) {}
		            return i > -1;
		        };
		}

		// Get the closest matching element
		for ( ; elem && elem !== document; elem = elem.parentNode ) {
			if ( elem.matches( selector ) ) return elem;
		}

		return null;

	}
};
