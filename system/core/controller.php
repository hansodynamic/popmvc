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

class Controller
{
	public function log_data($data)
	{
		file_put_contents(getcwd().'/_logfile.txt', $data."\n");
	}
	
	/**
	 * Autoload any libraries and models specified in the config file.
	 */
	public function autoload()
	{
		// Get the Application Config
		global $config;

		// Check whether we have any libraries specified
		if (!empty($config['autoload']['libraries']))
		{
			// Loop through and load each libraries
			foreach($config['autoload']['libraries'] as $library)
			{
				// Load the Library
				$this->load_library($library);
			}
		}
		
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
	 * Loads a library class from the system/libraries folder.
	 *
	 * Loads a library class from the system/libraries folder and creates an instance
	 * of the class to play with.
	 *
	 * @param string $library_name				The class name of the library to load.
	 */
	protected function load_library($library_name)
	{
		// Get the Full Filepath of the Library
		$library_file = getcwd().'/system/libraries/'.$library_name.'.php';
		
		// Check whether we've already loaded the library
		if (!class_exists($library_name))
		{
			// Check that the Library Exists
			if (file_exists($library_file))
			{
				// Include the Library Class File
				include $library_file;
				
				// Safety Measure - convert library name to lowercase;
				$lc_library_name = strtolower($library_name);
				
				// Create a new Instance of the Library
				$this->$lc_library_name = new $library_name();
			}
			else
			{
				// File doesn't exist, report an error
				report_error('Invalid Filename', 'The file <strong>'.$library_file.'</strong> does not exist.');
			}
		}
		else
		{
			// Safety Measure - convert library name to lowercase;
			$lc_library_name = strtolower($library_name);
			
			// Create a new Instance of the Library
			$this->$lc_library_name = new $library_name();
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
	 * Loads a module from the application/modules folder.
	 *
	 * Loads a module class from the application/modules folder and creates an instance
	 * of the class to play with.
	 *
	 * @param string $module_name				The class name of the module to load.
	 */
	protected function load_module($module_name)
	{
		// Get the Full Filepath of the Module
		$module_file = getcwd().'/application/modules/'.$module_name.'.php';
		
		// Check whether we've already loaded the module
		if (!class_exists($module_name))
		{
			// Check that the Module Exists
			if (file_exists($module_file))
			{
				// Include the Module Class File
				include $module_file;
				
				// Safety Measure - convert module name to lowercase
				$lc_module_name = strtolower($module_name);
				
				// Create a new Instance of the Module
				$this->$lc_module_name = new $module_name();
			}
			else
			{
				// File doesn't exist, report an error
				report_error('Invalid Filename', 'The file <strong>'.$module_file.'</strong> does not exist.');
			}
		}
	}
	
	/**
	 * Loads a view file from the application/views folder.
	 *
	 * Loads a view file from the application/views folder, passes any dynamic
	 * data into it for processing, and displays the view.
	 *
	 * @param string $view_name					The name of the view file to load.
	 * @param array $data						An array of data to pass into the view
	 *											for processing.
	 */
	protected function load_view($view_name, $data = null)
	{
		// Get the Full Filepath of the View
		$view_filepath = getcwd().'/application/views/'.$view_name.'.php';
		
		// Extract any Data for passing into the View
		if (!is_null($data)) extract($data);
		
		// Check that the File exists
		if (file_exists($view_filepath))
		{
			// Start the Output Buffer
			ob_start();
			
			// Include the View Filename
			include $view_filepath;
			
			// Flush the Output Buffer
			ob_end_flush();
		}
		else
		{
			// File doesn't exist, report an error
			report_error('Invalid Filename', 'The file <strong>'.$view_filepath.'</strong> does not exist.');
		}
	}
	
	/**
	 * Loads a view file and a view template from the application/views folder.
	 *
	 * Loads a view file and a view template from the application/views folder,
	 * passes any dynamic data into it for processing, and displays the view.
	 *
	 * @param string $view_name					The name of the view file to load.
	 * @param string $template_name				The name of the template file to load.
	 * @param array $data						An array of data to pass into the view
	 *											for processing.
	 * @param bool $compress						Compress output by removing new lines and tabs.
	 */
	protected function load_view_with_template($view_name, $template_name, $data = null, $compress = FALSE)
	{
		// Get the Full Filepath of the View
		$view_filepath = getcwd().'/application/views/'.$view_name.'.php';

		// Get the Full Filepath of the Template
		$template_filepath = getcwd().'/application/views/'.$template_name.'.php';
		
		// Extract any Data for passing into the View
		if (!is_null($data)) extract($data);
		
		// Check that the View Exists
		if (file_exists($view_filepath))
		{
			// Check that the Template Exists
			if (file_exists($template_filepath))
			{
				// Start the Output Buffer
				ob_start();
				
				// Include the Template Filename
				include $template_filepath;
				
				// Check if we're compressing
				if ($compress)
				{
					$output = ob_get_clean();
					$output = str_replace("\t", "", $output);
					$output = str_replace("\n", "  ", $output);
					$output = preg_replace('/<!--(.*)-->/Uis', '', $output);
					exit($output);
				}
				else
				{
					// Flush the Output Buffer
					ob_end_flush();
				}
			}
			else
			{
				// File doesn't exist, report an error
				report_error('Invalid Filename', 'The file <strong>'.$template_filepath.'</strong> does not exist.');
			}
		}
		else
		{
			// File doesn't exist, report an error
			report_error('Invalid Filename', 'The file <strong>'.$view_filepath.'</strong> does not exist.');
		}
	}
	
	/**
	 * Loads a view file from the application/views folder and returns the processed
	 * content.
	 *
	 * Loads a view file from the application/views folder, passes any dynamic
	 * data into it for processing, and returns the view content.
	 *
	 * @param string $view_name					The name of the view file to load.
	 * @param array $data						An array of data to pass into the view
	 *											for processing.
	 */
	protected function get_view($view_name, $data = null)
	{
		// Get the Full Filepath of the View
		$view_filepath = getcwd().'/application/views/'.$view_name.'.php';
		
		// Extract any Data for passing into the View
		if (!is_null($data)) extract($data);
		
		// Check that the File exists
		if (file_exists($view_filepath))
		{
			// Start the Output Buffer
			ob_start();
			
			// Include the View Filename
			include $view_filepath;
			
			// Return the Buffer Contents
			return ob_get_clean();
		}
		else
		{
			// File doesn't exist, report an error
			report_error('Invalid Filename', 'The file <strong>'.$view_filepath.'</strong> does not exist.');
		}
	}
	
	/**
	 * Takes a data array or object and prints as JSON for APIs.
	 *
	 * @param array $data						Array of data to convert to JSON.
	 *
	 */
	protected function jsonify($data)
	{
		// Print the Correct Header
		header('Content-Type: application/json');
		
		// Print the encoded data
		echo json_encode($data);
		
		// Exit
		exit();
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