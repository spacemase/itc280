<?php
/**
 * admin_only_inc.php session protection include for restricting access to administrative areas
 *
 * Checks for AdminID session variable, and forcibly redirects users not logged in
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.1 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin.php
 */
startSession() ; # wrapper for session_start()

if ( !isset( $_SESSION['AdminID'] ) )
{ // no session var
  myRedirect( ADMIN_LOGIN . '?msg=5' ) ;
}
else
{
  if ( !is_numeric( $_SESSION['AdminID'] ) )
  { myRedirect(ADMIN_LOGIN . '?msg=5' ) ; }
  if ( !isset( $access ) || $access == '' )
  { $access = 'admin' ; } # empty becomes admin
  $access = strtolower( $access ) ; # in case of typo
  switch( $access )
  {
    case 'admin':
      break ;
    case 'superadmin':
      // not developer/superadmin, back to admin page
      if ( $_SESSION['Privilege'] != 'developer' && $_SESSION['Privilege'] != 'superadmin' )
      { myRedirect( ADMIN_DASHBOARD . '?msg=1' ) ; }
      break ;
    case 'developer': # highest level. all access!
      // not developer to admin page
      if ( $_SESSION['Privilege'] != 'developer' )
      { myRedirect( ADMIN_DASHBOARD . '?msg=1' ) ; }
      break ;
    break ;
  }
}
?>
