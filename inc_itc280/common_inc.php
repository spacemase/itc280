<?php
/**
 * common_inc.php stores site-wide utility functions
 *
 * @package itc280
 * @author Mason Jensen < mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 */

/**
 * Forcibly passes user to a URL.  Accepts either an absolute or relative address.
 *
 * PHP does not have a built in redirect to a relative URL.  The PHP header() function
 * requires an absolute URL, eliciting this workaround.
 *
 * Any page using myRedirect() needs ob_start() at the top of the page or header() errors will occur.
 * Error will say 'headers already sent', etc.
 *
 * Updated to sniff for "http://", "https://", which will force an absolute redirect, otherwise assume local.
 *
 * @param string $myURL locally referenced file, or absolute with 'http://' as destination for user
 * @return void
 */
function myRedirect( $myURL )
{
  $httpCheck = strtolower( substr( $myURL, 0, 8 ) ) ; # http:// or https://
  if ( strrpos( $httpCheck, 'http://' ) > -1 || strrpos( $httpCheck, 'https://' ) > -1 )
  { // absolute URL
    header( 'Location: ' . $myURL ) ;
  }
  else
  { // relative URL
    $myProtocol = strtolower( $_SERVER['SERVER_PROTOCOL'] ) ; # cascade the http or https of current address
    if ( strrpos( $myProtocol, 'https' ) > -1 )
    { $myProtocol = 'https://' ; }
    else
    { $myProtocol = 'http://' ; }
    $dirName = dirname( $_SERVER['PHP_SELF'] ) ;
    $char = substr( $dirName, strlen( $dirName ) - 1 ) ;
    if ( $char != '/' ) { $dirName .= '/' ; } # only add slash if required!
    header( 'Location: ' . $myProtocol . $_SERVER['HTTP_HOST'] . $dirName . $myURL ) ;
  }
  die() ; # added for safety!
}

/**
 * Wrapper function for processing data pulled from db
 *
 * Forward slashes are added to MySQL data upon entry to prevent SQL errors.
 * Using our dbOut() function allows us to encapsulate the most common functions for removing
 * slashes with the PHP stripslashes() function, plus the trim() function to remove spaces.
 *
 * Later, we can add to this function sitewide, as new requirements or vulnerabilities develop.
 *
 * @param string $str data as pulled from MySQL
 * @return $str data cleaned of slashes, spaces around string, etc.
 * @see dbIn()
 */
function dbOut( $str )
{
	if ( $str != '' ) { $str = stripslashes( trim( $str ) ) ; } # strip out slashes entered for SQL safety
	return $str ;
}

/**
 * Filters data per MySQL standards before entering database.
 *
 * Adds slashes and helps prevent SQL injection per MySQL standards.
 * Function enclosed in 'wrapper' function to add further functionality when
 * as vulnerabilities emerge.
 *
 * @param string $var data as entered by user
 * @return string returns data filtered by MySQL, adding slashes, etc.
 * @see dbOut()
 * @see idbIn()
 */
function dbIn( $var )
{
  global $myConn ; # checks data against active DB connection

  if ( isset( $var ) && $var != '' )
  { return mysql_real_escape_string( $var ) ; }
  else
  { return '' ; }
}

/**
 * mysqli version of dbIn()
 *
 * Filters data per MySQL standards before entering database.
 *
 * Adds slashes and helps prevent SQL injection per MySQL standards.
 * Function enclosed in 'wrapper' function to add further functionality when
 * as vulnerabilities emerge.
 *
 * @param string $var data as entered by user
 * @param object $myConn active mysqli DB connection, passed by reference.
 * @return string returns data filtered by MySQL, adding slashes, etc.
 * @see dbIn()
 */
function idbIn( $var, &$myConn )
{
  if ( isset( $var ) && $var != '' )
  { return mysqli_real_escape_string( $myConn, $var ) ; }
  else
  { return '' ; }
}

/**
 * br2nl() changes '<br />' tags  to '\n' (newline)
 * Preserves user formatting for preload of <textarea>
 * <code>
 *  $myText = br2nl($myText); # <br /> changed to \n
 * </code>
 *
 * @param string $text Data from DB to be loaded into <textarea>
 * @return string Data stripped of <br /> tag variations, replaced with new line
 */
function br2nl( $text )
{
  $nl = '\n' ; # new line character
  $text = str_replace( '<br />', $nl, $text ) ; # XHTML <br />
  $text = str_replace( '<br>', $nl, $text ) ; # HTML <br>
  $text = str_replace( '<br/>', $nl, $text ) ; # bad break!
  return $text ;
  /* reference (unsused)
    $cr = chr(13); // 0x0D [\r] (carriage return)
    $lf = chr(10); // 0x0A [\n] (line feed)
    $crlf = $cr . $lf; // [\r\n] carriage return/line feed)
  */
}

/**
 * nl2br2() changes '\n' (newline)  to '<br />' tags
 * Break tags can be stored in DB and used on page to replicate user formatting
 * Use on input/update into DB from forms
 * <code>
 *  $myText = nl2br2($myText); # \n changed to <br />
 * </code>
 *
 * @param string $text Data from DB to be loaded into <textarea>
 * @return string Data stripped of <br /> tag variations, replaced with new line
 */
function nl2br2( $text )
{
  $text = str_replace( array( '\r\n', '\r', '\n'), '<br />', $text ) ;
  return $text ;
}

/**
 * wrapper function for PHP session_start(), to prevent 'session already started' error messages.
 *
 * To view any session data, sessions must be explicitly started in PHP.
 * In order to use sessions in a variety of INC files, we'll check to see if a session
 * exists first, then start the session only when necessary.
 *
 * @see adminVal.php
 * @return void
 */
function startSession()
{
  if ( !isset( $_SESSION ) ) { @session_start() ; }
}

/**
 * Encapsulates PHP write capability for functions like errorLog()
 * <code>
 *  return fileWrite("path/tomyfile.php","a+","Here is a test string!");
 * </code>
 *
 * @param string $filename The target file to be written
 * @param string $myMode context we use to write file, a+ is append/create, a is append, w is write/overwrite
 * @param string $myStr The string to write to the file
 * @return boolean returns true or false, success of writing file
 * @see errorLog()
 */
function fileWrite( $fileName, $myMode, $myStr )
{
  $isOpen = fopen( $fileName, $myMode ) ;
  if ( $isOpen )
  {
    fwrite( $isOpen, $myStr ) ;
    fclose( $isOpen ) ;
    return TRUE ;
  }
  else
  {
    return FALSE ;
  }
}

/**
 * Checks for email pattern using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 */
function onlyEmail( $myString )
{
  if ( eregi( '^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+$', $myString ) )
  { return TRUE ; }
  else
  { return FALSE ; }
}

/**
 * Checks data for alphanumeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 */
function onlyAlphaNum( $myString )
{
  $myReturn = eregi( '[^a-zA-Z0-9]', $myString ) ;
  if ( $myReturn )
  { return FALSE ; }
  else
  { return TRUE ; }
}

/**
 * Checks data for numeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 */
function onlyNum( $myString )
{
  $myReturn = eregi('[^0-9]', $myString ) ;
  if ( $myReturn )
  { return FALSE ; }
  else
  { return TRUE ; }
}

/**
 * Checks data for alphanumeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 */
function onlyAlpha( $myString )
{
  $myReturn = eregi('[^a-zA-Z]', $myString ) ;
  if ( $myReturn )
  { return FALSE ; }
  else
  { return TRUE ; }
}

/**
 * Requires data submitted as isset() and passes dat to
 * dbIn() which processes per MySQL standards, adding slashes and
 * attempting to prevent SQL injection.
 * Upon failure, user is forcibly redirected to global variable,
 * $redirect, which is applied just before checking a series of form values.
 *
 * <code>
 *  $redirect = "feedback.php?msg=3"; //global redirect
 *  $myVar = formReq($_POST['myVar']);
 *  $otherVar = formReq($_POST['otherVar']);
 * </code>
 *
 * @uses dbIn()
 * @param string $var data as entered by user
 * @return string returns data filtered by MySQL, adding slashes, etc.
 */
function formReq( $var )
{
  /**
   * $redirect stores page to redirect user to upon failure
   * This variable is declared in the page, just before the form fields are tested.
   *
   * @global string $redirect
   */
  global $redirect ;

  if ( empty( $var ) )
  { myRedirect( $redirect ) ; }
  else
  { return dbIn( $var ) ; }
}

/**
 * Requires data submitted as isset() and passes dat to
 * dbIn() which processes per MySQL standards, adding slashes and
 * attempting to prevent SQL injection.
 * Upon failure, user is forcibly redirected to global variable,
 * $redirect, which is applied just before checking a series of form values.
 *
 * <code>
 *  $redirect = "feedback.php?msg=3"; //global redirect
 *  $myVar = formReq($_POST['myVar']);
 *  $otherVar = formReq($_POST['otherVar']);
 * </code>
 *
 * @uses dbIn()
 * @param string $var data as entered by user
 * @return string returns data filtered by MySQL, adding slashes, etc.
 */
function form_Req( $var, $redirect )
{
  /**
   * $redirect stores page to redirect user to upon failure
   * This variable is declared in the page, just before the form fields are tested.
   *
   * @global string $redirect
   */
  if ( empty( $var ) )
  { myRedirect( $redirect ) ; }
  else
  { return dbIn( $var ) ; }
}

/**
 * mysqli version of formReq()
 *
 * Requires data submitted as isset() and passes data to
 * idbIn() which processes per MySQL standards, adding slashes and
 * attempting to prevent SQL injection.
 *
 * Upon failure, user is forcibly redirected to global variable,
 * $redirect, which is applied just before checking a series of form values.
 *
 * mysqli version requires explicit connection, $myConn
 *
 * <code>
 *  $redirect = "feedback.php?msg=3"; //global redirect
 *  $myConn = conn("admin",TRUE); //mysqli connection
 *  $myVar = iformReq($_POST['myVar'],$myConn);
 *  $otherVar = iformReq($_POST['otherVar'],$myConn);
 * </code>
 *
 * @uses idbIn()
 * @see formReq()
 * @param string $var data as entered by user
 * @param object $myConn active mysqli DB connection, passed by reference.
 * @return string returns data filtered by MySQL, adding slashes, etc.
 */
function iformReq( $var, &$myConn )
{
  /**
   * $redirect stores page to redirect user to upon failure
   * These variables are declared in the page, just before the form fields are tested.
   *
   * @global string $redirect
   */
  global $redirect ;

  if ( empty( $var ) )
  { myRedirect( $redirect ) ; }
  else
  { return idbIn( $var, $myConn ) ; }
}

/**
 * Checks a comma separated string of acceptable file types set by
 * an administrator in upload pages (upload_execute.php, upload_form.php)
 * to be certain an accepted file type is currently being uploaded.
 *
 * PHP upload file types can be derived by using extension2fileType() function.
 *
 * <code>
 *  $file_types = "image/pjpeg,image/jpeg,image/gif,image/x-png";
 *  $validFileType = checkFileType($file_types,$_FILES['FileToUpload']['type']);
 * </code>
 *
 * To add to acceptable file types, attempt to upload invalid file types,
 * then make a note of the extension, and add it to the list.
 *
 * Added with nmUpload Package
 *
 * @see upload_execute.php
 * @see upload_form.php
 * @uses extension2fileType
 *
 * @param str $file_types comma separated string of acceptable files to upload
 * @param str $currentFileType file type of the current file being uploaded
 * @return boolean true if passes filetype test
 */
function checkFileType( $file_types, $currentFileType )
{
  $aFiles = explode( ',', $file_types ) ; # create aFiles file type array:
  for ( $x=0; $x<count($aFiles); $x++ )
  {
    if ( $aFiles[$x] == $currentFileType ) { return TRUE ; }
  }
  return FALSE ; # no match found, return false!
}

/**
 * Converts natural file extension into file type required for
 * PHP upload.
 * Works with checkFileType() function to identify valid file types, as
 * declared by administrators
 *
 * <code>
 *  $fileType = extension2fileType(".jpg");
 * </code>
 *
 * To add to acceptable file type, attempt to upload INVALID file types,
 * then make a note of the file_type/extension, and add it to the switch below.
 *
 * Added with nmUpload Package
 *
 * @see upload_execute.php
 * @see upload_form.php
 *
 * @param string $extension natural extension of a file
 * @return string PHP upload file type of the current file
 */
function extension2fileType( $extension )
{
  $file_types = '' ; # initialize
  switch ( strtolower( $extension ) )
  {
    case '.jpg':
    case '.jpeg':
      $file_types = 'image/pjpeg,image/jpeg' ;
      break ;
    case '.gif':
      $file_types = 'image/gif' ;
      break ;
    case '.png':
      $file_types = 'image/x-png' ;
      break ;
    case '.doc':
      $file_types = 'application/msword' ;
      break ;
    case '.zip':
      $file_types = 'application/x-zip-compressed' ;
      break ;
    case '.pdf':
      $file_types = 'application/pdf' ;
      break ;
    case '.xls':
      $file_types = 'application/vnd.ms-excel' ;
      break ;
    case '.mp3':
      $file_types = 'audio/mpeg' ;
      break ;
    case '.txt':
      $file_types = 'text/plain' ;
      break ;
    case '.htm':
    case '.html':
      $file_types = 'text/html' ;
      break ;
    case '.wma':
      $file_types = 'audio/x-ms-wma' ;
      break ;
    default:
      $file_types = 'image/pjpeg,image/jpeg' ; # default to .jpg
  }
  return $file_types ; # return matching file type!
}
?>
