cahnrs_map_instance = function( map ) {
    this.map = map;
    this.locations = new Array();
    this.markers = new Array();
    var self = this;

    this.init = function() {

        this.add_style();

        this.do_map();

        this.set_tile_layer();

        this.set_locations();

        this.set_markers();

    } // End init

    this.add_style = function() {

        var map_style = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>';

        jQuery('head').append( map_style );

    } // End add_style

    this.do_map = function() {

        this.map = L.map('mapid').setView([51.505, -0.09], 13);

    } // End do_map

    this.set_tile_layer = function() {

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiY2FobnJzLXdlYnRlYW0iLCJhIjoiY2ppNTY4MjFuMGRmNzNwbWszaWN4OXp5eCJ9.WWTuo7-vadnt9Gryx6Kzrg', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiY2FobnJzLXdlYnRlYW0iLCJhIjoiY2ppNTY4MjFuMGRmNzNwbWszaWN4OXp5eCJ9.WWTuo7-vadnt9Gryx6Kzrg'
        }).addTo(this.map);

    } // End

    this.set_locations = function() {

        var marker_object = {
           lat:51.5,
           long:-0.09,
           caption:'<p>Hello World</p>',
        }

        this.locations.push( marker_object );

    } // End set_markers

    this.set_markers = function() {

        var marker = L.marker([51.5, -0.09]).addTo( this.map );

        console.log( this.locations );

        for ( var i = 0; i < this.locations.length; i++ ) {

            console.log( this.locations[i] );

            L.marker([51.5, -0.09]).addTo( this.map );

            var marker = L.marker([this.locations[i].lat, this.locations[i].long]).addTo( this.map );

            marker.bindPopup(this.locations[i].caption).openPopup();

            this.markers.push( marker );

        } // End for

    } // End set_markers

    this.init();
}

if ( 'undefined' !== jQuery && jQuery('#mapid').length ) {

    var cahnrs_map = new cahnrs_map_instance( jQuery('#mapid') );

} // End if
