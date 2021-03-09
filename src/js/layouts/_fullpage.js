(function ($, window, document, undefined) {

	'use strict';

	$(function () {

		$.expose = {};

		function initFullpage(){
			$('#fullpage').fullpage({
				css3: true,
				scrollOverflow: true,
				onLeave: function(index, nextIndex, direction){
					// Reveal center header links when entering slide 2
					if(nextIndex == 2){
						$('.header').addClass('reveal');
					}
					// Hide center header links when entering slide 1
					if(nextIndex == 1){
						$('.header').removeClass('reveal');
					}
					// Remove light class when entering last slide
					if(nextIndex == $('#fullpage .fp-section').length){
						$('.header').removeClass('light');
					}
					// Add light class when entering penultimate slide
					 if(nextIndex == $('#fullpage .fp-section').length - 1){
						$('.header').addClass('light');
					}
				},
				afterRender: function(){
					$('.header').addClass('light');
					// $('body').addClass('animate');
					// $('body').removeClass('hidden');
					homePageFinished = true;
					console.log('Fullpage Rendered');
				},
			});
			// If the hidden class is still on the body after 1500ms, remove it
			setTimeout(function(){
				if($('body').hasClass('hidden')){
					$('.header').addClass('light');
					$('body').addClass('animate');
					$('body').removeClass('hidden');
				}
			}, 1500);
		}

		function preparePage(){
			var bodyElement = $('body');
			var mainElement = $('.main');
			var layoutElements = $('.layout');
			var footerElement = $('.footer');
			if(bodyElement.hasClass('home')){
				// Hide the page
				// bodyElement.addClass('ready');
				// bodyElement.addClass('hidden');
				// Move footer into main element
				mainElement.append(footerElement);
				// Add frontpage id to main element
				mainElement.attr('id', 'fullpage');
				// Add class to first hero sections so we can target them together
				layoutElements.each(function(){
					var thisElement = $(this);
					if(thisElement.hasClass('hero') && thisElement.next().hasClass('hero')){
						thisElement.addClass('section');
						thisElement.find('h1').addClass('fade-in');
					}
					if(thisElement.hasClass('hero') && thisElement.prev().hasClass('hero')){
						thisElement.addClass('section');
						thisElement.find('h1').addClass('fade-in');
					}
				});
				// Recache layout elements
				layoutElements = $('.layout');
		        // Remove slide class from standalone hero elements
		        $('.hero.fragment').not('.section').find('.slide').removeClass('slide');
				// Wrap all layout elements except the existing section elements in a new section
				layoutElements.not('.section').wrapAll('<div class="section" />');
				console.log('Homepage Adjusted');
			}
			setTimeout(function(){
				initFullpage();
			}, 500);
		}

		var homePageFinished = false;
		preparePage();
		// initFullpage();
		console.log('Before load ' + homePageFinished);
		$(window).on('load', function() {
			// If the home page is not rendered after the window has loaded we need to prepare the page again.
			setTimeout(function(){
				console.log('After load ' + homePageFinished);
				if(!homePageFinished){
					console.log('Homepage did not finish rendering. Trying again.');
					initFullpage();
				}
			}, 1000);
		});

		$('#start-united').click(function(){
		    $.fn.fullpage.moveTo(2);
		});

	});

})(jQuery, window, document);
