<?php
/**
 * Create a form select.
 *
 * @param string	$name			the name of the element.
 * @param array		$values			an array of options.
 * @param value		$selected		the selected value.
 * @param array		$attributes		additional attributes for the element.
 *
 * @return string
 */
function form_select($name, $values, $selected = null, $attributes = null)
{
	// Start the Select Code
	$code = '<select name="'.$name.'"';
	
	// Check if we have an attributes list
	if (!is_null($attributes)) {
		// Attributes are in an Array
		if (is_array($attributes)) {
			// Loop through the attributes and add them
			foreach($attributes as $attr=>$val) {
				$code .= ' '.$attr.'="'.$val.'"';
			}
		}
		// Otherwise, if we have a String
		elseif (is_string($attributes)) {
			$code .= $attributes;
		}
	}
	
	// Finish the Opening Tag
	$code .= '>';
	
	// Now Loop through the Values
	if (is_array($values)) {
		foreach($values as $value=>$text) {
			// Add the Option
			$code .= '<option value="'.$value.'"';
			
			// Check if the Value or Label Matches the Selected
			if (!is_null($selected) && (($text == $selected) || ($value == $selected))) {
				$code .= ' selected="selected"';
			}
			
			// Finish the Option
			$code .= '>'.$text.'</option>';
		}
	}
	
	// Close the Select Group
	$code .= '</select>';
	
	// Return the Code
	return $code;
}

/**
 * Create an array of radio buttons.
 *
 * @param string	$name			the name of the element.
 * @param array		$values			an array of options.
 * @param value		$selected		the selected value.
 * @param array		$attributes		additional attributes for the element.
 * @param string	$spacer			characters to print between each checkbox.
 *
 * @return string
 */
function form_radiogroup($name, $values, $selected = null, $attributes = null, $spacer = null)
{
	// Begin the Code
	$code = '';

	// Check we have a Values Array
	if (is_array($values))
	{
		foreach($values as $value=>$label)
		{
			// Start the Code with Label and Radio Input
			$code .= '<input type="radio" id="'.$name.'_'.$value.'" name="'.$name.'" value="'.$value.'"';
			
			// Add Attributes (if any)
			if (!is_null($attributes))
			{
				if (is_array($attributes)) {
					foreach($attributes as $key=>$val) {
						$code .= ' '.$key.'="'.$val.'"';
					}
				} else if (is_string($attributes)) {
					$code .= ' '.$attributes;
				}
			}
			
			// Check if the Value or Label Matches the Selected
			if (!is_null($selected) && (($label == $selected) || ($value == $selected))) {
				$code .= ' checked="checked"';
			}
			
			// Close the Tag
			$code .= ' /> <label for="'.$name.'_'.$value.'">';
			
			// Add the Label
			$code .= $label.'</label>';
			
			// Add a Spacer if needed
			if (!is_null($spacer)) {
				$code .= $spacer;
			}
		}
	}
	
	// Return the Code
	return $code;
}

/**
 * Create an array of checkboxes.
 *
 * @param string	$name			the name of the element.
 * @param array		$values			an array of options.
 * @param array		$selected		the selected values.
 * @param array		$attributes		additional attributes for the element.
 * @param string	$spacer			characters to print between each checkbox.
 *
 * @return string
 */
function form_checkboxes($name, $values, $selected = null, $attributes = null, $spacer = null)
{
	// Begin the Code
	$code = '';

	// Check we have a Values Array
	if (is_array($values))
	{
		foreach($values as $value=>$label)
		{
			// Start the Code with Label and Radio Input
			$code .= '<input type="checkbox" id="'.$name.'_'.$value.'" name="'.$name.'" value="'.$value.'"';
			
			// Add Attributes (if any)
			if (!is_null($attributes))
			{
				if (is_array($attributes)) {
					foreach($attributes as $key=>$val) {
						$code .= ' '.$key.'="'.$val.'"';
					}
				} else if (is_string($attributes)) {
					$code .= ' '.$attributes;
				}
			}
			
			// Check if the Value or Label Matches the Selected
			if (!is_null($selected) && is_array($selected))
			{
				foreach($selected as $item)
				{
					if (($item == $value) || ($item == $label)) {
						$code .= ' checked="checked"';
					}
				}
			}
			
			// Close the Tag
			$code .= ' /> <label for="'.$name.'_'.$value.'">';
			
			// Add the Label
			$code .= $label.'</label>';
			
			// Add a Spacer if needed
			if (!is_null($spacer)) {
				$code .= $spacer;
			}
		}
	}
	
	// Return the Code
	return $code;
}
?>