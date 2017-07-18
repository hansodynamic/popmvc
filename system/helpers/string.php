<?php
/**
 * Make a string URL parsable by stripping non-alphanumeric chars with -
 *
 * @param string $string				Input string to format.
 *
 * @return string
 */
function make_url_tag($string)
{
	// Make Lowercase First
	$string = strtolower($string);
	
	// Now Replace non-Punctuation
	$string = preg_replace("/([^a-z0-9-_]+)/", "-", $string);
	
	// Trim any trailing Hyphens
	$string = trim($string, "-");
	
	// Return the Result
	return $string;
}

/**
 * Recursively trim an array, such as a POST array.
 *
 * @param mixed $input					Input variable.
 *
 * @return mixed
 */
function recursive_trim($input)
{
	if (is_array($input)) {
		return array_map('recursive_trim', $input);
	} else {
		return trim($input);
	}
}

/**
 * Create a random hash based on microtime.
 *
 * @param int $num_chars				Number of chars to make the hash.
 * @param string $salt					Additional salt key.
 *
 * @return string
 */ 
function create_hash($num_chars = 10, $salt = '')
{
	return substr(md5(microtime(1).$salt), 0, $num_chars);
}

/**
 * Create pre-formatted email headers.
 *
 * @param string $to					To email address.
 * @param string $from					From email address.
 * @param string $reply_to				(optional) Reply-to email address.
 *
 * @return string.
 */
function email_headers($to, $from, $reply_to = FALSE)
{
	$headers = "MIME-Version: 1.0" . "\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
	$headers .= "To: ".$to."\n";
	$headers .= "From: ".$from."\n";
	if ($reply_to) {
		$headers .= "Reply-To: ".$reply_to."\n";
	}
	else {
		$headers .= "Reply-To: ".$from."\n";	
	}
	
	return $headers;
}
?>