<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

?>
<!-- Import Form -->
<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">Add to World</h1>
<div class="col-md-10 col-centered">
  <div class="col-sm-6 typebox col-centered" id="name">
      <form method="post" action="process.php" id="import" enctype="multipart/form-data">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->
<div class="hide"><input type="text" name="worlduser" id="worlduser" value="<?php echo $loguser; ?>"></div>
<div class="col-sm-6 typebox col-centered" id="npc-type">
      <p class="text">Type

        <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="">None...</option>
          <?php
          $typeedit = "SELECT type FROM `world`";
          $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
          while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
            $type = $typerow['type'];
            $typeUpper = ucwords($type);
            echo "<option value=\"$type\">$type</option>";
          }

         ?>
        </select>
        <script type="text/javascript">
        $('#type').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
      </div>

      <div class="col-sm-6 typebox col-centered" id="npc-type">
            <p class="text">Code

              <select form="import" required="yes" name="code" id="code" onchange="codeForm(this);">
                <option value="">None...</option>
                <?php
                $typeedit = "SELECT code FROM `world`";
                $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
                while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
                  $code = $typerow['code'];
                  $codeUpper = ucwords($code);
                  echo "<option value=\"$code\">$code</option>";
                }

               ?>
              </select>
              <script type="text/javascript">
              $('#code').selectize({
          create: true,
          sortField: 'text'
      });
              </script>
            </p>
            </div>


      <!-- Different form for Different types -->
<!-- Form Alteration Script -->
<script type="text/javascript">
 function typeForm(selectObj) {

   var selectIndex=selectObj.selectedIndex;
   var selectValue=selectObj.options[selectIndex].text;
   var output=document.getElementById("output");
   document.getElementById("npc-form").style.display = "none";
   document.getElementById("est-form").style.display = "none";
   document.getElementById("npc-form").style.display = "none";

  if (selectValue == "npc") {
    document.getElementById("quest-form").style.display = "none";
    document.getElementById("npc-form").style.display = "block";
    document.getElementById("est-form").style.display = "none";
}
  else if (selectValue == "establishment") {
    document.getElementById("quest-form").style.display = "none";
  document.getElementById("est-form").style.display = "block";
  document.getElementById("npc-form").style.display = "none";
}
else if (selectValue == "public quest") {
document.getElementById("quest-form").style.display = "block";
document.getElementById("est-form").style.display = "none";
document.getElementById("npc-form").style.display = "none";
}
  else {
    document.getElementById("quest-form").style.display = "none";
    document.getElementById("npc-form").style.display = "none";
    document.getElementById("est-form").style.display = "none";
  }

 }
</script>

<!--NPC FORM -->
<div id="npc-form" style="display:none;">
<!-- 'NPC Diety' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-race">
      <p class="text">Race
        <select form="import" name="npc-race" id="race-form">
          <option value="" selected>None...</option>
          <?php
          $faithdrop = "SELECT npc_race FROM `world` WHERE `type` LIKE 'npc'";
          $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
          while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
            $deity = $deityrow['npc_race'];
            echo "<option value=\"$deity\">$deity</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#race-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
</div>

<div class="col-sm-6 typebox col-centered" id="npc-deity">
      <p class="text">Faith
        <select form="import" name="npc-deity" id="deity-form">
          <option value="" selected>None...</option>
          <?php
          $faithdrop = "SELECT title FROM `world` WHERE `type` LIKE 'deity' ORDER BY `world`.`title` ASC";
          $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
          while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
            $deity = $deityrow['title'];
            echo "<option value=\"$deity\">$deity</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#deity-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
</div>
<!-- 'NPC location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-location">
      <p class="text">Location
        <select form="import" name="npc-location" id="location-form">
          <option value="" selected>None...</option>
          <?php
          $locationdrop = "SELECT title FROM `world` WHERE `type` LIKE 'settlement' ORDER BY `world`.`title` ASC";
          $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
          while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
            $location = $locationrow['title'];
            echo "<option value=\"$location\">$location</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#location-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
<!-- 'NPC faction' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="npc-faction">
      <p class="text">Faction
        <select form="import" name="npc-faction" id="faction-form">
          <option value="" selected>None...</option>
          <?php
          $factiondrop = "SELECT title FROM `world` WHERE `type` LIKE 'faction' ORDER BY `world`.`title` ASC";
          $factiondata = mysqli_query($dbcon, $factiondrop) or die('error getting data');
          while($factionrow =  mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
            $faction = $factionrow['title'];
            echo "<option value=\"$faction\">$faction</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#faction-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>

    <!-- 'NPC establishment' Dropbox -->
    <div class="col-sm-6 typebox col-centered" id="npc-est">
          <p class="text">Establishment
            <select form="import" name="npc-establishment" id="establishment-form">
              <option value="" selected>None...</option>
              <?php
              $factiondrop = "SELECT title FROM `world` WHERE `type` LIKE 'establishment' ORDER BY `world`.`title` ASC";
              $factiondata = mysqli_query($dbcon, $factiondrop) or die('error getting data');
              while($factionrow =  mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
                $faction = $factionrow['title'];
                echo "<option value=\"$faction\">$faction</option>";
              }
              ?>
            </select>
            <script type="text/javascript">
            $('#establishment-form').selectize({
        create: true,
        sortField: 'text'
    });
            </script>
          </p>
        </div>

        <!-- 'NPC title' Dropbox -->
        <div class="col-sm-6 typebox col-centered" id="npc-title">
              <div class="text">Title</div>
                <div class="text"><input form="import" class="textbox" type="text" name="npc-title" id="title-form" placeholder="Title..."></div>
            </div>


</div>

<div id="est-form" style="display:none;">

<!-- 'establishment location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="est-location">
      <p class="text">Location
        <select form="import" name="est-location" id="est-location-form">
          <option value="" selected>None...</option>
          <?php
          $locationdrop = "SELECT title FROM `world` WHERE `type` LIKE 'settlement' ORDER BY `world`.`title` ASC";
          $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
          while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
            $location = $locationrow['title'];
            echo "<option value=\"$location\">$location</option>";
          }
          ?>
        </select>
        <script type="text/javascript">
        $('#est-location-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
    <!-- 'establishment type' Dropbox -->
    <div class="col-sm-6 typebox col-centered" id="est-location">
          <p class="text">Type
            <select form="import" name="est-type" id="est-type-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT est_type FROM `world` WHERE `type` LIKE 'establishment' ORDER BY `world`.`est_type` ASC";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['est_type'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
            <script type="text/javascript">
            $('#est-type-form').selectize({
        create: true,
        sortField: 'text'
    });
            </script>
          </p>
        </div>

</div>

<div id="quest-form" style="display:none;">

<!-- 'establishment location' Dropbox -->
<div class="col-sm-6 typebox col-centered" id="equest-status">
      <p class="text">Quest Status
        <select form="import" name="quest-status" id="quest-status-form">
          <option value="" selected>None...</option>
          <option value="available">Available</option>
          <option value="private">Private</option>
          <option value="complete">Complete</option>
        </select>
        <script type="text/javascript">
        $('#quest-status-form').selectize({
    create: true,
    sortField: 'text'
});
        </script>
      </p>
    </div>
    <!-- 'establishment type' Dropbox -->
    <div class="col-sm-6 typebox col-centered" id="quest-faction">
          <p class="text">Faction
            <select form="import" name="quest-faction" id="quest-faction-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT title FROM `world` WHERE `type` LIKE 'faction'";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['title'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
            <script type="text/javascript">
            $('#quest-faction-form').selectize({
        create: true,
        sortField: 'text'
    });
            </script>
          </p>
        </div>
        <div class="text col-centered col-md-6"><textarea type="text" name="quest-reward" id="quest-reward" placeholder="Reward...." style="height:100px;"></textarea></div>

</div>


    <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body" placeholder="Type the body of your content here..."></textarea></div>
    <input class="col-centered" type="file" name="fileToUpload1" id="fileToUpload1">

    <div id="map" style="display:none;">

    <div class="text">Coord</div><input class="textbox" style="text-align:center;" type="text" name="coord" id="coord" value="<?php echo $editrow['coord']; ?>">

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
               document.getElementById("coord").value = newCoord;
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
                     $("#locbutton").click(function addLog(){
                         $("#map").slideToggle("slow");
                     });
                 });
                 </script>
    </div>

<div class="col-centered">
<input form="import" class="btn btn-primary col-centered" type="submit" value="Submit">
</div>
</form>

</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
