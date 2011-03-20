/*
 * @name Mosne Map Address Plugin for Google Maps v3
 * @version version 0.3
 * @author Mosne http://www.mosne.it/
 * @plugin page http://www.mosne.it/playground/mosne_map/
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of
 * markers, manage styles and advanced map settings
 * 
 */

(function ($) {

    $.fn.mosne_map = function (options) {

        var baseconf = {
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        defaults = {

            elements: '#list .maplocation', //links selector
            map_opt: baseconf,              // custom map options object
            clat: 41.895466,                // set the lat default map center
            clng: 12.482324,                // set the lng default map center
            mapstyle_name: '',              // custom map style label and id
            mapstyle: '',                   // mapstyle object
            cluster_styles: {},             // custom cluster icons object
            marker_icon: '',                // custom marker icon url
            infobox: true,                  // shows infoWindows grabing html from the .infobox element
            trigger: 'map_open',            // you can set a event trigger for each link/marker
            clickedzoom: 15,                // set the zoom level when you click the single marker
            timeout: 100,                   // delay between click and zoom on the single marker
            mode: 'latlng',                 // switch mode
            wait: 500,                      // timeout between geocode requests
            showzoom: false,                // bind current map zoom level event
            before: function () {},         // before create map callback
            after: function () {},          // after create map callback 
            afterUpdate: function () {},    // after update map callback
        };

        var settings = $.extend({}, defaults, options);
        this.each(function () {

            var map_el = $(this);
            var the_map_el = $(this).get(0);

            //on before
            settings.before.apply(map_el);

            //init map
            var center = new google.maps.LatLng(settings.clat, settings.clng);
            var map = new google.maps.Map(the_map_el, settings.map_opt);
            var bounds = new google.maps.LatLngBounds();
            var markerCluster = new MarkerClusterer(map, null, settings.cluster_styles);
            map.setCenter(center);

            //apply map style
            if (settings.mapstyle_name != '') {
                var styledMapOptions = {
                    name: settings.mapstyle_name
                };
                var m_MapType = new google.maps.StyledMapType(settings.mapstyle, styledMapOptions);
                map.mapTypes.set(settings.mapstyle_name, m_MapType);
                map.setMapTypeId(settings.mapstyle_name);
            }

            // set markers icons     
            if (settings.marker_icon != '') {
                var markerIcon = new google.maps.MarkerImage(settings.marker_icon, new google.maps.Size(21, 34));
            }

            // light infowindow 
            if (settings.infobox) {
                var infowindow = new google.maps.InfoWindow({
                    maxWidth: 80
                });
            }
            
            // function create marker
            
            var _createMarker = function(el,latLng,markerIcon,m_name){
                     
                     var marker = new google.maps.Marker({
                            position: latLng,
                            icon: markerIcon,
                            title: m_name
                        });

                        //extend bounds
                        bounds.extend(latLng);

                        // bind click on map trigger event fill infowindow content on demand 
                        if (settings.infobox) {
                            var content = el.find('.infobox').html();
                        }
                      
                        google.maps.event.addListener(marker, 'click', function () {

                            if (settings.infobox) {
                                infowindow.close();
                                infowindow.setContent(content);
                                infowindow.open(map, marker);
                            }

                            el.trigger(settings.trigger);
                            console.log(1);

                            $(el).parents().find('.active').removeClass('active');
                            $(el).addClass('active');


                            setTimeout(function () {
                                map.setZoom(settings.clickedzoom);
                                map.panTo(latLng);
                                marker.setAnimation(google.maps.Animation.DROP);
                            }, settings.timeout);

                        });

                        // trigger click on list 
                        $(el).find('.maplink').unbind("click").bind("click", function (e) {
                            e.preventDefault();
                            google.maps.event.trigger(marker, "click");
                            return false;
                        });

                        markerCluster.addMarker(marker);
                    }
                    
                    //

            $(map_el).bind('update', function () {

                //reset cluster and bounds
                markerCluster.clearMarkers();
                bounds = null;
                bounds = new google.maps.LatLngBounds();
                
                // markers loop     
                var markers = [];
                var w_delay = 0;

                if (settings.mode === 'address') {
                    var geocoder = new google.maps.Geocoder();
                }

                $(settings.elements).each(function (i) {


                    // create marker
                    var el = $(this);


                    //mode geocoding
                    if (settings.mode === 'address') {

                        delay = settings.wait;

                        var name = $(this).find(".name").text();
                        var address = $(this).find(".address").text();
                        setTimeout(function () {

                            geocoder.geocode({
                                'address': address
                            }, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    latLng = results[0].geometry.location;
                                    _createMarker(el,latLng,markerIcon,name);
                                    //fit bounds 	
                                    map.fitBounds(bounds); /**/

                                } else {
                                    $(el).css({
                                        opacity: .35
                                    });
                                }
                            });

                            //timeout
                        }, delay);

                    } else {

                        // mode latlng
                        var mkr = el.data();
                        var latLng = new google.maps.LatLng(mkr.lat, mkr.lng);
                        _createMarker (el,latLng,markerIcon,mkr.name);

            }
            
            //end of the elements loop
            });
            
            if (settings.mode === 'latlng'){
            // bounds 
            map.fitBounds(bounds);
            };

            
            //callbak afterUpdate 
            settings.afterUpdate.apply(map_el);

        }).trigger('update');

        $(map_el).bind('bounds', function () {
            map.fitBounds(bounds);
        });

        // nice zoom status 
        if (settings.showzoom) {

            google.maps.event.addListener(map, 'zoom_changed', function () {
                $(map_el).trigger("showzoom", [map.getZoom()]);
            });

        };

        //on after
        settings.after.apply(map_el);

        return true;
    });


};
})(jQuery);