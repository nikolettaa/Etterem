<!DOCTYPE html>
<html lang="en">
<head>
  <title>Étterem</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Encode+Sans|Kaushan+Script|Source+Sans+Pro|Raleway|Bree+Serif|Lobster" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="style.css" />
  </script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
<?php
$today = date('Y-m-d');
?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="/etterem/index.php<?php echo $url .'">' . $home;?></a></li>
         <li><a href="/etterem/index.php?site=1&f_date=<?php echo $today. $urland.'">'.$menu;?></a></li>
        <li><a href="/etterem/index.php?site=2<?php echo $urland.'">'.$contact;?></a></li>
        <li><a href="/etterem/index.php?site=3<?php echo $urland.'">'.$rest;?></a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid main">
<!-- FEJLÉC -->
	<div class="row hidden-xs">
		<div class="col-sm-12 col-md-10 col-md-offset-1 head">
			<div class="col-sm-5 head-left">
			  <h1><?php echo $header; ?></h1>
			  <a href="http://www.facebook.com/" target=""> <img class="fb" src="images/fb.jpg"></a>
			  <span class="lang">Lang:</span> 
			  <a href="?lang=hu">HU</a>
			  <a href="?lang=en">EN</a>
			</div>
			<div class="col-sm-7 head-right">
			 <img class="img-responsive img-fluid" src="images/rest2.png"/>
			</div>
		</div>
	</div>

	<div class="row head main-mobile hidden-sm hidden-md hidden-lg">
		<div class="col-sm-12 head-mobile">
			<div class="col-sm-6">
				<h1><?php echo $header; ?></h1>
			</div>
			<div class="col-sm-6">
				 Tel:<?php echo $tel; ?><br>
				 Cím:<?php echo $city; ?>
			</div>	
		</div>
	</div>