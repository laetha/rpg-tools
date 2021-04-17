<!-- SQL Connect -->
<?php $sqlpath = $_SERVER['DOCUMENT_ROOT'];
$sqlpath .= "/sql-connect.php";
include_once($sqlpath); ?>

<!-- Header -->
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
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

				$logtitle = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
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
						if ($row['est_type'] !== ''){
							$body = $body.'Type: '.$row['est_type'].'<p>';
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



					$log1title = "SELECT * FROM world WHERE worlduser LIKE '$loguser'";
					$log1data = mysqli_query($dbcon, $log1title) or die('error getting data');
					while($row1 =  mysqli_fetch_array($log1data, MYSQLI_ASSOC)) {
						if (strpos($body, $row1['title']) !== false && $row1['title'] !== $row['title']) {
							$replace = $row1['title'];
							$body = str_replace($row1['title'],"@JournalEntry[$replace]",$body);
}
}

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
  $body = $body.'@JournalEntry['.$worldref.']';
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


	$bytes = file_put_contents("myfile.json", $json); 

//Footer
$footpath = $_SERVER['DOCUMENT_ROOT'];
$footpath .= "/footer.php";
include_once($footpath); ?>
