<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">World Building</h1>
<div class ="body bodytext">
  <div class="col-md-12 col-centered"><a href="/tools/world/import.php">Import</a></div>
  <div class="col-md-12 col-centered"><a href="/tools/world/upload.php">Upload</a></div>
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3">
        <a href="settlement.php"><h2>Settlements</h2></a>
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
        <a href="faction.php"><h2>Factions</h2></a>
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
        <a href="npc.php"><h2>NPCs</h2></a>
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
        <a href="deity.php"><h2>Deities</h2></a>
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

      <!-- Quests -->
      <div class="tocitem col-md-3">
        <a href="quest.php"><h2>Quests</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%quest%'";
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
        <a href="establishment.php"><h2>Establishments</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%establishment%'";
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

      <div class="tocitem col-md-3">
        <a href="publicquest.php"><h2>Public Quests</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%public quest%'";
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
