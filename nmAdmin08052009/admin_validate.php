<?php
/**
 * admin_validate.php validation page for access to administrative area
 *
 * Processes form data from admin_login.php to process administrator login requests.
 * Forwards user to admin.php, upon successful login.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_login.php
 * @see admin.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;

if ( isset( $_POST['em'] ) )
{ // if var is set, prepare to process form data
  if ( !onlyEmail( $_POST['em'] ) ) # CHECK EMAIL/PASSWORD FOR VALID DATA:
  { myRedirect( ADMIN_LOGIN . '?msg=3' ) ; }
  if ( !onlyAlphaNum( $_POST['pw'] ) )
  { myRedirect( ADMIN_LOGIN . '?msg=' ) ; }

  // create default 'admin' level connection to MySQL
  $myConn = conn() ; # MUST precede formReq() function, which uses active connection to parse data
  $redirect = ADMIN_LOGIN . '?msg=3' ; # global var used for following formReq redirection on failure
  $Email = formReq( $_POST['em'] ) ; # formReq() calls dbIn() internally, to check form data
  $MyPass = formReq( $_POST['pw'] ) ;

  $selSQL = sprintf( "select AdminID,FirstName,Privilege,NumLogins from " . PREFIX 
                    . "Admin WHERE Email='%s' AND AdminPW=SHA('%s')", $Email, $MyPass ) ;
  $result = @mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  if ( mysql_num_rows( $result ) > 0 )
  { // valid user, create session vars, redirect!
    $row = mysql_fetch_array( $result ) ;
    startSession() ; # wrapper for session_start()
    $AdminID = trim( $row['AdminID'] ) ;
    $_SESSION['AdminID'] = $AdminID ; # create session variables to identify admin
    $_SESSION['FirstName'] = dbOut( $row['FirstName'] ) ;
    $_SESSION['Privilege'] = dbOut( $row['Privilege'] ) ;
    $NumLogins = trim( $row['NumLogins'] ) ;
    $NumLogins += 1 ; # increment number of logins, then prepare to update record!

    // update Admin record, recording new number of logins, and new LastLogin date/time
    $updateSQL = sprintf( "UPDATE " . PREFIX . "Admin set NumLogins=%d, LastLogin=NOW()  WHERE AdminID=%d", $NumLogins, $AdminID ) ;
    @mysql_query( $updateSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
    myRedirect( ADMIN_DASHBOARD ) ; # successful login! Redirect to admin page
  }
  else
  { // failed login, redirect
    myRedirect( ADMIN_LOGIN . '?msg=2' ) ;
  }
}
else
{
  myRedirect( ADMIN_LOGIN . '?msg=3' ) ;
}
?>
