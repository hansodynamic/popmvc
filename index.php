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

// Include the Config Files
foreach(glob("application/config/*.php") as $core_file)
{
	// Load the Config File
	include $core_file;
}

// Declare the Config Array
global $config;

// Loop through and Include the Core Helper Files
foreach($config['autoload']['helpers'] as $helper)
{
	// Add the Full Filepath
	$helper_file = getcwd().'/system/helpers/'.$helper.'.php';
	
	// Check that the File Exists
	if (file_exists($helper_file))
	{
		// Load the Helper File
		include $helper_file;
	}
}

// Create a new Array of GET Variables
$_GET = array_merge($_GET, get_url_parameters());

// Loop through and Include the Core Application Files
foreach(glob("system/core/*.php") as $core_file)
{
	// Load the Core File
	include $core_file;
}

// Check for the URL Param
if (!empty($_GET['u']))
{
	// Parse the URL
	$url = parse_url_route($_GET['u']);
	
	// Get the Controller, View and Params from the URL
	list($_c, $_v, $_p) = array_pad(explode('/', $url, 3), 3, NULL);
}

// Get the Controller Name
$controller_name = !empty($_c) ? $_c : $config['default_controller'];

// Build the Controller Filename
$controller_file = getcwd().'/application/controllers/'.$controller_name.'.php';

// Check whether the File Exists
if (file_exists($controller_file))
{
	// Include the Controller Definition File
	include $controller_file;

	// Create a new instance of the Controller
	$controller = new $controller_name();

	// Call the Autoload Function
	$controller->autoload();

	// Get the Method Name
	$view = !empty($_v) ? $_v : $config['default_view'];
	
	// Check whether the View Method Exists
	if (method_exists($controller, $view))
	{
		// Get any Parameters
		if (!empty($_p))
		{
			// Split the Parameters
			$params = explode('/', $_p);
			
			// Call the View Method with the Parameters
			call_user_func_array(array($controller, $view), $params);
		}
		else
		{
			// Just call the View Function
			$controller->$view();
		}
	}
	else
	{
		// Check for an Error Page
		if (!empty($config['errors']['404']))
		{
			// Redirect
			redirect($config['errors']['404']);
		}
		else
		{
			// Set the Header
			header("HTTP/1.0 404 Not Found");
			
			// File doesn't exist, report an error
			report_error('Invalid View Name', 'The method <strong>'.$view.'</strong> does not exist.');
		}
	}
}
else
{
	// Check for an Error Page
	if (!empty($config['errors']['404']))
	{
		// Redirect
		redirect($config['errors']['404']);
	}
	else
	{
		// Set the Header
		header("HTTP/1.0 404 Not Found");
		
		// File doesn't exist, report an error
		report_error('Invalid Controller Name', 'The controller <strong>'.$controller_file.'</strong> does not exist.');
	}
}
?>