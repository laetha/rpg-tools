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
  <p><a href="http://kobold.club/fight/#/encounter-manager" target="_BLANK">Kobold Fight Club Encounters</a></p>
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
  <script src="/plugins/rpg-dice-roller-master/dice-roller.js"></script>
  <div class="sidebartext">
  <form action="" onsubmit="return roll();">
      <input type="text" placeholder="Dice roller..." autofocus="" id="input">
      <button type="submit">Roll</button>
    </form>
    <div>

      <div class="row">
        <table>
        <tr>
        <td><textarea rows="1" id="output" readonly="" placeholder="No dice rolled" style="margin-right:5px; height:30px; width:200px;"></textarea></td>
        <td><button onclick="clearLog()" style="float:right;">Clear</button></td>
        </tr>
      </table>
      </div>

    </div>
  <script>

      var diceRoller  = new DiceRoller();

      function roll(){
        var value = document.getElementById('input').value;

        diceRoller.roll(value);

        document.getElementById('output').value = diceRoller.getNotation();

        // stop event propagation
        return false;
      }

      function clearLog(){
        diceRoller.clearLog();

        document.getElementById('output').value = diceRoller.getNotation();

        // stop event propagation
        return false;
      }

</script>
</div>
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
          echo('<br /> AC: '.$row1['monsterAc']);
          $realHp = $row1['monsterHp'];
          $realHp = substr($realHp, 0, strpos($realHp, " "));
          $roll = rand(1,20);
          $init = floor((($row1['monsterDex']-10)/2));
          $initroll = $init + $roll;
          echo('<br /> Initiative: '.$initroll.'('.$roll.' + '.$init.')');
           ?>
          <a href="/tools/initiative/statblock.php?id=<?php echo $row1['title']; ?>" target="statblock"><button class=" butsm btn btn-info" id="<?php echo $rowns1; ?>-btn">></button></a>
          <button class="butsm btn btn-danger" id="<?php echo $rowns1; ?>-remove">-</button>
        <div class="<?php echo $rowns1; ?>-hptrack" id="<?php echo $rowns1; ?>-hptrack">
    <input type ="text" class="hp-track" value="<?php echo($realHp); ?>" id="<?php echo $rowns1; ?>-hp"></input>
    <button class="butsm btn btn-copy btn-success" id="<?php echo $rowns1; ?>-dupe">+</button>
    <div class="two">
  </div>
        </div>
      </td></tr>
<?php } ?>

</table>

</div>
<?php
$worldtitle = "SELECT * FROM monsters";
$titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
  $rowns = preg_replace('/\s+/', '', $row['title']);
  $rowns = preg_replace('/\(|\)/','', $rowns);
  ?>

<script>

$(document).ready(function remLog(){
  $("#<?php echo $rowns; ?>-remove").click(function remLog(){
  document.getElementById("show<?php echo $rowns; ?>").style.display = "none";
  document.getElementById("<?php echo $rowns; ?>").style.display = "none";
    });
  });
</script>
<?php } ?>
<script>
$('.one, .two, .three, .four, .five, .six, .seven').click(function() {
    this.className = {
       seven : 'one', one: 'two', two: 'three', three: 'four', four: 'five', five: 'six', six: 'seven'
    }[this.className];
});

$(function addbar(){
  $(".btn-copy").on('click', function(){
    var ele = $(this).closest('div').clone(true);
    $(this).closest('div').after(ele);
    $('.hp-track').each(function(){
      var $this = $(this);
    $(this).zeninput();
    });
  });
});
$('.hp-track').each(function(){
  var $this = $(this);
$(this).zeninput();
});

</script>

<div class="col-md-8 col-xs-12" style="float:right;"><iframe class="blockframe" name="statblock"></iframe></div>
</div> <!--Body -->
</div> <!-- Mainbox -->

<?php
//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath);
?>
