$(function () {

    $("#map_1").mosne_map({
        elements: '#map_1_list .maplocation'
    });

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
        opt_textColor: '#222222'
    }, {
        url: 'images/m5.png',
        width: 50,
        height: 50,
        opt_textSize: 21,
        opt_anchor: [8, 0],
        opt_textColor: '#222222'
    }];

    var marker_icon = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=|f6005d|f6005d';

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
        infowindows: true,
        showzoom: true,
        zoom: 6,
        trigger: 'aj_open',
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
        marker_icon: marker_icon,
        afterUpdate: counter
    });




    $("#map_3").mosne_map({
        mode: 'address',
        elements: '#map_3_list .maplocation'
    });

    $("#map_4").bind("showzoom", function (e, zoom) {
        $("#zoom").html(zoom);
    });

    $("#map_4_list .maplocation").bind('aj_open', function (e) {
        $(this).append('<div class="pd">do something fun!</div>');
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

        tot_p = $("#map_4_list .maplocation").length;
        $("#tot").html(tot_p);
    }

       $("#map_4").mosne_map({
        elements: '#map_4_list .maplocation',
        showzoom: true,
        trigger: 'aj_open',
        clickedzoom: 14,
        infowindows: false, //dont't use infoWindow
        afterUpdate: counter
    });

var my_cat_style ={
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
    });
    
    
     $("#map_6").mosne_map({
        elements: '#map_6_list .maplocation',
        infowindows: false,                     //do not use infoWindow
        infobox: true,                          //  use infobox instead
        cluster_styles: {
            zoomOnClick: true,
            maxZoom: 3,
            styles: cluster_styles
        },
        marker_icon:'images/m_red.png'
    });

   
    //snipet
    $("pre.js").snippet("javascript", {
        style: "whitengrey",
        clipboard: "js/ZeroClipboard.swf",
        showNum: true
    });
    $("pre.html").snippet("html", {
        style: "whitengrey",
        clipboard: "js/ZeroClipboard.swf",
        showNum: true
    });

});