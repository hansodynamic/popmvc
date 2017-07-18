<?php
/**
 * Upload a File using the PHP HTTP POST upload functions.
 *
 * @param array		$file				the posted file field (e.g. $_FILES['myfile'])
 * @param string	$new_filename		the name you want to rename the file to (the file
 *										extension is preserved).
 * @param string	$upload_location	the directory to upload the file to. This is in relation
 *										to the current working directory.
 * @param array		$allowed_filetypes	an array of MIME filetypes that the upload file must
 *										adhere to (e.g. image/jpeg, application/x-pdf)
 * @param bool		$return_filepath		return the path of the uploaded file.
 *
 * @return bool
 */
function upload($file, $new_filename = null, $upload_location = null, $allowed_filetypes = null, $return_filepath = FALSE)
{
	// Get the Global Config File
	global $config;
	
	// Build the Full Upload location
	$full_upload_location = $config['upload_path'];
	
	// Check whether we have a trailing slash
	if (substr($upload_location, strlen($upload_location) -1, 1) != '/') $upload_location .= '/';
	
	// Add the Specified Location to it, if needed
	if (!is_null($upload_location)) $full_upload_location .= $upload_location;
	
	// Automatically add directory
	if (!is_dir($full_upload_location)) {
		mkdir($full_upload_location, 0777, true);
	}
	
	// Get the File Properties
	$filename = $file['name'];
	$file_tmp = $file['tmp_name'];
	$filetype = $file['type'];
	$fileinfo = pathinfo($filename);
	$file_ext = '.'.strtolower($fileinfo['extension']);
	
	// Check if we have a list of allowed filetypes
	if (!is_null($allowed_filetypes))
	{
		// Check if the Filetype is Allowed
		if (!in_array($filetype, $allowed_filetypes)) {
			return FALSE;
		}
	}
	
	// New Filename
	$destination = $full_upload_location;
	
	// Add the new Filename, if specified
	if (!is_null($new_filename)) $destination .= pathinfo($new_filename, PATHINFO_FILENAME).$file_ext;
	else $destination .= $filename;
	
	if (move_uploaded_file($file_tmp, $destination)) {
		if ($return_filepath) {
			return $upload_location.$new_filename.$file_ext;
		} else return TRUE;
	}
	else return FALSE;
}

/**
 * Copy a file
 *
 * @param string		$original_file		Name and path of file to copy. Path should be
 *											in relation to the current working directory.
 * @param string		$copy_to			Name and path of the copy. Path should be in
 *											relation to the current working directory.
 *
 * @return bool
 */
function copy_file($original_file, $copy_to)
{
	// Get the Global Config File
	global $config;
	
	// Make the Full Paths
	$original = $config['upload_path'].$original_file;
	$copy = $config['upload_path'].$copy_to;
	$copypath = pathinfo($copy);
	
	// Check that the File Exists
	if (!file_exists($original)) return FALSE;
	
	// Create the new Directories, if necessary
	if (!is_dir($copypath['dirname'])) mkdir($copypath['dirname'], 0777, true);
	
	// Perform the File Copy
	return copy($original, $copy);
}

/**
 * Move a file
 *
 * @param string		$original_file		Name and path of file to move. Path should be
 *											in relation to the current working directory.
 * @param string		$new_location		Path to move the file to. Path should be in
 *											relation to the current working directory.
 *
 * @return bool
 */
function move_file($original_file, $new_location)
{
	// Get the Global Config File
	global $config;
	
	// Make the Full Paths
	$original = $config['upload_path'].$original_file;
	$origpath = pathinfo($original);
	
	// Check whether we have a trailing slash
	if (substr($new_location, strlen($new_location) -1, 1) != '/') $new_location .= '/';
	
	// Create the new Directories, if necessary
	if (!is_dir($new_location)) mkdir($new_location, 0777, true);
	
	// Check that the File Exists
	if (!file_exists($original)) return FALSE;
	
	// Perform the Move
	return rename($original, $new_location.$origpath['basename']);
}

/**
* Delete a File
*
* @param string			$filename		Name and path of the file to delete. Path should be
*										in relation to the current working directory.
*
* @return bool
*/
function delete_file($filename)
{
	// Get the Global Config File
	global $config;
	
	// Make the Full Path
	$file = $config['upload_path'].$filename;
	
	// Check that the File Exists
	if (!file_exists($file)) return FALSE;
	
	// Delete the File
	return unlink($file);
}
?>