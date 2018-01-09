<?php
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
$xml = simplexml_load_file('pagedata.xml');
$home = $xml->nav->home->$lang;
$menu = $xml->nav->menu->$lang;
$header = $xml->head->restname;
$contact = $xml->nav->contact->$lang;
$rest = $xml->nav->rest->$lang;
$homecont = $xml->content->home->$lang;
$contactcont = $xml->content->contact->$lang;
$restcont = $xml->content->restaurants->$lang;
$open = $xml->aside->open->$lang;
$info = $xml->aside->info->$lang;
$infos = $xml->aside->infos->$lang;
$foocont = $xml->footer->contact->$lang;
$addr = $xml->footer->address->$lang;
$tel = $xml->footer->tel;
$city= $xml->footer->city;

include_once 'header.php';
include_once 'content.php';
include_once 'footer.php';
?>