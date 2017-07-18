<?php
// Set the Application Mode
$app_mode = 'DEBUG';

// Setup the Default Controller and View
$config['default_controller'] = 'main';
$config['default_view'] = 'index';

// Setup the Cache Path
$config['cache_path'] = 'cache/';

// Set a Hash Key for Session Variables
$config['sess_hash'] = 'p0pmVc2';

// Upload Path
$config['upload_path'] = getcwd().'/';

// Lay out some Configuration Details
if ($app_mode == 'DEBUG')
{
	// Report ALL Errors
	error_reporting(E_ALL);
}
elseif ($app_mode == 'RELEASE')
{
	// Don't Report Errors
	error_reporting(E_NONE);
}
?>