<?php
$headfoo = parse_ini_file("main.ini",true);
$url = '';
if(isset($_GET['lang'])){
	$lang = $_GET['lang'];
	if($lang = 'en')
		$url = '?/lang='.$lang;
}else{
	$lang = 'hu';
}

$xml = simplexml_load_file('lang.xml');
$home = $xml->nav->home->$lang;

include_once 'header.php';
include_once 'content.php';
include_once 'footer.php';
?>