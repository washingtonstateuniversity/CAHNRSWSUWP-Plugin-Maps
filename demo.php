<html>
	<head>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		<div data-categories="" data-tags="" data-taxonomyrelation="OR" data-termrelation="OR" id="mapid" class="cahnrs-map" style="width: 600px; height: 400px;"></div>


		<div id="mapid_control" class="cahnrs-map-control"><button class="remove-markers-action">Remove Markers</button></div>
		<script>

			function c_map_control( map_control, c_map ) {

				this.map = c_map;

				this.control_wrapper = map_control;

				var self = this;

				this.init = function() {

					this.bind_controls();
				}

				this.bind_controls = function(){

					this.control_wrapper.on(
						'click',
						'.remove-markers-action',
						function( e ){
							e.preventDefault();
							self.map.remove_markers();
						} 
					)

				} // End bind_controls

				this.init();

			} // end c_map_control
			

			function c_map( map_id ) {

				// @var string map_id Map id for the div
				this.map_id = map_id;

				this.j_map = jQuery( '#' + this.map_id );

				// @var instance of Leaflet map
				this.map = false;

				// @var array All markers avaialbe to the map
				this.locations = [];

				// @var array Markers used in the current map
				this.current_locations = [];

				// @var array Visible Markers
				this.markers = [];

				// @var string|bool URL for request
				this.request_url = 'http://local-cahnrs.wsu.edu/maps/map/?map-json=true';

				this.marker_query = {
					categories:[],
					tags:[],
					taxonomy_relation: 'OR',
					term_relation: 'OR',
				};

				var self = this;

				/**
				 * Builds the map from the given id
				 */
				this.init_map = function() {

					this.get_markers( 'set_map' );

				} // End init_map


				this.set_marker_query = function() {

					category_data = this.j_map.data('categories');

					tag_data = this.j_map.data('tags');

					taxonomy_relation = this.j_map.data('taxonomyrelation');

					term_relation = this.j_map.data('termrelation');

					if ( category_data ) {

						this.marker_query.categories = category_data.split(',');

					} // End if

					if ( tag_data ) {

						this.marker_query.tags = tag_data.split(',');

					} // End if

					this.marker_query.taxonomy_relation = taxonomy_relation;

					this.marker_query.term_relation = term_relation;

				} // End set_query


				this.remove_markers = function() {

					alert( 'removed');

					for ( i=0; i < this.markers.length; i++ ) {

						this.map.removeLayer( this.markers[i] );

					} // End for

				} // End remove_markers


				this.set_current_locations = function() {

					this.current_locations = [];

					var cats = this.marker_query.categories;

					var tags = this.marker_query.tags;

					// Has set categories or tags
					if ( cats.length || tags.length ) {

						for ( var i = 0; i < this.locations.length; i++ ) {

							var marker = this.locations[ i ];

							var has_cat = this.check_has_taxonomy_term( cats, marker.taxonomies.categories, this.marker_query.term_relation );

							var has_tag = this.check_has_taxonomy_term( tags, marker.taxonomies.tags, this.marker_query.term_relation );

							if ( 'AND' === this.marker_query.taxonomy_relation ) {

								if ( has_cat && has_tag ) {

									this.current_locations.push( marker );

								} // End if

							} else {

								if ( has_cat || has_tag ) {

									this.current_locations.push( marker );

								} // End if

							} // End if

						} // End for

					} else {

						this.current_locations = this.locations;

					}// End if

				} // End set_current_locations
				
				this.check_has_taxonomy_term = function( query_terms, marker_terms, term_relation ) {

					var has_terms = false;

					if ( marker_terms.length ) {

						if ( 'AND' === term_relation ) {

							has_terms = true;

							for ( var c = 0; c < query_terms.length; c++ ) {

								if ( marker_terms.indexOf( query_terms[ c ] ) == -1 ) {

									has_terms = false;

									break;

								} // End if

							} // End for

						} else {

							for ( var c = 0; c < query_terms.length; c++ ) {

								if ( marker_terms.indexOf( query_terms[ c ] ) !== -1 ) {

									has_terms = true;

									break;

								} // End if

							} // End for

						} // End if

					} // End if

					return has_terms;

				} // End check_has_taxonomy_term

				this.set_map = function() {

					this.create_map();

					this.set_tile_layer();

					this.set_marker_query();

					this.set_current_locations();

					this.add_markers();

				} // End set_map

				/**
				 * Handles creation of the map.
				 * Sets this.map property
				 */
				this.create_map = function() {

					this.map = L.map( this.map_id ).setView([51.505, -0.09], 13);

				}  // End create_map

				/**
				 * Handles adding the tile layer to the map
				 */
				this.set_tile_layer = function() {

					L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
						maxZoom: 18,
						attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
							'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
							'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
						id: 'mapbox.streets'
					}).addTo( this.map );

				} // End set_tile_layer

				/**
				 * Handles adding the markers from this.locations to the map
				 */
				this.add_markers = function() {

					var mkrs = this.current_locations;

					for ( var i = 0; i < mkrs.length; i++ ) {

						console.log( mkrs[i] );

						var lat = mkrs[i].latitude;

						var long = mkrs[i].longitude;

						var caption = mkrs[i].excerpt;

						marker = L.marker([lat, long]).addTo( this.map ).bindPopup( caption ).openPopup();

						this.markers.push( marker );

					} // for

				} // End add_markers


				/**
				 * Do JSON Request and return markers
				 */
				this.get_markers = function( callback ) {

					var self = this;

					jQuery.get( 
						this.request_url, 
						function( data ) {
							self.locations = data;
							console.log( callback );
							self[ callback ]( data );
						},
						'JSON'
					);

				} // End get_markers

				// Start the map build
				this.init_map();

			} // End c_map

			// Check if both jQuery and Leaflet are available
			if ( 'undefined' !== jQuery && 'undefined' !== L ) {

				var cahnrs_map = {};

				var cahnrs_map_controls = {};

				var c_map_instances = jQuery( '.cahnrs-map' );

				if ( c_map_instances.length ) {

					c_map_instances.each(
						function( index ) {

							var j_map = jQuery( this );

							var map_id = j_map.attr( 'id' );

							var map_control = jQuery( '#' + map_id + '_control' );

							var map = new c_map( map_id );

							cahnrs_map[ map_id ] = map;

							if ( map_control.length ) {

								cahnrs_map_controls[ map_id + '_control' ] = new c_map_control( map_control, map );

							} // End if

						}
					) // End each

				} // End if

				console.log( cahnrs_map );

			} // End if


		</script>
	</body>
</html>