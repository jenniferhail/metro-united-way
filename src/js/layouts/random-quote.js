var rq,
randomQuote = {
	settings: {
		quoteList: $('.splash li'),
		random: Math.floor(Math.random() * $('.splash li').length),
	},
	init: function() {
		rq = this.settings;
		this.bindUIActions();
		// Optional - Expose scoped vars to global $. Use in console with $.expose
		$.expose.rq = rq;
		$.expose.randomQuote = randomQuote;
		console.log('randomQuote loaded!');
	},
	bindUIActions: function() {
		rq.quoteList.hide().eq(rq.random).show();
	}
};