<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php 
	include_once('libs/curl_query.php');
	include_once('libs/simple_html_dom.php');
	$html = new simple_html_dom();
	#$html = curl_get ('http://ntschool.ru/kursyi');
	$html->load_file('https://www.ukr.net/ru/');
	echo $html;

 ?>

	
</body>
</html>