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
<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">Add to World</h1>
<div class="col-md-10 col-centered">
  <div class="col-sm-6 typebox col-centered" id="name">
      <form method="post" action="process.php" id="import" enctype="multipart/form-data">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->

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

        <input class="col-centered" type="file" name="fileToUpload1" id="fileToUpload1">

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
