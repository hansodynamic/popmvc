<?php
function get_month_number($full_month)
{
	// Make the Month Lowercase
	$full_month = strtolower($full_month);

	// Determine the Month
	switch($full_month)
	{
		case 'january':
		case 'jan':
			$month = 1;
			break;
		case 'february':
		case 'feb':
			$month = 2;
			break;
		case 'march':
		case 'mar';
			$month = 3;
			break;
		case 'april':
		case 'apr':
			$month = 4;
			break;
		case 'may':
			$month = 5;
			break;
		case 'june':
		case 'jun':
			$month = 6;
			break;
		case 'july':
		case 'jul':
			$month = 7;
			break;
		case 'august':
		case 'aug':
			$month = 8;
			break;
		case 'september':
		case 'sept':
		case 'sep':
			$month = 9;
			break;
		case 'october':
		case 'oct':
			$month = 10;
			break;
		case 'november':
		case 'nov':
			$month = 11;
			break;
		case 'december':
		case 'dec':
			$month = 12;
			break;
		default:
			$month = false;
			break;
	}
	
	// Return the Month
	return $month;
}
?>