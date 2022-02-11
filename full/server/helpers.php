<?php
	// Sending a response
	function response($status, $data=NULL) {
		header("HTTP/1.1 ".$status);
		$response_args["status"] = $status;
		$response_args["data"] = $data;
		$json_response = json_encode($response_args);
		$response_args = array();
		header("Content-Type: application/json");
		echo $json_response;
	}

	// Get json data
	function request($key=NULL) {
		if($_SERVER["CONTENT_TYPE"] == 'application/json') {
			$data = file_get_contents('php://input');
			$array = json_decode($data, true);
		} else $array = array_merge($_REQUEST, $_FILES);
		$return = ($key === NULL) ? $array : $array[$key];
		return $return;
	}

	// Check user
	function check_user() {
		global $connect, $arr_sql;

		// Current user
		if(isset($_SESSION["user_id"])) {
			if(!$result = $connect->query(sprintf($arr_sql["get_user"], "user_id", $_SESSION["user_id"])))
				return response(400, $connect->error);

			if(!$user = $result->fetch_assoc()) $user = add_user();

		} else {
			
			if(!$result = $connect->query(sprintf($arr_sql["get_user"], "ips", $_SERVER["REMOTE_ADDR"])))
				return response(400, $connect->error);

			if(!$user = $result->fetch_assoc()) $user = add_user();

		}

		// Saving sessions
		$_SESSION["user_id"] = $user["user_id"];

		return $user["token"];
	}

	// Add user
	function add_user() {
		global $connect, $arr_sql;

		// Delete session
		unset($_SESSION["user_id"]);

		// Token generation
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$token = substr(str_shuffle($permitted_chars), 0, 30);
		
		// Adding a user
		$sql = sprintf($arr_sql["add_user"], $_SERVER["REMOTE_ADDR"], $token);
		if(!$connect->query($sql)) return response(400, $connect->error);
		
		// Return data
		return [
			"user_id" => $connect->insert_id,
			"token" => $token
		];
	}