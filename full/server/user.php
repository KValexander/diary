<?php
if(isset($_GET["t"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
	$type = $_GET["t"];
	switch($type) {
		case "change":
			$sql = sprintf($arr_sql["get_user"], "token", request("token"));
			if(!$user = $connect->query($sql)->fetch_assoc())
				return response(422);
			$_SESSION["user_id"] = $user["user_id"];
		break;
		default: return response(400); break;
	} return response(200);
} else return response(400);