<div class="mainbox">
  <h1 class="pagetitle"><?php
  $id = addslashes($id);
  $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
  $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
  while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
   echo $row['title'];
 }
  ?></h1>
  <div class="menu">
    <p class ="bodytext" id="body">
      <?php
        $compendiumtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '%{$id}%'";
        $titledata = mysqli_query($dbcon, $compendiumtitle) or die('error getting data');
        while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
          echo nl2br($row['body']);
        }
      ?>
      </p>
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
</div>
