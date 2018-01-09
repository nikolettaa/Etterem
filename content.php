<?php
require_once('connectvars.php');
?>
<!-- TARTALOM -->
     <div class="row row-cont1">
		<div class="col-xs-12 col-md-10 col-md-offset-1 row-cont">
 <!-- JOBB OLDAL -->
			<div class="col-sm-12 col-md-8 col-md-push-4 cont-right text-size">
			  <?php
				if (isset($_GET['site'])){
					$old = $_GET['site'];
				}
				else $old = 0;
				switch ($old){
					case 1:
						echo '<h1>'.$menu.'</h1>
						<hr class="line"></hr>
						<div class="right">';
						$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						mysqli_set_charset($dbc, "utf8");
						$week_number = date('W');
						$year = date('Y');
						$date = array();
						for($day = 1; $day < 7; $day++){
						  array_push($date, date('Y-m-d', strtotime($year."W".$week_number.$day)))."\n";
						}
						$today = date("Y-m-d"); 
						$query = "SELECT etlap.datum, etel_tipus.tipus, etelek.nev, etelek.ar, etelek.kep FROM etel_tipus, etelek, menu, etlap WHERE etel_tipus.id = etelek.tipus_id AND menu.nev_id = etelek.id AND etlap.menu_szam = menu.menu_szam AND etlap.datum between '".$date[0]."' AND '".$date[5]."' ORDER BY etlap.datum;";
						$query2 = "SELECT etel_tipus.tipus, etelek.tipus_id FROM etel_tipus, etelek WHERE etel_tipus.id = etelek.tipus_id Group BY etel_tipus.tipus ORDER BY `etelek`.`tipus_id` ASC;";
						$result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
						$result2 = mysqli_query($dbc, $query2) or die(mysqli_error($dbc));
						mysqli_close($dbc);
						$data = array();
						$tipusok = array();
						while($row = mysqli_fetch_array($result)){
							array_push($data, $row);
						}
						echo '<h2>Dátum:</h2>' .$date[0]. ' - ' .$date[5].' -ig <br><br>';
						echo '<div class="table-responsive"><table class="table table-menu"><thead><tr>';
						if($lang == 'en'){
							$days = ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];
						}else
							$days = ['Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'];
						for($i = 0; $i < 6; $i++){
							echo '<th><a href="index.php?site=1&f_date='.$date[$i].'" title="'.$date[$i].'">'.$days[$i].'</a></th>';
						}
						echo '</tr></thead><tbody>';
						$tip = "";
						if (isset($_GET['f_date'])){
							$fdate = $_GET['f_date'];
							echo '<tr><th id="date" colspan="6">'.$fdate.'</th></tr>';
							while($tipusok = mysqli_fetch_array($result2)){
								for($i = 0; $i < count($data); $i++){
									if($fdate == $data[$i]['datum'] && $tipusok['tipus'] == $data[$i]['tipus']){
										if ($tip !== $tipusok['tipus']){
											echo '<tr><th colspan="6">'.$tipusok['tipus'].'</th></tr>';
											$tip = $tipusok['tipus'];
										}
										if (is_file('images/'.$data[$i]['kep']) && filesize('images/'.$data[$i]['kep']) > 0) {
											echo '<tr><td colspan="2"><a href="images/'.$data[$i]['kep'].'" target="_blank"><img width="60px" height="50px" src="images/'.$data[$i]['kep'].'"></a></td>';
										}
										else echo '<tr><td colspan="2"><img width="60px" height="50px" src="images/no-img.jpg"></td>';
										echo '<td class="align-middle" colspan="3">'.$data[$i]['nev'].'</td><td colspan="1">'.$data[$i]['ar'].' Ft</tr>';
									}
								}
							}
						}
						echo '</tbody></table></div></div>';
						break;
					case 2:
						echo '<h1>'.$contact.'</h1>
						<hr class="line"></hr>
						<div class="right">'.$contactcont.
						'</div>';
						break;
					case 3:
						echo '<h1>'.$rest.'</h1>
						<hr class="line"></hr>
						<div class="right">'.$restcont.'</div>';
						break;
					default:
						echo '<h1>'.$home.'</h1>
						<hr class="line"></hr>
						<div class="right">'.$homecont.'
						</div>';
				}
				?>
			</div>
		  <!-- BAL OLDAL-->  
			<div class="col-sm-12 col-md-4 col-md-pull-8 cont-left">
				<h1><?php echo $open;?></h1>
				<hr class="line"></hr>
				<div class="left">
					<p>Hetfő: 10.00 - 18.00<br> Kedd: 10.00 - 18.00<br>Szerda: 10.00 - 18.00<br>Csütörtök: 10.00 - 18.00<br>Péntek: 10.00 - 18.00<br>Szombat: 10.00 - 14.00</p>
				</div>
				<h1><?php echo $info;?></h1>
				<hr class="line"></hr>
				<div class="left">
				<?php
					for($i=0; $i<count($infos[0]); $i=$i+2){
					echo '<h2>'.$infos->a[$i].'</h2>';
					echo '<p>'.$infos->a[$i+1].'</p>';
					if($i+2 < count($infos[0])){
						echo '<hr></hr>';}
					}
				?>			
				</div>
		  </div>	  
		</div>
	</div>
  </div>