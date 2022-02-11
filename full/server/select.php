<?php
// Select current profile
if(isset($_GET["t"])) {
	$type = $_GET["t"];
	$profile_id = $_GET["profile_id"];
	switch($type) {
		// Select
		case "select":
			if(isset($_GET["profile_id"])) {
				$sql = sprintf($arr_sql["select_get"], $_SESSION["user_id"], $profile_id);
				$result = $connect->query($sql);
				if(!$result) return response(400, $connect->error);
				if($profile = $result->fetch_assoc()) {
					$_SESSION["profile_id"] = $profile["profile_id"];
					$_SESSION["profile_name"] = $profile["name"];
					return response(200, $profile["name"]);
				} return response(400, "This profile does not exist");
			} else return response(400);
		break;
		// Deselect
		case "deselect":
			unset($_SESSION["profile_id"]);
			unset($_SESSION["profile_name"]);
			return response(200);
		break;
		// Error
		default: return response(400); break;
	}
// Error
} else return response(400);