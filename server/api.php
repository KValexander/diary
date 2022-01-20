<?php
session_start();
include "connect.php";
include "helpers.php";

// Routes
$routes = [
	"/check" => "check.php", // check current date
	"/refresh" => "refresh.php", // refresh data page
	"/select" => "select.php", // select current profile
	"/get" 	=> "get.php", // get data
	"/add" 	=> "add.php", // add data
	"/update" => "update.php", // update data
	"/delete" => "delete.php", // delete data
];

if(array_key_exists($_SERVER["REDIRECT_URL"], $routes))
	include $routes[$_SERVER["REDIRECT_URL"]];
else header("Location:/");