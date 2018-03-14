<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);

$id = "index";
$disallowed_paths = array('header', 'footer');
if (!empty($_GET['id'])) {
  $tmp_action = basename($_GET['id']);
  if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
        $id = $tmp_action;
        $id = addslashes($id);
        $worldedit = "SELECT * FROM `world` WHERE `title` LIKE '%{$id}%'";
        $editdata = mysqli_query($dbcon, $worldedit) or die('error getting data');
        while($editrow =  mysqli_fetch_array($editdata, MYSQLI_ASSOC)) {
          $editid = $editrow['id'];
if ($editrow['type'] == "npc"){
  ?><style type="text/css">#npc-form{
  display:block;
  }</style>  <?php
}
          else{
?>
<style type="text/css">#npc-form{
display:none;
}</style>
<?php
}
         ?>
         <div class="tocbox col-md-12">
           <div class ="body bodytext">
         <h1 class="pagetitle">Edit Entry</h1>
       <div class="col-md-10 col-centered">
         <div class="col-sm-6 typebox col-centered" id="name">
             <form method="post" action="editprocess.php" id="import">
             <div class="text">Name</div><input class="textbox" type="text" name="name" id="name" value="<?php echo $editrow['title']; ?>">
       </div>
       <!-- 'Type' Dropbox -->

       <div class="col-sm-6 typebox col-centered" id="npc-type">
             <p class="text">Type
                <select form="import" name="editid" id="editid" style="display:none;" required="yes">
                  <option value="<?php echo $editrow['id']; ?>" selected></option>
                  </select>
               <select form="import" required="yes" name="type" id="type" onchange="typeForm(this);">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['type']; ?>" selected><?php echo $editrow['type']; ?></option>
                 <?php
                 $typeedit = "SELECT type FROM `world`";
                 $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
                 while($typerow =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
                   $type = $typerow['type'];
                   echo "<option value=\"$type\">$type</option>";
                 }
                 ?>
               </select>
               <script type="text/javascript">
               $('#type').selectize({
           create: false,
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

       if (selectValue == "npc") {
         document.getElementById("npc-form").style.display = "block";
         document.getElementById("est-form").style.display = "none";

     }
     else if (selectValue == "establishment") {
       document.getElementById("est-form").style.display = "block";
       document.getElementById("npc-form").style.display = "none";
   }
     else {
       document.getElementById("npc-form").style.display = "none";
       document.getElementById("est-form").style.display = "none";

     }
        }
       </script>

       <!--NPC FORM -->
       <div id="npc-form">
       <!-- 'NPC Diety' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="npc-deity">
             <p class="text">Faith
               <select form="import" name="npc-deity" id="deity-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_deity']; ?>" selected><?php echo $editrow['npc_deity']; ?></option>
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
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_location']; ?>" selected><?php echo $editrow['npc_location']; ?></option>
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
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['npc_faction']; ?>" selected><?php echo $editrow['npc_faction']; ?></option>
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
           <div class="col-sm-6 typebox col-centered" id="npc-establishment">
                 <p class="text">Establishment
                   <select form="import" name="npc-establishment" id="npc-est-form">
                     <option value="">None...</option>
                     <option value="<?php echo $editrow['npc_est']; ?>" selected><?php echo $editrow['npc_est']; ?></option>
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
                   $('#npc-est-form').selectize({
               create: true,
               sortField: 'text'
           });
                   </script>
                 </p>
               </div>

       </div>

       <!--NPC FORM -->
       <div id="est-form">
       <!-- 'NPC Diety' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="est-location">
             <p class="text">Location
               <select form="import" name="est-location" id="est-location-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['est_location']; ?>" selected><?php echo $editrow['est_location']; ?></option>
                 <?php
                 $faithdrop = "SELECT title FROM `world` WHERE `type` LIKE 'settlement' ORDER BY `world`.`title` ASC";
                 $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
                 while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
                   $deity = $deityrow['title'];
                   echo "<option value=\"$deity\">$deity</option>";
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
       <!-- 'NPC location' Dropbox -->
       <div class="col-sm-6 typebox col-centered" id="est-type">
             <p class="text">Type
               <select form="import" name="est-type" id="est-type-form">
                 <option value="">None...</option>
                 <option value="<?php echo $editrow['est_type']; ?>" selected><?php echo $editrow['est_type']; ?></option>
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


           <div class="text col-centered col-md-12"><textarea type="text" name="body" id="body"><?php echo $editrow['body']; ?></textarea></div>

       <div class="col-centered">
       <input class="btn btn-primary col-centered inline" type="submit" value="Save">
       <a class="clean" href="world.php?id=<?php echo $id; ?>"><button class="btn btn-danger col-centered inline" type="button">Cancel</button></a>
       </div>
      </form>

     </div>
   </div>
  </div>
         <?php
       }
  ?>
  <!-- Import Form -->

<?php
  }
  ?>

<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
 ?>
