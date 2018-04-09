<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Campaign Log - ';
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

<div class="mainbox col-md-10 col-xs-12 col-centered">

  <div class="pagetitle col-xs-12">Campaign Log</div>
    <!-- Add to Log -->
    <p><button class="btn btn-info" id="addbutton">Add to Log</button></p>
    <div id="adddiv" style="display:none;">
      <div class="row">
      <form method="post" action="logprocess.php" id="logadd">
        <div class="col-md-1" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logdate" id="logdate" placeholder="day #"></div>
        <div class="col-md-2" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logcoord" id="logcoord" placeholder="coordinates"></div>
        <div class="col-md-6" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logentry" id="logentry" placeholder="Log Entry...."></div>
        <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="logmap" value="1">Map?
          <button type="button" class="btn btn-primary" onclick="myGen()">Gen</button></div>
        <div class="col-md-1"><input class="btn btn-primary" type="submit" value="Submit"></div>
    </form>
  </div>
<!-- MAP -->

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
crs: L.CRS.Simple
});

// dimensions of the image
var w = 5040,
h = 3308,
url = '/assets/images/Starting-Region.jpg';

// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom()-1);
var northEast = map.unproject([w, 0], map.getMaxZoom()-1);
var bounds = new L.LatLngBounds(southWest, northEast);
map.setView(new L.LatLng(-220.925003, 103.017123), 3);


// add the image overlay,
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);

// tell leaflet that the map is exactly as big as the image
map.setMaxBounds(bounds);

var popup = L.popup();

function onMapClick(e) {
popup
.setLatLng(e.latlng)
.setContent("You clicked the map at " + e.latlng.toString())
.openOn(map);
var newCoord = e.latlng.toString();
newCoord = newCoord.replace(/LatLng/g, "");
  newCoord = newCoord.replace(/[{()}]/g, '');
document.getElementById("logcoord").value = newCoord;
//.openOn(map);
}

map.on('click', onMapClick);

</script>
<?php
$worldtitle = "SELECT * FROM campaignlog WHERE active = 1";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
$mrk = 1;
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
?>
<script>
var myIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/iconic/open-iconic/master/png/map-marker-8x.png',
    iconSize: [32, 32],
    iconAnchor: [16,32]
});
var marker<?php echo $mrk; ?> = L.marker([<?php echo $row['coord']; ?>, {icon: myIcon}]).addTo(map);

marker<?php echo $mrk; ?>.bindPopup("<?php echo $row['entry']; ?>");
</script>
<?php
$mrk = $mrk + 1;

}
?>
<!-- <script>
var marker = L.marker([-233.356251, 87.868822]).addTo(map);
marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
</script> -->


<!-- END MAP -->

  </div>
  <script>
  $(document).ready(function addLog(){
      $("#addbutton").click(function addLog(){
          $("#adddiv").slideToggle("slow");
      });
  });
  </script>
  <!--<div class="padding"></div>-->
  <div class="table-responsive sidebartext">
  <table id="campaignlog" class="table table-condensed table-striped table-responsive dt-responsive sidebartext" cellspacing="0" width="100%">
      <thead class="thead-dark">
          <tr>
              <th scope="col">Day</th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col">Coord</th>
              <th scope="col">Entry</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
            <th scope="col">Day</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Coord</th>
            <th scope="col">Entry</th>
          </tr>
      </tfoot>
      <tbody id="thelog">
        <?php
        $logtitle = "SELECT * FROM campaignlog WHERE active=1 ORDER BY date DESC ";
        $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
          echo ('<tr><td>');
          echo ($row['date'].'</td>');
          echo ('<td><button type="button" class="logbtn btn btn-danger btn-sq-xs" name="deleteItem" id="delete-log" data-toggle="modal" data-target="#deleteModal'.$row['id'].'"><span class="glyphicon glyphicon-remove"></span></button></td>');
          echo ('<td><button type="button" class="logbtn btn btn-info btn-sq-xs" id="edit-log" data-toggle="modal" data-target="#editModal'.$row['id'].'"><span class="glyphicon glyphicon-edit"></span></button></td>');
          echo ('<td><a href="#image-map1" data-zoom="3" data-position="'.$row['coord'].'">'.$row['coord'].'</a></td>');

          echo ('<td>'.$row['entry'].'</td>');
          echo ('</tr>');
?>
          <!-- EDIT Modal -->
          <div class="modal fade" id="editModal<?php echo $row['id']; ?>" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content modalstyle bodytext">

                <div class="modal-body">
                  <form method="post" action="logedit.php?editid=<?php echo $row['id']; ?>" id="edit<?php echo $row['id']; ?>">
                    <input form="edit<?php echo $row['id']; ?>" type="text" class="logeditdate" name="editdate<?php echo $row['id']; ?>" id="date<?php echo $row['id']; ?>" placeholder="Date..." value="" />
                    <input form="edit<?php echo $row['id']; ?>" class="logeditcoord" type="text" name="editcoord<?php echo $row['id']; ?>" id="coordentry<?php echo $row['id']; ?>" placeholder="Coord..." value="" />
                    <input form="edit<?php echo $row['id']; ?>" class="logeditentry" type="text" name="editentry<?php echo $row['id']; ?>" id="editentry<?php echo $row['id']; ?>" placeholder="Entry..." value="" />
                    <button form="edit<?php echo $row['id']; ?>"class="logbtn btn btn-info btn-sq-xs" id="editconfirm" type="submit" value="Save" />
                      <span class="glyphicon glyphicon-ok"></span></button>
                  </form>
                  <p></p><p>Old Text:</p>
                  <p class="sidebartext">
                  <?php echo $row['entry']; ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

          <!-- DELETE Modal -->
          <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content modalstyle bodytext">

                <div class="modal-body">
                  <p>Are you sure you want to delete <em>"<?php echo $row['entry']; ?>"</em>?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
                      <a href="logdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger delform">Delete</button></a>
                </div>
              </div>

            </div>
          </div>

<?php


        }
          ?>

  </tbody>
  </table>
  <script>
  $(document).ready(function() {
  // Setup - add a text input to each footer cell
  // DataTable
  var table = $('#campaignlog').DataTable(
    {
      "columnDefs": [
    { "width": "50px", "targets": 0 },
    { "width": "15px", "targets": 1 },
    { "width": "15px", "targets": 2 },
    { "width": "50px", "targets": 3 }


  ]
    }
  );


  } );
  </script>
  </div>
  <?php
    $sqlworld = "SELECT * FROM world";
    $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
    while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
    $temp = $linkrow['title'];
    ?>
    <script>
    var foundlink = "<?php echo $temp ?>";
    function replace (querytext){
      var bodytext = document.getElementById("thelog").innerHTML;
      var url = "<a href=\"/tools/world/world.php?id=" + querytext + "\">" + querytext + "</a>";
      var regex = new RegExp(querytext, 'ig');
      newtext = bodytext.replace(regex, url);
      document.getElementById("thelog").innerHTML = newtext;
    }
    replace(foundlink);
        </script>
        <?php
      } ?>

      <style>
      #image-map1 {
        width: 100%;
        height: 600px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
      }
      </style>

      <div id="image-map1"></div>
<script>
// Using leaflet.js to pan and zoom a big image.
// See also: http://kempe.net/blog/2014/06/14/leaflet-pan-zoom-image.html

// create the slippy map
var map = L.map('image-map1', {
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

<div class="sidebartext">
  <a href="/tools/world/generator.php" target=""><button class="btn btn-primary">Generate More Encounters</button></a>
  <a href="/tools/world/gendelete.php" target=""><button class="btn btn-danger">Clear Current Table</button></a>
  <table id="generator" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">Type</th>
                  <th scope="col">Text</th>
                  <th scope="col">Text2</th>
              </tr>

          </thead>
          <tfoot>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Text</th>
                <th scope="col">Text2</th>
            </tr>
          </tfoot>
          <tbody>
<?php
$sqlworld = "SELECT * FROM savedencounters LIMIT 20";
$worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
  echo ('<tr><td>'.$row['type'].'</td>');
  echo ('<td>'.$row['text1'].'</td>');
  echo ('<td>'.$row['text2'].'</td></tr>');
}

?>
</tbody>
</table>
<script>
$(document).ready(function() {
   // Setup - add a text input to each footer cell
   $('#generator tfoot th').each( function () {
       var title = $(this).text();
       $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
   } );

   // DataTable
   var table = $('#generator').DataTable(
         "bSort": false
   );

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


</div>



</div>


<!-- Map Gen -->

<?php
$rand1 = rand(0,99);
$type = '';
$text1 = '';
$text2 = '';
$foundOverall = 0;
$found2 = 0;

?>
 <?php
 $typeedit = "SELECT * FROM `encounters` ORDER BY num";
 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
 while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
   if ($rand1 <= $row['num'] && $foundOverall == 0 && $row['type'] == 'overallpre') {
      $foundOverall = 1;
      $type = $row['text'];
      $rand2 = rand(0,99);
   }


}

 $typeedit = "SELECT * FROM `encounters` ORDER BY num";
 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
 while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
   if ($type == 'lair' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'lair') {
       $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 0 && $rand2 <= 64) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'commonlair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

    else if ($rand2 >= 65 && $rand2 <= 94) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'uncommonlair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 95 && $rand2 <= 99) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'legendarylair') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

   }

   if ($type == 'Remote Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'remotestructure') {
     $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 0 && $rand2 <= 9) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'singlehouse') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 50 && $rand2 <= 54) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'tower') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 63 && $rand2 <= 65) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'woodenpole') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 79 && $rand2 <= 82) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'workingmine') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

   }


   if ($type == 'Ruined Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'ruinedstructure') {
     $found2 = 1;
     $text1 = $row['text'];
   }

   if ($type == 'Natural Structure' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'naturalstructure') {
     $found2 = 1;
     $text1 = $row['text'];
   }

   if ($type == 'Remarkable Event' && $rand2 <= $row['num'] && $found2 == 0 && $row['type'] == 'remarkableevent') {
     $found2 = 1;
     $text1 = $row['text'];

     if ($rand2 >= 15 && $rand2 <= 19) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'glowingpillar') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }

     else if ($rand2 >= 20 && $rand2 <= 24) {
       $rand3 = rand(0,99);
       $found3 = 0;
       $typeedit = "SELECT * FROM `encounters` ORDER BY num";
       $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
       while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
         if ($rand3 <= $row['num'] && $found3 == 0 && $row['type'] == 'blacktree') {
           $found3 = 1;
           $text2 = $row['text'];
         }

       }

     }


   }
 }

$mapgen = $type.' :: '. $text1.' :: '.$text2;

?>
<script>
function myGen() {
  document.getElementById("logentry").value = '<?php echo $mapgen; ?>';
}
</script>
<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
