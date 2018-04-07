<?php
function sum2() {
	ini_set("auto_detect_line_endings", true); // for end lines with \r

	$input = fopen('input_file.in', 'r'); // open input file in readmode
	$output = fopen('output_file.out', 'w'); // open output file in writemode

	if (!$input || !$output) { // if either don't open, return
		return;
	}

	while (!feof($input)) { // while hasn't reached the end of file
		$lines[] = fgets($input, 9999); // push lines to array
	}

	fclose($input); // close input file

	if (isset($lines) && !empty($lines)) { // if there are lines
		$sum = intval($lines[0]) + intval($lines[1]); // count the integer values of first two
		fwrite($output, $sum); // output the sum to the output file
		fclose($output); // close the output file
	}

	return;
}

sum2();