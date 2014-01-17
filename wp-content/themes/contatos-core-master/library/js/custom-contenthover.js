jQuery(function($){ //on document.ready
	$('.avatar').contenthover({
		data_selector: '.contenthover',	// The selector for the element that will be the content of the overlay element to show on hover 
		width: 120,			// Set to 0 to let the plugin figure it out
		height: 120,			// Set to 0 to let the plugin figure it out
		overlay_width: 120,		// The overlay element's width. Set to 0 to use the same as 'width'
		overlay_height: 120,
		overlay_opacity:0.8,
	});
})
