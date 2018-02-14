<?php
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.html";
include_once($headpath);
?>
  <div class="tocbox col-md-12">
    <div class ="toc body bodytext">
  <h1 class="pagetitle">Import</h1>
      <form method="post" action="process.php">
      <p class="text">Name         <input type="text" name="name" id="name"></p>
      <p class="text">Type        <input type="text" name="type" id="type"></p>
      <p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body"></textarea></p>
      <input type="submit" value="Submit">
    </form>
</div>
</div>
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.html";
include_once($footpath);
 ?>
