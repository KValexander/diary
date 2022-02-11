<?php
	$connect = new mysqli("localhost", "root", "root", "diary");
	$connect->set_charset("utf8");
	if($connect->connect_error)
		die("Connection failed: ". $connect->connect_error);