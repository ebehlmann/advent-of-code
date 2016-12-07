<?php

	include 'input.php';

	$message = "";

	function get_letter_breakdown($input_array, $index) {

		$letter_breakdown = array();

		foreach($input_array as $item) {
			$letter_breakdown[$item[$index]] += 1;
		}

		return $letter_breakdown;

	}

	function find_most_common_letter($letter_breakdown_array) {

		$letter = "";
		arsort($letter_breakdown_array);

		foreach($letter_breakdown_array as $letter_name => $letter_count) {
			if(strlen($letter) == 0) {
				$letter = $letter . $letter_name;
			}
		}

		return $letter;

	}

	$input_exploded = (explode("\n", $input));

	$current_letter = 0;

	while(strlen($message) < strlen($input_exploded[0])) {

		$letter_breakdown = get_letter_breakdown($input_exploded, $current_letter);
		$letter_to_add = find_most_common_letter($letter_breakdown);
		$message = $message . $letter_to_add;
		$current_letter++;
	}

	echo $message;

?>