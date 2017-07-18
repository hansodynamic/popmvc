<?php
/**
 * Converts items in an object into correct data types.
 *
 * @param &$object			Object to modify.
 *
 * @return $object
 */
function convert_value_types(&$object)
{
	foreach($object as &$item)
	{
		if (is_int($item)) {
			$item = (int)$item;
		}
		elseif (is_float($item) || is_numeric($item)) {
			$item = (float)$item;
		}
		elseif (is_object($item)) {
			convert_value_types($item);
		}
		elseif (is_array($item)) {
			continue;
		}
		else {
			$item = (string)$item;
		}
	}
	
	return $object;
}