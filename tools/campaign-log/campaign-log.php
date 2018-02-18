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
<div class="mainbox col-xs-12">
  <div class="pagetitle col-xs-12">Campaign Log</div>
<div id="logsearch">
    <input class="search searchbox" placeholder="Search" />
    <!--<button class="sort btn btn-primary btn-xs" data-sort="date">
    Sort by Date
    </button>
    <button class="sort btn btn-info btn-xs" data-sort="entry">
    Sort by Entry
  </button>-->
  <div class="padding"></div>
  <div class="row bodytext tablehead col-xs-12">
    <div class="date headitem col-sm-3 col-xs-4 col-md-1 col-lg-1">
      Day
    </div>
    <div class="entry headitem col-sm-8 col-xs-8 col-md-10 col-lg-10">
      Entry
    </div>
  </div>
<div class="list sidebartext" id="thelog">

<?php
   $logtitle = "SELECT * FROM `campaignlog` ORDER BY `date` DESC ";
   $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
    echo ('<div class="row"><div class="date col-sm-3 col-xs-2 col-md-1">');
    echo ("Day ");
    echo $row['date'];
    echo ('</div><div class="entry col-sm-8 col-xs-8 col-md-10 col-lg-11">');
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
          var bodytext = document.getElementById("thelog").innerHTML;
          var url = "<a href=\"/tools/compendium/compendium.php?id=" + querytext + "\">" + querytext + "</a>";
          var regex = new RegExp(querytext, 'g');
          newtext = bodytext.replace(regex, url);
          document.getElementById("thelog").innerHTML = newtext;
        }
        replace(foundlink);

        var options = {
          valueNames: [ 'date', 'entry' ]
        };

        var userList = new List('logsearch', options);

        </script>
        <?php
        }
?>
</div>
<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
