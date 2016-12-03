<?php
	$bunny_recruiting_doc = array(L2, L5, L5, R5, L2, L4, R1, R1, L4, R2, R1, L1, L4, R1, L4, L4, R5, R3, R1, L1, R1, L5, L1, R5, L4, R2, L5, L3, L3, R3, L3, R4, R4, L2, L5, R1, R2, L2, L1, R3, R4, L193, R3, L5, R45, L1, R4, R79, L5, L5, R5, R1, L4, R3, R3, L4, R185, L5, L3, L1, R5, L2, R1, R3, R2, L3, L4, L2, R2, L3, L2, L2, L3, L5, R3, R4, L5, R1, R2, L2, R4, R3, L4, L3, L1, R3, R2, R1, R1, L3, R4, L5, R2, R1, R3, L3, L2, L2, R2, R1, R2, R3, L3, L3, R4, L4, R4, R4, R4, L3, L1, L2, R5, R2, R2, R2, L4, L3, L4, R4, L5, L4, R2, L4, L4, R4, R1, R5, L2, L4, L5, L3, L2, L4, L4, R3, L3, L4, R1, L2, R3, L2, R1, R2, R5, L4, L2, L1, L3, R2, R3, L2, L1, L5, L2, L1, R4);


	function find_easter_bunny_hq($directions) {
		$x_coord = 0;
		$y_coord = 0;
		$facing = "N";
		//$locations_visited = array();
		//$location_as_string = "";

		foreach($directions as $direction) {
			$direction_turn_value = substr($direction, 0, 1);
			$direction_distance = substr($direction, 1);
			
			switch($facing) {
				case "N":
					if($direction_turn_value == "L") {
						$facing = "W";
						$x_coord -= $direction_distance;
						/*
						while($direction_distance > 0) {
							$x_coord -= 1;
							$location_as_string = $x_coord.", ".$y_coord;
							if(in_array($location_as_string, $locations_visited)) {
								echo $location_as_string."<br/>";
							}
							array_push($locations_visited, $location_as_string);
							$direction_distance--;
						}
						*/
					} else {
						$facing = "E";
						$x_coord += $direction_distance;
					}
					break;
				case "S":
					if($direction_turn_value == "L") {
						$facing = "E";
						$x_coord += $direction_distance;
					} else {
						$facing = "W";
						$x_coord -= $direction_distance;
					}
					break;
				case "E":
					if($direction_turn_value == "L") {
						$facing = "N";
						$y_coord += $direction_distance;
					} else {
						$facing = "S";
						$y_coord -= $direction_distance;
					}
					break;
				case "W":
					if($direction_turn_value == "L") {
						$facing = "S";
						$y_coord -= $direction_distance;
					} else {
						$facing = "N";
						$y_coord += $direction_distance;
					}
					break;
			}

		}

		return abs($x_coord) + abs($y_coord);
	}

	$distance = find_easter_bunny_hq($bunny_recruiting_doc);

	echo "The distance to the Easter Bunny is ".$distance." blocks."

?>