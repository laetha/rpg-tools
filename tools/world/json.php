<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
$worldname = $_GET['id'];
$json = '{
	"book":
	[
		{
			"id":"0101",
			"name":"Riverbend",
			"contents": [
				';
				$logtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
				$logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
				while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
				 $json = $json.'{"name":"'.$row['title'].'"},';
			}
			$json = rtrim($json, ",");
			$json=$json.']}
	],
	"bookData":
	[
		{
			"id":"0101",
			"data":[
				';

				$logtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser' AND title NOT LIKE ''";
				$logdata = mysqli_query($dbcon, $logtitle) or die('error getting data');
				while($row =  mysqli_fetch_array($logdata, MYSQLI_ASSOC)) {
					$item->name = $row['title'];
					$body = 'Type: '.$row['type'].'<br />';
					if ($row['type'] == "npc"){
						//$body = $body.'<br />Type: NPC<br />';
						if ($row['npc_race'] !== ''){
							$body = $body.'Race: '.$row['npc_race'].'<br />';
						}
						if ($row['npc_location'] !== ''){
							$body = $body.'Location: '.$row['npc_location'].'<br />';
						}
						if ($row['npc_faction'] !== ''){
							$body = $body.'Faction: '.$row['npc_faction'].'<br />';
						}
						if ($row['npc_deity'] !== ''){
							$body = $body.'Deity: '.$row['npc_deity'].'<br />';
						}
						if ($row['npc_est'] !== ''){
							$body = $body.'Establishment: '.$row['npc_est'].'<br />';
						}
						if ($row['npc_title'] !== ''){
							$body = $body.'Title: '.$row['npc_title'].'<p>';
						}
					}
					if ($row['type'] == "establishment"){
						if ($row['est_type'] !== ''){
						$body = $body.'Type: '.$row['est_type'].'<br />';
						}
						if ($row['est_location'] !== ''){
							$body = $body.'Location: '.$row['est_location'].'<p>';
							}
							if ($row['est_location'] !== ''){
								$npctitle = "SELECT * FROM world WHERE npc_location LIKE '$row['title']'";
								$npcdata = mysqli_query($dbcon, $npctitle) or die('error getting data');
								$zz=1;
								while($npcrow =  mysqli_fetch_array($npcdata, MYSQLI_ASSOC)) {
									if ($zz = 1){
										$body = $body.'Inhabitants:<br />'.$npcrow['title'].' :: '.$npcrow['npc_title'].'<br />';
										$zz++;
									}
									else {
										$body = $body.$npcrow['title'].' :: '.$npcrow['npc_title'].'<br />';
									}
								}
								$body = $body.'<p>';
							}
					}

					$log1title = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
					$log1data = mysqli_query($dbcon, $log1title) or die('error getting data');
					while($row1 =  mysqli_fetch_array($log1data, MYSQLI_ASSOC)) {
						$logcount = 0;
						if (strpos($body, $row1['title']) !== false && $row1['title'] !== $row['title'] && $logcount != 1) {
							$replace = $row1['title'];
							if ($replace !== $worldname){
							$fullreplace = '@Compendium['.$worldname.'.'.$worldname.' Journal.'.$replace.']{'.$replace.'}';
							$body = str_replace($replace,$fullreplace,$body);
							$logcount = 1;
							}
}
}


					
					$body=$body.'<hr />'.nl2br($row['body'].'<p>');
					$temptitle = str_replace("'", "''", $row['title']);
					
					$logs = "SELECT * FROM campaignlog WHERE entry LIKE '%$temptitle%' AND active = 1 AND worlduser LIKE '$loguser'";
    				$log2data = mysqli_query($dbcon, $logs) or die('error getting data');
    				$logshow = 1;
    				while($log2row = mysqli_fetch_array($log2data, MYSQLI_ASSOC)) {
						if($logshow == 1){
							$body = $body.'<p><hr /><h3>Log References:</h3>';
							$logshow++;
							$body = $body.'<ul style="list-style-type: circle;">';

						  }
					
						  $body = $body.'<li>';
						  $selecteddate = $log2row['date'];
						  $selectedlog = $log2row['entry'];
						  $body = $body.'<strong>Day ';
						  $body = $body.$selecteddate;
						  $body = $body.':</strong> ';
						  $body = $body.$selectedlog;
					  	  $body = $body."<br />";
    					  $body = $body."</li><p>";

					}
					$body=$body."</ul><p>";
					

$temptitle = str_replace("'", "''", $row['title']);
$logs = "SELECT * FROM world WHERE body LIKE '%$temptitle%' AND worlduser LIKE '$loguser'";
$log3data = mysqli_query($dbcon, $logs) or die('error getting data');
$logshow = 1;
while($log3row = mysqli_fetch_array($log3data, MYSQLI_ASSOC)) {
  if($logshow == 1){
	$body = $body.'<hr /><h3>World References:</h3>';
	$body = $body.'<ul style="list-style-type: circle;">';
	$logshow++;

  }
  $worldref = $log3row['title'];
  $body = $body.'<li>';
  $body = $body.'@Compendium['.$worldname.'.'.$worldname.' Journal.'.$worldref.']{'.$worldref.'}';
  $body = $body."</li><p>";

}

$body=$body."</ul>";


					$item->entries = array($body);
					$json=$json.json_encode($item);
					$json=$json.',';
			}
			$json = rtrim($json, ",");
			$json=$json.']	
		}
	]
}';

	$filename = $worldname.'.json';
	$bytes = file_put_contents($filename, $json);
	echo ('<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
    <div class ="body bodytext">
  <h1 class="pagetitle">JSON Exported</h1>
<div class="col-md-10 col-centered">');
	echo ('<a href="'.$filename.'" download><div class="btn btn-success">'.$filename.'</div></a>');
	echo ('</div></div></div>');

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
