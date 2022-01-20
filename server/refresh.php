<?php
// Current profile
if(isset($_SESSION["profile_id"])) {
	$sql = sprintf("SELECT EXISTS(SELECT * FROM `profiles` WHERE `profile_id`='%s')", $_SESSION["profile_id"]);
	$result = $connect->query($sql)->fetch_array()[0];
	if($result == "1") $current_profile = $_SESSION["profile_name"];
	else {
		unset($_SESSION["profile_id"]);
		unset($_SESSION["profile_name"]);
		$current_profile = "Guest";	
	}
} else $current_profile = "Guest";

// SQL queries
$sql = [
	"profiles" => "SELECT `profile_id`, `name` FROM `profiles` ORDER BY `profile_id` ASC",
	"labels" => "SELECT `label_id`, `label`, `description` FROM `labels` ORDER BY `label_id` ASC",
	"hours" => "SELECT `hour_id`, `hour` FROM `hours` ORDER BY `hour` ASC",
	"dates" => "SELECT `date_id`, `date` FROM `dates` ORDER BY `date` DESC",
];

// Arrays
$data = [];
$out = [];
$select_out = [];

// Data
foreach($sql as $key => $val)
	$data[$key] = $connect->query($val)->fetch_all();

// Output select data
foreach($data as $key => $value)
	foreach($value as $val)
		$select_out[$key] .=
			($key == "labels") ?
				sprintf('<option value="%s">%s %s</option>', $val[0], $val[1], ($val[2] == "") ?
					"" : "- ".$val[2])
			: sprintf('<option value="%s">%s</option>', $val[0], $val[1]);

// Out labels
foreach($data["labels"] as $val) {
	$description = ($val[2] == "") ? "" : "- ". $val[2];
	$out["labels"] .= sprintf('<li>%s %s</li>', $val[1], $description);
}

// Out hours
foreach($data["hours"] as $val)
	$out["hours"] .= sprintf('<div class="cell">%s</div>', $val[1]);

// Out dates
foreach($data["dates"] as $val) {
	$date = explode("-", $val[1]);
	$out["dates"] .= sprintf('
		<div class="cell">
			<div class="cell_left">%s</div>
			<div class="cell_right">
				<div>%s</div>
				<div>%s<br>%s</div>
			</div>
		</div>
	', $date[2], $date[1], substr($date[0], -2), substr($date[0], 2));
}

// Out cells
for($i = 0; $i < count($data["dates"]); $i++) {
	$out["cells"] .= '<div class="row">';
	for($j = 0; $j < count($data["hours"]); $j++)
		$out["cells"] .= '<div class="cell" id="d'.$data["dates"][$i][0].'-h'.$data["hours"][$j][0].'"></div>';
	$out["cells"] .= '</div>';
}

// Return data
return response(200, [
	"data" => $data,
	"out" => $out,
	"select_out" => $select_out,
	"current_profile" => $current_profile
]);