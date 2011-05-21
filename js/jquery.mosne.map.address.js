/*
 * @name Mosne Map Address Plugin for Google Maps v3
 * @version version 0.1
 * @author Mosne http://www.mosne.it/
 * @plugin page http://www.mosne.it/playground/mosne_map/
 * @fileoverview
 * The library creates and manages per-zoom-level clusters for large amounts of
 * markers, manage styles and advanced map settings
 * 
 */
 
 (function($){
 
 $.fn.mosne_map_address = function(options) {

 var defaults = {
  mapstyle:'',
  showzoom:false,
  timeout:100,
  trigger:'map_open',
  elements:'#pool .maplocation',
  mapstyle_name:'',
  cluster_styles:{},
  marker_icon:'',
  infobox:true,
  clickedzoom:15,
	clat:41.895466,
  clng:12.482324,
  before : function(){},
  after : function(){},
  afterUpdate : function(){},
  map_opt: {zoom: 6, mapTypeId: google.maps.MapTypeId.ROADMAP}
 };
     
 var settings = $.extend({}, defaults, options);
 this.each(function(){
 
  var map_el = $(this);
  var the_map_el = $(this).get(0);
  
  //on before
  settings.before.apply(map_el); 
    
  //init map
	var center = new google.maps.LatLng(settings.clat,settings.clng);
	var bounds = new google.maps.LatLngBounds();
	var map = new google.maps.Map(the_map_el,settings.map_opt);
	var markerCluster = new MarkerClusterer(map,null,settings.cluster_styles);
  map.setCenter(center);
  
  //apply map style
  if (settings.mapstyle_name!=''){
  	var styledMapOptions = {name:settings.mapstyle_name};
		var m_MapType = new google.maps.StyledMapType(settings.mapstyle, styledMapOptions);
		map.mapTypes.set(settings.mapstyle_name, m_MapType);  
  	map.setMapTypeId(settings.mapstyle_name);
  }
  
  // set markers icons     
	if (settings.marker_icon!=''){
  	var markerIcon = new google.maps.MarkerImage(settings.marker_icon, new google.maps.Size(21, 34));
  }
  
  // light infowindow 
  if (settings.infobox){
  var infowindow = new google.maps.InfoWindow({maxWidth: 80});
  }
  
  $(map_el).bind('update',function(){
  
  markerCluster.clearMarkers();
	
  // markers loop     
	var markers = [];
	var geocoder = new google.maps.Geocoder();
  	

	
  $(settings.elements).each(function(i){
  	
  	delay = i*settings.wait;
  	
  	// create marker
  	var el = $(this);
  	var name = $(this).find(".name").text();
  	var address = $(this).find(".address").text();
  	
  	
  	setTimeout(function(){

  	
  	
  	geocoder.geocode({ 'address':address}, function(results, status) {
    	if (status == google.maps.GeocoderStatus.OK) {
				 
				 /**/
				 
				 latLng = results[0].geometry.location;
								 
			   var marker = new google.maps.Marker({position: latLng, icon:markerIcon, title: name, animation:google.maps.Animation.DROP});
			   
			   // extend bounds
			   bounds.extend(latLng);
			    
			   
			   // bind click on map trigger event fill infowindow content on demand 
			   if (settings.infobox){
			   	var content = el.find('.infobox').html();
			   }
			   
			   google.maps.event.addListener(marker, 'click', function() {
			   	
			   	if (settings.infobox){
			    		infowindow.close();
			     	infowindow.setContent(content); 
			     	infowindow.open(map,marker);
			     }
			     
			     el.trigger(settings.trigger);
			     
			     $(el).parents().find('.active').removeClass('active');
			 	 	 $(el).addClass('active');
			     
			     setTimeout(function(){
			     	map.setZoom(settings.clickedzoom);
			       map.panTo(latLng);
			       marker.setAnimation(google.maps.Animation.DROP);
			     },settings.timeout);
			   
			   });
			   
			   // trigger click on list 
			   $(el).find('.maplink').bind("click",function(e){
			    e.preventDefault();
			    google.maps.event.trigger(marker, "click");
			   });
			 	
			 	 //set active
			 	 			 	 
			 	 	
			 	 
			 	 
			 			 
	  		 markerCluster.addMarker(marker);
	 			
	 			 //fit bounds 	
	 			 map.fitBounds(bounds);
			 /**/
			
			}else{
				 $(el).css({opacity:.35});
			}
			});
			
			//timeout
			},delay);
 
  });

 	//callbak afterUpdate 
  settings.afterUpdate.apply(map_el);
  
  }).trigger('update');
    
  $(map_el).bind('bounds',function(){
    map.fitBounds(bounds);
  });

	// nice zoom status 
  
  if (settings.showzoom){
      
   google.maps.event.addListener(map, 'zoom_changed', function() {
   	$(map_el).trigger("showzoom",[map.getZoom()]);
	 });
	 
	};
  
  //on after
  settings.after.apply(map_el); 
 
 return true;
 });


};
})(jQuery);