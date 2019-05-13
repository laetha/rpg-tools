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
   <div class="col-xs-4 sidebartext">
     <div class="hide" id="slot1"><div id="monster1"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="1"></input></div>
     <div class="hide" id="slot2"><div id="monster2"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="2"></input></div>
     <div class="hide" id="slot3"><div id="monster3"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="3"></input></div>
     <div class="hide" id="slot4"><div id="monster4"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="4"></input></div>
     <div class="hide" id="slot5"><div id="monster5"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="5"></input></div>
     <div class="hide" id="slot6"><div id="monster6"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="6"></input></div>
     <div class="hide" id="slot7"><div id="monster7"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="7"></input></div>
     <div class="hide" id="slot8"><div id="monster8"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="8"></input></div>
     <div class="hide" id="slot9"><div id="monster9"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="9"></input></div>
     <div class="hide" id="slot10"><div id="monster10"></div><button class="btn btn-success">+</button><button class="btn btn-danger">-</button><input type="text" id="num1" value="10"></input></div>
     <div style="float:right;">Total XP: <div id="totalxp" style="display:inline;">0</div></div>
   </div>
     <div class="body sidebartext col-xs-8" id="body">
       <div class="table-responsive">
   <table id="allspells" class="table table-condensed table-striped table-responsive dt-responsive" cellspacing="0" width="100%">
           <thead class="thead-dark">
               <tr>
                   <th scope="col">Add</th>
                   <th scope="col">Name</th>
                   <th scope="col">Image</th>
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
                 <th scope="col">Image</th>
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
               if (file_exists($jpgurl)){
                 echo ('<td><img class="tableimg" src="'.$jpgurl.'"></td>');
               }
               else if (file_exists($pngurl)){
                 echo ('<td><img class="tableimg" src="'.$pngurl.'"></td>');
               }
               else {
                 echo ('<td>n/a</td>');
               }
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
var i = 1;
var totalxp = document.getElementById('totalxp').innerHTML;
totalxp = parseFloat(totalxp);
function addMonster(value) {
  var monster = value;
  var currentxp = 0;
  $.ajax({
  url : '/tools/compendium/encounter-add.php',
  type: 'GET',
  data : { "monster" : monster },
  success: function(data)
  {

   document.getElementById('monster' + i).innerHTML = monster;
   $('#slot' + i).removeClass('hide');
   i++;
   currentxp = data.replace(/\D/g,'');
   currentxp = parseInt(currentxp.slice(0, -2));
   totalxp = totalxp + currentxp;
   document.getElementById('totalxp').innerHTML = totalxp;
  },
  error: function (jqXHR, status, errorThrown)
  {
      //if fail show error and server status
      $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
  }
  });

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
