<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.ss">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/style.css" />
		<link rel="stylesheet" type="text/css" href="/selectize/css/selectize.default.css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="/tools/compendium/statblock.css" rel="stylesheet" type="text/css">
			<!-- This code is to prevent FOUC -->
			<script type="text/javascript">
		    $('html').addClass('hidden');
		    $(window).on('load', function () {
		    $('html').removeClass('hidden');
		     });
		   </script>
       <?php
       //SQL Connect
        $sqlpath = $_SERVER['DOCUMENT_ROOT'];
        $sqlpath .= "/sql-connect.php";
        include_once($sqlpath);
        $pgtitle = $_GET['id'];
        ?>
		<title><?php echo $pgtitle; ?> - RPG Tools</title>
	</head>
	<body class="sidebartext" style="min-width: 0px;">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/jquery-1.8.3.js" tpye="text/javascript"></script>-->
		<script src="/selectize/js/standalone/selectize.min.js" tpye="text/javascript"></script>
		<script src="/selectize/js/list.js" tpye="text/javascript"></script>
		<!--<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js" tpye="text/javascript"></script>-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" tpye="text/javascript"></script>
<?php
    $tmp_action = basename($_GET['id']);
          $id = $tmp_action;

          $worldtitle = "SELECT * FROM `compendium` WHERE `title` LIKE '$id'";
          $titledata = mysqli_query($dbcon, $worldtitle) or die('error getting data');
          while($row =  mysqli_fetch_array($titledata, MYSQLI_ASSOC)) {
            //echo ('<h2>'.ucwords($row['type']).'</h2>');
            $type = $row['type'];
            echo ('<h3 style="color: #5499c7;">'.$row['title'].'</h3><br />');

          if($type == 'item'){

            echo ('<strong>Type: '.ucwords($row['itemType']).'</strong><br />');
            if($row['itemMagic'] == 1){
              echo ('Magic Item, '.$row['itemDetail'].'<br />');
            }
            if($row['itemWeight'] != ''){
              echo ('Weight: '.$row['itemWeight'].'lbs.<br />');
            }
            if($row['itemValue'] != ''){
              echo ('Cost: '.$row['itemValue'].'gp<br />');
            }
            if($row['itemRange'] != ''){
              echo ('Range: '.$row['itemRange'].'<br />');
            }
            if($row['itemStrength'] != ''){
              echo ('Strength Requirement: '.$row['itemStrength'].'<br />');
            }
            if($row['itemStealth'] != ''){
              echo ('Stealth: Disadvantage<br />');
            }
            echo nl2br('<p></p><div class="sidebartext">'.$row['text'].'</div>');
            $sidebartype = $row['type'];
            }

}
?>
</body>
</html>
