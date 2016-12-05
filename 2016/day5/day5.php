<?php

	$input = "wtnhxymk";

	$password = "";

	$i = 0;

	while(strlen($password) < 8) {
		$string_to_hash = $input . $i;
		$hash = md5($string_to_hash);

		if(strcmp(substr($hash, 0, 5), "00000") == 0) {
			$password = $password . substr($hash, 5, 1);
		}

		$i++;
	}

	echo $password;

?>