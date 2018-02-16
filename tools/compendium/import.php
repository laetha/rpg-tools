<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.html";
include_once($headpath);
?>
<!-- Import Form -->
  <div class="tocbox col-md-12">
    <div class ="toc body bodytext">
  <h1 class="pagetitle">Add to Compendium</h1>
      <form method="post" action="process.php" id="import">
      <p class="text">Name         <input type="text" name="name" id="name" placeholder="Name..."></p>

<!-- 'Type' Dropbox -->
<div id="npc-type">
      <p class="text">Type
          <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
          <option value="" disabled selected>Entry Type</option>
          <option value="settlement">Settlement</option>
          <option value="faction">Faction</option>
          <option value="npc">NPC</option>
          <option value="deity">Deity</option>
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
   //alert(output.innerText);
   document.getElementById("npc-form").style.display = "none";
   document.getElementById("faction-form").style.display = "none";
   document.getElementById("settlement-form").style.display = "none";
   document.getElementById("deity-form").style.display = "none";

   if (selectValue == "Faction") {
     document.getElementById("faction-form").style.display = "block";
  }
  if (selectValue == "Deity") {
    document.getElementById("deity-form").style.display = "block";
 }
  if (selectValue == "Settlement") {
   document.getElementById("settlement-form").style.display = "block";
}
  if (selectValue == "NPC") {
    document.getElementById("npc-form").style.display = "block";
}
 }
</script>

<!--NPC FORM -->
<div id="npc-form">
<!-- 'NPC Diety' Dropbox -->
<div class="typebox" id="npc-deity">
      <p class="text">Faith
        <select form="import" name="npc-deity" id="type">
          <option value="" selected>None...</option>
          <?php
          $faithdrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'deity' ORDER BY `compendium`.`title` ASC";
          $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
          while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
            $deity = $deityrow['title'];
            echo "<option value=\"$deity\">$deity</option>";
          }
          ?>
        </select>
      </p>
</div>
<!-- 'NPC location' Dropbox -->
<div class="typebox" id="npc-location">
      <p class="text">Location
        <select form="import" name="npc-location" id="type">
          <option value="" selected>None...</option>
          <?php
          $locationdrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'settlement' ORDER BY `compendium`.`title` ASC";
          $locationdata = mysqli_query($dbcon, $locationdrop) or die('error getting data');
          while($locationrow =  mysqli_fetch_array($locationdata, MYSQLI_ASSOC)) {
            $location = $locationrow['title'];
            echo "<option value=\"$location\">$location</option>";
          }
          ?>
        </select>
      </p>
    </div>
<!-- 'NPC faction' Dropbox -->
<div class="typebox" id="npc-faction">
      <p class="text">Faction
        <select form="import" name="npc-faction" id="type">
          <option value="" selected>None...</option>
          <?php
          $factiondrop = "SELECT title FROM `compendium` WHERE `type` LIKE 'faction' ORDER BY `compendium`.`title` ASC";
          $factiondata = mysqli_query($dbcon, $factiondrop) or die('error getting data');
          while($factionrow =  mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
            $faction = $factionrow['title'];
            echo "<option value=\"$faction\">$faction</option>";
          }
          ?>
        </select>
      </p>
    </div>
    <p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body" placeholder="Type the body of your content here..."></textarea></p>

</div>

<div id="faction-form">
<!-- 'NPC Diety' Dropbox -->
<p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body" placeholder="Type the body of your content here..."></textarea></p>
</div>
<div id="deity-form">
<!-- 'NPC Diety' Dropbox -->
<p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body" placeholder="Type the body of your content here..."></textarea></p>

</div>
<div id="settlement-form">
<!-- 'NPC Diety' Dropbox -->
<p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body" placeholder="Type the body of your content here..."></textarea></p>

</div>
<input type="submit" value="Submit">
</form>
</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
