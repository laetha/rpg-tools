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
        <div class="col-md-7" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logentry" id="logentry" placeholder="Log Entry...."></div>
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
          echo ('<td>'.$row['coord'].'</td>');

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

</div>


<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
