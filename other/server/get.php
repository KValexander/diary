<?php
if(isset($_GET["t"])) {
	$type = $_GET["t"];
	$id = (isset($_GET["id"])) ? $_GET["id"] : NULL;
	switch($type) {
		case "profile":
			$sql = sprintf($arr_sql["get_profile"], ($id == NULL) ? "" : sprintf("WHERE `profile_id`='%s'", $id));
		break;
		case "label":
			$sql = sprintf($arr_sql["get_label"], ($id == NULL) ? "" : sprintf("WHERE `label_id`='%s'", $id));
		break;
		case "hour":
			$sql = sprintf($arr_sql["get_hour"], ($id == NULL) ? "" : sprintf("WHERE `hour_id`='%s'", $id));
		break;
		case "date":
			$sql = sprintf($arr_sql["get_date"], ($id == NULL) ? "" : sprintf("WHERE `date_id`='%s'", $id));
		break;
		default: return response(400); break;
	} $result = $connect->query($sql);
	if($result) {
		$data = ($id == NULL) ? $result->fetch_all() : $result->fetch_assoc(); 
		return response(200, $data);	
	}; return response(400, $connect->error);
} else return response(400);