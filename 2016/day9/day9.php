<?php

	include 'input.php';
	//$input = preg_replace('/\s/', '', $input);

	$input = "A(2x2)BCD(2x2)EFG";

	$result = "";

	function parse_marker($marker_string) {
		$x_pos = strpos($marker_string, "x");
		$chars_to_repeat = intval(substr($marker_string, 1, $x_pos-1));
		$times_to_repeat = intval(substr($marker_string, $x_pos+1, strlen($marker_string - (strlen($chars_to_repeat)+ 3))));
		return array($chars_to_repeat, $times_to_repeat);
	}

	$i = 0;

	while($i < strlen($input)) {
		if($input[$i] != "(") {
			$result = $result . $input[$i];
		}
		$i++;
	}

	echo $result;

?>