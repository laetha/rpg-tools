<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
?>

<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">DM Resources</h1>
<div class ="body bodytext">
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3 col-centered" style="margin-top: 50px;">
        <a href="monsterharvest.php"><p>Monster Harvester's Handbook</p></a>

      </div>
  </div>
</div>

   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>