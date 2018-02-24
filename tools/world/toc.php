<div class="tocbox col-md-12">
  <h1 class="pagetitle">World Building</h1>
<div class ="body bodytext">
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3">
        <h2>Settlements</h2>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%settlement%'";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- Factions -->
      <div class="tocitem col-md-3">
        <h2>Factions</h2>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%faction%'";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- NPCs -->
      <div class="tocitem col-md-3">
        <h2>NPCs</h2>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%npc%'";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- Deities -->
      <div class="tocitem col-md-3">
        <h2>Deities</h2>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%deity%'";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>
      </div>
  </div>
</div>