<?php
session_start();
include "connect.php";
include "helpers.php";
include "sql.php";

// Routes
$routes = [
	"/user" => "user.php", // user manipulation
	"/check" => "check.php", // check current date
	"/refresh" => "refresh.php", // refresh data page
	"/select" => "select.php", // select current profile
	"/get" 	=> "get.php", // get data
	"/add" 	=> "add.php", // add data
	"/update" => "update.php", // update data
	"/delete" => "delete.php", // delete data
	"/cell" => "cell.php", // cells
];

if(array_key_exists($_SERVER["REDIRECT_URL"], $routes))
	include $routes[$_SERVER["REDIRECT_URL"]];
else header("Location:/");