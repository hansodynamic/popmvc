<?php
function parse_url_route($url_string)
{
	// Get the Global Config File
	global $config;
	
	// Check whether the URL String matches any of the routes
	foreach($config['routes'] as $parser=>$urlslug)
	{
		// Escape Slashes
		$parser = str_replace('/', '\/', $parser);
		
		// Replace the Number Part
		$parser = str_replace('[:num]', '([0-9]+)', $parser);
		
		// Replace Alpha Part
		$parser = str_replace('[:alpha]', '([a-zA-Z]+)', $parser);
		
		// Replace the Word and Slash / Underscore Part
		$parser = str_replace('[:any]', '([a-zA-Z0-9-_]+)', $parser);
		
		// Add the Delimiters
		$parser = '/^'.$parser.'$/';
		
		// Check for Matches, and Return the Formatted String
		if (preg_match($parser, $url_string))
		{
			// Return the Formatted String
			return preg_replace($parser, $urlslug, $url_string);
		}
	}
	
	// Just return the String
	return $url_string;
}