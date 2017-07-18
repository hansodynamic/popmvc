<?php
/**
 * Determine whether an Array is associative or not.
 *
 * @param array $array				array to check.
 *
 * @return bool
 */
function is_assoc($array)
{
	return array_keys($array) !== range(0, count($array) - 1);
}

/**
 * Get an array of Items from Array A that aren't in Array B
 *
 * @param array		$array_a		array of possible returnable items.
 * @param array		$array_b		array of items to check against.
 * @param bool		$match_keys		determine whether to match the array key
 *									as well.
 *
 * @return array | FALSE			returns an array if there are matching
 *									items or FALSE if not.
 */
function get_items_from_a_not_in_b($array_a, $array_b, $match_keys = FALSE) 
{
	// Create the Return Array
	$return_array = array();
	
	// Check that both Arrays are actually Arrays
	if (is_array($array_a) && is_array($array_b))
	{
		// Determine if it's an Associative Array or not
		if (is_assoc($array_b) || $match_keys)
		{
			// Loop through and Compare
			foreach($array_a as $key_a=>$item_a)
			{
				// Set the Flag
				$in_array = FALSE;
				
				foreach($array_b as $key_b=>$item_b)
				{
					// If the Items Match, set the Flag
					if ($key_a == $key_b) {
						if ($array_a[$key_a] == $array_b[$key_b]) {
							$in_array = TRUE;
						}
					}
				}
				
				// Add the Item
				if (!$in_array) $return_array[$key_a] = $item_a;
			}
		}
		else
		{
			// Arrays non-associative
			foreach($array_a as $item_a) {
				if (!in_array($item_a, $array_b)) {
					$return_array[] = $item_a;
				}
			}
		}
		
		// Return the Results (or FALSE if no Results)
		return (!empty($return_array) ? $return_array : FALSE);
	}
	else return FALSE;
}

/**
 * Get an array of Items from Array A that are also in Array B
 *
 * @param array		$array_a		array of possible returnable items.
 * @param array		$array_b		array of items to check against.
 * @param bool		$match_keys		determine whether to match the array key
 *									as well.
 *
 * @return array | FALSE			returns an array if there are matching
 *									items or FALSE if not.
 */
function get_items_in_a_and_b($array_a, $array_b, $match_keys = FALSE)
{
	// Create the Return Array
	$return_array = array();
	
	// Check that both Arrays are actually Arrays
	if (is_array($array_a) && is_array($array_b))
	{
		// Determine if it's an Associative Array or not
		if (is_assoc($array_b) || $match_keys)
		{
			// Loop through and Compare
			foreach($array_a as $key_a=>$item_a)
			{
				// Set the Flag
				$in_array = FALSE;
				
				foreach($array_b as $key_b=>$item_b)
				{
					// If the Items Match, set the Flag
					if ($key_a == $key_b) {
						if ($array_a[$key_a] == $array_b[$key_b]) {
							$in_array = TRUE;
						}
					}
				}
				
				// Add the Item
				if ($in_array) $return_array[$key_a] = $item_a;
			}
		}
		else
		{
			// Arrays non-associative
			foreach($array_a as $item_a) {
				if (in_array($item_a, $array_b)) {
					$return_array[] = $item_a;
				}
			}
		}
	}
	else return FALSE;
}
?>