<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>
<div id="logsearch">
    <input class="search" placeholder="Search" />
    <button class="sort" data-sort="date">
    Sort by Date
    </button>
    <button class="sort" data-sort="entry">
    Sort by Entry
  </button>
<div class="list bodytext">
<?php
   $logtitle = "SELECT * FROM `campaignlog`";
   $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
    echo ('<div class="row"><div class="date col-md-1">');
    echo ("Day ");
    echo $row['date'];
    echo ('</div><div class="entry col-md-10">');
    echo $row['entry'];
    echo ('</div></div>');
   }
   ?>
 </div>

</div>

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
          var bodytext = document.getElementById("logsearch").innerHTML;
          var url = "<a href=\"/tools/compendium/compendium.php?id=" + querytext + "\">" + querytext + "</a>";
          var newtext = bodytext.replace(querytext, url)
          document.getElementById("logsearch").innerHTML = newtext;
        }
        replace(foundlink);

        var options = {
          valueNames: [ 'date', 'entry' ]
        };

        var userList = new List('logsearch', options);

        </script>
        <?php
        }


//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
