<?php
	// SQL queries
	$arr_sql = [
		// user
		"add_user" => "INSERT INTO `users`(`ips`, `token`) VALUES('%s', '%s')",
		"get_user" => "SELECT * FROM `users` WHERE `%s`='%s'",
		// refresh.php
		"refresh_exists" => "SELECT EXISTS(SELECT * FROM `profiles` WHERE `profile_id`='%s')",
		"refresh_profiles" => "SELECT `profile_id`, `name` FROM `profiles` ORDER BY `profile_id` ASC",
		"refresh_labels" => "SELECT `label_id`, `label`, `description` FROM `labels` ORDER BY `label_id` ASC",
		"refresh_hours" => "SELECT `hour_id`, `hour` FROM `hours` ORDER BY `hour` ASC",
		"refresh_dates" => "SELECT `date_id`, `date` FROM `dates` ORDER BY `date` DESC",
		"refresh_cells" => "SELECT * FROM `cells` INNER JOIN `labels` USING(`label_id`) WHERE `profile_id`='%s'",
		// check.php
		"check_exists" => "SELECT EXISTS(SELECT * FROM `dates` WHERE `date`='%s')",
		"check_insert" => "INSERT INTO `dates`(`date`) VALUES('%s')",
		// select.php
		"select_get" => "SELECT * FROM `profiles` WHERE `profile_id`='%s'",
		// get.php
		"get_profile" => "SELECT * FROM `profiles` %s ORDER BY `profile_id` ASC",
		"get_label" => "SELECT * FROM `labels` %s ORDER BY `label_id` ASC",
		"get_hour" => "SELECT * FROM `hours` %s ORDER BY `hour_id` ASC",
		"get_date" => "SELECT * FROM `dates` %s ORDER BY `date_id` ASC",
		// add.php
		"add_profile" => "INSERT INTO `profiles`(`name`) VALUES('%s')",
		"add_label" => "INSERT INTO `labels`(`label`, `description`) VALUES('%s', '%s')",
		"add_hour" => "INSERT INTO `hours`(`hour`) VALUES('%s')",
		"add_date" => "INSERT INTO `dates`(`date`) VALUES('%s')",
		// update.php
		"update_profile" => "UPDATE `profiles` SET `name`='%s' WHERE `profile_id`='%s'",
		"update_label" => "UPDATE `labels` SET `label`='%s', `description`='%s' WHERE `label_id`='%s'",
		"update_hour" => "UPDATE `hours` SET `hour`='%s' WHERE `hour_id`='%s'",
		"update_date" => "UPDATE `dates` SET `date`='%s' WHERE `date_id`='%s'",
		// delete.php
		"delete_profile" => "DELETE `profiles`, `cells` FROM `profiles` LEFT JOIN `cells` USING(`profile_id`) WHERE `profiles`.`profile_id`='%s'",
		"delete_label" => "DELETE `labels`, `cells` FROM `labels` LEFT JOIN `cells` USING(`label_id`) WHERE `labels`.`label_id`='%s'",
		"delete_hour" => "DELETE `hours`, `cells` FROM `hours` LEFT JOIN `cells` USING(`hour_id`) WHERE `hours`.`hour_id`='%s'",
		"delete_date" => "DELETE `dates`, `cells` FROM `dates` LEFT JOIN `cells` USING(`date_id`) WHERE `dates`.`date_id`='%s'",
		// cell.php
		"cell_id" => "SELECT `cell_id` FROM `cells` WHERE `profile_id`='%s' AND `hour_id`='%s' AND `date_id`='%s'",
		"cell_add" => "INSERT INTO `cells`(`profile_id`, `hour_id`, `date_id`, `label_id`) VALUES('%s', '%s', '%s', '%s')",
		"cell_update" => "UPDATE `cells` SET `profile_id`='%s',`hour_id`='%s',`date_id`='%s',`label_id`='%s' WHERE `cell_id`='%s'",
		"cell_delete" => "DELETE FROM `cells` WHERE `cell_id`='%s'",
		"cell_label" => "SELECT `label`, `description` FROM `labels` WHERE `label_id`='%s'",
	];
