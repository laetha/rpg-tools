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
   <div class="mainbox col-md-12">

     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Award XP
   </div>
   </div>
     <div class="body bodytext col-xs-12" id="body">
       <!-- Body Text -->

       <div class="col-centered">
         <div class="row">
         <form method="post" action="xpprocess.php" id="xp">
           <div class="col-md-6" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="xp-award" id="xp-award" placeholder="Total XP..."></div>
           <div class="col-md-2" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="numplayers" id="numplayers" placeholder="# of players..."></div>

         </div>
         <div class="row">
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="ciara" value="1">Ciara</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="frukas" value="1">Frukas</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="quynn" value="1">Quynn</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="riordan" value="1">Riordan</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="threads" value="1">Threads</div>
           <div class="col-md-1 sidebartext" style="padding-bottom:20px;"><input type="checkbox" name="all" value="1">All</div>
         </div>
         <div class="row">

           <div class="col-md-1"><input class="btn btn-primary" type="submit" value="Submit"></div></p>
       </form>
     </div>

     </div>

     <div class="sidebartext">
       <p style="margin-top:40px;">Current XP:</p>
       <table id="XP" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
               <thead class="thead-dark">
                   <tr>
                       <th scope="col">Name</th>
                       <th scope="col">Level</th>
                       <th scope="col">Current XP</th>

                   </tr>
               </thead>
               <tfoot>
                   <tr>
                     <th scope="col">Name</th>
                     <th scope="col">Level</th>
                     <th scope="col">Current XP</th>
                   </tr>
               </tfoot>
               <tbody>
                 <?php
                   $sqlcompendium = "SELECT * FROM world WHERE type LIKE 'player character'";
                   $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
                   while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                   echo ('<tr><td>');
                   $entry = $row['title'];
                   echo "<a href=\"world.php?id=$entry\">";
                   echo $entry;
                   echo "</a></td>";
                   echo ('<td>'.$row['pc_lvl'].'</td>');
                   echo ('<td>'.$row['pc_xp'].'</td>');
                   echo "</tr>";

                 }
                   ?>

    </tbody>
    </table>
     </div>

         </div>

</div>
   </div>
<?php

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
