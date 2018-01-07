<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8"> 
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="col-sm-4 text-center">
<table class="table table-bordered table-text">
<thead><tr>
<?php
require_once('connectvars.php');
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_set_charset($dbc, "utf8");
	$week_number = date('W');
	$year = 2017;
	$date = array();
	for($day = 1; $day < 7; $day++){
	  array_push($date, date('Y-m-d', strtotime($year."W".$week_number.$day)))."\n";
	}
	$query = "SELECT etlap.datum, etel_tipus.tipus, etelek.nev, etelek.ar FROM etel_tipus, etelek, menu, etlap WHERE etel_tipus.id = etelek.tipus_id AND menu.nev_id = etelek.id AND etlap.menu_szam = menu.menu_szam AND etlap.datum between '".$date[0]."' AND '".$date[5]."' ORDER BY etlap.datum;";
	$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
	mysqli_close($dbc);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		array_push($data, $row);
	}
	//print_r($data);
	//echo count($data);
	$days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'];
	for($i = 0; $i < 6; $i++){
		echo '<th><a href="table.php?f_date='.$date[$i].'">'.$days[$i].'</a></th>';
	}
	echo '</tr></thead><tbody>';
	$tipusok = ['Levesek', 'Húsfélék', 'Tésztafélék', 'Desszertek'];
	$tip = "";
	if (isset($_GET['f_date'])){
		$fdate = $_GET['f_date'];
		foreach($tipusok as $tipus){
			for($i = 0; $i < count($data); $i++){
				if($fdate == $data[$i]['datum'] && $tipus == $data[$i]['tipus']){
					if ($tip !== $tipus){
							echo '<tr><td colspan="6"><b>'.$tipus.'</b></td></tr>';
							$tip = $tipus;
					}
					echo '<tr><td colspan="4">'.$data[$i]['nev'].'</td><td colspan="2">'.$data[$i]['ar'].'</tr>';
				}//else echo '<tr><td>A mai napon nincs menü.</td></tr>';
			}
		}
	}
?>
</tbody>
</table>
</div>
</body>
</html>
