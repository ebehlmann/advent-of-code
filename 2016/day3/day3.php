<?php

	include 'input.php';

	function triangle_checker($sides) {
		sort($sides);
		if($sides[0] + $sides[1] <= $sides[2]) {
			return false;
		} else {
			return true;
		}
	}

	// for puzzle 1 only
	function loop_through_sides($sides_array) {
		$triangle_count = 0;

		while(count($sides_array) > 0) {
			$side_1 = array_pop($sides_array);
			$side_2 = array_pop($sides_array);
			$side_3 = array_pop($sides_array);

			$triangle_to_check = array($side_1, $side_2, $side_3);
			if(triangle_checker($triangle_to_check) == true) {
				$triangle_count++;
			}
		}

		return $triangle_count;
	}

	// for puzzle 2 only
	function loop_through_triangles($triangle_array) {
		$triangle_count = 0;

		foreach($triangle_array as $triangle) {
			if(triangle_checker($triangle) == true) {
				$triangle_count++;
			}
		}

		return $triangle_count;
	}

  	$input_exploded = (explode("  ", $input));

  	$zero_indexes = array();

  	$i = 0;

  	while($i < count($input_exploded)) {
  		$input_exploded[$i] = intval($input_exploded[$i]);
  		if($input_exploded[$i] == 0) {
  			array_push($zero_indexes, $i);
  		}
  		$i++;
  	}

  	foreach($zero_indexes as $index) {
  		unset($input_exploded[$index]);
  	}

  	$input_in_nines = array_chunk($input_exploded, 9);
  	
  	$input_in_threes = array();

  	while(count($input_in_nines) > 0) {
  		$array_1 = array();
  		$array_2 = array();
  		$array_3 = array();
  		$current_element = array_pop($input_in_nines);
  		array_push($array_1, $current_element[0], $current_element[3], $current_element[6]);
  		array_push($array_2, $current_element[1], $current_element[4], $current_element[7]);
  		array_push($array_3, $current_element[2], $current_element[5], $current_element[8]);
  		array_push($input_in_threes, $array_1, $array_2, $array_3);
  	}

  	echo loop_through_triangles($input_in_threes);

?>