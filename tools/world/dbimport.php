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
      <form method="post" action="dbprocess.php" id="compendium" enctype="multipart/form-data">
      <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" placeholder="Name...">
</div>
<!-- 'Type' Dropbox -->
<div class="hide"><input type="text" name="worlduser" id="worlduser" value="<?php echo $loguser; ?>"></div>
<div class="col-sm-6 typebox col-centered" id="npc-type">
      <p class="text">Type

        <select form="compendium" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="">None...</option>
          <option value="background">Background</option>
          <option value="feat">Feat</option>
          <option value="item">Item</option>
          <option value="monster">Monster</option>
          <option value="race">Race</option>
          <option value="spell">Spell</option>
          <option value="class">Class</option>
          <option value="subclass">Subclass</option>
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
   var selectedForm = "#" + selectValue + "-form";
   selectedForm = (selectedForm).toLowerCase();
   
   $("#background-form").hide();
   $("#feat-form").hide();
   $("#item-form").hide();
   $("#monster-form").hide();
   $("#race-form").hide();
   $("#spell-form").hide();
   $("#class-form").hide();
   $("#subclass-form").hide();
   
   $(selectedForm).show();

 }
</script>
<div id="background-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="backgroundProficiency" id="backgroundProficiency" placeholder="backgroundProficiency" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="backgroundTraits" id="backgroundTraits" placeholder="backgroundTraits" style="height:50px;"></textarea></div>

</div>
<div id="feat-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="featText" id="featText" placeholder="featText" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="featPrerequisite" id="featPrerequisite" placeholder="featPrerequisite" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="featModifier" id="featModifier" placeholder="featModifier" style="height:50px;"></textarea></div>

</div>
<div id="item-form" style="display:none;">
<div class="text col-centered col-md-6"><textarea type="text" name="itemText" id="itemText" placeholder="itemText" style="height:50px;"></textarea></div>
<select form="compendium" name="itemType" id="itemType-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT itemType FROM `compendium` WHERE `type` LIKE 'item'";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['itemType'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="itemWeight" id="itemWeight" placeholder="itemWeight" style="height:50px;"></textarea></div>
<select form="compendium" name="itemStock" id="itemStock-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT itemStock FROM `compendium` WHERE `type` LIKE 'item' AND itemStock NOT LIKE ''";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['itemStock'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="itemDetail" id="itemDetail" placeholder="itemDetail" style="height:50px;"></textarea></div>
<input type="checkbox" name="itemMagic" value="1">Magic?<br>
<div class="text col-centered col-md-6"><textarea type="text" name="itemValue" id="itemValue" placeholder="itemValue" style="height:50px;"></textarea></div>

</div>
<div id="monster-form" style="display:none;">
monster
</div>
<div id="race-form" style="display:none;">
<select form="compendium" name="itemStock" id="itemStock-form">
              <option value="T">Tiny</option>
              <option value="S">Small</option>
              <option value="M" selected>Medium</option>
              <option value="L">Large</option>
              <option value="H">Huge</option>
              <option value="G">Gargantuan</option>
            </select>
<div class="text col-centered col-md-6"><textarea type="text" name="raceSpeed" id="raceSpeed" placeholder="raceSpeed" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceAbility" id="raceAbility" placeholder="raceAbility" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceSpellAbility" id="raceSpellAbility" placeholder="raceSpellAbility" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceProficiency" id="raceProficiency" placeholder="raceProficiency" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="raceTraits" id="raceTraits" placeholder="raceTraits" style="height:50px;"></textarea></div>
</div>
<div id="spell-form" style="display:none;">
spell
</div>
<div id="class-form" style="display:none;">
class
</div>
<div id="subclass-form" style="display:none;">
subclass
</div>

<!--    <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body" placeholder="Type the body of your content here..."></textarea></div> -->
   

<div class="col-centered">
<input form="compendium" class="btn btn-primary col-centered" type="submit" value="Submit">
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
