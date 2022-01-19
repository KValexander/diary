<?php
// Select current profile
if(isset($_GET["profile_id"])) {
	$sql = sprintf("SELECT * FROM `profiles` WHERE `profile_id`='%s'", $_GET["profile_id"]);
	$result = $connect->query($sql);
	if(!$result) return response(400, $connect->error);
	if($profile = $result->fetch_assoc()) {
		$_SESSION["profile_id"] = $profile["profile_id"];
		$_SESSION["profile_name"] = $profile["name"];
		return response(200, $profile["name"]);
	} return response(400, "This profile does not exist");
// Clear current profile
} else if(isset($_GET["clear"])) {
	unset($_SESSION["profile_id"]);
	unset($_SESSION["profile_name"]);
	return response(200);
// Error
} else return response(400);