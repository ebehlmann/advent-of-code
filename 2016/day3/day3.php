<?php

	include 'input.php';

  	$input_exploded = (explode("  ", $input));

	function triangle_checker($sides) {
		sort($sides);
		if($sides[0] + $sides[1] <= $sides[2]) {
			return false;
		} else {
			return true;
		}
	}

	function loop_through_sides($sides_array) {
		$triangle_count = 0;

		while(count($sides_array) > 0) {
			$side_1 = intval(array_pop($sides_array));
			if($side_1 == 0 || $side_1 == null) {
				$side_1 = intval(array_pop($sides_array));
			}

			$side_2 = intval(array_pop($sides_array));
			if($side_2 == 0 || $side_2 == null) {
				$side_2 = intval(array_pop($sides_array));
			}

			$side_3 = intval(array_pop($sides_array));
			if($side_3 == 0 || $side_3 == null) {
				$side_3 = intval(array_pop($sides_array));
			}

			$triangle_to_check = array($side_1, $side_2, $side_3);
			if(triangle_checker($triangle_to_check) == true) {
				$triangle_count++;
			}
		}

		return $triangle_count;
	}
	
	echo loop_through_sides($input_exploded);

?>