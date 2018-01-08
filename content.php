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
					echo '<h1>Étlap</h1>
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
					echo '<h1>Elérhetőség</h1>
					<hr class="line"></hr>
					<div class="right"><p>Integer tempor dolor at lacus imperdiet pulvinar. Nullam id sem orci. Maecenas pellentesque bibendum turpis, et porta nisl consectetur eu. Cras vel elit auctor lacus vestibulum lobortis. Nulla eget diam in purus tempor sodales. Aenean consectetur vestibulum metus, sit amet ornare neque dignissim nec. In dictum eros sed magna finibus, eget varius tortor sollicitudin.</p>
					<div class="google-maps"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d341134.1143436711!2d20.39556932517015!3d48.08881441320263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47409e878d72ebe7%3A0x400c4290c1e11b0!2sMiskolc!5e0!3m2!1shu!2shu!4v1515334936942" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe></div><br></div>';
					break;
				case 3:
					echo '<h1>Éttermeink</h1>
					<hr class="line"></hr>
					<div class="right"><p>Nullam in est enim. Nullam vel porta dui. Duis faucibus, est non elementum consequat, dui risus mollis lorem, eu condimentum leo dolor a nunc. Integer aliquam eros tellus, id laoreet odio rutrum a. Ut vestibulum dui massa, sit amet venenatis dui vestibulum quis. Nullam maximus consectetur commodo. Donec euismod magna a turpis malesuada, vel ultricies eros pellentesque.</p></div>';
					break;
				default:
					echo '<h1>Főoldal</h1>
					<hr class="line"></hr>
					<div class="right"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis congue faucibus velit, et blandit ipsum bibendum at. 
					Sed accumsan lorem sit amet lobortis condimentum. Duis eu urna vel nulla mollis rhoncus at sed purus. Donec tempus sodales lobortis. 
					Sed risus neque, eleifend pellentesque sem sit amet, ultricies porttitor metus. Etiam eget elit sit amet enim ullamcorper imperdiet. 
					Proin non sapien leo. Vivamus libero ex, fermentum eu condimentum porttitor, faucibus accumsan tortor. Morbi semper blandit enim, 
					vitae dapibus lacus lacinia non. Nunc augue tellus, aliquam eget augue eget, placerat dictum ante. Nulla ullamcorper fermentum diam nec 
					dictum. Nulla facilisi. Nam tempor consectetur ipsum, a fermentum nulla luctus non. Curabitur mollis ante vitae enim commodo, 
					ut pulvinar ligula scelerisque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
					Suspendisse nunc tellus, elementum rutrum hendrerit et, pharetra in nulla.</p>
					</div>';
		}
			?>
		  </div>
		  <!-- BAL OLDAL-->  
		  <div class="col-sm-12 col-md-4 col-md-pull-8 cont-left">
			<h1>Nyitvatartás</h1>
			<hr class="line"></hr>
			<div class="left">
				<p>
					Hetfő: 10.00 - 18.00<br> Kedd: 10.00 - 18.00<br>Szerda: 10.00 - 18.00<br>Csütörtök: 10.00 - 18.00<br>Péntek: 10.00 - 18.00<br>Szombat: 10.00 - 14.00
				</p>
			</div>
			<h1>Információ</h1>
			<hr class="line"></hr>
			<div class="left">
<?php		for($i=0; $i<count($headfoo['infos']); $i=$i+2){
			echo '<h2>'.$headfoo['infos'][$i].'</h2>';
			echo '<p>'.$headfoo['infos'][$i+1].'</p>';
			if($i+2 < count($headfoo['infos'])){
				echo '<hr></hr>';}
			}
?>			</div>
		  </div>	  
		</div>
	</div>
  </div>