 /*!
 * MOSNE MAP / jQuery Plugin v0.8
 * markerClusterer + InfoBox + Geocoder + Styled Google Maps API v3
 * http://www.mosne.it/playground/mosne_map/
 *
 * Require jQuery 1.5+, Google Maps API v3, markerClusterer, InfoBox
 *
 * Copyright 2011, Paolo Mosne
 * Licensed under GPL Version 3 licenses.
 * http://www.gnu.org/licenses/gpl.html
 *
 * Date: 2011-03-20 11:19 AM
 */

(function ($) {

    $.fn.mosne_map = function (options) {

        var baseconf = {
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var s_infobox = {
			 content: "",
			 disableAutoPan: false,
			 maxWidth: 0,
			 pixelOffset: new google.maps.Size(-110, 5),
			 zIndex: null,
			 boxStyle: { 
			 background: "url('images/infobox_top.png') top center no-repeat",
			 opacity: 1,
			 color:'#000',
			 padding: '0',
			 width: "220px"
			 },
			 closeBoxMargin: "16px 4px",
			 closeBoxURL: "images/infobox_close.png",
			 infoBoxClearance: new google.maps.Size(1, 1),
			 isHidden: false,
			 pane: "floatPane",
			 enableEventPropagation: false
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
            infowindows: true,              // shows infoWindows grabing html from the .infobox element
            infobox: false,                 // enable custom infoWindows using infobox class
            infobox_s: s_infobox,           // default color scheme for custom infobox container
            trigger: 'map_open',            // you can set a event trigger for each link/marker
            clickedzoom: 15,                // set the zoom level when you click the single marker
            timeout: 100,                   // delay between click and zoom on the single marker
            mode: 'latlng',                 // switch mode
            wait: 500,                      // timeout between geocode requests
            maxtry:10,                      // limit of time to bypass query overlimit
            cat_style: {},                  // costum icons and click zoom level
            fitbounds: true,                // on|off fit bounds
            defzoom : 20,                    // default zoom level if fitbounds is off
            showzoom: false,                // bind current map zoom level event
            before: function () {},         // before create map callback
            after: function () {},          // after create map callback 
            afterUpdate: function () {}     // after update map callback
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
            
            // init infowindow 
            if (settings.infowindows) {
                var infowindow = new google.maps.InfoWindow({
                    maxWidth: 80
                });
            }
          
            // init infobox
            if (settings.infobox) {
               var boxText = document.createElement("div");
               boxText.style.cssText = settings.infobox_s_txt
		       boxText.innerHTML = "hello world";
               var m_box = new InfoBox(settings.infobox_s);
            }
                        
            // function create marker
            
            var _createMarker = function(el,latLng,markerIcon,m_name,cat){
                     
                       if (cat){
                        var c_icon = settings.cat_style[cat]['icon'];
                        if (c_icon){ var markerIcon =  c_icon; }
                       }
                       
                       var marker = new google.maps.Marker({
                            position: latLng,
                            icon: markerIcon,
                            title: m_name
                        });
                        
                        //extend bounds
                        bounds.extend(latLng);

                        // bind click on map trigger event fill infowindow / infobox content on demand 
                        if (settings.infowindows || settings.infobox ) {
                            var content = el.find('.infobox').html();
                        }
                        
                        google.maps.event.addListener(marker, 'click', function () {

                            if (settings.infowindows) {
                                infowindow.close();
                                infowindow.setContent(content);
                                infowindow.open(map, marker);
                            }
                            if (settings.infobox) {
                                m_box.close();
                                $(boxText).hide();
                                m_box.setContent(content);
                                m_box.open(map, marker);
                                $(boxText).show("slow");
                               
                            }
                            
                            el.trigger(settings.trigger);
                           
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
                        
                    };
                    
                    var _m_geocode = function (el,geocoder,address,name,cat,j){
                    
                         geocoder.geocode({
                                'address': address
                            }, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    latLng = results[0].geometry.location;
                                   
                                    _createMarker (el,latLng,markerIcon,name,cat);
                                     if ( settings.fitbounds === true){
                                     map.fitBounds(bounds);
                                     }
                                } else {
                                     
                                     if (status==="OVER_QUERY_LIMIT"){
                                        setTimeout(function(){
                                        //console.log("trying again "+g_address);
                                        j++; if (j<= settings.maxtry){
                                        _m_geocode(el,geocoder,address,name,cat,j);
                                        }else{ $(el).css({opacity: .35});}
                                        },settings.wait);
                                        
                                     }else if (status==="ZERO_RESULTS"){
                                        $(el).css({opacity: .35});
                                     }
    
                                }
                            });
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

                        var mkr = el.data();
                        var name = $(this).find(".name").text();
                        var address = $(this).find(".address").text();
                        setTimeout(function () {
                            _m_geocode(el,geocoder,address,name,mkr.cat,0);
                        }, settings.wait*i);

                    } else {

                        // mode latlng
                        var mkr = el.data();
                        var latLng = new google.maps.LatLng(mkr.lat, mkr.lng);
                        _createMarker (el,latLng,markerIcon,mkr.name,mkr.cat);

            }
            
            //end of the elements loop
            });
            
            if ( settings.fitbounds === true){
                map.fitBounds(bounds);
            }else{
                map.setZoom(settings.defzoom);
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