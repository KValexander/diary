<?php
include "connect.php";
include "helpers.php";

$routes = [
	"/add" => "add.php",
];

if(array_key_exists($_SERVER["REDIRECT_URL"], $routes))
	include $routes[$_SERVER["REDIRECT_URL"]];
else header("Location:/");