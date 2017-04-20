<?php
/**
 * upload_execute.php takes ID number & image file sent via upload_form.php, and
 * replaces image associated with the current ID number.
 *
 * This page requires a loaded querystring, with an id number of an item passed to it. Form
 * will submit image to be uploaded, and ID to uploadImage.php, which processes the upload.
 * The checkFileType() function in the common_inc.php is used to validate file extensions.
 *
 * All default settings below can be over-written by a submitting form.
 *
 * Global Variable $_FILES is used in PHP 4.x
 * $_FILES['upload']['size'] ==> Returns the Size of the File in Bytes.
 * $_FILES['upload']['tmp_name'] ==> Returns the Temporary Name of the File.
 * $_FILES['upload']['name'] ==> Returns the Actual Name of the File.
 * $_FILES['upload']['type'] ==> Returns the Type of the File.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2008/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see checkFileType()
 * @see upload_form.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'admin_only_inc.php' ;

// Default allowable file size here; 100000 is 100K, for example.
$size_bytes = 100000 ; //bytes max file size, can be overwritten by form

// Default setting: If true, will create thumbnail in same upload directory
$createThumb = 'TRUE' ; # This is a string, so it can also be passed by a form

// Default setting: Declared width of thumbnail
$thumbWidth = 50 ; # Height calculated from there

// Default setting: Declared prefix of thumbnail.
$thumbPrefix = 'thumb_' ; # if use 'thumb_', and image is 'm', file name would be: thumb_m1.jpg

/**
 * Default setting: comma separated string of acceptable file types.
 * Works with checkFileType() function in utilINC.php
 * Examples of (image) file types below:
 *
 * <code>
 *  $file_types = "image/pjpeg,image/jpeg,image/gif,image/x-png";
 * </code>
 *
 * To add to acceptable file types, attempt to upload invalid file types,
 * then make a note of the extension, and add it to the list.
 *
 * NOTE: These are only default values, and can be over-written by the submitting form.
 *
 * @see checkFileType()
 * @see common_inc.php
 */
$file_types = 'image/pjpeg,image/jpeg' ; # currently only accepts jpegs!

/**
 * Default setting: Indicate relative path to file upload here.
 * Folder must have public write capability, either 0755 or 0777
 * You may not want this to be your actual images directory.
 * Note the path includes a last "/".
 */
$upload_dir = 'upload/' ;

//check variable of item passed in on querystring
if ( isset( $_POST['myID'] ) )
{
  $myID = stripslashes( trim( $_POST['myID'] ) ) ;
  if ( !is_numeric( $myID ) ) { myRedirect( $redirect ) ; } # no number, redirect
}
else
{
  myRedirect( $redirect ) ; # no id number in form, redirect
}

// retrieve $imagePrefix to add to image for upload
if ( isset( $_POST['imagePrefix'] ) )
{ $imagePrefix = $_POST['imagePrefix'] ; }
else { $imagePrefix = '' ; }

if ( isset( $_POST['sizeBytes'] ) )
{ // retrieve $size_bytes from form page.  If none, default to size declared on this page
  if ( is_numeric( $_POST['sizeBytes'] ) )
  {
    $size_bytes = $_POST['sizeBytes'] ;
  }
}

// retrieve default over-rides from form page, if applicable
if ( isset( $_POST['uploadFolder'] ) ) { $uploadFolder = $_POST['uploadFolder'] ; }
if ( isset( $_POST['createThumb'] ) ) { $createThumb = $_POST['createThumb'] ; }
if ( isset( $_POST['thumbWidth'] ) ) { $thumbWidth = $_POST['thumbWidth'] ; }
if ( isset( $_POST['thumbPrefix'] ) ) { $thumbPrefix = $_POST['thumbPrefix'] ; }

/**
 * Indicate exact path to file upload here.
 * Folder must have write capability, either 0775, or 0777
 * You may not want this to be your actual images directory. Note the path must include a last "/".
 *
 * PHYSICAL PATH is path to root space of server, and set in config_inc.php
 */
$upload_dir = PHYSICAL_PATH . $uploadFolder ;


// determine acceptable extensions for file upload - convert to formats used by PHP upload
if ( !empty( $_POST['extensions'] ) )
{ // if not passed by form, use defaults
  $aExtensions = explode(',', $_POST['extensions'] ) ;
  if ( is_array( $aExtensions ) )
  {
    $fileString = '' ;
    for ( $x=0; $x<count($aExtensions); $x++ )
    {
      $file_types = extension2fileType( $aExtensions[$x] ) ;
      if ( $fileString == '' )
      { $fileString .= extension2fileType( $aExtensions[$x] ) ; }
      else
      { $file_types .= ',' . extension2fileType( $aExtensions[$x] ) ; }
      $extension = $aExtensions[$x] ;
    }
  }
  else
  {
    $file_types = extension2fileType( $aExtensions ) ;
    $extension = $_POST['extension'] ; # single extension (non-array) attach to doc
  }
}

$FileName = $imagePrefix . $myID . $extension ; # create name of file to be uploaded
$aErrors = array() ; # init - If error message is loaded (array length > 0) errors occurred!

// identify the page where the admin will return once upload is complete
if ( isset( $_POST['returnPage'] ) )
{ $returnPage = $_POST['returnPage'] ; }
else
{ $returnPage = ADMIN_DASHBOARD ; }

// check if the directory exist or not.
if ( !is_dir( '$upload_dir' ) )
{
  $aErrors[] = 'The directory <strong>' . $upload_dir . '</strong> doesn&#39;t exist.' ;
}

// check if the directory is writable.
if ( count( $aErrors ) == 0 && !is_writeable( '$upload_dir' ) )
{
  $aErrors[] = 'Unable to write to directory: <strong>' . $upload_dir
              . '</strong>. Change directory permissions: First try 0755, and if that fails 0777' ;
} //TODO:  not determining correctly if writeable or not.  Might be checking for writeable via PHP, not public

// Check first if a file has been sent via HTTP POST. Returns false otherwise.
if ( count( $aErrors ) == 0 && is_uploaded_file( $_FILES['FileToUpload']['tmp_name'] ) )
{
  $size = $_FILES['FileToUpload']['size'] ; # Get the Size of the File
  if ( count( $aErrors ) == 0 && $size > $size_bytes ) # Make sure that $size is acceptable
  {
    $aErrors[] = 'The File you tried to upload is <strong>' . $size . '</strong>K. Maximum file size: <strong>' . $size_bytes
                . '</strong>K. Please upload a smaller file.' ;
  }

  if ( count( $aErrors ) == 0 && !checkFileType( $file_types, $_FILES['FileToUpload']['type'] ) )
  { // Make sure file is of allowable file types
    $aErrors[] = 'File you tried to upload is <strong>' . $_FILES['FileToUpload']['type']
                . '</strong>. This file type is not currently allowed.' ;
  }

  // move_filetoupload_file('filename','destination') Moves file to directory
  if ( count( $aErrors ) == 0 && move_uploaded_file( $_FILES['FileToUpload']['tmp_name'], $upload_dir.$FileName ) )
  {
    if ( $createThumb == 'TRUE' )
    { // create thumbnail in same folder, add thumbPrefix
      $tempImage = ImageCreateFromJPEG( $upload_dir.$FileName ) ; # copy to temporary image
      $width = ImageSx( $tempImage ) ; # Original picture width
      $height = ImageSy( $tempImage ) ; # Original picture height
      $thumbHeight = floor( $height * ( $thumbWidth / $width ) ) ; # calculate proper thumbnail height
      $newimage = imagecreatetruecolor( $thumbWidth, $thumbHeight ) ; # create new blank image
      imageCopyResampled( $newimage, $tempImage, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height ) ; # copy to thumb
      ImageJpeg( $newimage, $upload_dir . $thumbPrefix . $FileName ) ; # create thumbnail in same directory
    }

    // append timestamp to qstring to print temporary reload() message
    $mySeconds = time() ;

    // redirect to item page so new file can be seen
    myRedirect( $returnPage . '&msg=' . $mySeconds ) ;
  }
  else
  { // Print error
    $aErrors[] = 'Unable to upload file.' ;
  }
}
else
{
  $aErrors[] = 'File not sent via POST.' ;
}

if ( count( $aErrors ) > 0 )
{
  include_once INCLUDE_PATH . 'header_inc.php' ;
  echo '<h2 align="center">Upload Error</h2>' ;
  echo '<div align="center">Please view the following upload error(s)</div><ol>' ;
  for ( $x=0; $x<count($aErrors); $x++ )
  {
    echo '<li>' . $aErrors[$x] . '</li>' ;
  }
  echo '</ol><div align="center"><a href="' . $returnPage . '">BACK</a></div>' ;
  include_once INCLUDE_PATH . 'footer_inc.php' ;
}
?>
