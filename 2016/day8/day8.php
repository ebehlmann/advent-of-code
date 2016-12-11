<?php
	
	include 'input.php';	

	$screen = array(
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
		array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)
	);

	function add_rect($screen, $width, $height) {
		$y = 0;
		$x = 0;
		while($y < $height) {
			while($x < $width) {
				$screen[$y][$x] = "1";
				$x++;
			}
			$y++;
			$x = 0;
		}
		return $screen;
	}

	function rotate_y($screen, $row_to_shift, $amount_to_shift) {
		$i = 1;
		$screen_row = $screen[$row_to_shift];

		while($i <= $amount_to_shift) {
			$pixel_to_move = array_pop($screen[$row_to_shift]);
			array_unshift($screen[$row_to_shift], $pixel_to_move);
			$i++;
		}
		return $screen;
	}

	function rotate_x($screen, $column_to_shift, $amount_to_shift) {
		$current_values = array();
		foreach($screen as $row) {
			array_push($current_values, $row[$column_to_shift]);
		}

		$i = 1;

		while($i <= $amount_to_shift) {
			$pixel_to_move = array_pop($current_values);
			array_unshift($current_values, $pixel_to_move);
			$i++;
		}

		$position = 0;
		while(count($current_values) > 0) {
			$element_to_add = array_shift($current_values);
			$screen[$position][$column_to_shift] = $element_to_add;
			$position++;
		}
		return $screen;
	}

	function parse_input($screen, $input_string) {
		
		$input_array = explode(" ", $input_string);

		// ret instruction
		if($input_array[0] == "rect") {
			$x_pos = strpos($input_array[1], "x");
			$width = intval(substr($input_array[1], 0, $x_pos));
			$height = intval(substr($input_array[1], $x_pos + 1));
			$screen = add_rect($screen, $width, $height);
			return $screen;
		} else {

			$amount_to_shift = intval($input_array[4]);
			$rotate_instruction = explode("=", $input_array[2]);
			
			// rotate y instruction
			if($rotate_instruction[0] == "y") {
				$row_to_shift = intval($rotate_instruction[1]);
				$screen = rotate_y($screen, $row_to_shift, $amount_to_shift);
				return $screen;
			} else {
				// rotate x instruction
				$column_to_shift = intval($rotate_instruction[1]);
				$screen = rotate_x($screen, $column_to_shift, $amount_to_shift);
				return $screen;
			}
		}

	}

	$input_exploded = (explode("\n", $input));	
	
	foreach($input_exploded as $instruction) {
		$screen = parse_input($screen, $instruction);
	}

	$count = 0;

	foreach($screen as $row) {
		foreach($row as $pixel) {
			if($pixel == 1) {
				$count++;
			}
		}
	}

	echo $count . "<br />";

	echo "<table>";
		foreach($screen as $row) {
			echo "<tr>";
				foreach($row as $pixel) {
					if($pixel == 1) {
						echo "<td style='background-color: red'></td>";
					} else {
						echo "<td></td>";
					}
				}
			echo "</tr>";
		}
	echo "</table>";

	//echo $screen[0];
?>