<?php
include('../../sql-connect.php');
include('header.html');
?>
<div class="mainbox">
  <h1 class="pagetitle">Import</h1>
  <div class="menu">
    <p class ="bodytext" id="body">
      <form method="post" action="process.php">
      <p>Name<input type="text" name="name" id="name"></p>
      <p>Type<input type="text" name="type" id="type"></p>
      <p>Body<textarea type="text" cols="50" rows="10" name="body" id="body"></textarea></p>
      <input type="submit" value="Submit">
    </form>

  </div>
</div>
<?php
include('footer.html');
 ?>
