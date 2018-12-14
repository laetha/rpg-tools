<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);
   $parsepath = $_SERVER['DOCUMENT_ROOT'];
   $parsepath .= "/plugins/Parsedown.php";
   include_once($parsepath);

   //Header
   $pgtitle = 'Spells - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>
   <?php  $Parsedown = new Parsedown(); ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
     <?php
     $id = "index";
     $disallowed_paths = array('header', 'footer');
     if (!empty($_GET['id'])) {
       $tmp_action = basename($_GET['id']);
       if (!in_array($tmp_action, $disallowed_paths) /*&& file_exists("world/{$tmp_action}.php")*/)
             $id = $tmp_action;

   $stripid = str_replace("'", "", $id);
   $stripid = stripslashes($stripid);
   $id = addslashes($id);
   $worldtitle = "SELECT * FROM `characters` WHERE `title` LIKE '$id'";
   $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
     if ($row['user'] !== $loguser && $loguser !== 'tarfuin'){
       header("Location: /tools/users/login.php");
       die();
     }
     $allspells = $row['spells'];
     $spellsarray = explode(',', $allspells);
     $spellsarray = join("','",$spellsarray);
     $title = $row['title'];
     $charID = $row['id'];
     $fullclass = $row['class1'];
     $fullmulticlass = $row['class2'];
     $dexmod = floor((($row['dex']-10)/2));
     $coreclass = substr($fullclass, 0, strpos($fullclass, "(") -1);
     $coremulticlass = substr($fullmulticlass, 0, strpos($fullmulticlass, "(") -1);
     $subclasstemp = substr($fullclass, strpos($fullclass, "(") +1);
     $multisubclasstemp = substr($fullmulticlass, strpos($fullmulticlass, "(") +1);
     $subclass = trim($subclasstemp, ')');
     $multisubclass = trim($multisubclasstemp, ')');
     $coreclassbare = ucwords($coreclass);
     $coremultibare = ucwords($coremulticlass);
     $coremulticlassbare = ucwords($coremulticlass);
     $background = $row['background'];
     $race = $row['race'];
     $bgbare = ucwords($row['background']);
     $coreclass = $coreclass.' core';
     $checkprofs = $row['proficiencies'];
     $checksaves = $row['saves'];
     $checkexperts = $row['expertise'];
     $allattacks = $row['attacks'];
     $allfeats = $row['feats'];
     $customattacks = $row['customattacks'];
     $charNotes = $row['notes'];
     $charItems = $row['items'];
     $level = $row['level'];
     $multiclasslevel = (int)$row['class2lvl'];
     $mainclasslevel = (int)$level - $multiclasslevel;

     $strmod = floor((($row['str']-10)/2));
     $dexmod = floor((($row['dex']-10)/2));
     $conmod = floor((($row['con']-10)/2));
     $intelmod = floor((($row['intel']-10)/2));
     $wismod = floor((($row['wis']-10)/2));
     $chamod = floor((($row['cha']-10)/2));
     $level = $row['level'];
     $multiclasslevel = (int)$row['class2lvl'];
     $mainclasslevel = (int)$level - $multiclasslevel;


     if ($row['level'] >= 1 && $row['level'] <= 4) {
       $profbonus = 2;
     }
     if ($row['level'] >= 5 && $row['level'] <= 8) {
       $profbonus = 3;
     }
     if ($row['level'] >= 9 && $row['level'] <= 12) {
       $profbonus = 4;
     }
     if ($row['level'] >= 13 && $row['level'] <= 16) {
       $profbonus = 5;
     }
     if ($row['level'] >= 17 && $row['level'] <= 20) {
       $profbonus = 6;
     }




     $basespelldc = 8 + (int)$profbonus;
     if ($coreclassbare == 'Paladin' || $coreclassbare == 'Sorcerer' || $coreclassbare == 'Warlock' || $coreclassbare == 'Bard'){
       $spelldc = $basespelldc + $chamod;
       $spellattack = $chamod + (int)$profbonus;
     }
     else if ($coreclassbare == 'Wizard' || $coreclassbare == 'Mystic' || $coreclassbare == 'Artificer' || $subclass == 'Eldritch Knight' || $subclass == 'Arcane Trickster'){
       $spelldc = $basespelldc + $intelmod;
       $spellattack = $intelmod + (int)$profbonus;
     }
     else if ($coreclassbare == 'Cleric' || $coreclassbare == 'Druid' || $coreclassbare == 'Monk' || $coreclassbare == 'Ranger' || $coreclassbare == 'Revised Ranger'){
       $spelldc = $basespelldc + $wismod;
       $spellattack = $wismod + (int)$profbonus;
     }
     else {
       $spelldc = 'N/A';
       $spellattack = 'N/A';
     }
     if ($coremultibare == 'Paladin' || $coremultibare == 'Sorcerer' || $coremultibare == 'Warlock' || $coremultibare == 'Bard'){
       $spelldc2 = $basespelldc + $chamod;
       $spellattack2 = $chamod + (int)$profbonus;
     }
     else if ($coremultibare == 'Wizard' || $coremultibare == 'Mystic' || $coremultibare == 'Artificer' || $multisubclass == 'Eldritch Knight' || $multisubclass == 'Arcane Trickster'){
       $spelldc2 = $basespelldc + $intelmod;
       $spellattack2 = $intelmod + (int)$profbonus;
     }
     else if ($coremultibare == 'Cleric' || $coremultibare == 'Druid' || $coremultibare == 'Monk' || $coremultibare == 'Ranger' || $coremultibare == 'Revised Ranger'){
       $spelldc2 = $basespelldc + $wismod;
       $spellattack2 = $wismod + (int)$profbonus;
     }
     else {
       $spelldc2 = 'N/A';
       $spellattack2 = 'N/A';
     }
       ?>
     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle"><?php echo ucwords($row['title']); ?>'s' Spells</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body" style="padding: 0px;">
       <table class="col-centered" style="width: 25%;">
         <tr>
           <td><div class="col-centered spellinfo" id="spelldc"><?php echo $spelldc; ?></div></td>
           <td><div class="col-centered spellinfo" id="spellattack">+<?php echo $spellattack; ?></div></td>
         </tr>
         <tr>
         <td><div class="charDeet">Spell DC</div></td>
         <td><div class="charDeet">Spell Attack</div></td>
       </tr>
       <table style="width:100%;">
         <tr class="col-centered">
           <td class="slotcell" style="border-left: 1px solid white;">1st</td>
           <td class="slotcell">2nd</td>
           <td class="slotcell">3rd</td>
           <td class="slotcell">4th</td>
           <td class="slotcell">5th</td>
           <td class="slotcell">6th</td>
           <td class="slotcell">7th</td>
           <td class="slotcell">8th</td>
           <td class="slotcell">9th</td>
         </tr>
         <tr class="bigt col-centered">
           <td class="slotcell" style="border-left: 1px solid white;">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
           <td class="slotcell">OOOO</td>
         </tr>
       </table>
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                   <th scope="col">lvl</th>
                   <th scope="col">Casting Time</th>
                   <th scope="col">Duration</th>
                   <th scope="col">Range</th>
                   <th scope="col">Attack/Save</th>
                   <th scope="col" class="none">Description</th>
               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Name</th>
                 <th scope="col">lvl</th>
                 <th scope="col">Casting Time</th>
                 <th scope="col">Duration</th>
                 <th scope="col">Range</th>
                 <th scope="col">Attack/Save</th>
                 <th scope="col">Description</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $a = 1;
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'spell' AND title NOT LIKE '%*' AND title NOT LIKE '%(Ritual Only)' AND title NOT LIKE '%invocation%' AND title IN ('$spellsarray')";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
               echo ('<tr style="padding:50px;"><td class="bigt">');
               $entry = $row['title'];
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               echo ('<td>'.$row['spellLevel'].'</td>');
               echo ('<td>'.$row['spellTime'].'</td>');
               echo ('<td>'.$row['spellDuration'].'</td>');
               echo ('<td>'.$row['spellRange'].'</td>');
               if (strpos($row['text'], 'Strength saving throw') !== false){
                 echo ('<td>STR Save</td>');

               }
               else if (strpos($row['text'], 'Dexterity saving throw') !== false){
                 echo ('<td>DEX Save</td>');

               }
               else if (strpos($row['text'], 'Constitution saving throw') !== false){
                 echo ('<td>CON Save</td>');

               }
               else if (strpos($row['text'], 'Intelligence saving throw') !== false){
                 echo ('<td>INT Save</td>');

               }
               else if (strpos($row['text'], 'Wisdom saving throw') !== false){
                 echo ('<td>WIS Save</td>');

               }
               else if (strpos($row['text'], 'Charisma saving throw') !== false){
                 echo ('<td>CHA Save</td>');

               }
               else if (strpos($row['text'], 'spell attack') !== false){
                 echo ('<td>Spell Attack</td>');

               }
               else {
                 echo ('<td>-</td>');
               }
               $spelldeet = substr($row['text'], 0, strpos($row['text'], "Source:"));
               $spelldeet = rtrim($spelldeet);
               echo ('<td class="smallt" id="spell'.$a.'">'.nl2br($spelldeet).'</td>');
               echo ('</tr>');
               ?>
               <?php
             }
               ?>

</tbody>
</table>

<?php
}
}
 ?>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell


    // DataTable
    var table = $('#allspells').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.childRowImmediate,
                type: ''
            }
        },
         "order": [[ 1, "asc" ]]

    } );


} );
</script>
</div>
</div>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
