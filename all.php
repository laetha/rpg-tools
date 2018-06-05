<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Everything - ';
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
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Everything</div>
   </div>
     <div class="body sidebartext col-xs-12" id="body">
       <div class="table-responsive">
   <table id="deity" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Name</th>
                    <th scope="col">Type</th>
               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Name</th>
                 <th scope="col">Type</th>
               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT title,type FROM world";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
               echo ('<tr><td>');
               $entry = $row['title'];
               $source = $row['type'];
               echo "<a href=\"/tools/world/world.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
               echo "<td>";
               echo $source;
               echo ('</td></tr>');

             }
               ?>

               <?php
                 $sqlcompendium = "SELECT title,type FROM compendium";
                 $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
                 while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 echo ('<tr><td>');
                 $entry = $row['title'];
                 $source = $row['type'];
                 echo "<a href=\"/tools/compendium/compendium.php?id=$entry\">";
                 echo $entry;
                 echo "</a></td>";
                 echo "<td>";
                 echo $source;
                 echo ('</td></tr>');

               }
                 ?>

                 <?php
                   $sqlcompendium = "SELECT name,class FROM subclasses";
                   $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
                   while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                   echo ('<tr><td>');
                   $entry = $row['name'];
                   $class = $row['class'];
                   $source = 'Subclass';
                   echo "<a href=\"/tools/compendium/compendium.php?id=$class\">";
                   echo $entry;
                   echo "</a></td>";
                   echo "<td>";
                   echo $source;
                   echo ('</td></tr>');

                 }
                   ?>

                   <?php
                     $sqlcompendium = "SELECT name FROM mysticabilities";
                     $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
                     while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                     echo ('<tr><td>');
                     $entry = $row['name'];
                     $source = 'Mystic Ability';
                     echo "<a href=\"/tools/compendium/compendium.php?id=Mystic\">";
                     echo $entry;
                     echo "</a></td>";
                     echo "<td>";
                     echo $source;
                     echo ('</td></tr>');

                   }
                     ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#deity tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#deity').DataTable();

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
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
