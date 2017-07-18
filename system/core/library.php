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

class Library
{
	/**
	 * Autoload any libraries and models specified in the config file.
	 */
	public function autoload()
	{
		// Get the Application Config
		global $config;
		
		// Check whether we have any models specified
		if (!empty($config['autoload']['models']))
		{
			// Loop through and load each model
			foreach($config['autoload']['models'] as $model)
			{
				// Load the Model
				$this->load_model($model);
			}
		}
	}
	
	/**
	 * Loads a helper file from the system/helpers folder.
	 *
	 * @param string $helper_name				The name of the helper file to load.
	 */
	protected function load_helper($helper_name)
	{
		// Add the Full Filepath
		$helper_file = getcwd().'/system/helpers/'.$helper_name.'.php';
		
		// Check that the File Exists
		if (file_exists($helper_file))
		{
			// Load the Helper File
			include $helper_file;
		}
	}
	
	/**
	 * Loads a model from the application/models folder.
	 *
	 * Loads a model class from the application/models folder and creates an instance
	 * of the class to play with.
	 *
	 * @param string $model_name				The class name of the model to load.
	 */
	protected function load_model($model_name)
	{
		// Get the Full Filepath of the Model
		$model_file = getcwd().'/application/models/'.$model_name.'.php';
		
		// Check whether we've already loaded the model
		if (!class_exists($model_name))
		{
			// Check that the Model Exists
			if (file_exists($model_file))
			{
				// Include the Model Class File
				include $model_file;
				
				// Safety Measure - convert model name to lowercase
				$lc_model_name = strtolower($model_name);
				
				// Create a new Instance of the Model
				$this->$lc_model_name = new $model_name();
			}
			else
			{
				// File doesn't exist, report an error
				report_error('Invalid Filename', 'The file <strong>'.$model_file.'</strong> does not exist.');
			}
		}
		else
		{
			// Safety Measure - convert model name to lowercase
			$lc_model_name = strtolower($model_name);
			
			// Create a new Instance of the Model
			$this->$lc_model_name = new $model_name();
		}
	}
	
	/**
	 * Print Debug Information.
	 *
	 * @param object / array / string $data		Debug data to print.
	 */
	protected function print_debug($data)
	{
		// Begin the Preformatted Tag
		echo '<pre style="background: #000; font-size: 10px; color: #fff; padding: 10px; border-radius: 10px">';
		
		// If it's an Object, do a Variable Dump
		if (is_object($data)) {
			var_dump($data);
		}
		// If it's an Array, do an Array Print
		elseif (is_array($data)) {
			print_r($data);
		}
		// ... anything else, just echo it
		else echo $data;
		
		// End the Preformatted Tag
		echo '</pre>';
	}
}
?>