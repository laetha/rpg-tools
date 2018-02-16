<div class="mainbox col-md-9">

  <!-- Page Header -->
  <h1 class="pagetitle"><?php
  $id = addslashes($id);
  $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
  $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
   $title = $row['title'];
 }
  ?></h1>
  
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
          var bodytext = document.getElementById("body").innerHTML;
          var url = "<a href=\"compendium.php?id=" + querytext + "\">" + querytext + "</a>";
          var newtext = bodytext.replace(querytext, url)
          document.getElementById("body").innerHTML = newtext;
        }
        replace(foundlink);

        </script>
        <?php
      }
      ?>
    </div>


  <!--Settlement NPCs-->
  <?php
  if ($sidebartype == "settlement") {
    ?>
    <div class="body col-md-9 bodytext">
    <?php
    echo "<h3>Key NPC's:</h3>";
    $temptitle = str_replace("'", "''", $title);
    $npcs = "SELECT * FROM compendium WHERE npc_location LIKE '%$temptitle%'";
    $npcdata = mysqli_query($dbcon, $npcs) or die('error getting data');
    while($titlerow = mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
      $selectednpc = $titlerow['title'];
      echo "<a href=\"compendium.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
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
      echo "<a href=\"compendium.php?id=$selectednpc\">";
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
      echo "<a href=\"compendium.php?id=$selectednpc\">";
      echo $selectednpc;
      echo "</a><br />";
    }
    echo "</div>";
  }
  ?>

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
