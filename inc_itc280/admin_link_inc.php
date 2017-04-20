<?php
/**
 * admin_link_inc.php session based 'peek-a-boo' administrator links
 *
 * Use this file as an include in your left nav, or other conspicuous INC file.
 * INC has 2 states:
 *
 * 1) Shows Admin's first name, links to admin & logout pages
 * 2) Not visible, if no admin logged in
 *
 * Placing this INC file at the top of your links provides access back to
 * admin pages for administrators
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_login.php
 * @see admin_validate.php
 * @see admin_logout.php
 * @see admin_only_inc.php
 * @see admin.php
 */
startSession() ; # wrapper for session_start()

if ( isset( $_SESSION['AdminID'] ) )
{
  print '<p align="center">' . $_SESSION['Privilege'] . ' <b>' . $_SESSION['FirstName'] . '</b> is logged in.</p>' ;
  print '<p align="center"><a href="' . ADMIN_DASHBOARD . '">ADMIN</a></p>' ;
  print '<p align="center"><a href="' . ADMIN_LOGOUT . '">LOGOUT</a></p>' ;
}
?>
