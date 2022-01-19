<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Diary</title>
	<link rel="stylesheet" href="style.css">
	<script src="scripts/script.js"></script>
	<script src="scripts/popup.js"></script>
	<script src="scripts/menu.js"></script>
</head>
<body>

	<!-- Application -->
	<div class="app">
		<div class="bar">
			<div class="left">
				<div class="cell"><div class="point">Menu</div></div>
				<!-- Out dates -->
				<div id="out_dates">
					<?= $out["dates"] ?>
				</div>
				<!-- End out dates -->
			</div>
			<div class="right">
				<!-- Out hours -->
				<div class="row" id="out_hours">
					<?= $out["hours"] ?>
				</div>
				<!-- End out hours -->
				<!-- Out cells -->
				<div class="bottom" id="out_cells">
					<?= $out["cells"] ?>
				</div>
				<!-- End out cells -->
			</div>
		</div>
	</div>
	<!-- End application -->

	<!-- Mask -->
	<div id="mask"></div>
	<!-- End mask -->

	<!-- Menu -->
	<div id="menu">

		<!-- Left -->
		<div class="main">
			<div class="point button" id="hide">Hide</div>
			<!-- Out labels -->
			<fieldset>
				<legend>Labels</legend>
				<ul id="out_labels"><?= $out["labels"] ?></ul>
			</fieldset><br>
			<!-- End out labels -->
			<div onclick="menu.show_side('labels')" class="point button">Labels</div>
			<div onclick="menu.show_side('profiles')" class="point button">Profiles</div>
			<div onclick="menu.show_side('directories')" class="point button">Directories</div>
		</div>
		<!-- End left -->

		<!-- Right -->
		<div class="side">
			<div class="point button" id="close">Close</div><br>
			<!-- Labels -->
			<div id="labels">
				<!-- Add label -->
				<fieldset>
					<legend>Labels</legend>
					<h3>Add label</h3><hr>
					<form onsubmit="return labels.add(event)">
						<div class="part">
							<input type="text" placeholder="Label" pattern="[\w]{1,8}" required>
							<button>Add</button>
						</div>
						<textarea placeholder="Description" pattern="[\w]{1,128}"></textarea>
					</form>
				</fieldset>
				<!-- End add label -->
				<!-- Actions -->
				<fieldset>
					<legend>Actions</legend>
					<form onsubmit="return labels.actions(event)">
						<select class="select_labels"></select>
						<div class="part row">
							<button value="update">Update</button>
							<button value="delete">Delete</button>
						</div>
					</form>
				</fieldset>
				<!-- End actions -->
			</div>
			<!-- End labels -->
			<!-- Profiles -->
			<div id="profiles">
				<fieldset>
					<legend>Profiles</legend>
					<!-- Select profile -->
					<h3>Current profile: <span id="current_profile"></span></h3><hr>
					<form onsubmit="return profiles.select(event)">
						<div class="part">
							<select class="select_profiles"></select>
							<button>Select</button>
						</div>
					</form><br>
					<!-- End select profile -->
					<!-- Add profile -->
					<h3>Add profile</h3><hr>
					<form onsubmit="return profiles.add(event)">
						<div class="part">
							<input type="text" placeholder="Profile name" pattern="[\w]{1,64}" required>
							<button>Add</button>
						</div>
					</form>
					<!-- End add profile -->
				</fieldset>
				<!-- Actions -->
				<fieldset>
					<legend>Actions</legend>
					<form onsubmit="return profiles.actions(event)">
						<select class="select_profiles"></select>
						<div class="part row">
							<button value="update">Update</button>
							<button value="delete">Delete</button>
						</div>
					</form>
				</fieldset>
				<!-- End actions -->
			</div>
			<!-- End profiles -->
			<!-- Directories -->
			<div id="directories">
				<!-- Hours -->
				<fieldset>
					<legend>Hours</legend>
					<!-- Add hour -->
					<h3>Add hour</h3><hr>
					<form onsubmit="return hours.add(event)">
						<div class="part">
							<input required pattern="[0-9]{2}:[0-9]{2}" type="text" placeholder="Hour">
							<button>Add</button>
						</div>
					</form><br>
					<!-- End add hour -->
					<!-- Actions -->
					<h3>Actions</h3><hr>
					<form onsubmit="return hours.actions(event)">
						<select class="select_hours"></select>
						<div class="part row">
							<button value="update">Update</button>
							<button value="delete">Delete</button>
						</div>
					</form>
					<!-- End actions -->
				</fieldset><br>
				<!-- End hours -->

				<!-- Dates -->
				<fieldset>
					<legend>Dates</legend>
					<!-- Add date -->
					<h3>Add date</h3><hr>
					<form onsubmit="return dates.add(event)">
						<div class="part">
							<input required type="date">
							<button>Add</button>
						</div>
					</form><br>
					<!-- End add date -->
					<!-- Actions -->
					<h3>Actions</h3><hr>
					<form onsubmit="return dates.actions(event)">
						<select class="select_dates"></select>
						<div class="part row">
							<button value="update">Update</button>
							<button value="delete">Delete</button>
						</div>
					</form>
					<!-- End actions -->
				</fieldset>
				<!-- End dates -->
			</div>
			<!-- End directories -->
		</div>
		<!-- End right -->

	</div>
	<!-- End menu -->

	<!-- Popup -->
	<div id="popup"><div id="message"></div></div>
	<!-- End popup -->
</body>
</html>