<?php
/**
 * Copyright (c) 2017 Hanso Dynamic Limited
 *
 * @author Andy Mills
 *
 * This code is created and distributed under the GNU
 * General Public License (GPL)
 *
 */
class File_Cache
{
	// Cache Path
	var $cache_path;
	
	// Default Constructor
	public function __construct()
	{
		// Get the Config Details
		global $config;
		
		// Set the Cache Path
		$this->cache_path = getcwd().'/'.$config['cache_path'];
	}
	
	/**
	 * Add data to a cache file.
	 *
	 * @param string $cache_name			Name of the cache file to create.
	 *										This can also include a path.
	 * @param array $data					Array of Data to write to the cache.
	 */
	public function add_data($cache_name, $data)
	{
		// Build the Full Cache Name
		$cache_file = $this->cache_path.$cache_name.'.cache';
		
		// JSON Encode the Data
		if (is_array($data)) {
			$json_data = json_encode($data);
		} else {
			$json_data = json_encode(array($data));
		}
		
		// Write to File
		file_put_contents($cache_file, $json_data);
	}
	
	/**
	 * Retrieve data from a cache file.
	 *
	 * @param string $cache_name			Name of the cache file to retrieve.
	 *										This can also include a path.
	 */
	public function get_data($cache_name)
	{
		// Build the Full Cache Name
		$cache_file = $this->cache_path.$cache_name.'.cache';
		
		// Check that the File Exists
		if (file_exists($cache_file))
		{
			// Get the File Contents
			$json_data = file_get_contents($cache_file);
			
			// Decode into an Array
			$data = json_decode($json_data, true);
			
			// Return the Result
			return $data;
		}
		else
		{
			// Otherwise, just return null
			return null;
		}
	}
	
	/**
	 * Check if a cache file has expired.
	 *
	 * @param string $cache_name			Name of the cache file to create.
	 *										This can also include a path.
	 * @param int $expiry_time				Number of seconds after creation
	 *										before a cache file expires.
	 *
	 * @return bool
	 */
	public function has_expired($cache_name, $expiry_time = 3600)
	{
		// Build the Full Cache Name
		$cache_file = $this->cache_path.$cache_name.'.cache';
		
		// Check that the File Exists
		if (file_exists($cache_file))
		{
			// Get the Modified Time
			$modified_time = filemtime($cache_file);
			
			// Get the Time since Modified
			$time_since_modified = time() - $modified_time;
			
			// Check it against the Expiry Time
			if ($time_since_modified > $expiry_time) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		else
		{
			// If the file doesn't exist, return TRUE by default
			return TRUE;
		}
	}
}
?>