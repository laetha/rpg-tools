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
   if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
   }

   $id = 'notset';
   $disallowed_paths = array('header', 'footer');
   if (!empty($_GET['id'])) {
     $tmp_action = basename($_GET['id']);
     if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
           $id = $tmp_action;
     }
   $id = addslashes($id);
   $id = str_replace('%20', ' ', $id);
   echo $id;
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
    <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

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
  minZoom: 2,
  maxZoom: 7,
  center: [0, 0],
  zoom: 2,
  crs: L.CRS.Simple,
  scrollWheelZoom:'center'

});
var mapFeatures = L.layerGroup();
var mapLog = L.layerGroup();
var mapCompendium = L.layerGroup();
var mapZones = L.layerGroup();

var overlayMaps = {
    "Map Feautures": mapFeatures,
    "Campaign Log": mapLog,
    "Legend": mapCompendium,
    "Zones": mapZones

};

L.control.layers(null, overlayMaps).addTo(map);


// dimensions of the image
var w = 2259*6,
    h = 1435*6,
    url = '/assets/images/City2.png';

// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom()-1);
var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
var bounds = new L.LatLngBounds(southWest, northEast);

// add the image overlay,
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);

// tell leaflet that the map is exactly as big as the image
map.setMaxBounds(bounds);

var popup = L.popup();



//DISTRICT 1
var district1 = [[-92.125, 101.560761],
                [-86.4375, 111.621424],
                [-92.375, 115.370739],
                [-95.125, 120.682269],
                [-78.3125, 124.744027],
                [-74.375, 124.306367],
                [-69.5625, 125.681116],
                [-64.625, 122.681664],
                [-60.0625, 121.806824],
                [-51.625, 112.746036],
                [-57.5, 110.683912],
                [-64, 105.93478],
                [-66, 103.935145],
                [-67.3125, 103.747679],
                [-76.8125, 106.184734],
                [-83.625, 103.057725],
                [-85.75, 100.620671],
                [-92.125, 101.560761]
              ];
      var poly = L.polygon(district1).addTo(map);
      poly.setStyle({
        fillColor: '#cfcc00',
        color: '#cfcc00'
      });
      poly.on('mouseover', function(){
        poly.setStyle({
          fillColor: '#fffd6e',
        color: '#fffd6e'
        });
      });
        poly.on('mouseout', function(){
        poly.setStyle({
          fillColor: '#cfcc00',
        color: '#cfcc00'
        });
      });
      poly.addTo(mapZones);

      //DISTRICT 2
var district2 = [[-93.34375, 99.372687],
                [-95.53125, 92.62392],
                [-101.40625, 93.311659],
                [-104.90625, 92.343086],
                [-107.8125, 87.687686],
                [-107.28125, 82.594867],
                [-102.65625, 77.533291],
                [-98.625, 75.687589],
                [-90.75, 75.281265],
                [-86.59375, 74.405734],
                [-80.4375, 71.217681],
                [-76.96875, 70.936482],
                [-69.59375, 73.998697],
                [-65.53125, 76.997949],
                [-59.46875, 66.68727],
                [-55.0625, 67.624599],
                [-51.46875, 72.21751],
                [-55.5, 82.496882],
                [-52.09375, 87.185016],
                [-48.71875, 90.184468],
                [-48.28125, 103.244583],
                [-50.625, 111.184143],
                [-56.28125, 109.090975],
                [-62.53125, 104.404331],
                [-64.375, 102.592162],
                [-67.75, 101.904416],
                [-76.5, 104.185387],
                [-82.40625, 101.248423],
                [-85.046875, 98.733604],
                [-93.34375, 99.372687]
              ];
      var poly2 = L.polygon(district2).addTo(map);
      poly2.setStyle({
        fillColor: '#9500ff',
        color: '#9500ff'
      });
      poly2.on('mouseover', function(){
        poly2.setStyle({
          fillColor: '#c26bff',
        color: '#c26bff'
        });
      });
        poly2.on('mouseout', function(){
        poly2.setStyle({
          fillColor: '#9500ff',
        color: '#9500ff'
        });
      });
      poly2.addTo(mapZones);

     //DISTRICT 3
     var district3 = [[-95.125, 120.733792],
                [-98.3125, 123.436192],
                [-107.625, 140.05872],
                [-109.0625, 140.746426],
                [-99.8125, 148.903121],
                [-102.65625, 155.964331],
                [-102.875, 163.806649],
                [-100.21875, 163.153497],
                [-93.96875, 159.060495],
                [-86.21875, 153.591911],
                [-77.3125, 152.560449],
                [-63.5625, 149.060678],
                [-59, 161.996637],
                [-57.71875, 161.777927],
                [-46.6875, 151.747961],
                [-44.84375, 136.467801],
                [-28.4375, 139.123315],
                [-20.8125, 133.744472],
                [-23.875, 122.184084],
                [-29.734375, 123.4047],
                [-42.34375, 124.091677],
                [-47.4375, 116.654228],
                [-51.46875, 113.217356],
                [-60.03125, 121.935158],
                [-64.71875, 122.84134],
                [-69.375, 125.840792],
                [-74.6875, 124.528195],
                [-78.375, 124.934371],
                [-87.5, 122.215518],
                [-95.125, 120.733792]
              ];
      var poly3 = L.polygon(district3).addTo(map);
      poly3.setStyle({
        fillColor: '#00ff47',
        color: '#00ff47'
      });
      poly3.on('mouseover', function(){
        poly3.setStyle({
          fillColor: '#69ff93',
        color: '#69ff93'
        });
      });
        poly3.on('mouseout', function(){
        poly3.setStyle({
          fillColor: '#00ff47',
        color: '#00ff47'
        });
      });
      poly3.addTo(mapZones);

        //DISTRICT 4
     var district4 = [[-18.125, 118.841574],
                  [-16.09375, 92.47139],
                  [-17.9375, 77.032081],
                  [-25.40625, 62.469381],
                  [-34.5625, 53.031585],
                  [-43.09375, 60.717647],
                  [-49.78125, 62.373509],
                  [-54.90625, 67.653794],
                  [-51.28125, 72.152973],
                  [-55.375, 82.526078],
                  [-52.03125, 87.091129],
                  [-48.53125, 90.184314],
                  [-48.0625, 103.373258],
                  [-50.4375, 111.278064],
                  [-45.125, 116.370884],
                  [-41.65625, 122.528423],
                  [-29.9375, 121.497362],
                  [-18.125, 118.841574]
                
              ];
      var poly4 = L.polygon(district4).addTo(map);
      poly4.setStyle({
        fillColor: '#ff0015',
        color: '#ff0015'
      });
      poly4.on('mouseover', function(){
        poly4.setStyle({
          fillColor: '#ff6975',
        color: '#ff6975'
        });
      });
        poly4.on('mouseout', function(){
        poly4.setStyle({
          fillColor: '#ff0015',
        color: '#ff0015'
        });
      });
      poly4.addTo(mapZones);

        //DISTRICT 5
     var district5 = [[-34.53125, 52.937646],
                  [-21.6875, 37.906528],
                  [-32.625, 29.935997],
                  [-46.625, 36.310084],
                  [-71.9375, 26.967458],
                  [-79.625, 39.809342],
                  [-77.03125, 45.839491],
                  [-86.03125, 52.432037],
                  [-92, 56.9984],
                  [-101.90625, 65.340838],
                  [-116.6875, 68.590535],
                  [-128.875, 77.931641],
                  [-117.75, 91.616642],
                  [-107.875, 86.929998],
                  [-107.125, 82.404085],
                  [-102.875, 77.498731],
                  [-98.75, 75.592829],
                  [-90.59375, 75.155078],
                  [-86.71875, 74.435797],
                  [-80.5625, 71.186391],
                  [-76.90625, 70.842367],
                  [-69.65625, 73.748086],
                  [-65.6875, 76.810027],
                  [-59.5, 66.717184],
                  [-54.96875, 67.592025],
                  [-49.9375, 62.373611],
                  [-43.15625, 60.654764],
                  [-34.53125, 52.937646]
                
              ];
      var poly5 = L.polygon(district5).addTo(map);
      poly5.setStyle({
        fillColor: '#0000FF',
        color: '#0000FF'
      });
      poly5.on('mouseover', function(){
        poly5.setStyle({
          fillColor: '#5c5cff',
        color: '#5c5cff'
        });
      });
        poly5.on('mouseout', function(){
        poly5.setStyle({
          fillColor: '#0000FF',
        color: '#0000FF'
        });
      });
      poly5.addTo(mapZones);


</script>

<?php
$worldtitle = "SELECT * FROM world WHERE coord NOT LIKE ''";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
$mrk = 1;
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  ?>
  <script>
  var markerPos<?php echo $mrk; ?> = new L.LatLng(<?php echo $row['coord']; ?>);
  var pinAnchor<?php echo $mrk; ?> = new L.Point(10, 32);
  var pin<?php echo $mrk; ?> = new L.Icon({ iconUrl: "/assets/images/map-marker-purple.png", iconAnchor<?php echo $mrk; ?>: pinAnchor<?php echo $mrk; ?>, iconSize: [20, 32] });
  var marker<?php echo $mrk; ?> = new L.marker(markerPos<?php echo $mrk; ?>, { icon: pin<?php echo $mrk; ?> }).addTo(map).bindPopup('<a href="world.php?id=<?php echo $row['title']; ?>" target="_BLANK"><?php echo $row['title']; ?></a>');

  marker<?php echo $mrk; ?>.addTo(mapCompendium);
  </script>
  <?php
    $mrk = $mrk + 1;
    
}
 ?>

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
  var marker<?php echo $mrk; ?> = new L.marker(markerPos<?php echo $mrk; ?>, { icon: pin<?php echo $mrk; ?> }).addTo(map).bindPopup("<?php echo 'Day '.$row['date'].': '.$row['entry']; ?>");
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
 
   bmarker<?php echo $mrk; ?>.addTo(mapFeatures);
   </script>
   <?php
     $mrk = $mrk + 1;

 }
  ?>
  <div class="table-responsive">

 <table id="faction" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
      <thead class="thead-dark">
          <tr>
              <th scope="col">Coord</th>
             <th scope="col">Text</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Text</th>
          </tr>
      </tfoot>
      <tbody>
        <?php
        $logtitle = "SELECT * FROM mapfeatures";
        $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
          echo ('<tr>');
          echo ('<td><a onclick="movemap'.$row['id'].'()">'.$row['coord'].'</a></td>'); ?>
          <script>
          function movemap<?php echo $row['id'] ?>() {
              map.setView(new L.LatLng(<?php echo $row['coord']; ?>), 4);
          }
          </script>
          <?php
          echo ('<td>'.$row['text'].'</td>');
          echo ('</tr>');
         }
          ?>

 </tbody>
 </table>
 <script>
 $(document).ready(function() {
 // Setup - add a text input to each footer cell
 $('#faction tfoot th').each( function () {
   var title = $(this).text();
   $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
 } );

 // DataTable
 var table = $('#faction').DataTable();

 // Apply the search
 table.columns().every( function () {
   var that = this;

   $( 'input', this.footer() ).on( 'keyup change', function () {
       if ( that.search() !== this.value ) {
           that
               .search( this.value )
               .draw();
       }
   } );
 } );
 } );
 </script>
 </div>
</div>
</div>
<script>
<?php
if ($id == 'notset') {
 ?>
map.setView(new L.LatLng(-219.375, 0.369713));
<?php }
else { ?>
  map.setView(new L.LatLng(<?php echo $id; ?>), 4);

<?php } ?>
</script>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
