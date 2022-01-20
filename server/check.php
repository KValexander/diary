<?php
date_default_timezone_set('UTC');

// Check current date
$date = date("Y-m-d");
$sql = sprintf("SELECT EXISTS(SELECT * FROM `dates` WHERE `date`='%s')", $date);
if($connect->query($sql)->fetch_array()[0] == "0") {
	$sql = sprintf("INSERT INTO `dates`(`date`) VALUES('%s')", $date);
	if($connect->query($sql)) return response(201);
	else return response(400, $connect->error);
}

return response(200);