<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = 'Characters - ';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
?>
<script>
$(document).ready(function (){
  showCharModal();
}
);

function showCharModal() {
  $("#charModal").modal({backdrop: 'static', keyboard: false});
  showCharModal();
}

</script>


  <!-- Item Modal -->
  <div class="modal fade bd-example-modal-lg" id="charModal" role="dialog">
    <div class="modal-dialog" style="width: 80%; max-width:1200px;">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext" style="height:100%;">
        <div class="modal-header" style="padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <div class="modal-body createModal" id="charModalBody" style="height:100%; padding-top: 0px;">

        <div id="charNameShow">
          <div class="col-centered">Character Name</div>
          <input class="bigInput col-centered" id="charNameAdd" value="" placeholder="Character Name..."></input>
          <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addName()">Next</button></div>
        </div>

        <div id="charRaceShow" style="display:none;">
          <div class="col-centered">Race</div>
          <div class="col-md-6 col-xs-12"><select class="charClassSelect sheetDrop" name="charRaceAdd" id="charRaceAdd"  onchange="showRaceDetails()"></div>
            <?php
            $racetitle = "SELECT title FROM `compendium` WHERE `type` LIKE 'race'";
            $racedata = mysqli_query($dbcon, $racetitle) or die('error getting data');
            while($row1 =  mysqli_fetch_array($racedata, MYSQLI_ASSOC)) {
              $raceNameNoR = str_replace('(race)', '', $row1['title']);
              $raceNameClean = preg_replace('/[^a-z\d]+/i', '', $raceNameNoR);
                echo ('<option value="'.$raceNameNoR.'">'.$raceNameNoR);
            }
             ?>
          </select>
          <div class="col-md-6 col-xs-12" id="raceDetails"></div>
          <div class="col-centered"><button class="btn btn-info" class="nextButton" onclick="addRace()">Next</button></div>
        </div>


        </div>

      </div>

    </div>
  </div>


<div id="charName"></div>
<div id="charRace"></div>
<div id="charClass"></div>


<script>
function addName() {
  var charName = document.getElementById('charNameAdd').value;
  document.getElementById('charName').innerHTML = charName;
  $('#charNameShow').fadeOut(500);
  $('#charRaceShow').delay(400).fadeIn(300);
};

function addRace() {
  var charName = document.getElementById('charRaceAdd').value;
  document.getElementById('charRace').innerHTML = charName;
  $('#charRaceShow').fadeOut(500);
  $('#charClassShow').delay(400).fadeIn(300);
};


function showRaceDetails(){
  var selectedRace = document.getElementById('charRaceAdd').value;
  document.getElementById('raceDetails').innerHTML = '<div class="iframe-container"><iframe frameBorder="0" src="/tools/compendium/compendium.php?id=' + selectedRace + '" /></div>';
};
</script>

         <?php

         //Footer
         $footpath = $_SERVER['DOCUMENT_ROOT'];
         $footpath .= "/footer.php";
         include_once($footpath);
         ?>
