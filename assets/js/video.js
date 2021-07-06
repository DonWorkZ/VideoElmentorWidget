( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetVideoHandler = function( $scope, $ ) {

        $(document).ready(function () {
        
            var vid = $scope.data('id');
            var player = new Plyr(`#video-${vid}`, {controls: false});

            console.log(vid, player);
            
            player.on('timeupdate', event => {
                console.log(event);
            });      
            player.on('play', event => {
                console.log('playing', event);
            });

        });

	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/video-widget.default', WidgetVideoHandler );
	} );
} )( jQuery );
