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
<select form="compendium" name="raceSize" id="raceSize-form">
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
<div id="subclass-form" style="display:none;">
Class
<select form="compendium" name="subclassClass" id="subclassClass-form">
              <option value="" selected>None...</option>
              <?php
              $locationdrop = "SELECT DISTINCT class FROM `subclasses`";
              $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
              while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
                $location = $locationrow['class'];
                echo "<option value=\"$location\">$location</option>";
              }
              ?>
            </select>

<div class="text col-centered col-md-6"><textarea type="text" name="subclassSource" id="subclassSource" placeholder="subclassSource" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill1name" id="lvlskill1name" placeholder="lvlskill1name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill1text" id="lvlskill1text" placeholder="lvlskill1text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill2name" id="lvlskill2name" placeholder="lvlskill2name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill2text" id="lvlskill2text" placeholder="lvlskill2text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill3name" id="lvlskill3name" placeholder="lvlskill3name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill3text" id="lvlskill3text" placeholder="lvlskill3text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill4name" id="lvlskill4name" placeholder="lvlskill4name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill4text" id="lvlskill4text" placeholder="lvlskill4text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill5name" id="lvlskill5name" placeholder="lvlskill5name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill5text" id="lvlskill5text" placeholder="lvlskill5text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill6name" id="lvlskill6name" placeholder="lvlskill6name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill6text" id="lvlskill6text" placeholder="lvlskill6text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill7name" id="lvlskill7name" placeholder="lvlskill7name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill7text" id="lvlskill7text" placeholder="lvlskill7text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill8name" id="lvlskill8name" placeholder="lvlskill8name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill8text" id="lvlskill8text" placeholder="lvlskill8text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill9name" id="lvlskill9name" placeholder="lvlskill9name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill9text" id="lvlskill9text" placeholder="lvlskill9text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill10name" id="lvlskill10name" placeholder="lvlskill10name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill10text" id="lvlskill10text" placeholder="lvlskill10text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill11name" id="lvlskill11name" placeholder="lvlskill11name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill11text" id="lvlskill11text" placeholder="lvlskill11text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill12name" id="lvlskill12name" placeholder="lvlskill12name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill12text" id="lvlskill12text" placeholder="lvlskill12text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill13name" id="lvlskill13name" placeholder="lvlskill13name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill13text" id="lvlskill13text" placeholder="lvlskill13text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill14name" id="lvlskill14name" placeholder="lvlskill14name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill14text" id="lvlskill14text" placeholder="lvlskill14text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill15name" id="lvlskill15name" placeholder="lvlskill15name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill15text" id="lvlskill15text" placeholder="lvlskill15text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill16name" id="lvlskill16name" placeholder="lvlskill16name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill16text" id="lvlskill16text" placeholder="lvlskill16text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill17name" id="lvlskill17name" placeholder="lvlskill17name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill17text" id="lvlskill17text" placeholder="lvlskill17text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill18name" id="lvlskill18name" placeholder="lvlskill18name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill18text" id="lvlskill18text" placeholder="lvlskill18text" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill19name" id="lvlskill19name" placeholder="lvlskill19name" style="height:50px;"></textarea></div>
<div class="text col-centered col-md-6"><textarea type="text" name="lvlskill19text" id="lvlskill19text" placeholder="lvlskill19text" style="height:50px;"></textarea></div>


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