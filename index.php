<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>MOSNE MAP / jQuery Plugin / markerClusterer + InfoBox + Geocoder + styled Google Maps API v3</title>
  <meta name="description" content="A jQuery Plugin with markerClusterer, InfoBox, Geocoder,styled Google Maps,API v3">
  <meta name="author" content="Mosne">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" href="style.css?v=2">
  <script src="js/libs/modernizr-1.7.min.js"></script>

</head>

<body>

  <div id="container">
    <header>
    <?
    echo $bc = '<nav class="bc">
    <ul>
     <li><a href="http://www.mosne.it/">Mosne / Graphic & Web design</a></li>
     <li><a href="http://www.mosne.it/playground/">Playground</a></li>
     <li><a href="http://www.mosne.it/community/eureka/">Eureka Community</a></li>
    </ul>';
    ?> 
    <h1>MOSNE MAP / jQuery Plugin</h1>
    <h3>markerClusterer + InfoBox + Geocoder + styled Google Maps API v3</h3> 
    <a id="down" href="#downloads">&#9660; Download</a>
<? echo $nav =' 
      <nav>
        <ul>
        <li><a href="#setup">Setup</a></li>
        <li><a href="#demos">Demos</a></li>
        <li><a href="#real">Real life examples</a></li>
        <li><a href="#options">Options</a></li>
        <li><a href="#downloads">Download</a></li>
        <li><a href="#tools">Tools</a></li>
        <li><a href="#thanks">Thanks</a></li>
          <li><a href="#donate">Donate</a></li>
        <li><a href="http://plugins.jquery.com/project/mosne_map">jQuery plugins project page</a></li>
        <li><a href="https://github.com/mosne/mosne_map">Github project page</a></li>
        <li><a href="https://github.com/mosne/mosne_map/pulls">Requests</a></li>
        <li><a href="https://github.com/mosne/mosne_map/issues">Issues</a></li>
        <li><a href="https://github.com/mosne/mosne_map/fork">Fork</a></li>
      </ul>
      </nav>';?>
      
    </header>
    
    <div id="main" role="main">
    
    <section id="setup">
      <h2>Setup</h2>
      
      Requires
      <ul>
        <li><a href="http://jquery.com/">jQuery 1.5</a></li>
        <li><a href="http://code.google.com/intl/fr/apis/maps/documentation/javascript/">Google Maps API v3</a></li>
        <li><a href="http://gmaps-utility-library-dev.googlecode.com/svn/tags/markerclusterer/">MarkerClusterer</a></li>
      </ul>
      
      <div class="code">
      <pre class="html">
&lt;script src=&quot;//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js&quot;&gt;&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot; src=&quot;http://maps.google.com/maps/api/js?sensor=true&amp;key=&quot;&gt;&lt;/script&gt;
&lt;script type=&quot;text/javascript&quot; src=&quot;MarkerClusterer.js&quot;&gt;&lt;/script&gt;
&lt;!-- mode 'latlng'  for LARGE markers array - use lat lng direct input --&gt;
&lt;!-- mode 'address' for SMALL markers array - use plain text address input --&gt;
&lt;script type=&quot;text/javascript&quot; src=&quot;jquery.mosne.map.js&quot;&gt;&lt;/script&gt;</pre>

      </div>
      
    </section>  
    
    <section id="demos">
    <h2>Real life examples</h2>
    
    <div class="clearfix example">
    <ul>
        <li><a href="http://fotoautomat.fr/category/photocabines/" target="_blank">Fotoautomat France</a></li>
        <li><a href="http://www.wallacesarthousescotland.com/contacts/" target="_blank">Wallace's arthouse scotland</a></li>
        <li>Many others coming sooon...</li>
        <li>twitme yours @mosne</li>
    </ul>
    </div>
    </section>   
        
    <section id="demos">
    <h2>Demos</h2>
    
    <div class="clearfix example">
    <ul>
        <li><a href="#map_1">Map1: Simple</a> use lat lng coordinates for each link</li>
        <li><a href="#map_2">Map2: Advanced</a> how-to style google maps</li>
        <li><a href="#map_3">Map3: Geocoding</a> use plaint text address for each link</li>
        <li><a href="#map_4">Map4: Events</a> shows how to bind an trigger different events</li>
        <li><a href="#map_5">Map5: Categories</a> customs  marker icons based on category</li>
        <li><a href="#map_6">Map6: InfoBox</a> customs  infobox styles (infobox.js required)</li>
    </ul>
    </div>
    
    <!-- map1 example -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_1" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map1: simple</h2>
        <div id="map_1_list" class="list">
    
          <? 
           $all=8;
           for ($a=0; $a<$all; $a++){ ?>
        
          <div class="maplocation" 
            data-name="Link <? echo $a; ?>"  
            data-lat="<? echo rand(41,45).".".rand(0,9999999); ?>"
            data-lng="<? echo rand(8,16).".".rand(0,9999999); ?>">
            
            <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
              <div class="infobox">
              
                <h2>foo <? echo $a; ?></h2>
                <p>Hello world!</p>
               
              </div>
          </div>
        
          <? }  ?>
        </div>
      </div>
      
      
      
      <div class="code">
      
      <pre class="html">
&lt;div id=&quot;map_1&quot; class=&quot;mapbox&quot;&gt;&lt;/div&gt;
&lt;div id=&quot;map_1_list&quot; class=&quot;list&quot;&gt;
  &lt;div class=&quot;maplocation&quot; data-name=&quot;Link 1&quot;  data-lat=&quot;41.1051872&quot; data-lng=&quot;13.2934012&quot;&gt;
    &lt;h2&gt;&lt;a href=&quot;#&quot; class=&quot;maplink&quot;&gt;Link 1&lt;/a&gt;&lt;/h2&gt;
    &lt;div class=&quot;infobox&quot;&gt;
      &lt;h2&gt;Link 1&lt;/h2&gt;
      &lt;p&gt;Hello world!&lt;/p&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  ...
&lt;/div&gt;</pre>
      
      <pre class="js">$("#map_1").mosne_map({elements:'#map_1_list .maplocation'});</pre>
      </div>
      
    </div>

    <!-- map2 example -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_2" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map2: advanced</h2>
        <div id="map_2_list" class="list">
    
          <? 
           $all=8;
           for ($a=0; $a<$all; $a++){ ?>
        
          <div class="maplocation" 
            data-name="Link <? echo $a; ?>"  
            data-lat="<? echo rand(41,45).".".rand(0,9999999); ?>"
            data-lng="<? echo rand(8,16).".".rand(0,9999999); ?>">
            
            <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
              <div class="infobox">
                <h2>foo <? echo $a; ?></h2>
                <p>Hello world!</p>
              </div>
          </div>
        
          <? }  ?>
        </div>
      </div>
      
      <div class="code" >
      <pre class="js">
var mycolor = "#ff0066";
var mycolor2 = "#966E7E";
var mybg_color = "#000000";

var cluster_styles = [{
    url: 'images/m3.png',
    height: 30,
    width: 30,
    opt_textSize: 14,
    anchor: [3, 0],
    textColor: '#222222'
}, {
    url: 'images/m4.png',
    height: 40,
    width: 40,
    opt_textSize: 17,
    opt_anchor: [6, 0],
    opt_textColor: '#222222'
}, {
    url: 'images/m5.png',
    width: 50,
    height: 50,
    opt_textSize: 21,
    opt_anchor: [8, 0],
    opt_textColor: '#222222',
}, {
    url: 'images/m5.png',
    width: 50,
    height: 50,
    opt_textSize: 21,
    opt_anchor: [8, 0],
    opt_textColor: '#222222',
}];

var marker_icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|f6005d|f6005d';

// Styledmaps wizard 
// http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/

var stylez = [{
    featureType: "water",
    elementType: "all",
    stylers: [{
        invert_lightness: true
    }, {
        lightness: -100
    }]
}, {
    featureType: "road",
    elementType: "all",
    stylers: [{
        visibility: "on"
    }, {
        saturation: -99
    }, {
        gamma: 0.34
    }]
}, {
    featureType: "landscape",
    elementType: "all",
    stylers: [{
        visibility: "on"
    }, {
        gamma: 0.16
    }, {
        saturation: -93
    }, {
        lightness: -75
    }]
}, {
    featureType: "poi",
    elementType: "all",
    stylers: [{
        visibility: "off"
    }]
}, {
    featureType: "administrative",
    elementType: "all",
    stylers: [{
        invert_lightness: true
    }]
}, {
    featureType: "road.arterial",
    elementType: "labels",
    stylers: [{
        visibility: "off"
    }]
}, {
    featureType: "road.highway",
    elementType: "labels",
    stylers: [{
        visibility: "off"
    }]
}, {
    featureType: "transit",
    elementType: "all",
    stylers: [{
        visibility: "off"
    }]
}, {
    featureType: "road",
    elementType: "all",
    stylers: [{
        hue: mycolor
    }, {
        saturation: 16
    }, {
        lightness: -49
    }]
}, {
    featureType: "administrative",
    elementType: "all",
    stylers: [{
        saturation: 25
    }, {
        lightness: -40
    }, {
        hue: mycolor2
    }]
}];

var mapstyle_id = 'minimal';
var mapOptions = {
    mapTypeControlOptions: {
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, mapstyle_id]
    },
    panControl: false,
    zoomControl: true,
    zoomControlOptions: {
        style: google.maps.ZoomControlStyle.SMALL,
        position: google.maps.ControlPosition.TOP_LEFT
    },
    mapTypeControl: false,
    scaleControl: false,
    streetViewControl: false,
    zoom: 6,
    disableDoubleClickZoom: true,
    backgroundColor: mybg_color
};


$("#map_2").mosne_map({
    elements: '#map_2_list .maplocation',
    showzoom: true,
    timeout: 100,
    clat: 41.895466,
    clng: 12.482324,
    clickedzoom: 14,
    mapstyle: stylez,
    mapstyle_name: mapstyle_id,
    map_opt: mapOptions,
    cluster_styles: {
        zoomOnClick: true,
        maxZoom: 13,
        gridSize: 30,
        styles: cluster_styles
    },
    marker_icon: marker_icon

});
            </pre>
      </div>
      
    </div>
    <!-- map3 example -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_3" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map3: geocoding</h2>
        <div id="map_3_list" class="list">
    
          <? 
     $all=8;
     $strade =array("casilina",
                    "prenestina",
                    "tuscolana",
                    "boccea",
                    "pontina",
                    "salaria",
                    "tiburtina",
                    "aurelia");
     
     for ($a=0; $a<$all; $a++){ ?>
  
   <div class="maplocation">
      
      <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
        <div class="infobox">
          <h2 class="name">foo <? echo $a; ?></h2>
          <p class="address">via <? echo $strade[rand(0,7)]; ?> <? echo (($a*20)+1); ?>, 00100 roma, italia</p>
          <p>Hello world!</p>
        </div>
    </div>
  
<? }  ?>

        </div>
      </div>
      
      
      
      <div class="code">
      <pre class="html">
&lt;div id=&quot;map_3&quot; class=&quot;mapbox&quot;&gt;&lt;/div&gt;
&lt;div class=&quot;maplocation&quot;&gt;
  &lt;h2&gt;&lt;a href=&quot;#&quot; class=&quot;maplink&quot;&gt;Link 1&lt;/a&gt;&lt;/h2&gt;
  &lt;div class=&quot;infobox&quot;&gt;
    &lt;h2 class=&quot;name&quot;&gt;Link 1&lt;/h2&gt;
    &lt;p class=&quot;address&quot;&gt;via casilina 11, 00100 roma, italia&lt;/p&gt;
    &lt;p&gt;Hello world!&lt;/p&gt;
   &lt;/div&gt;
&lt;/div&gt;</pre>
      
      <pre class="js"> $("#map_3").mosne_map({mode:'address',elements:'#map_3_list .maplocation'});</pre>
      </div>
      
    </div>
    
    
    <!-- map1 example -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_4" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map4: Events</h2>
        
        <div class="pd">
           <div>zoom level: <span id="zoom">0</span></div>
           <div>total locations: <span id="tot">0</span></div>
           <ul>
            <li><a id="reset" href="#">reset zoom (fit to bouds)</a></li>
            <li><a id="up" href="#">Remove some elements and update map</a></li>
           </ul>
           
        </div>
        
        <div id="map_4_list" class="list">
    
          <? 
           $all=8;
           for ($a=0; $a<$all; $a++){ ?>
        
          <div class="maplocation" 
            data-name="Link <? echo $a; ?>"  
            data-lat="<? echo rand(41,45).".".rand(0,9999999); ?>"
            data-lng="<? echo rand(8,16).".".rand(0,9999999); ?>">
            
            <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
              <div class="infobox">
                <h2>foo <? echo $a; ?></h2>
                <p>Hello world!</p>
              </div>
          </div>
        
          <? }  ?>
        </div>
      </div>
      
      
      
      <div class="code">
      
  

      <pre class="js">
    $("#map_4").bind("showzoom", function (e, zoom) {
        $("#zoom").html(zoom);
    });

    $("#map_4_list .maplocation").bind('aj_open', function (e) {
        $(this).append('&lt;div class=&quot;pd&quot;&gt;do something fun!&lt;/div&gt;');
        return false;
    });

    $("#reset").click(function (e) {
        e.preventDefault();
        $("#map_4").trigger("bounds");
    });

    $("#up").click(function (e) {
        e.preventDefault();
        $("#map_4_list .maplocation:odd").remove();
        $("#map_4").trigger("update");
    });

    var counter = function () {
        tot_p = $("#map_4 .maplocation").length;
        $("#tot").html(tot_p);
    }

    $("#map_4").mosne_map({
        elements: '#map_4_list .maplocation',
        showzoom: true,
        trigger: 'aj_open',
        clickedzoom: 14,
        infowindows: false, //do not use infoWindow
        afterUpdate: counter
    });</pre>
      </div>
      
    </div>


    




  <!-- map1 example -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_5" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map5: Categories</h2>
        
        <div id="map_5_list" class="list">
    
          <? 
           $all=8;
           
           $cats = array('red','green','blue','aqua');
           for ($a=0; $a<$all; $a++){ 
           
           $cc = $cats[rand(0,3)];
           
           ?>
        
          <div class="maplocation" 
            data-name="Link <? echo $a; ?>"  
            data-lat="<? echo rand(41,45).".".rand(0,9999999); ?>"
            data-cat="<? echo $cc ?>"
            data-lng="<? echo rand(8,16).".".rand(0,9999999); ?>">
            
            <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
              <div class="infobox">
                <h2>foo <? echo $a; ?></h2>
                <p><? echo $cc ?></p>
              </div>
          </div>
        
          <? }  ?>
        </div>
      </div>
      
      
      
      <div class="code">
      
       <pre class="html">&lt;div class=&quot;maplocation&quot; data-name=&quot;Link 1&quot;  data-lat=&quot;41.10&quot; data-lng=&quot;13.29&quot; data-cat=&quot;red&quot;&gt;</pre>
     
      <pre class="js">var my_cat_style ={
    red:    { icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=R|cc0000|FFFFFF'},
    green:  { icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=G|00cc00|333333'},
    blue:   { icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=B|2222cc|FFFFFF'}, 
    aqua:   { icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|00cccc|333333'}
    };
        
    $("#map_5").mosne_map({
        elements: '#map_5_list .maplocation',
        cluster_styles: {
            zoomOnClick: true,
            maxZoom: 3,
            styles: cluster_styles
        },
        cat_style: my_cat_style    
    });</pre>
      </div>
      
    </div>


 <!-- map6 custom infoWindows -->
    
    <div class="clearfix example">
      <div class="sx">
        <div id="map_6" class="mapbox"></div>
      </div>
      <div class="dx">
        <h2>Map6: custom infoWindows</h2>
        
        <div id="map_6_list" class="list">
    
          <? 
           $all=8;
           
           //$cats = array('today','yesterday','comingsoon');
           for ($a=0; $a<$all; $a++){ 
           
           $cc = 'yesterday'; //$cats[rand(0,2)];
           
           ?>
        
          <div class="maplocation" 
            data-name="Link <? echo $a; ?>"  
            data-lat="<? echo rand(41,45).".".rand(0,9999999); ?>"
            data-lng="<? echo rand(8,16).".".rand(0,9999999); ?>">
            
            <h2><a href="#" class="maplink">Link <? echo $a; ?></a></h2>
              <div class="infobox">
              <div class="m_tooltip">
                <p>this is so <? echo $cc ?>!</p>
              </div>
              </div>
          </div>
        
          <? }  ?>
        </div>
      </div>
      
      
      
      <div class="code">
      
       <pre class="html">&lt;div class=&quot;infobox&quot;&gt;
    &lt;div class=&quot;m_tooltip&quot;&gt;
        &lt;p&gt;this is so yesterday!&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>

<pre class="html">
.m_tooltip{
	position: absolute;
	text-align: center;
	left: 0;
	top: 0;
	z-index: -2;
	color: #FFFFFF;
    float: left;
    margin-top: 10px;
    padding: 10px;
    width: 260px;
    border: 1px solid #313436;
    text-shadow: 0px 0px 3px #000;
       -moz-border-radius: 5px;  
    -webkit-border-radius: 5px; 
            border-radius: 5px; 
       -moz-box-shadow: 0px 1px 2px #000; 
    -webkit-box-shadow: 0px 1px 2px #000;
            box-shadow: 0px 1px 2px #000;
  	background-color: #313436;
    background-image: -webkit-linear-gradient(top, #313436, #222526); 
    background-image:    -moz-linear-gradient(top, #313436, #222526);
    background-image:     -ms-linear-gradient(top, #313436, #222526); 
    background-image:      -o-linear-gradient(top, #313436, #222526); 
    background-image:         linear-gradient(top, #313436, #222526);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#313436', EndColorStr='#222526');
    }
</pre>
     
      <pre class="js">$("#map_6").mosne_map({
        elements: '#map_6_list .maplocation',
        infowindows: false,                     // do not use infoWindow
        infobox: true,                          // use infobox instead
        cluster_styles: {
            zoomOnClick: true,
            maxZoom: 3,
            styles: cluster_styles
        },
        marker_icon:'images/m_red.png'
    });</pre>
      </div>
      
    </div>

    
</section>  

 <section id="options">
      <h2>Options</h2>
      
      <div class="code">
      <pre class="js">
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
            cat_style: {},                  // costum icons and click zoom level
            fitbounds: true,                // on|off fit bounds
            showzoom: false,                // bind current map zoom level event
            before: function () {},         // before create map callback
            after: function () {},          // after create map callback 
            afterUpdate: function () {}     // after update map callback
        };</pre>
      </div>
      
    </section>  


    
    <section id="downloads">  
    <h2>Download</h2>
    <p>this project is under <a href="http://www.gnu.org/licenses/gpl.html">GNU General Public License</a><br/></p>
    
    <ul>
      <li><a href="https://github.com/mosne/mosne_map">this site on github</a></li>
      <li><a href="jquery.mosne.map.js">jquery.mosne.map.js</a></li>
      <li><a href="http://marijnhaverbeke.nl/uglifyjs?code_url=http://www.mosne.it/playground/mosne_map/jquery.mosne.map.js&download=jquery.mosne.map.min.js">jquery.mosne.map.min.js</a> (UglifyJS minification)</li>
    </ul>
    
    
    
    </section>  
    
    
    <section id="tools">  
    <h2>Tools</h2>
    <ul>
      <li><a href="http://gmaps-utility-library-dev.googlecode.com/">markerClusterer and InfoBox</a></li>
      <li><a href="http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html">Google Maps API Styled Map Wizard</a></li>
      <li><a href="http://itouchmap.com/latlong.html">iTouchmap / latitude and longitude of a point</a></li>
      <li><a href="http://code.google.com/intl/fr/apis/maps/documentation/javascript/basics.html">Google Maps Javascript API V3</a></li>
      <li><a href="http://code.google.com/intl/fr/apis/maps/documentation/javascript/reference.html">Google Maps Javascript API V3 Reference</a></li>
    </ul>
    </section>  
    
    <section id="thanks"> 
    <h2>Thanks</h2>
    <ul>
      <li><a href="http://vigetlabs.github.com/jmapping/">Brian Landau's jMapping</a></li>
      <li><a href="http://marcgrabanski.com/articles/jquery-google-maps-tutorial-basics">Marc Grabanski's tutorial</a></li>
      <li><a href="http://marijnhaverbeke.nl/uglifyjs">UglifyJS JavaScript minification</a></li>
      <li><a href="http://lacab.it">Lacab Hosting</a></li>
    </ul>
    </section>  
    
 <section id="donate"> 
    <h2>Help this project</h2>   
    
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</section>  

    
  <!--main ends -->
    </div>
    <footer>
    <? echo $nav; echo $bc; ?>
    </footer>
  </div> 

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.5.1.min.js">\x3C/script>')</script>

  <!-- scripts concatenated and minified via ant build script-->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&key=ABQIAAAARR0HQxACUc8T7no6lwNbcRRSiXwM92cUDm23D7Ry7WdvUOfXWxRqPjl2PGjDH85KKQEz-_7rsSWQCA"></script>
    <script type="text/javascript" src="MarkerClusterer.js"></script>
    <script type="text/javascript" src="infobox.js"></script>
        <script type="text/javascript" src="jquery.mosne.map.js?v=7"></script>
    <script type="text/javascript" src="plugins.js"></script>
    <script type="text/javascript" src="effects.js?v=7"></script>

  <!-- end scripts-->

  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix('img, .png_bg'); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->


  <script>
    var _gaq=[['_setAccount','UA-7443537-1'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>

</body>
</html>