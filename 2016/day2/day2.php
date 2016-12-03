<?php
	$bathroom_keypad1 = array(array(1, 2, 3), array(4, 5, 6), array(7, 8, 9));
	$bathroom_keypad2 = array(array(1), array(2, 3, 4), array(5, 6, 7, 8, 9), array("A", "B", "C"), array("D"));
	
	$example = array("ULL", "RRDDD", "LURDL", "UUUUD");

	$bathroom_keys = array("UDRLRRRUULUUDULRULUDRDRURLLDUUDURLUUUDRRRLUUDRUUDDDRRRLRURLLLDDDRDDRUDDULUULDDUDRUUUDLRLLRLDUDUUUUDLDULLLDRLRLRULDDDDDLULURUDURDDLLRDLUDRRULDURDDLUDLLRRUDRUDDDLLURULRDDDRDRRLLUUDDLLLLRLRUULRDRURRRLLLLDULDDLRRRRUDRDULLLDDRRRDLRLRRRLDRULDUDDLDLUULRDDULRDRURRURLDULRUUDUUURDRLDDDURLDURLDUDURRLLLLRDDLDRUURURRRRDRRDLUULLURRDLLLDLDUUUDRDRULULRULUUDDULDUURRLRLRRDULDULDRUUDLLUDLLLLUDDULDLLDLLURLLLRUDRDLRUDLULDLLLUDRLRLUDLDRDURDDULDURLLRRRDUUDLRDDRUUDLUURLDRRRRRLDDUUDRURUDLLLRRULLRLDRUURRRRRLRLLUDDRLUDRRDUDUUUDRUDULRRULRDRRRDDRLUUUDRLLURURRLLDUDRUURDLRURLLRDUDUUDLLLUULLRULRLDLRDDDU", 
	"DRRRDRUDRLDUUDLLLRLULLLUURLLRLDRLURDRDRDRLDUUULDRDDLDDDURURUDRUUURDRDURLRLUDRRRDURDRRRDULLRDRRLUUUURLRUULRRDUDDDDUURLDULUDLLLRULUDUURRDUULRRDDURLURRUDRDRLDLRLLULULURLRDLRRRUUURDDUUURDRDRUURUDLULDRDDULLLLLRLRLLUDDLULLUDDLRLRDLDULURDUDULRDDRLUDUUDUDRLLDRRLLDULLRLDURUDRLRRRDULUUUULRRLUDDDLDUUDULLUUURDRLLULRLDLLUUDLLUULUULUDLRRDDRLUUULDDRULDRLURUURDLURDDRULLLLDUDULUDURRDRLDDRRLRURLLRLLLLDURDLUULDLDDLULLLRDRRRDLLLUUDDDLDRRLUUUUUULDRULLLDUDLDLURLDUDULRRRULDLRRDRUUUUUURRDRUURLDDURDUURURULULLURLLLLUURDUDRRLRRLRLRRRRRULLDLLLRURRDULLDLLULLRDUULDUDUDULDURLRDLDRUUURLLDLLUUDURURUD",
	"UDUUUUURUDLLLRRRDRDRUDDRLLDRRLDRLLUURRULUULULRLLRUDDRLDRLUURDUDLURUULLLULLRRRULRLURRDDULLULULRUDDDUURDRLUDUURRRRUUULLRULLLDLURUDLDDLLRRRULDLLUURDRRRDRDURURLRUDLDLURDDRLLLUUDRUULLDLLLLUUDRRURLDDUDULUDLDURDLURUURDUUUURDLLLRUUURDUUUDLDUDDLUDDUDUDUDLDUDUUULDULUURDDLRRRULLUDRRDLUDULDURUURULLLLUDDDLURURLRLRDLRULRLULURRLLRDUDUDRULLRULRUDLURUDLLDUDLRDRLRDURURRULLDDLRLDDRLRDRRDLRDDLLLLDUURRULLRLLDDLDLURLRLLDULRURRRRDULRLRURURRULULDUURRDLURRDDLDLLLRULRLLURLRLLDDLRUDDDULDLDLRLURRULRRLULUDLDUDUDDLLUURDDDLULURRULDRRDDDUUURLLDRDURUDRUDLLDRUD", 
	"ULRDULURRDDLULLDDLDDDRLDUURDLLDRRRDLLURDRUDDLDURUDRULRULRULULUULLLLDRLRLDRLLLLLRLRRLRLRRRDDULRRLUDLURLLRLLURDDRRDRUUUDLDLDRRRUDLRUDDRURRDUUUDUUULRLDDRDRDRULRLLDLDDLLRLUDLLLLUURLDLRUDRLRDRDRLRULRDDURRLRUDLRLRLDRUDURLRDLDULLUUULDRLRDDRDUDLLRUDDUDURRRRDLDURRUURDUULLDLRDUDDLUDDDRRRULRLULDRLDDRUURURLRRRURDURDRULLUUDURUDRDRLDLURDDDUDDURUDLRULULURRUULDRLDULRRRRDUULLRRRRLUDLRDDRLRUDLURRRDRDRLLLULLUULRDULRDLDUURRDULLRULRLRRURDDLDLLRUUDLRLDLRUUDLDDLLULDLUURRRLRDULRLRLDRLDUDURRRLLRUUDLUURRDLDDULDLULUUUUDRRULLLLLLUULDRULDLRUDDDRDRDDURUURLURRDLDDRUURULLULUUUDDLRDULDDLULDUDRU",
	"LRLRLRLLLRRLUULDDUUUURDULLLRURLDLDRURRRUUDDDULURDRRDURLRLUDLLULDRULLRRRDUUDDRDRULLDDULLLUURDLRLRUURRRLRDLDUDLLRLLURLRLLLDDDULUDUDRDLRRLUDDLRDDURRDRDUUULLUURURLRRDUURLRDLLUDURLRDRLURUURDRLULLUUUURRDDULDDDRULURUULLUDDDDLRURDLLDRURDUDRRLRLDLRRDDRRDDRUDRDLUDDDLUDLUDLRUDDUDRUDLLRURDLRUULRUURULUURLRDULDLDLLRDRDUDDDULRLDDDRDUDDRRRLRRLLRRRUUURRLDLLDRRDLULUUURUDLULDULLLDLULRLRDLDDDDDDDLRDRDUDLDLRLUDRRDRRDRUURDUDLDDLUDDDDDDRUURURUURLURLDULUDDLDDLRUUUULRDRLUDLDDLLLRLLDRRULULRLRDURRRLDDRDDRLU");

	function is_edge($keypad, $row_index, $position_in_row) {
		if($position_in_row == 0 || $position_in_row == count($keypad[$row_index])-1) {
			return true;
		} else {
			return false;
		}
	}

	function find_security_code_number($key, $keypad, $starting_row_index, $starting_position_in_row) {
		$key_length = strlen($key);
		$i = 0;
		$current_row_index = $starting_row_index;
		$current_position_in_row = $starting_position_in_row;

		//echo "starting at ".$current_row_index." and ".$current_position_in_row."<br />";

		while($i < $key_length) {
			
			switch($key[$i]) {
				case "U":
					/*
					if($current_row_index > 0 && count($keypad[$current_row_index]) <= count($keypad[$current_row_index-1])) {
						$current_row_index--;
					}
					*/
					// not at the top and
					if($current_row_index > 0 && 
					// either is not on an edge or is below a larger row
					(is_edge($keypad, $current_row_index, $current_position_in_row) == false ||
					count($keypad[$current_row_index]) <= count($keypad[$current_row_index-1]))) {
						
						//echo "going up 1<br />";
						if(count($keypad[$current_row_index]) < count($keypad[$current_row_index-1])) {
							$current_position_in_row += 1;
							//echo "increasing index. index is now ".$current_position_in_row."<br />";
						} else {
							$current_position_in_row -= 1;
							//echo "reducing index. index is now ".$current_position_in_row."<br />";
						}
						$current_row_index--;
					} else {
						//echo "direction is up. not moving<br />";
					}
					break;
				case "D":
					/*
					if($current_row_index < count($keypad) && count($keypad[$current_row_index]) <= count($keypad[$current_row_index+1])) {
						$current_row_index++;
					}
					*/
					// not at the bottom and
					if($current_row_index < (count($keypad)-1) && 
					// either is not on an edge or is above a larger row
					(is_edge($keypad, $current_row_index, $current_position_in_row) == false ||
					count($keypad[$current_row_index]) <= count($keypad[$current_row_index+1]))) {
	
						//echo "going down 1<br />";
						if(count($keypad[$current_row_index]) > count($keypad[$current_row_index+1])) {
							$current_position_in_row -= 1;
							//echo "reducing index. index is now".$current_position_in_row."<br />";
						} else {
							$current_position_in_row +=1;
							//echo "increasing index. index is now".$current_position_in_row."<br />";
						}
						$current_row_index++;
					} else {
						//echo "direction is down. not moving<br />";
					}
					break;
				case "R":
					if($current_position_in_row < count($keypad[$current_row_index])-1) {
						$current_position_in_row++;
						//echo "going right 1<br />";
					} else {
						//echo "direction is right. not moving<br />";
					}
					break;
				case "L":
					if($current_position_in_row > 0) {
						$current_position_in_row--;
						//echo "going left 1<br />";
					} else {
						//echo "direction is left. not moving<br />";
					}
					break;
			}

			$i++;
		}

		return array($current_row_index, $current_position_in_row, $keypad[$current_row_index][$current_position_in_row]);
	}

	echo "The key code for the bathroom is: ";
	
	$row = 2;
	$position = 0;

	foreach($bathroom_keys as $key) {
		$result = find_security_code_number($key, $bathroom_keypad2, $row, $position);
		$row = $result[0];
		$position = $result[1];
		echo $result[2];
	}

?>