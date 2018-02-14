<div class="mainbox col-md-12">
  <h1 class="pagetitle"><?php
  $id = addslashes($id);
  $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
  $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
 }
  ?></h1>
  <div class="body bodytext col-md-9" id="body">
      <?php
        $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
        $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          echo nl2br($row['body']);
          $sidebartype = $row['type'];
        }
      ?>

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
    <div class="sidebar bodytext col-md-3">
    <p><a href="/tools/compendium/compendium.php">Back to Compendium</a></p>
    <div class="toc1">
    <h2><?php
    if ($sidebartype == "npc" ) {
      echo "NPC";
    }
    else if ($sidebartype == "diety" ) {
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
    </p>
    </div>
  </div>
</div>
