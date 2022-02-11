<?php
if(isset($_GET["t"]) && isset($_GET["id"])) {
	$type = $_GET["t"]; $id = $_GET["id"];
	$sql = sprintf($arr_sql["delete_". $type], $_SESSION["user_id"], $id);
	if($sql == NULL) return response(400);
	if(!$connect->query($sql)) return response(400, $connect->error);
	else return response(201);
} else return response(400);