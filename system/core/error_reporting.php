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

function php_error_handler($errno, $errstr, $errfile, $errline)
{
	// Check if we have an Error Number
	if (!(error_reporting() & $errno)) {
		// This error code is not included in error_reporting
		return;
	}
	
	// Determine the Error Type
	switch($errno)
	{
		// Error
		case E_USER_ERROR:
			echo '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
			echo '<h4 style="margin: 0px">ERROR :: ['.$errno.']</h4><p>'.$errstr.'</p>';
			echo '<p>Fatal error on line <strong>'.$errline.'</strong> in file <strong>'.$errfile.'</strong></p>';
			echo '</div>';
		break;
		// Warning
		case E_USER_WARNING:
			echo '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
			echo '<h4 style="margin: 0px">WARNING :: ['.$errno.']</h4><p>'.$errstr.'</p>';
			echo '<p>Warning on line <strong>'.$errline.'</strong> in file <strong>'.$errfile.'</strong></p>';
			echo '</div>';
		break;
		// Notice
		case E_USER_NOTICE:
			echo '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
			echo '<h4 style="margin: 0px">NOTICE :: ['.$errno.']</h4><p>'.$errstr.'</p>';
			echo '<p>Notice on line <strong>'.$errline.'</strong> in file <strong>'.$errfile.'</strong></p>';
			echo '</div>';
		break;
		// Default
		default:
			echo '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
			echo '<h4 style="margin: 0px">Unknown Error Type: ['.$errno.']</h4><p>'.$errstr.'</p>';
			echo '<p>Notice on line <strong>'.$errline.'</strong> in file <strong>'.$errfile.'</strong></p>';
			echo '</div>';
		break;
	}
	
	// Don't execute the PHP internal error handler
	return TRUE;
}

function report_error($title, $message, $code = null)
{
	// Get the Config Variable
	global $app_mode;
	
	// If we are in Debug Mode
	if ($app_mode == 'DEBUG')
	{
		// Build a Simple Error Message Box
		$error_box = '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
		$error_box .= '<h4 style="margin: 0px">'.$title.'</h4><p>'.$message.'</p>';
		
		// Check if we have any associated code attached
		if (!is_null($code)) {
			$error_box .= '<pre style="font-size: 10px; font-family: Consolas, monospace">'.$code.'</pre>';
		}
		
		$error_box .= '</div>';
		
		// Print the Message and Kill the Application
		exit($error_box);
	}
	else
	{
		// Exit the Application
		exit("Application Error");
	}
}

function return_error($title, $message, $code = null)
{
	// Build a Simple Error Message Box
	$error_box = '<div style="font-size: 12px; font-family: Helvetica, sans-serif; padding: 10px; border-radius: 4px; border: 1px solid #ccc; background-color: #eee; margin: 20px auto; width: 600px">';
	$error_box .= '<h4 style="margin: 0px">'.$title.'</h4><p>'.$message.'</p>';
	
	// Check if we have any associated code attached
	if (!is_null($code)) {
		$error_box .= '<pre style="font-size: 10px; font-family: Consolas, monospace">'.$code.'</pre>';
	}
	
	$error_box .= '</div>';
	
	// Print the Message and Kill the Application
	return $error_box;
}

// Set the Error Handler
set_error_handler("php_error_handler");
?>