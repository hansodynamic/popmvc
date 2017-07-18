<?php
// Get the App Mode
global $app_mode;

// Lay out some Configuration Details
if ($app_mode == 'DEBUG')
{
	// Primary Database Connection
	$config['db']['primary']['host'] = 'localhost';
	$config['db']['primary']['user'] = 'root';
	$config['db']['primary']['pass'] = 'password';
	$config['db']['primary']['data'] = 'popmvc';
	$config['db']['primary']['port'] = FALSE;
}
elseif ($app_mode == 'RELEASE')
{
	// Primary Database Connection
	$config['db']['primary']['host'] = 'localhost';
	$config['db']['primary']['user'] = 'root';
	$config['db']['primary']['pass'] = 'root';
	$config['db']['primary']['data'] = 'popvc';
	$config['db']['primary']['port'] = FALSE;
}