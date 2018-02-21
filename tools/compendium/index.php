<div class="mainbox col-md-9">

  <!-- Page Header -->
  <div class="col-md-12">
  <div class="pagetitle" id="pgtitle"><?php
  $id = addslashes($id);
  $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
  $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
   $title = $row['title'];
   $deleteid = $row['id'];
 }
  ?>
</div>
</div>
  <div class="body bodytext col-xs-12" id="body">

    <!-- Body Text -->
      <?php
        $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
        $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          echo nl2br($row['body']);
          $sidebartype = $row['type'];
        }
      ?>
      </div>
      <p>
      <button type="button" class="editbutton btn btn-danger" id="delete-entry" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-remove"></span>Delete</button>
      <a href="edit.php?id=<?php echo $title; ?>"><button class="editbutton btn btn-info"><span class="glyphicon glyphicon-edit"></span>Edit</button></a></p>

    <div class="body bodytext col-xs-12" id="body2">

  <!--Settlement NPCs-->
  <?php
  if ($sidebartype == "settlement") {
    ?>
    <div class="body col-md-12 bodytext">
    <?php
    echo "<h3>Key NPC's:</h3>";
    echo ('<div class="row col-md-12">');
    $temptitle = str_replace("'", "''", $title);
    $npcs = "SELECT * FROM compendium WHERE npc_location LIKE '%$temptitle%'";
    $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
    while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
      $selectednpc = $titlerow['title'];
      //echo "<a href=\"compendium.php?id=$selectednpc\">";
      echo ('<div class="col-md-4">');
      echo $selectednpc;
      echo "</div>";
    }
    echo "</div></div>";
  }

  //Faction NPCs
  if ($sidebartype == "faction") {
    ?>
    <div class="body col-md-9 bodytext">
    <?php
    echo "<h3>Known Members:</h3>";
    $temptitle = str_replace("'", "''", $title);
    $factionnpcs = "SELECT * FROM compendium WHERE npc_faction LIKE '%$temptitle%'";
    $factiondata = mysqli_query($dbcon, $factionnpcs) or die('error getting data');
    while($factionrow = mysqli_fetch_array($factiondata, MYSQLI_ASSOC)) {
      $selectednpc = $factionrow['title'];
      //echo "<a href=\"compendium.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
  }

  //Deity NPC's
  if ($sidebartype == "deity") {
    ?>
    <div class="body col-md-9 bodytext">
    <?php
    echo "<h3>Known Followers:</h3>";
    $temptitle = str_replace("'", "''", $title);
    $deitynpcs = "SELECT * FROM compendium WHERE npc_deity LIKE '%$temptitle%'";
    $deitydata = mysqli_query($dbcon, $deitynpcs) or die('error getting data');
    while($deityrow = mysqli_fetch_array($deitydata, MYSQLI_ASSOC)) {
      $selectednpc = $deityrow['title'];
      //echo "<a href=\"compendium.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
  }
  ?>

  <!-- campaignlog References -->
  <?php

    ?>
    <div class="body sidebartext col-md-12 bodytext">
    <?php
    echo "<h3>Log references:</h3>";
    echo ('<ul style="list-style-type: circle;">');
    $temptitle = str_replace("'", "''", $title);
    $logs = "SELECT * FROM campaignlog WHERE entry LIKE '%$temptitle%' ORDER BY date DESC";
    $logdata = mysqli_query($dbcon, $logs) or die('error getting data');
    while($logrow = mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
      echo ('<li>');
      $selecteddate = $logrow['date'];
      $selectedlog = $logrow['entry'];
      echo ('<strong>Day ');
      echo $selecteddate;
      echo (':</strong> ');
      echo $selectedlog;
      echo "</li><p>";
    }

    echo "</ul></div>";


  ?>
<!-- Search and add hyperlinks -->
  <?php
    $sqlcompendium = "SELECT * FROM compendium WHERE title NOT LIKE '%{$id}%'";
    $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
    while($linkrow = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
    $temp = $linkrow['title'];
    ?>
    <script>
    var foundlink = "<?php echo $temp ?>";
    function replace (querytext){
      var bodytext = document.getElementById("body").innerHTML;
      //var pgtitle = document.getElementById("pgtitle").innerHTML;
      var url = "<a href=\"compendium.php?id=" + querytext + "\">" + querytext + "</a>";
      var regex = new RegExp(querytext, 'ig');
      var newtext = bodytext.replace(regex, url)
      document.getElementById("body").innerHTML = newtext;
    }
    replace(foundlink);

    </script>
    <?php
  }
  ?>
  <!-- Search and add hyperlinks -->
    <?php
      $sqlcompendium = "SELECT * FROM compendium";
      $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
      while($linkrow = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
      $temp = $linkrow['title'];
      ?>
      <script>
      var foundlink = "<?php echo $temp ?>";
      function replace (querytext){
        var bodytext = document.getElementById("body2").innerHTML;
        var url = "<a href=\"compendium.php?id=" + querytext + "\">" + querytext + "</a>";
        var regex = new RegExp(querytext, 'ig');
        var newtext = bodytext.replace(regex, url)
        document.getElementById("body2").innerHTML = newtext;
      }
      replace(foundlink);

      </script>
      <?php
    }
    ?>
</div>

</div>



<!-- Sidebar -->
    <div class="sidebar sidebartext col-xs-2">
    <p><a href="/tools/compendium/compendium.php">Back to Compendium</a></p>

    <h2><?php
    if ($sidebartype == "npc" ) {
      echo "NPC";
    }
    else if ($sidebartype == "deity" ) {
      echo "Dietie";
    }
    else {
    echo ucwords($sidebartype);
  }
    echo "s"; ?></h2>
    <?php
      $sidebar = "SELECT * FROM compendium WHERE type LIKE '%{$sidebartype}%'";
      $sidebardata = mysqli_query($dbcon, $sidebar) or die('error getting data');
      while($row =  mysqli_fetch_array($sidebardata, MYSQLI_ASSOC)) {
      $entry = $row['title'];
      echo "<a href=\"compendium.php?id=$entry\">";
      echo $entry;
      echo "</a>";
      echo "<br>";
    }
      ?>

  </div>
<!-- Delete Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modalstyle bodytext">

      <div class="modal-body">
        <p>Are you sure you want to delete <?php echo $title; ?>?</p>
      </div>
      <div class="modal-footer">
      <form class="delform" method="post" id="delform" action="delete.php">
        <select form="delform" name="delete" id="deleteid" style="display:none;" required="yes">
          <option value="<?php echo $deleteid; ?>" selected></option></select>
<button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
          <input class="btn btn-danger" type="submit" value="Delete"></Input>

      </form>
      </div>
    </div>

  </div>
</div>
