<?php
date_default_timezone_set('UTC');

// Check current date
$date = date("Y-m-d");
$sql = sprintf($arr_sql["check_exists"], $date);
if($connect->query($sql)->fetch_array()[0] == "0") {
	// Adding today's date
	$sql = sprintf($arr_sql["check_insert"], $date);
	if($connect->query($sql)) return response(201);
	else return response(400, $connect->error);
}

return response(200);