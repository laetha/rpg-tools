<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">
<?php
  //SQL Connect
   $pgtitle = 'Initiative - ';
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>


<div class="mainbox col-sm-10 col-xs-12 col-sm-offset-1">
  <h1 class="pagetitle">Initiative Tracker</h1>
<div class ="body bodytext">
<div class="col-md-4">
  <select form="import" name="add-monster" id="add-monster" onChange="addMonster(this)">
    <option value="" selected>Add Monster...</option>
    <?php
    $faithdrop = "SELECT title FROM compendium WHERE type LIKE 'monster'";
    $faithdata = mysqli_query($dbcon, $faithdrop) or die('error getting data');
    while($deityrow =  mysqli_fetch_array($faithdata, MYSQLI_ASSOC)) {
      $deity = $deityrow['title'];
      echo "<option value=\"$deity\">$deity</option>";
    }
    ?>
  </select>
  <script type="text/javascript">
  $('#add-monster').selectize({
create: false,
sortField: 'text'
});
  </script>

  <script type="text/javascript">
  var output = new Array();
   function addMonster(selectObj) {

     var selectIndex=selectObj.selectedIndex;
     var selectValue=selectObj.options[selectIndex].text;
     output.push(selectValue);
     var selectValueNoBrackets = selectValue.replace(/"/g, "").replace(/'/g, "").replace(/\(|\)/g, "");
     var selectValueNs = selectValueNoBrackets.replace(/\s/g, '');
     var fullSelect = "show" + selectValueNs;
     document.getElementById(fullSelect).style.display = "block";

   }
  </script>

  <table>
    <?php
      $worldtitle1 = "SELECT * FROM monsters";
      $titledata1 = mysqli_query($dbcon, $worldtitle1) or die('error getting data');
      while($row1 =  mysqli_fetch_array($titledata1, MYSQLI_ASSOC)) {
        $rowns1 = preg_replace('/\s+/', '', $row1['title']);
        $rowns1 = preg_replace('/\(|\)/','', $rowns1);
        ?>

        <tr><td>
          <div class="init-entry sidebartext" id="show<?php echo $rowns1; ?>" style="display:none;">
          <?php echo $row1['title'];
          echo('<br /> AC: '.$row1['monsterAc'].'<p></p>');
          $realHp = $row1['monsterHp'];
          $realHp = substr($realHp, 0, strpos($realHp, " "));
           ?>
          <a href="/tools/initiative/statblock.php?id=<?php echo $row1['title']; ?>" target="statblock"><button class="btn btn-info" id="<?php echo $rowns1; ?>-btn">></button></a>
          <button class="btn btn-danger" id="<?php echo $rowns1; ?>-remove">-</button>
          <div class="<?php echo $rowns1; ?>-hptrack" id="<?php echo $rowns1; ?>-hptrack"  onclick="colchange(this)">
    <input type ="text" class="hp-track form- control" value="<?php echo($realHp); ?>" id="<?php echo $rowns1; ?>-hp" oninput="myFunction()"></input>
    <button class="btn btn-copy btn-info" id="<?php echo $rowns1; ?>-dupe">+</button>
    <div class="two"></div>
  </div>
        </div>
      </td></tr>
      <script>
      $(function addbar(){
        $(".btn-copy").on('click', function(){
          var ele = $(this).closest('.<?php echo $rowns1; ?>-hptrack').clone(true);

          $(this).closest('.<?php echo $rowns1; ?>-hptrack').after(ele);
        });
      });
      </script>

<?php } ?>
</table></div>
<?php
$worldtitle = "SELECT * FROM monsters";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  $rowns = preg_replace('/\s+/', '', $row['title']);
  $rowns = preg_replace('/\(|\)/','', $rowns);


  ?>

<script>
function myFunction() {
    var x = document.getElementById("<?php echo $rowns; ?>-hp").value;
    document.getElementById("<?php echo $rowns; ?>-health").innerHTML = "You wrote: " + x;
}

$(document).ready(function addLog(){
    $("#<?php echo $rowns; ?>-btn").click(function addLog(){
        $("#<?php echo $rowns; ?>").slideToggle("slow");
    });
});
$(document).ready(function remLog(){
  $("#<?php echo $rowns; ?>-remove").click(function remLog(){
  document.getElementById("show<?php echo $rowns; ?>").style.display = "none";
  document.getElementById("<?php echo $rowns; ?>").style.display = "none";

    });
  });

  
  $('.one, .two, .three, .four, .five, .six, .seven').click(function() {
      this.className = {
         seven : 'one', one: 'two', two: 'three', three: 'four', four: 'five', five: 'six', six: 'seven'
      }[this.className];
  });


</script>
<?php } ?>

<div class="col-md-8 col-xs-12" style="float:right;"><iframe class="blockframe" name="statblock"></iframe></div>
</div> <!--Body -->
</div> <!-- Mainbox -->





<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
