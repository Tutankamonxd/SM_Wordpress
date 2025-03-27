( function( api ) {

	// Extends our custom "food-grocery-hub" section.
	api.sectionConstructor['food-grocery-hub'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );