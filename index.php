<?php
$headfoo = parse_ini_file("main.ini",true);
$url = '';
$urland = '';
if(isset($_GET['lang'])){
	$lang = $_GET['lang'];
	if($lang == 'en'){
		$url = '?lang='.$lang;
		$urland = '&lang='.$lang;
	}
}else{
	$lang = 'hu';
}

$xml = simplexml_load_file('lang.xml');
$home = $xml->nav->home->$lang;
$menu = $xml->nav->menu->$lang;
$contact = $xml->nav->contact->$lang;
$rest = $xml->nav->rest->$lang;
$open = $xml->aside->open->$lang;
$info = $xml->aside->info->$lang;
$foocont = $xml->footer->contact->$lang;
$addr = $xml->footer->address->$lang;
include_once 'header.php';
include_once 'content.php';
include_once 'footer.php';
?>