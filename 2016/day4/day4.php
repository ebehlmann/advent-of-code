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
		$temp_array = array();

		//ksort($room_name_array);
		arsort($room_name_array);

		while($item = current($room_name_array)) {
			$room_checksum = $room_checksum . key($room_name_array);
			next($room_name_array);
		}
		
		return substr($room_checksum, 0, 5);
	}

	// split input into array by line breaks
  	$input_exploded = (explode("\n", $input));
  	$total = 0;

  	foreach($input_exploded as $room) {
  		$broken_down_room = break_down_room_code($room);
  		$room_name_array = find_frequency_of_letters($broken_down_room[0]);
  		//echo find_checksum($room_name_array)."<br />";
  		if(find_checksum($room_name_array) == $broken_down_room[2]) {
  			$total += $broken_down_room[1];
  		}
  	}

  	echo $total;

  	/*
  	print_r(break_down_room_code("aaaaa-bbb-z-y-x-124[abxyz]"));
  	echo "<br /><br />";
  	print_r(find_frequency_of_letters("bbbbbaaaaabzyx"));
  	echo "<br /><br />";
  	print_r(find_checksum(find_frequency_of_letters("bbbbbaaaaabzyx")));
  	*/

?>