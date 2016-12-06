<?php

	set_time_limit(180);

	$input = "wtnhxymk";

	$password = "";

	$i = 0;

	$password_array = (array("", "", "", "", "", "", "", ""));

	while(in_array("", $password_array, true)) {
		$string_to_hash = $input . $i;
		$hash = md5($string_to_hash);

		if(strcmp(substr($hash, 0, 5), "00000") == 0) {
			$password_index = substr($hash, 5, 1);
			if($password_index < 8 && $password_array[$password_index] == "") {
				$password_array[$password_index] = substr($hash, 6, 1);
			}
		}

		$i++;
	}

	//print_r($password_array);
	echo substr(implode("", $password_array), 0, 8);

?>