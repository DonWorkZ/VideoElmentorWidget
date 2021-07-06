( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetVideoHandler = function( $scope, $ ) {

        $(document).ready(function () {
        
            var vid = $scope.data('id');
            var player = new Plyr(`#video-${vid}`, {controls: false});
            var brakes = $(`#videojs-${vid}`).data('brakes');
            var counter = 0;
            var playing = true;

            brakes = brakes.split(",");
            var brakesLength = brakes.length;
            var pauseAt = brakes[0];

            player.on('timeupdate', event => {
                if( player.currentTime > pauseAt && playing == true ){
                    playing = false;
                    player.pause();
                    counter++;
                }
            });

            $(window).on('scroll', function (event) {
                if( counter >= brakesLength ){
                    return;
                }
                if( playing === false ){
                    player.play();
                    playing = true;
                    pauseAt = brakes[counter];
                }
            });

        });

	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/video-widget.default', WidgetVideoHandler );
	} );
} )( jQuery );
