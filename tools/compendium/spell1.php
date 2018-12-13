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

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">My Spells</div>
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
                 <th scope="col">Description</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $a = 1;
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'spell' AND title NOT LIKE '%*' AND title NOT LIKE '%(Ritual Only)' AND title NOT LIKE '%invocation%'";
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
        }

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
