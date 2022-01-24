<?php
if(isset($_GET["t"]) && isset($_GET["id"])) {
	$type = $_GET["t"];
	$id = $_GET["id"];
	switch($type) {
		case "profile":
			$sql = sprintf("DELETE `profiles`, `cells` FROM `profiles` LEFT JOIN `cells` USING(`profile_id`) WHERE `profiles`.`profile_id`='%s'", $id);
		break;
		case "label":
			$sql = sprintf("DELETE `labels`, `cells` FROM `labels` LEFT JOIN `cells` USING(`label_id`) WHERE `labels`.`label_id`='%s'", $id);
		break;
		case "hour":
			$sql = sprintf("DELETE `hours`, `cells` FROM `hours` LEFT JOIN `cells` USING(`hour_id`) WHERE `hours`.`hour_id`='%s'", $id);
		break;
		case "date":
			$sql = sprintf("DELETE `dates`, `cells` FROM `dates` LEFT JOIN `cells` USING(`date_id`) WHERE `dates`.`date_id`='%s'", $id);
		break;
		default: return response(400); break;
	}
	if(!$connect->query($sql)) return response(400, $connect->error);
	else return response(201);
} else return response(400);