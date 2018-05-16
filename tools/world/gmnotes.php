<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'GM Notes - ';
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
   <div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">

     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">GM Notes</div>

     <form method="post" action="gmprocess.php" id="import" enctype="multipart/form-data">



         <div class="text col-centered col-md-12"><textarea type="text" name="gmnote" id="gmnote" placeholder="Enter notes here...">
           <?php
           $typeedit = "SELECT * FROM `gmnotes` WHERE id LIKE '1'";
           $typedata = mysqli_query($dbcon, $typeedit) or die('error getting data');
           while($row =  mysqli_fetch_array($typedata, MYSQLI_ASSOC)) {
           echo $row['note'];
}
?></textarea></div>

     </div>
   </form>
   <input form="import" class="btn btn-primary col-centered" type="submit" value="Save">
<?php

 ?>

  </div>
</div>


   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
