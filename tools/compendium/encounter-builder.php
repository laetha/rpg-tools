<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Monsters - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
     <style>
     th, td { white-space: nowrap; }
     </style>
     <!-- Page Header -->
     <div class="col-md-12">
     <div class="pagetitle" id="pgtitle">Monsters</div>
   </div>
   <div class="col-md-4 sidebartext">
     <div class="selectors">
     # of players
     <select>
       <option>1
       <option>2
       <option>3
       <option>4
       <option>5
       <option>6
       <option>7
       <option>8
     </select>

     Level
     <select>
       <option>1
       <option>2
       <option>3
       <option>4
       <option>5
       <option>6
       <option>7
       <option>8
       <option>9
       <option>10
       <option>11
       <option>12
       <option>13
       <option>14
       <option>15
       <option>16
       <option>17
       <option>18
       <option>19
       <option>20
     </select>
   </div>
     <div class="hide monslot" id="slot1"><div class="inline" id="monster1"></div><div class="hide" id="xp1"></div><div class="controls"><button class="btn btn-success" onclick="addMon('1')">+</button><button class="btn btn-danger" onclick="remMon('1')">-</button><input class="narrowinput" type"text" id="num1" value="0"></input></div></div>
     <div class="hide monslot" id="slot2"><div class="inline" id="monster2"></div><div class="hide" id="xp2"></div><div class="controls"><button class="btn btn-success" onclick="addMon('2')">+</button><button class="btn btn-danger" onclick="remMon('2')">-</button><input class="narrowinput" type"text" id="num2" value="0"></input></div></div>
     <div class="hide monslot" id="slot3"><div class="inline" id="monster3"></div><div class="hide" id="xp3"></div><div class="controls"><button class="btn btn-success" onclick="addMon('3')">+</button><button class="btn btn-danger" onclick="remMon('3')">-</button><input class="narrowinput" type"text" id="num3" value="0"></input></div></div>
     <div class="hide monslot" id="slot4"><div class="inline" id="monster4"></div><div class="hide" id="xp4"></div><div class="controls"><button class="btn btn-success" onclick="addMon('4')">+</button><button class="btn btn-danger" onclick="remMon('4')">-</button><input class="narrowinput" type"text" id="num4" value="0"></input></div></div>
     <div class="hide monslot" id="slot5"><div class="inline" id="monster5"></div><div class="hide" id="xp5"></div><div class="controls"><button class="btn btn-success" onclick="addMon('5')">+</button><button class="btn btn-danger" onclick="remMon('5')">-</button><input class="narrowinput" type"text" id="num5" value="0"></input></div></div>
     <div class="hide monslot" id="slot6"><div class="inline" id="monster6"></div><div class="hide" id="xp6"></div><div class="controls"><button class="btn btn-success" onclick="addMon('6')">+</button><button class="btn btn-danger" onclick="remMon('6')">-</button><input class="narrowinput" type"text" id="num6" value="0"></input></div></div>
     <div class="hide monslot" id="slot7"><div class="inline" id="monster7"></div><div class="hide" id="xp7"></div><div class="controls"><button class="btn btn-success" onclick="addMon('7')">+</button><button class="btn btn-danger" onclick="remMon('7')">-</button><input class="narrowinput" type"text" id="num7" value="0"></input></div></div>
     <div class="hide monslot" id="slot8"><div class="inline" id="monster8"></div><div class="hide" id="xp8"></div><div class="controls"><button class="btn btn-success" onclick="addMon('8')">+</button><button class="btn btn-danger" onclick="remMon('8')">-</button><input class="narrowinput" type"text" id="num8" value="0"></input></div></div>
     <div class="hide monslot" id="slot9"><div class="inline" id="monster9"></div><div class="hide" id="xp9"></div><div class="controls"><button class="btn btn-success" onclick="addMon('9')">+</button><button class="btn btn-danger" onclick="remMon('9')">-</button><input class="narrowinput" type"text" id="num9" value="0"></input></div></div>
     <div class="hide monslot" id="slot10"><div class="inline" id="monster10"></div><div class="hide" id="xp10"></div><div class="controls"><button class="btn btn-success" onclick="addMon('10')">+</button><button class="btn btn-danger" onclick="remMon('10')">-</button><input class="narrowinput" type"text" id="num10" value="0"></input></div></div>

     <br><div style="float:right;">Total XP: <div id="totalxp" style="display:inline;">0</div></div>
     <br><div style="float:right;">Adjusted XP: <div id="adjxp" style="display:inline;">0</div></div>
     <br><div style="float:right;">Easy: <div id="easy" style="display:inline;">0</div></div>
     <br><div style="float:right;">Medium: <div id="medium" style="display:inline;">0</div></div>
     <br><div style="float:right;">Hard: <div id="hard" style="display:inline;">0</div></div>
     <br><div style="float:right;">Deadly: <div id="deadly" style="display:inline;">0</div></div>


   </div>
     <div class="body sidebartext col-md-8" id="body">
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Add</th>
                   <th scope="col">Name</th>
                <!--   <th scope="col">Image</th> -->
                   <th scope="col">Size</th>
                   <th scope="col">Type</th>
                   <th scope="col">CR</th>
                   <th scope="col">Source</th>
                   <th scope="col">AC</th>
                   <th scope="col">HP</th>
                   <th scope="col">Speed</th>
                   <th scope="col">STR</th>
                   <th scope="col">DEX</th>
                   <th scope="col">CON</th>
                   <th scope="col">INT</th>
                   <th scope="col">WIS</th>
                   <th scope="col">CHA</th>
                   <th scope="col">Saves</th>
                   <th scope="col">Resistences</th>
                   <th scope="col">Vulnerabilities</th>
                   <th scope="col">Immunities</th>
                   <th scope="col">Condition Immunities</th>
                   <th scope="col">Senses</th>
                   <th scope="col">Passive Perception</th>
                   <th scope="col">Languages</th>


               </tr>
           </thead>
           <tfoot>
               <tr>
                 <th scope="col">Add</th>
                 <th scope="col">Name</th>
            <!--     <th scope="col">Image</th> -->
                 <th scope="col">Size</th>
                 <th scope="col">Type</th>
                 <th scope="col">CR</th>
                 <th scope="col">Source</th>
                 <th scope="col">AC</th>
                 <th scope="col">HP</th>
                 <th scope="col">Speed</th>
                 <th scope="col">STR</th>
                 <th scope="col">DEX</th>
                 <th scope="col">CON</th>
                 <th scope="col">INT</th>
                 <th scope="col">WIS</th>
                 <th scope="col">CHA</th>
                 <th scope="col">Saves</th>
                 <th scope="col">Resistences</th>
                 <th scope="col">Vulnerabilities</th>
                 <th scope="col">Immunities</th>
                 <th scope="col">Condition Immunities</th>
                 <th scope="col">Senses</th>
                 <th scope="col">Passive Perception</th>
                 <th scope="col">Languages</th>

               </tr>
           </tfoot>
           <tbody>
             <?php
               $sqlcompendium = "SELECT * FROM compendium WHERE type LIKE 'monster'";
               $compendiumdata = mysqli_query($dbcon, $sqlcompendium) or die('error getting data');
               while($row = mysqli_fetch_array($compendiumdata, MYSQLI_ASSOC)) {
                 $entry = $row['title'];
                 $entry =  str_replace("(monster)","",$entry);
                 $jpgurl = 'bestiary/'.$entry.'.jpg';
                 $pngurl = 'bestiary/'.$entry.'.png';

               echo ('<tr><td>');
               echo ('<button class="btn btn-success" onclick="addMonster(\''.$entry.'\')">+</button>');
               echo ('</td><td>');
               echo "<a href=\"compendium.php?id=$entry\">";
               echo $entry;
               echo "</a></td>";
            /*   if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else {
                 echo ('<td>n/a</td>');
               }*/
               echo ('<td>'.$row['monsterSize'].'</td>');
               echo ('<td>'.$row['monsterType'].'</td>');
               if($row['monsterCr'] ==0.125){
                 echo ('<td>0.125</td>');

               }
               elseif($row['monsterCr'] ==0.25){
                 echo ('<td>0.25</td>');

               }
               elseif($row['monsterCr'] ==0.5){
                 echo ('<td>0.5</td>');

               }
               else{
               echo ('<td>'.number_format((float)$row['monsterCr'], 0, '.', '').'</td>');
             }
             echo ('<td>'.$row['monsterTrait1'].'</td>');
             echo ('<td>'.$row['monsterAc'].'</td>');
             echo ('<td>'.$row['monsterHp'].'</td>');
             echo ('<td>'.$row['monsterSpeed'].'</td>');
             echo ('<td>'.$row['monsterStr'].'</td>');
             echo ('<td>'.$row['monsterDex'].'</td>');
             echo ('<td>'.$row['monsterCon'].'</td>');
             echo ('<td>'.$row['monsterInt'].'</td>');
             echo ('<td>'.$row['monsterWis'].'</td>');
             echo ('<td>'.$row['monsterCha'].'</td>');
             echo ('<td>'.$row['monsterSave'].'</td>');
             echo ('<td>'.$row['monsterResist'].'</td>');
             echo ('<td>'.$row['monsterVulnerable'].'</td>');
             echo ('<td>'.$row['monsterImmune'].'</td>');
             echo ('<td>'.$row['monsterConditionImmune'].'</td>');
             echo ('<td>'.$row['monsterSenses'].'</td>');
             echo ('<td>'.$row['monsterPassive'].'</td>');
             echo ('<td>'.$row['monsterLanguages'].'</td>');

             echo ('</tr>');

             }
               ?>

</tbody>
</table>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
/*    $('#allspells tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } ); */

    // DataTable
    var table = $('#allspells').DataTable(
      {
         "scrollX": true,
         "scrollY": "600px",
         "responsive": false,
         "columnDefs": [
    { "width": 25, "targets": 0 }
  ],
        "fixedColumns": true
     }
    );

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>

<script>
//var i = 1;
function addMonster(value) {
  var totalxp = document.getElementById('totalxp').innerHTML;
  totalxp = parseFloat(totalxp);
  var monster = value;
  var currentxp;
  $.ajax({
  url : '/tools/compendium/encounter-add.php',
  type: 'GET',
  data : { "monster" : monster },
  success: function(data)
  {
    var x = 1;
    for (i = 1; i <= 10; i++){
      var checkEmpty = document.getElementById('monster' + i).innerHTML;
      if (checkEmpty == '' && x == 1){
        document.getElementById('num' + i).value = 1;
        document.getElementById('monster' + i).innerHTML = monster;
        $('#slot' + i).removeClass('hide');
        currentxp = data.replace(/\D/g,'');
        currentxp = parseInt(currentxp.slice(0, -2));
        document.getElementById('xp' + i).innerHTML = currentxp;
       // i++;
        totalxp = totalxp + currentxp;
        document.getElementById('totalxp').innerHTML = totalxp;
        x++;
      }

 }
   calcDifficulty();

  },
  error: function (jqXHR, status, errorThrown)
  {
      //if fail show error and server status
      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
  }
  });
}
</script>

<script>
function addMon(value) {
var currentNum = $('#num' + value).val();
var monID = 'num' + value;
var newNum = parseInt(currentNum) + 1;
document.getElementById(monID).value = newNum;
var monXp = $('#xp' + value).html();
var totalxp = document.getElementById('totalxp').innerHTML;
totalxp = parseInt(totalxp) + parseInt(monXp);
document.getElementById('totalxp').innerHTML = totalxp;
calcDifficulty();
}
</script>
<script>
function remMon(value) {
var currentNum = $('#num' + value).val();
if (parseInt(currentNum) > 0){
var monID = 'num' + value;
var newNum = parseInt(currentNum) - 1;
document.getElementById(monID).value = newNum;
var monXp = $('#xp' + value).html();
var totalxp = document.getElementById('totalxp').innerHTML;
totalxp = parseInt(totalxp) - parseInt(monXp);
document.getElementById('totalxp').innerHTML = totalxp;
if (newNum == 0) {
  $('#slot' + value).addClass("hide");
  $('#xp' + value).html("0");
  $('#monster' + value).html("");
  $('#num' + value).val("0");
}
}
calcDifficulty();
}

</script>
<script>
function calcDifficulty(){
var mon1 = parseInt($('#num1').val());
var mon2 = parseInt($('#num2').val());
var mon3 = parseInt($('#num3').val());
var mon4 = parseInt($('#num4').val());
var mon5 = parseInt($('#num5').val());
var mon6 = parseInt($('#num6').val());
var mon7 = parseInt($('#num7').val());
var mon8 = parseInt($('#num8').val());
var mon9 = parseInt($('#num9').val());
var mon10 = parseInt($('#num10').val());
var numMon = 0;
numMon = mon1 + mon2 + mon3 + mon4 + mon5 + mon6 + mon7 + mon8 + mon9 + mon10;
var monMult = 0;

if (numMon == 1){
  monMult = 1;
}
if (numMon == 2){
  monMult = 1.5;
}
if (numMon >= 3 && numMon <= 6){
  monMult = 2;
}
if (numMon >= 7 && numMon <= 10){
  monMult = 2.5;
}
if (numMon >= 11 && numMon <= 14){
  monMult = 3;
}
if (numMon >= 15){
  monMult = 4;
}
var totalxp = $('#totalxp').html();
var adjXp = totalxp * monMult;
document.getElementById('adjxp').innerHTML = adjXp;

}

</script>

</div>
</div>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
