( function( api ) {

	// Extends our custom "books-printing" section.
	api.sectionConstructor['books-printing'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );