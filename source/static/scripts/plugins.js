// Avoid `console` errors in browsers that lack a console.
(function() {
	var method;
	var noop = function() {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while (length--) {
		method = methods[ length ];

		// Only stub undefined methods.
		if (!console[ method ]) {
			console[ method ] = noop;
		}
	}
}());


// Собираем все нужные плагины в нужном порядке

//////////////////////////////////////////////////////////////////////////////
// Important plugins
//////////////////////////////////////////////////////////////////////////////

// JQuery
// Browser feature detection library for HTML5/CSS3
//= require jquery/dist/jquery.js


// FastclickJS
// Remove delay between a physical tap and the firing of a click event on mobile browsers.
//= require fastclick/lib/fastclick.js


// Helpers
//= require helpers/jquery.isset.js
//= require helpers/jquery.scrollTo.js
//= require slick/slick.min.js
//= require simple/simple-lightbox.min.js


//////////////////////////////////////////////////////////////////////////////
// Optionals plugins
//////////////////////////////////////////////////////////////////////////////

// Basic table
// Responsive tables
// ---------------------------------------------------------------------------
//= require basictable/jquery.basictable.js


// Remodal
// Css modal windows
// ---------------------------------------------------------------------------
//= require remodal/dist/remodal.js
