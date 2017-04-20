<?php
/**
 * admin_logout.php destroys session so administrators can logout
 * Clears session data, forwards user to admin login page upon successful logout
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/08/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_login.php
 * @see admin_validate.php
 * @see admin_logout.php
 * @see admin_only_inc.php
 */
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;

// clears session data, forwards user to admin login page upon successful logout
startSession() ; # wrapper for session_start()

// setting a session to an empty array safely clears all data
$_SESSION = array() ;

// Release the connection to the cleared session
session_destroy() ;

myRedirect( ADMIN_LOGIN . '?msg=1' ) ; # redirect for successful logout
?>
