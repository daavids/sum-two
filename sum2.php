<?php
/*
This is basically a re-write of 
https://www.geeksforgeeks.org/sum-two-large-numbers/
but in PHP and with file r/w
*/
function sum2() {
	ini_set("auto_detect_line_endings", true);

	$input = fopen('input_file.in', 'r');
	$output = fopen('output_file.out', 'w');

	if (!$input || !$output) {
		return;
	}

	$lines = [];
	while (!feof($input)) {
		$lines[] = fgets($input, 9999);
	}

	fclose($input);

	if (isset($lines) && !empty($lines)) {
		// longer string has to be second
		if (strlen($lines[0]) > strlen($lines[1])) {
			$str1 = $lines[1];
			$str2 = $lines[0];
		} else {
			$str1 = $lines[0];
			$str2 = $lines[1];
		}

		$result = "";
		$str1 = strrev(str_replace(' ', '', $str1)); // reverse and remove spaces
		$str2 = strrev(str_replace(' ', '', $str2));

		$count1 = strlen($str1);
		$count2 = strlen($str2);
		
		$carry = 0; // digit to carry over

		for ($i = 1; $i < $count1; $i++) { // fgets() returns a string+\n, so have to start at 1
			$sum = (intval($str1[$i]) + intval($str2[$i]) + $carry);
			$result .= $sum%10;
			$carry = intval($sum/10);
		}

		for ($i = $count1; $i < $count2; $i++) {
			$sum = (intval($str2[$i]) + $carry);
			$result .= $sum%10;
			$carry = intval($sum/10);
		}

		if ($carry) {
			$result .= $carry;
		}

		$result = strrev($result);
		fwrite($output, $result);
		fclose($output);
	}
	return;
}

sum2();
