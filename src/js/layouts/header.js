var lh,
	LayoutHeader = {
		settings: {
			searchToggle: jQuery('.search-toggle'),
			searchForm: jQuery('#header-search'),
			headerCenter: jQuery('.header .nav-center'),
			header: jQuery('.header'),
			hamburgerToggle: jQuery('#menuToggle')
		},
		init: function () {
			lh = this.settings;
			this.bindUIActions();
		},
		bindUIActions: function () {
			lh.searchToggle.click(function (evt) {
				evt.preventDefault();
				LayoutHeader.toggleSearch();
			});
			lh.hamburgerToggle.click(function (evt) {
				LayoutHeader.toggleBackground();
			});
			// Init the headerScroll function
			LayoutHeader.headerScroll();
		},
		toggleSearch: function (ele) {
			lh.searchForm.toggleClass('active');
			lh.searchForm.find('.search-field').focus();
			lh.headerCenter.toggleClass('hide');
		},
		toggleBackground: function (ele) {
			console.log('Clicked');
			console.log(lh.header);
			lh.header.toggleClass('no-bg');
		},
		headerScroll: function () {
			document.addEventListener('scroll', function(event) {
				var scrollY = window.pageYOffset;
				// console.log('scroll event - ' + scrollY);
				if ( $('.header').hasClass('scroll-change') ) {
					if ( scrollY > 200  ) {
						$('.header').removeClass('light');
					} else {
						$('.header').addClass('light');
					}
				}
			});
		}
	}
