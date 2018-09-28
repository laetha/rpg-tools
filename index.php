<?php
$pgtitle = '';

//SQL Connect
 $sqlpath = $_SERVER['DOCUMENT_ROOT'];
 $sqlpath .= "/sql-connect.php";
 include_once($sqlpath);

 include('header.php');
 ?>

<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
				<h1 class="pagetitle">RPG Tools</h1>
			  <div class="quote">
          <?php
          $sqlworld = "SELECT * FROM quotes ORDER BY RAND() LIMIT 1";
          $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
          while($linkrow = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
            echo ('<em>"'.$linkrow['quote'].'"</em>');
            echo ('<br>');
            echo ('<div style="text-align: right;">- '.$linkrow['source'].'</div>');
          }
           ?>
        </div>
        <div class="fp-img">
          <?php
      		$handle = opendir(dirname(realpath(__FILE__)).'/assets/images/hp/');
      		while( $entry = readdir($handle) )
      		{
      		    if( $entry != '.' && $entry != '..' )
      		    {
      		        $files[] = $entry;
      		    }
      		}

      		closedir($handle);

      		sort($files);

      		  $i = rand(0, count($files)-1); // generate random number size of the array
      		  $selectedBg = "$files[$i]"; // set variable equal to which random filename was chosen
      		?>
          <img style="max-width: 90%; height: auto;" src="/assets/images/hp/<?php echo $selectedBg; ?>" />
        </div>
			</div>
<?php include('footer.php'); ?>
