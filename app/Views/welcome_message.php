<!DOCTYPE html>
<html lang="en">

</html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <!-- Include the CesiumJS JavaScript and CSS files -->
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.96/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.96/Build/Cesium/Widgets/widgets.css" rel="stylesheet">
  <style>
    .cesium-viewer-timelineContainer,
    .cesium-viewer-animationContainer,
    .cesium-viewer-toolbar,
    .cesium-widget-credits,
    .cesium-credit-textContainer,
    .cesium-widget-credits img,
    a.cesium-widget-credits,
    .cesium-credit-expand-link
    {
        display:none;
    }

    .control-btn{
      margin:5px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col"><div id="cesiumContainer"></div></div>   
      <div class="col">
        <div id="controls" class="row"></div>
        <div id="bullets"></div>
      </div>
    </div>
  </div>
  <script>
    // Your access token can be found at: https://cesium.com/ion/tokens.
    Cesium.Ion.defaultAccessToken = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJkNjViMzZhNS00MGJlLTQ4YTktOWUzNS1mYjNkZjNkYjViMmYiLCJpZCI6MzQyMjcsImlhdCI6MTYwMDAzNTkxMX0.EQBtegHNt-HolrydRiNV0gD75tu0cbpo57K-Hwfcu4E';
        
    var c = 0;
    var places = [
      {'city':'Charlotte','lat':-80.843124,'lng':35.227085},
      {'city':'Ft Lauderdale','lat':-80.137314,'lng':26.122438},
      {'city':'Miami','lat':-80.191788,'lng':25.761681},
      {'city':'Santiago','lat':-70.692039 ,'lng':19.470800},
      {'city':'Puerto Plata','lat':-70.687111,'lng':19.780769},
      {'city':'Sosua','lat':-70.491213,'lng':19.666497},
      {'city':'Cabrete','lat':-70.414421,'lng':19.750923}      
    ]

    // Initialize the Cesium Viewer in the HTML element with the `cesiumContainer` ID.
    const viewer = new Cesium.Viewer('cesiumContainer', {
      terrainProvider: Cesium.createWorldTerrain()
    }); 
       
   function fly(x,y,z,c){
          viewer.entities.add({
            position: Cesium.Cartesian3.fromDegrees(x-.2, y-.05, 5000),
            label: {
              text: z,
              font: "20px Helvetica"
            }            
          });
          viewer.entities.add({
            position: Cesium.Cartesian3.fromDegrees(x, y,5000),
            point: {
              pixelSize: 12,
              color: Cesium.Color.WHITE,
            }           
          });
          
        viewer.camera.flyTo({
            destination : Cesium.Cartesian3.fromDegrees(x, y, 170000),
            duration:20,
            orientation : {
                heading : Cesium.Math.toRadians(0.0),
                pitch : Cesium.Math.toRadians(-90.0),
            },
                       
            complete: function(){
                c++;

                if(c == 8){
                  c = 0;
                }

                setTimeout(function(){
                      getnextplace(c);
                }, 5000);                
            }
        });
    } 

    function getnextplace(c){      
      $('div#bullets').html('<h3>'+places[c].city+'</h3>')
      $('div#bullets').append('<p>Information, facts, photos, links to resources about this city for travellers.</p>')
      fly(places[c].lat, places[c].lng, places[c].city, c);
    }

    function populate(p){
      for(var x in p){
        $('div#controls').append('<button class="control-btn">'+p[x].city+'</button>');
      }      
    }
    
    populate(places);
    getnextplace(0);

    $('body').click(function(){       
      console.log('pressed');
    });
 
 </script>
 </div>
</body>