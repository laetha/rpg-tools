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
       ?>
     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle"><?php echo ucwords($row['title']); ?>'s' Spells</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
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
               echo ('<tr><td>');
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
               echo ('<td id="spell'.$a.'">'.nl2br($spelldeet).'</td>');
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
