<?php
/**
 * config_inc.php stores site-wide configuration settings, functions & file references
 *
 * Stores configuration data like support email address, SUPPORT_EMAIL
 * and functions like my_error_handler() which
 * over-rides the default error handler of PHP.
 *
 * Toward the end of the file are references to other include files, for example
 * common_inc.php, which stores utility functions and conn_inc.php which provides
 * database credentials and a 'handle' to an active database connection
 *
 * To include this file, place it in a folder outside the web server root, in a folder with
 * 0700 permission, that will store your PHP include files, for instance:
 *
 * inc_myapp
 *
 * I recommend referencing this include file at the top of all associated application pages, thus:
 *
 * require_once '/home/classes/horsey01/inc_myapp/config_inc.php';
 *
 * while it' not pretty, and should be deployed at the top of all your site files, it has the benefit of
 * speed (a simple string) and uniqueness (for multi-file search & replace for moving to another server)
 *
 * Less efficient, but prettier, you might use the document root env variable:
 *
 * require_once $_SERVER["DOCUMENT_ROOT"] . '/inc_myapp/config_inc.php';
 *
 * However this doesn't work on many servers.  I avoid attempting to change the INC path, as it doesn't work if
 * PHP is setup as a CGI (faster, more secure) instead of an Apache Module, which allows INC paths & PHP config via .htaccess.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.1 2009/07/01
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see common_inc.php
 * @see conn_inc.php
 */
if( !isset( $PageTitle ) ) { $PageTitle = 'ITC280 - mjense11' ; }
define( "HIDE_ALL_ERRORS", FALSE ) ; # FALSE = CURRENTLY ALLOWING VISIBILITY OF SITE ERRORS
// more on error logging (and directory search): http://phr34k.com/secure/archives/category/php
define( "SUPPORT_EMAIL", "mason.jensen@hotmail.com" ) ;
date_default_timezone_set( 'America/Los_Angeles' ) ;

// This buffers our page to be prevent header errors. Call before INC files or ANY html!
ob_start() ;

define( 'PHYSICAL_PATH', '/home/a5001834/public_html/public_html/itc280/' ) ;

define( 'VIRTUAL_PATH', 'http://www.spacemase.com/itc280/' ) ;

define( 'INCLUDE_PATH', '/home/a5001834/public_html/inc_itc280/' ) ;

define( 'LOG_PATH', '/home/a5001834/public_html/log_itc280/' ) ;

/**
 * Prefix to add uniqueness to your table names.  Maintains some sort of uniqueness to limit hackability, plus
 * helps prevent collisions with other applications.  I recomment 2-3 characters & underscore, ie: "xx_"
 *
 * In order to use a prefix, you would need to add it to any tables & SQL statements.  Currently the PREFIX is
 * added to the Admin table for administrative access.
 */
define( 'PREFIX', 'itc280_' ) ;

define( 'TABLE_EDITOR', 'nmEdit.php' ) ;

define( 'ADMIN_LOGIN', 'admin_login.php' ) ;

define( 'ADMIN_VALIDATE', 'admin_validate.php' ) ;

define( 'ADMIN_DASHBOARD', 'admin.php' ) ;

define( 'ADMIN_LOGOUT', 'admin_logout.php' ) ;

define( 'ADMIN_ADD', 'admin_add.php' ) ;

define( 'ADMIN_RESET', 'admin_reset.php' ) ;

// provides database connectivity
include_once 'conn_inc.php' ;

// provides common utility functions
include_once 'common_inc.php' ;

// pager class
include_once 'pager_inc.php' ;

/**
 * If using default file system to save session data, identifies path to session storage folder.
 * Folder should exist outside of the web root and have permissions set to 0700
 */
ini_set( 'session.save_path', '/home/a5001834/public_html/sessions' ) ;

/**
 * Save session data to db - part of nmSession package
 */
//ini_set( 'session.use_trans_sid', false ) ; # turns off querystring session handling - off by default by PHP 4.3.4
//require_once 'session_db_inc.php' ; # session database handling include file
//session_set_save_handler( 'session_open', 'session_close', 'session_read', 'session_write', 'session_eliminate', 'session_clean' ) ;

/**
 * Error logging section.
 * Path to location where to (optionally) store log files
 *
 * If PHP errors are shut off, we can still view these errors via the error_log
 * file.  To do this, create a folder outside the web root, with a permission of 0700 (recursive).
 *
 * Identify the physical path to this folder ABOVE, in the LOG_PATH constant.
 *
 * Once this path is identified, and the ini_set command 'log_errors' is set to "1" (on), then we can
 * view errors live via the command line, and the 'tail' command:
 *
 * <code>
 *  tail -f error_log
 * </code>
 *
 * This will allow you to view the latest errors added to the error_log file as they are added.
 */
//ini_set( 'log_errors', 1 ) ; # 1 turns on error logging, 0 shuts it off
//ini_set( 'error_log', LOG_PATH . 'error_log' ) ; # places PHP errors into a folder at this location

/**
 * Replace default PHP error handler with ours.  If we over-ride the default error handler with
 * our own.
 *
 * None of our error reporting settings will matter if 'display_errors' is off' in the PHP.INI file.
 * To determine, view phpInfo().  If it is, we can only view error logs.
 */
set_error_handler( 'myErrorHandler' ) ;

/**
 * We can undo our over-ride of the error handler by commenting the set_error_handler() line above
 * and uncomment the following two lines of code.
 *
 * We can un-comment the lines below to either see default errors (1) or shut off visual errors completely (0).
 * Shutting off all errors could be appropriate for a production enviroment.
 */
ini_set( 'error_reporting', E_ALL | E_STRICT ) ;
ini_set( 'display_errors', 1 ) ; # 1 turns on error reporting, 0 shuts it off

/**
 * Overrides PHP's default error handler
 *
 * Inherits error info from default handler and allows us to display
 * custom error messages if these boolean constants are both true:
 *
 * 1 HIDE_ALL_ERRORS
 * 2 HIDE_PAGE_ERRORS
 *
 * The first comes from this file, the second must be in the calling page
 *
 * @param string $e_number error number provided by PHP error handler
 * @param string $e_message error message provided by PHP error handler
 * @param string $e_file file name provided by PHP error handler
 * @param string $e_line line number of error provided by PHP error handler
 * @param array $e_vars variables present at time of error
 * @return void
 */
function myErrorHandler( $e_number, $e_message, $e_file, $e_line, $e_vars )
{
  static $counter = 0 ; # will identify if myError() was called more than once
  $counter++ ;
  if ( HIDE_ALL_ERRORS || HIDE_PAGE_ERRORS )
  { // display generic error message, with support email from config file
    if ( $counter < 2 ) { printUserError( $e_file, $e_line ) ; } # only print one error message to user
  }
  else
  { // show errors directly on page. (troubleshooting purposes only!)
    printDeveloperError( $e_file, $e_line, $e_message, $counter ) ;
  }
}

/**
 * Create an error code out of the file name and line number of our error
 *
 * Will make upper case, strip out the vowels and create an
 * error of the file name (minus extension & vowels) + "x" + line number of error
 *
 * Will also replace any underscores with "x". This file would be:
 * Example: CNFGxNCx41
 *
 * The above would be the example for this file, plus an error at line 41
 * This allows a user to report an error that identifies it, without compromising site security
 *
 * @param string $myFile file name provided by PHP error handler
 * @param string $myLine line number of error provided by PHP error handler
 * @return string File name and line number of error disguised vaguely as an error code
 * @see printUserError()
 */
function createErrorCode( $myFile, $myLine )
{
  $mySlash = strrpos( $myFile, '/' ) ; # find position of last slash in path
  $myFile = substr( $myFile, $mySlash + 1 ) ; # strip off all but file name
  $myFile = substr( $myFile, 0, strripos( $myFile, '.' ) ) ; # remove extension
  $myFile = strtoupper( $myFile ) ; # change to upper case
  $vowels = array( 'A', 'E', 'I', 'O', 'U', 'Y' ) ; # array of vowels to remove
  $myFile = str_replace( $vowels, '', $myFile ) ; # remove vowels
  $myFile = str_replace( '_', 'x', $myFile ) ; # replace underscore with "x"
  return $myFile . 'x' . $myLine ; # CNFGNCx50
}

/**
 * Prints a customized public error message
 *
 * Will use a custom error code created by calling
 * createErrorCode() function, and display it to the user
 *
 * @param string $myFile file name provided by PHP error handler
 * @param string $myLine line number of error provided by PHP error handler
 * @return void
 * @see createErrorCode()
 * @see printDeveloperError()
 */
function printUserError( $myFile, $myLine )
{
  $errorCode = createErrorCode( $myFile, $myLine ) ; # create error code out of file name & line number
  echo '<h2 align="center">Our page has encountered an error!</h2>' ;
  echo '<table align="center" width="50%" style="border:#F00 1px solid;"><tr><td align="center">' ;
  echo 'Please try again, or email support at <b>' . SUPPORT_EMAIL . '</b>,<br /> and let us know you are receiving ' ;
  echo 'the following Error Code: <b>' . $errorCode . '</b><br />' ;
  echo 'This will help us identify the problem, and fix it as quickly as possible.<br />' ;
  echo 'Thank you for your assistance and understanding!<br />' ;
  echo 'Sincerely,<br />Support Staff<br />' ;
  echo '<a href="index.php">Exit</a></td></tr></table>' ;
  if ( file_exists( INCLUDE_PATH . 'footer_inc.php' ) ) { include_once INCLUDE_PATH . 'footer_inc.php' ; }
  die() ; # one error is enough!
}

/**
 * Prints a customized developer error message
 * This is what a developer will see when an error occurs
 *
 * @param string $myFile file name provided by PHP error handler
 * @param string $myLine line number of error provided by PHP error handler
 * @param string $errorMsg error text provided by mysql_error() or developer, etc.
 * @param array|string $vars array dump of page variables, if available
 * @return void
 * @see printUserError()
 */
function printDeveloperError( $myFile, $myLine, $errorMsg, $counter )
{
  // build the error message.
  echo '<div class="error">' ; # no body or closing HTML allows multiple errors to show
  echo 'Error in file: <b>\'' . $myFile . '\'</b> on line: <font color="blue"><b>' . $myLine . '</b></font> '  ;
  echo 'Error message: <font color="red"><b>' . $errorMsg . '</b></font><br /><br />' ;

  // only print one instance of backtrace of debug data:
  if ( $counter < 2 )
  {
    echo 'BackTrace: <font color="purple"><pre>' . print_r(debug_backtrace(),1) . '</pre></font><br /><br />' ;
  }

echo '</div><br />';
}
?>
