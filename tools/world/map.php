<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Region Map - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
   integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
   crossorigin=""/>
   <!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
  integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
  crossorigin=""></script>
    <div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">

      <!-- Page Header -->
      <div class="col-md-12">
      <div class="pagetitle" id="pgtitle">Region Map</div>
    </div>
      <div class="body sidebartext col-xs-12" id="body">

        <style>
        #image-map {
          width: 100%;
          height: 600px;
          border: 1px solid #ccc;
          margin-bottom: 10px;
        }
        </style>

        <div id="image-map"></div>
<script>
// Using leaflet.js to pan and zoom a big image.
// See also: http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html

// create the slippy map
var map = L.map('image-map', {
  minZoom: 1,
  maxZoom: 4,
  center: [0, 0],
  zoom: 1,
  crs: L.CRS.Simple,
  scrollWheelZoom:'center'

});
var mapFeatures = L.layerGroup();
var mapLog = L.layerGroup();

var overlayMaps = {
    "Map Feautures": mapFeatures,
    "Campaign Log": mapLog

};

L.control.layers(null, overlayMaps).addTo(map);


// dimensions of the image
var w = 5040,
    h = 3308,
    url = '/assets/images/Starting-Region.jpg';

// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom()-1);
var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
var bounds = new L.LatLngBounds(southWest, northEast);

// add the image overlay,
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);

// tell leaflet that the map is exactly as big as the image
map.setMaxBounds(bounds);
map.setView(new L.LatLng(-220.925003, 103.017123), 3);
var popup = L.popup();

/*function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);*/

</script>
<?php
$worldtitle = "SELECT * FROM campaignlog WHERE active = 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
$mrk = 1;
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  ?>
  <script>
  var markerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
  var pinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
  var pin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-blue.png", iconAnchor<?php echo $mrk; ?>: pinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
  var marker<?php echo $mrk; ?> = new L.marker(markerPos<?php echo $mrk; ?>, { icon: pin<?php echo $mrk; ?> }).addTo(map).bindPopup("<?php echo $row['entry']; ?>");
//  var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>], {icon: myIcon}).addTo(map).bindPopup("<?php echo $row['entry']; ?>");
  marker<?php echo $mrk; ?>.addTo(mapLog);
  </script>
  <?php
    $mrk = $mrk + 1;

}
 ?>

 <?php
 $worldtitle = "SELECT * FROM mapfeatures";
 $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
 $mrk = 1;
 while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   ?>
   <script>
   var bmarkerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
   var bpinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
   var bpin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-red.png", iconAnchor<?php echo $mrk; ?>: bpinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
   var bmarker<?php echo $mrk; ?> = new L.marker(bmarkerPos<?php echo $mrk; ?>, { icon: bpin<?php echo $mrk; ?> }).addTo(map).bindPopup("<?php echo $row['text']; ?>");
 //  var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>], {icon: myIcon}).addTo(map).bindPopup("<?php echo $row['text']; ?>");
   bmarker<?php echo $mrk; ?>.addTo(mapFeatures);
   </script>
   <?php
     $mrk = $mrk + 1;

 }
  ?>
<!-- <script>
 var marker = L.marker([-233.356251, 87.868822]).addTo(map);
 marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
</script> -->

</div>
</div>


   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
