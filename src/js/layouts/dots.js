var dm,
dots = {
	settings: {
		dotControl: $('.dot-control'),
		dotLabel: $('#dot-label'),
		activeDot: 0,
		activeDotLabel: '',
		mainDots: $('.main-dot'),
	},
	init: function() {
		dm = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.dm = dm;
		$.expose.dots = dots;
		console.log('dots loaded!');
	},
	bindUIActions: function() {
		// When the dot control elements are clicked
		dm.dotControl.click(function(evt){
			// Prevent default behavior
			evt.preventDefault();
			// Set the activeDot var to the data attr of the clicked dot control
			dm.activeDot = $(this).data('dot-value');
			// Set the activeDotLabel var to the data attr of the clicked dot control
			dm.activeDotLabel = $(this).data('dot-label');
			// Run the activateDot function
			dots.activateDot();
		});
		// When the main dots are clicked
		dm.mainDots.click(function(evt){
			// Prevent default behavior
			evt.preventDefault();
			// Set the activeDot var to the data attr of the clicked main dot
			dm.activeDot = $(this).data('dot-value');
			// Set the activeDotLabel var to the data attr of the dot control
			dm.activeDotLabel =  $('.dot-control[data-dot-value=' + dm.activeDot + ']').data('dot-label');
			// Run the activateDot function
			dots.activateDot();
		});
	},
	activateDot: function() {
		// Add the label from the clicked dot to the h4 element
		dm.dotLabel.text(dm.activeDotLabel);
		// Remove the active class from all dot controls
		dm.dotControl.removeClass('active');
		// Remove the active class from all main dots
		dm.mainDots.removeClass('active');
		// Activate the main dot by targeting the clicked dot data
		$('.main-dot[data-dot-value=' + dm.activeDot + ']').addClass('active');
		// Add active class to the clicked dot control
		$('.dot-control[data-dot-value=' + dm.activeDot + ']').addClass('active');
	}
};

$(window).load(function() {
	// Get last column in the layout to make some calculations
	var colContainer = $('.layout.cta-stats .col').last();
	var colWidth = colContainer.outerWidth();
	var colHeight = colContainer.outerHeight();
	var allCircles = $('.circle');
	var allMovingCircles = $('.circle').not('.active');
	var directionX = 1;
	var directionY = 1;
	// Set the initial random position of the circles
	allCircles.each(function(){
		// Cache this
		var ele = $(this);
		// Element width and height are equal so we will use outerWidth for calculations
		var eleSize = ele.outerWidth();
		// Set scale string so we can concatenate to translate string for transform property
		var scaleString = 'scale3d(1, 1, 1)';
		// If element has class of lg then we need to divide the width by 2 (it is scaled 0.5 in css)
		if(ele.hasClass('lg')){
			eleSize = eleSize/2;
			scaleString = 'scale3d(0.5, 0.5, 1)';
		}
		// Generate random X position between 0 and width of col minus the width of the circle
		var randomX = (Math.random() * (colWidth - eleSize));
		// Generate random Y position between 0 and height of col minus the height of the circle
		var randomY = (Math.random() * (colHeight - eleSize));
		// Create the translate string for transform property
		var translateString = 'translate3d(' + randomX + 'px, ' + randomY + 'px, 0)';
		// Set the css of the element
		ele.css({
			transform: translateString + scaleString,
		});
		// Extend this dom object to add a direction property that we will use to determine the initial direction of movement
		$.extend(this, {directionX : Math.round(Math.random())});
		$.extend(this, {directionY : Math.round(Math.random())});
	});

	window.requestAnimFrame = (function(){
	  return  window.requestAnimationFrame       ||
			  window.webkitRequestAnimationFrame ||
			  window.mozRequestAnimationFrame    ||
			  function( callback ){
				window.setTimeout(callback, 1000 / 60);
			  };
	})();

	setTimeout(function(){
	(function animloop(){
		requestAnimFrame(animloop);
		animateDiv();
	})();
	}, 1000);

	function animateDiv() {
		allMovingCircles.each(function(){
			var ele = $(this);
			var eleSize = ele.outerWidth();
			var scaleString = 'scale3d(1, 1, 1)';
			if(ele.hasClass('lg')){
				eleSize = eleSize/2;
				scaleString = 'scale3d(0.5, 0.5, 1)';
			}
			var boundaryX = colWidth - eleSize;
			var boundaryY = colHeight - eleSize;

			var oldX = ele.position().left;
			var oldY = ele.position().top;
			var newX = 0;
			var newY = 0;
			var velocityX = 0;
			var velocityY = 0;

			if(oldX > boundaryX && this.directionX === 1){
				this.directionX = 0;
			}
			if(oldY > boundaryY && this.directionY === 1){
				this.directionY = 0;
			}
			if(oldX < 0 && this.directionX === 0){
				this.directionX = 1;
			}
			if(oldY < 0 && this.directionY === 0){
				this.directionY = 1;
			}
			if(this.directionX > 0){
				newX = oldX + 1;
			} else {
				newX = oldX - 1;
			}
			if(this.directionY > 0){
				newY = oldY + 1;
			} else {
				newY = oldY - 1;
			}
			var translateString = 'translate3d(' + newX + 'px, ' + newY + 'px, 0)';
			ele.css({
				transform: translateString + scaleString,
			});
		});
	};
});
