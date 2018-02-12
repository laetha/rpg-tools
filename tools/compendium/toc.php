<div class="mainbox">
  <h1 class="pagetitle">Compendium</h1>
      <div class="toc1">
      <h2>Settlements</h2>
      <p class="bodytext">
      <?php
        $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE '%settlement%'";
        $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
        while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
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
