<?php

	include 'input.php';


	// returns array that includes room name (string), room number (integer) and checksum (string)
	function break_down_room_code($room_code) {
		$room_name = "";
		$room_number_as_string = "";
		$checksum = "";

		$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

		$room_code = explode("[", $room_code);
		$checksum = substr($room_code[1], 0, -1);

		$i=0;

		while($i < strlen($room_code[0])) {
			if($room_code[0][$i] != "-") {

				if(in_array($room_code[0][$i], $numbers, true)) {
					$room_number = $room_number . $room_code[0][$i];
				} else {
					$room_name = $room_name . $room_code[0][$i];
				}
			}
			$i++;
		}

		return array($room_name, intval($room_number), $checksum);

	}

	function break_down_room_code_keep_hyphens($room_code) {
		$room_name = "";
		$room_number_as_string = "";
		$checksum = "";

		$numbers = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

		$room_code = explode("[", $room_code);
		$checksum = substr($room_code[1], 0, -1);

		$i=0;

		while($i < strlen($room_code[0])) {
			if(in_array($room_code[0][$i], $numbers, true)) {
				$room_number = $room_number . $room_code[0][$i];
			} else {
				$room_name = $room_name . $room_code[0][$i];
			}
			$i++;
		}

		return array($room_name, intval($room_number), $checksum);

	}

	// returns an array that includes multiple arrays, each containing a letter and its count
	function find_frequency_of_letters($room_name) {
		$i = 0;
		$letter_breakdown = array();

		while($i < strlen($room_name)) {
			$letter_breakdown[$room_name[$i]] += 1;
			$i++;
		}

		return $letter_breakdown;
	}

	// returns the checksum for a room name
	function find_checksum($room_name_array) {
		$room_checksum = "";
		$temp_string = "";
		$temp_array = array();

		arsort($room_name_array);
		//print_r($room_name_array);

		$current_value = reset($room_name_array);

		while($item = current($room_name_array)) {
			if(current($room_name_array) == $current_value) {
				$temp_string = $temp_string . key($room_name_array);
			} else {
				$temp_array = str_split($temp_string, 1);
				sort($temp_array);
				$temp_string = implode($temp_array);
				$room_checksum = $room_checksum . $temp_string;
				$temp_string = "";
				$current_value = current($room_name_array);
				$temp_string = $temp_string . key($room_name_array);
			}
			next($room_name_array);
		}

		$temp_array = str_split($temp_string, 1);
		sort($temp_array);
		$temp_string = implode($temp_array);
		$room_checksum = $room_checksum . $temp_string;

		return substr($room_checksum, 0, 5);
	}

	function run_shift_cipher($room_code) {
		$alphabet = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");

		$room_code_array = break_down_room_code_keep_hyphens($room_code);
		$room_name = $room_code_array[0];
		$sector_id = $room_code_array[1];
		$checksum = $room_code_array[2];

		$room_name_decoded = "";

		$amount_to_advance = $sector_id % 26;
		
		$i = 0;

		while($i < strlen($room_name)) {
			if($room_name[$i] == "-") {
				$room_name_decoded = $room_name_decoded . " ";
			} else {
				$position = array_search($room_name[$i], $alphabet);
				if($amount_to_advance > (25 - $position)) {
					$new_letter = $alphabet[$amount_to_advance - (26 - $position)];
				} else {
					$new_letter = $alphabet[$position + $amount_to_advance];
				}

				$room_name_decoded = $room_name_decoded . $new_letter;
			}

			$i++;
		}

		return array($room_name_decoded, $sector_id, $checksum);
	}

	// split input into array by line breaks
  	$input_exploded = (explode("\n", $input));
  	$total = 0;
  	$real_rooms = array();
  	
  	foreach($input_exploded as $room) {
  		$broken_down_room = break_down_room_code($room);
  		$room_name_array = find_frequency_of_letters($broken_down_room[0]);
  		//echo find_checksum($room_name_array)."<br />";
  		if(find_checksum($room_name_array) == $broken_down_room[2]) {
  			$total += $broken_down_room[1];
  			array_push($real_rooms, $room);
  		}
  	}

  	echo $total . "<br />";

  	foreach($real_rooms as $room) {
  		print_r(run_shift_cipher($room));  
  		echo "<br />";
  	}	

?>