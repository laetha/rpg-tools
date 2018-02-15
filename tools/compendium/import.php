<?php
//SQL Connect
$sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath);
//Header
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.html";
include_once($headpath);
?>
<!-- Import Form -->
  <div class="tocbox col-md-12">
    <div class ="toc body bodytext">
  <h1 class="pagetitle">Add to Compendium</h1>
      <form method="post" action="process.php" id="import">
      <p class="text">Name         <input type="text" name="name" id="name" placeholder="Name..."></p>

<!-- 'Type' Dropbox -->
      <p class="text">Type
        <select form="import" required="yes" name="type" id="type">
          <option value="settlement" selected="selected">Settlement</option>
          <option value="faction">Faction</option>
          <option value="npc">NPC</option>
          <option value="deity">Deity</option>
        </select></p>

      <p class="text">Body         <textarea type="text" cols="50" rows="10" name="body" id="body" placeholder="Type the body of your content here..."></textarea></p>
      <input type="submit" value="Submit">
    </form>
</div>
</div>
<!-- Footer -->
<?php
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.html";
include_once($footpath);
 ?>
