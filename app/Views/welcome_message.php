<!DOCTYPE html>
<html lang="en">

</html>
<head>
  <meta charset="utf-8">
  <!-- Include the CesiumJS JavaScript and CSS files -->
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.96/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.96/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
  <style>
    .cesium-viewer-timelineContainer,
    .cesium-viewer-animationContainer,
    .cesium-viewer-toolbar,
    .cesium-widget-credits{
        display:none;
    }
  </style>
</head>
<body>
  <div id="cesiumContainer"></div>
  <script>
    // Your access token can be found at: https://cesium.com/ion/tokens.
    // This is the default access token from your ion account

    Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJkNjViMzZhNS00MGJlLTQ4YTktOWUzNS1mYjNkZjNkYjViMmYiLCJpZCI6MzQyMjcsImlhdCI6MTYwMDAzNTkxMX0.EQBtegHNt-HolrydRiNV0gD75tu0cbpo57K-Hwfcu4E';

    // Miami -80.191788, 25.761681
    // Charlote -80.843124, 35.227085
    // Sosua -70.491213, 19.666497
    
    var c = 0;
    var places = [
      {'city':'Charlotte','lat':-80.843124,'lng':35.227085},
      {'city':'Miami','lat':-80.191788,'lng':25.761681},
      {'city':'Sosua','lat':-70.491213,'lng':19.666497}
    ]

    // Initialize the Cesium Viewer in the HTML element with the `cesiumContainer` ID.
    const viewer = new Cesium.Viewer('cesiumContainer', {
      terrainProvider: Cesium.createWorldTerrain()
    }); 
       
   function fly(x,y,z,c){
        viewer.entities.add({
            position: Cesium.Cartesian3.fromDegrees(x, y),
            label: {
              text: z,
            },
          });
        viewer.camera.flyTo({
            destination : Cesium.Cartesian3.fromDegrees(x, y, 120000),
            duration:25,
            orientation : {
                heading : Cesium.Math.toRadians(0.0),
                pitch : Cesium.Math.toRadians(-90.0),
            },
                       
            complete: function(){
                c++;

                if(c == 3){
                  c = 0;
                }

                setTimeout(function(){
                      getnextplace(c);
                }, 5000);                
            }
        });
    } 

    function getnextplace(c){
      fly(places[c].lat, places[c].lng, places[c].city, c);
    }
    
    
    getnextplace(0);
  </script>
 </div>
</body>