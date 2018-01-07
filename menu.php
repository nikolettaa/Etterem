<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		mysqli_set_charset($dbc, "utf8");
		$week_number = date('W');
		$year = 2017;
		$date = array();
		for($day = 1; $day < 7; $day++){
		  array_push($date, date('Y-m-d', strtotime($year."W".$week_number.$day)))."\n";
		}
		$today = date("Y-m-d"); 
		$query = "SELECT etlap.datum, etel_tipus.tipus, etelek.nev, etelek.ar, etelek.kep FROM etel_tipus, etelek, menu, etlap WHERE etel_tipus.id = etelek.tipus_id AND menu.nev_id = etelek.id AND etlap.menu_szam = menu.menu_szam AND etlap.datum between '".$date[0]."' AND '".$date[5]."' ORDER BY etlap.datum;";
		$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
		mysqli_close($dbc);
		$data = array();
		while($row = mysqli_fetch_array($result)){
			array_push($data, $row);
		}
		echo '<table class="table table-bordered"><thead><tr>';
		$days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'];
		for($i = 0; $i < 6; $i++){
			echo '<th><a href="index2.php?oldal=1&f_date='.$date[$i].'">'.$days[$i].'</a></th>';
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
					echo '<tr><td colspan="2"><a href="images/'.$data[$i]['kep'].'" target="_blank"><img width="60px" height="50px" src="images/'.$data[$i]['kep'].'"></a></td><td colspan="3">'.$data[$i]['nev'].'</td><td colspan="1">'.$data[$i]['ar'].'</tr>';
					}
				}
			}	
		}
		echo '</tbody></table>';