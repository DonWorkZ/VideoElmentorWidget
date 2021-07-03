( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetVideoHandler = function( $scope, $ ) {

        var vid = $scope.data('id');
        var video = videojs.getPlayer(`video-${vid}`);
        var offsetTop = $(`#videojs-${vid}`).data('offset');

        function playVideo(){
            video.play();
        }
        
        $(`#video-${$scope.attr('data-id')}`).waypoint({
        handler: function(direction) {
            playVideo(vid);
        },
        offset: offsetTop
        });
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/video-widget.default', WidgetVideoHandler );
	} );
} )( jQuery );
