$.getScript("http://openlayers.org/dev/OpenLayers.js", function(){

$(document).ready(function() {

var map, layer;
var fromProjection = new OpenLayers.Projection("EPSG:4326"); // transform from WGS 1984
var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
                                                             // below are bounds for Lebanon
var extent = new OpenLayers.Bounds(35.0587,33.0187,36.6505,34.7132).transform(fromProjection,toProjection);
 var options = {
          projection: toProjection,
          restrictedExtent : extent,
          controls: [
            new OpenLayers.Control.Navigation(),
            new OpenLayers.Control.PanZoomBar(),
            new OpenLayers.Control.Attribution(),
            new OpenLayers.Control.MousePosition()
          ]
        };
markers = new OpenLayers.Layer.Markers("Markers");
      
map = new OpenLayers.Map( 'map', options);
            layer = new OpenLayers.Layer.XYZ(
            "OpenStreetMap", 
            [
                "http://otile1.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.png",
                "http://otile2.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.png",
                "http://otile3.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.png",
                "http://otile4.mqcdn.com/tiles/1.0.0/map/${z}/${x}/${y}.png"
            ],
            {
                attribution: "Data, imagery and map information provided by <a href='http://www.mapquest.com/'  target='_blank'>MapQuest</a>, <a href='http://www.openstreetmap.org/' target='_blank'>Open Street Map</a> and contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/' target='_blank'>CC-BY-SA</a>  <img src='http://developer.mapquest.com/content/osm/mq_logo.png' border='0'>",
                transitionEffect: "resize"
            }
        );
            map.addLayer(layer);
            map.addLayer(markers);
            map.setCenter(
                new OpenLayers.LonLat(35.529785, 33.85217).transform(
                    fromProjection,
                    toProjection
                ), 9
            );    

  //This is needed to register clicks on the map, get lat long and insert if in the form to add new location
  map.events.register("click", map, function(e) {
      var position = map.getLonLatFromPixel(e.xy);

      //This is needed to transform coordinates back to geographical Lat Long values
      var position1 = new OpenLayers.LonLat(position.lon,position.lat).transform(toProjection, fromProjection);
    
      OpenLayers.Util.getElement("latitude").value = position1.lon.toFixed(5);
      OpenLayers.Util.getElement("longitude").value = position1.lat.toFixed(5);
    
  });

  //This is needed to add a marker on the map to make it easier to track clicks
  map.events.register("click", map, function(e){
        var lonlat = map.getLonLatFromViewPortPx(e.xy);
        var lonlat2 = map.getLonLatFromViewPortPx(e.xy);
          m = new OpenLayers.Marker(lonlat);
        markers.clearMarkers();
          markers.addMarker(m);
        });
});

});

