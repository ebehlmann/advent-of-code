<?php

	include 'input.php';

	function split_input($input) {

		$sequences = array();
		$hypernets = array();

		$i=0;
		$currently_on = "sequences";
		$char_set = "";

		while($i < strlen($input)) {
			
			if($currently_on == "sequences") {
				if($input[$i] != "[") {
					$char_set = $char_set . $input[$i];
				} else {
					array_push($sequences, $char_set);
					$char_set = "";
					$currently_on = "hypernets";
				}
			} else {
				if($input[$i] != "]") {
					$char_set = $char_set . $input[$i];
				} else {
					array_push($hypernets, $char_set);
					$char_set = "";
					$currently_on = "sequences";
				}
			}

			$i++;
		}

		if($char_set != "") {
			array_push($sequences, $char_set);
		}

		return array($sequences, $hypernets);

	}

	function test_abba($sequence) {
		$i = 0;

		while($i < strlen($sequence) - 3) {
			$four_char = substr($sequence, $i, 4);
			//echo "testing " . $four_char . "<br />";
			if($four_char[0] == $four_char[3] && $four_char[1] == $four_char[2] && $four_char[0] != $four_char[1]) {
				return true;
			}
			$i++;
		}

		return false;
	}

	function test_aba($three_chars) {
		if($three_chars[0] == $three_chars[2] && $three_chars[0] != $three_chars[1]) {
			return true;
		} else {
			return false;
		}
	}

	function flip_aba($aba) {
		$result = "";
		$result = $result . $aba[1] . $aba[0] . $aba[1];
		return $result;
	}

	function test_ip_one($ip) {
		$sequences = $ip[0];
		$hypernets = $ip[1];

		foreach($hypernets as $hypernet) {
			if(test_abba($hypernet) == true) {
				return false;
			}
		}

		foreach($sequences as $sequence) {
			if(test_abba($sequence) == true) {
				return true;
			}
		}

		return false;
	}

	function test_ip_two($ip) {
		$sequences = $ip[0];
		$hypernets = $ip[1];

		$sequence_abas = array();
		$hypernet_abas = array();

		foreach($sequences as $sequence) {
			$i = 0;

			while($i < strlen($sequence) - 2) {
				$three_char = substr($sequence, $i, 3);
				if(test_aba($three_char) == true) {
					array_push($sequence_abas, $three_char);
				}
				$i++;
			}
		}

		if(count($sequence_abas) > 0) {

			foreach($hypernets as $hypernet) {
				$i = 0;

				while($i < strlen($hypernet) - 2) {
					$three_char = substr($hypernet, $i, 3);
					if(test_aba($three_char) == true) {
						array_push($hypernet_abas, $three_char);
					}
					$i++;
				}
			}

		} else {

			return false;

		}

		$sequence_abas_reversed = array();

		foreach($sequence_abas as $aba) {
			$reversed_aba = flip_aba($aba);
			array_push($sequence_abas_reversed, $reversed_aba);
		}

		$result = array_intersect($hypernet_abas, $sequence_abas_reversed);
		if(count($result) > 0) {
			return true;
		} else {
			return false;
		}

	}

	$count = 0;
	
	$input_exploded = (explode("\n", $input));

	foreach($input_exploded as $ip) {
		$result = test_ip_two(split_input($ip));

		if($result == true) {
			$count++;
		} 
	}

	echo $count;

?>
