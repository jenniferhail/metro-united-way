var fl,
fancyLabels = {
	settings: {
	},
	init: function() {
		fl = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.fl = fl;
		$.expose.fancyLabels = fancyLabels;
		console.log('fancyLabels loaded!');
	},
	bindUIActions: function() {
        var activate = function (ele, evt) {
            // console.log('activate');
            // console.log(ele);
            // console.log(evt.type);
            var fancylabelInputs = $('.ginput_container input, .ginput_container textarea');

            fancylabelInputs.each(function () {
                var thisItem = $(this);
                var parentItem = $(this).parent().parent();

                // Andar Input Fields
                // .ginput_container_andaraccount
                if ( parentItem.hasClass('ginput_container_andaraccount') ) {
                    parentItem = $(this).parent();
                    console.log('This is an Andar input');
                }

                    if (thisItem.val()) {
                        parentItem.addClass('active');
                    } else {
                        parentItem.removeClass('active');
                    }

                if (thisItem.val()) {
                    parentItem.addClass('active');
                } else {
                    parentItem.removeClass('active');
                }
            });

            if (evt.type === 'focusin') {
                var eventParentItem = $(ele).parent().parent();
                if ( parentItem.hasClass('ginput_container_andaraccount') ) {
                    parentItem = $(this).parent();
                    console.log('This is an Andar input');
                } else {
                    eventParentItem.addClass('active');
                }
            }
        }

        // Jen's JS

        var complexClasses = 'ginput_container_andaraccount, ginput_container_address, ginput_container_creditcard';

        var hasValue = function(ele, evt) {
            var fancyLabels = $('.newdonate_wrapper .ginput_container input, .newdonate_wrapper .ginput_container textarea, .newdonate_wrapper .ginput_container select');
            fancyLabels.each(function() {
                var thisInput = $(this);
                var parentInput = thisInput.parent().parent();
                if ( parentInput.hasClass('ginput_container_andaraccount') || parentInput.hasClass('ginput_container_address') || parentInput.hasClass('ginput_container_creditcard') ) {
                    parentInput = thisInput.parent();
                }
                if (thisInput.val()) {
                    parentInput.addClass('active');
                }
            });
        }
        hasValue(); // Run this on page load

        $(document).bind('gform_post_render', function() {
            hasValue(); // Run every time the Ajax form reloads
        });

        var activateIn = function(ele, evt) {
            var parentInput = $(ele).parent().parent();
            if ( parentInput.hasClass('ginput_container_andaraccount') || parentInput.hasClass('ginput_container_address') || parentInput.hasClass('ginput_container_creditcard') ) {
                parentInput = $(ele).parent();
            }
            parentInput.addClass('active');
        }

        var activateOut = function(ele, evt) {
            var parentInput = $(ele).parent().parent();
            if ( parentInput.hasClass('ginput_container_andaraccount') || parentInput.hasClass('ginput_container_address') || parentInput.hasClass('ginput_container_creditcard') ) {
                parentInput = $(ele).parent();
            }
            parentInput.removeClass('active');
        }

        $(document).on('focusin', '.newdonate_wrapper .ginput_container input, .newdonate_wrapper .ginput_container textarea, .newdonate_wrapper .ginput_container select', function (evt) {
            console.log('focus in');
            activateIn(this, evt);
        });

        $(document).on('focusout', '.newdonate_wrapper .ginput_container input, .newdonate_wrapper .ginput_container textarea, .newdonate_wrapper .ginput_container select', function (evt) {
            console.log('focus out');
            activateOut(this, evt);
            hasValue(); // Check again when focusing out
        });
    }
}