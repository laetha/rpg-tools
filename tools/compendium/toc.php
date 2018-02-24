<div class="tocbox col-md-12">
  <h1 class="pagetitle">Compendium</h1>
<div class ="body bodytext">
      <div class="toc bodytext">

      <!-- Settlements -->
      <div class="tocitem col-md-3">
        <h2>Backgrounds</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'background' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="backgrounds.php">View full list...</a>
      </div>
      <div class="tocitem col-md-3">
        <h2>Feats</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'feat' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="feats.php">View full list...</a>
      </div>
      <div class="tocitem col-md-3">
        <h2>Items</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'item' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="items.php">View full list...</a>
      </div>
      <div class="tocitem col-md-3">
        <h2>Monsters</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'monster' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="monsters.php">View full list...</a>
      </div>
      <div class="tocitem col-md-3">
        <h2>Races</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'race' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="races.php">View full list...</a>
      </div>
      <div class="tocitem col-md-3">
        <h2>Spells</h2>
      <?php
        $sqlcompendium = "SELECT title FROM compendium WHERE type LIKE 'spell' LIMIT 0,5";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"compendium.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
        <a href="spells.php">View full list...</a>
      </div>

      </div>
  </div>
</div>
