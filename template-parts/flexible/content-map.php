<?php
$map = get_sub_field('content_map');
$background_color = get_sub_field('background_color');
$zoom = get_sub_field('zoom');
$max_height = get_sub_field('max_height');
if( !empty($map) ):?>
    <div class="map">
        <div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
    </div>
    <?php if($max_height):?>
    <style>
        .map{
            height: <?php echo $max_height;?>px !important;

        }
        .map img{
            width: auto;
        }
    </style>
<?php endif;?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script type="text/javascript">
        (function($) {
            function render_map( $el ) {
                // var
                var $markers = $el.find('.marker');
                // vars
                var args = {
                    center		: new google.maps.LatLng(0, 0),
                    mapTypeId	: google.maps.MapTypeId.ROADMAP,
                    draggable   : false,
                    zoomControl: false,
                    scaleControl: false,
                    scrollwheel: false,
                    panControl: false,
                    rotateControl: false,
                    streetViewControl: false,
                    overviewMapControl: false,
                    styles      : [{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, {  "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100}, { "lightness": 45 } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#18b6ea" }, { "visibility": "on" } ] } ] };
                // create map
                var map = new google.maps.Map( $el[0], args);
                // add a markers reference
                map.markers = [];
                // add markers
                $markers.each(function(){
                    add_marker( $(this), map );
                });
                // center map
                center_map( map );

            }
            function add_marker( $marker, map ) {
                // var
                var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
                // custom marker
                var icon = {
                    url: '<?php echo get_stylesheet_directory_uri(); ?>/images/map-icon.png'
                };
                // create marker
                var marker = new google.maps.Marker({
                    position	: latlng,
                    map			: map,
                    icon        : icon
                });
                // add to array
                map.markers.push( marker );
                // if marker contains HTML, add it to an infoWindow
                if( $marker.html() )
                {
                    // create info window
                    var infowindow = new google.maps.InfoWindow({
                        content		: $marker.html()
                    });
                    // show info window when marker is clicked
                    google.maps.event.addListener(marker, 'click', function() {

                        infowindow.open( map, marker );
                    });
                }
            }
            function center_map( map ) {
                // vars
                var bounds = new google.maps.LatLngBounds();
                // loop through all markers and create bounds
                $.each( map.markers, function( i, marker ){
                    var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
                    bounds.extend( latlng );
                });
                // only 1 marker?
                if( map.markers.length == 1 )
                {
                    // set center of map
                    map.setCenter( bounds.getCenter() );
                    map.setZoom( <?php echo $zoom; ?> );
                }
                else
                {
                    // fit to bounds
                    map.fitBounds( bounds );
                }
            }
            $(document).ready(function(){
                $('.map').each(function(){
                    render_map( $(this) );
                });
            });
        })(jQuery);
    </script>
<?php endif; ?>