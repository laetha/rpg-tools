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

    <!-- Add to Log -->
    <p><button class="btn btn-info" id="addbutton">Add to Log</button>
    <div id="adddiv" style="display:none;">
      <form method="post" action="logprocess.php" id="logadd">
        <div class="col-md-1" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logdate" id="logdate" placeholder="day #"></div>
        <div class="col-md-6" style="padding-bottom:20px;"><input class="searchbox" style="width:100%;" type="text" name="logentry" id="logentry" placeholder="Log Entry...."></div>
        <div class="col-md-1"><input class="btn btn-primary" type="submit" value="Submit"></div>
    </form>
  </div>
  <script>
  $(document).ready(function addLog(){
      $("#addbutton").click(function addLog(){
          $("#adddiv").slideToggle("slow");
      });
  });
  </script>
  <!--<div class="padding"></div>-->
  <div class="row bodytext tablehead col-xs-12">
    <div class="date headitem col-sm-1 col-xs-1 col-md-1">
      Day
    </div>
    <div class="logbuttons headitem col-sm-2 col-xs-1 col-md-1 col-lg-1">
      Edit
    </div>
    <div class="entry headitem col-sm-7 col-xs-6 col-md-9 col-lg-9">
      Entry
    </div>
  </div>
<div class="list sidebartext" id="thelog">
<form action="" method="post">
<?php
   $logtitle = "SELECT * FROM campaignlog WHERE active=1 ORDER BY date DESC ";
   $logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
   while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
    echo ('<div class="row"><div class="date col-sm-1 col-xs-1 col-md-1">');
    echo ('Day ');
    echo $row['date'];
    echo ('</div><div class="logbuttons col-sm-2 col-xs-2 col-md-1 col-lg-1">');
    echo ('<button type="button" class="logbtn btn btn-danger btn-sq-xs" name="deleteItem" id="delete-log" data-toggle="modal" data-target="#deleteModal'.$row['id'].'"><span class="glyphicon glyphicon-remove"></span></button>');
    echo ('<button type="button" class="logbtn btn btn-info btn-sq-xs" id="edit-log" data-toggle="modal" data-target="#editModal'.$row['id'].'"><span class="glyphicon glyphicon-edit"></span></button>');
    echo ('</div><div class="entry col-sm-7 col-xs-7 col-md-9 col-lg-10" name ="entry1" id="entry');
    echo $row['id'];
    echo ('">');
    echo $row['entry'];
    echo ('<div id="hiddenid">'.$row['entry'].'</div>');
    echo ('</div></div>');
    ?>
    <!-- EDIT Modal -->
    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalstyle bodytext">

          <div class="modal-body">
            <form method="post" action="logedit.php?editid=<?php echo $row['id']; ?>" id="edit<?php echo $row['id']; ?>">
              <input form="edit<?php echo $row['id']; ?>" class="logeditbox" type="text" name="editentry<?php echo $row['id']; ?>" id="editentry<?php echo $row['id']; ?>" placeholder="Enter text here..." value="" />
              <button form="edit<?php echo $row['id']; ?>"class="logbtn btn btn-info btn-sq-xs" id="editconfirm" type="submit" value="Save" />
                <span class="glyphicon glyphicon-ok"></span></button>
            </form>
            <p></p><p>Old Text:</p>
            <p class="sidebartext">
            <?php echo $row['entry']; ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <!-- DELETE Modal -->
    <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalstyle bodytext">

          <div class="modal-body">
            <p>Are you sure you want to delete <em>"<?php echo $row['entry']; ?>"</em>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info delform" data-dismiss="modal">Go Back</button>
                <a href="logdelete.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger delform">Delete</button></a>
          </div>
        </div>

      </div>
    </div>
    <?php
    }
   ?>
 <!--</form>-->
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

//List.js
        var options = {
          valueNames: [ 'date', 'entry' ],
          fuzzySearch: {
            searchClass: "search",
            location: 0,
            distance: 500,
            threshold: 0.4,
            multiSearch: true
        }
        };
        var userList = new List('logsearch', options);

//Edit Entry

/*function logEdit(editquery) {
      var editid = ('entry' + editquery);
      var originaltext = document.getElementById(editid).innerHTML;
      var doc = new DOMParser().parseFromString(originaltext, 'text/html');
      var cleantext = doc.body.textContent || "";
      var editbox = '<form method="post" action="" id="import">' +
      '<input class="logeditbox" type="text" name="editEntry" id="editEntry" value="' + cleantext +
      '">' +
      '<button class="logbtn btn btn-info btn-sq-xs" id="editconfirm" type="submit" value="Save">' +
      '<span class="glyphicon glyphicon-ok"></span></button>' +
      '</form>'
      document.getElementById(editquery).innerHTML = editbox;
};*/


        </script>
        <?php
      } ?>

</div>


<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
