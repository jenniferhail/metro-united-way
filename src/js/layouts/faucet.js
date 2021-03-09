var ft,
faucet = {
	settings: {
		viewAll: $('.page-template-search-results .view-all .facetwp-radio'),
		postTypes: $('.page-template-search-results .facetwp-facet-post_type .facetwp-radio')
	},
	init: function() {
		ft = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.ft = ft;
		$.expose.randomQuote = faucet;
		console.log('faucet loaded!');
	},
	bindUIActions: function() {
		// Should the view all button be disabled when it is checked?

		// If you click the View All button, clear the others and style accordingly
		ft.viewAll.click( function() {
			if ( $(this).hasClass('checked') ) {
				$(this).removeClass('checked');
			} else {
				$(this).addClass('checked');
				$('.page-template-search-results .facetwp-facet-post_type .facetwp-radio.checked').trigger('click');
			}
		});

		$(document).on('facetwp-refresh', function () {

			$('.loading-search').show();
			$('#search-results').addClass('loading');

			if (FWP.facets['search'] == '') {
				$('#search-results').hide();
				$('.loading-search').hide();
			} else {
				$('#search-results').show();
			}

		});

		$(document).on('facetwp-loaded', function() {
			console.log('facetwp-loaded');

			// Toggle the View All button — remove or add checked class
			$('.page-template-search-results .facetwp-facet-post_type .facetwp-radio').each( function() {
				if ( $(this).hasClass('checked') ) {
					console.log('A post type is checked.');
					$('.page-template-search-results .view-all .facetwp-radio').removeClass('checked');
					return false;
				} else {
				   $('.page-template-search-results .view-all .facetwp-radio').addClass('checked');
				}
			});

			$('.loading-search').hide();
			$('#search-results').removeClass('loading');
	     });

	}
};
