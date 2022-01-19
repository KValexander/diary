<?php
session_start();
include "connect.php";
include "helpers.php";

// Routes
$routes = [
	"/get" => "get.php",
	"/add" => "add.php",
	"/select" => "select.php",
	"/update" => "update.php",
	"/change" => "change.php",
	"/delete" => "delete.php",
];

if(array_key_exists($_SERVER["REDIRECT_URL"], $routes))
	include $routes[$_SERVER["REDIRECT_URL"]];
else header("Location:/");