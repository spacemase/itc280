<?php
/**
 * admin_add.php is a single page web application that adds an administrator
 * to the admin database table
 *
 * This page is public by default, but as soon as you add yourself to the database,
 * make the page private by removing the commented referenct to admin_only_inc.php on
 * approximately line 54 of this page
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see admin_only_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$access = 'superadmin' ;
$PageTitle = 'Add Administrator' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'admin_only_inc.php' ; # KEEP COMMENTED UNTIL ADMINS ADDED, THEN UNCOMMENT FOR ADMIN SESSION PROTECTION!
include_once INCLUDE_PATH . 'header_inc.php' ;

if ( isset( $_POST['Email'] ) )
{ // if Email is set, check for valid data
  if ( !onlyEmail( $_POST['Email'] ) ) # checks email/password for valid data
  { myRedirect( ADMIN_ADD . '?msg=2' ) ; }
  if ( !onlyAlphaNum( $_POST['PWord1'] ) )
  { myRedirect( ADMIN_ADD . '?msg=2' ) ; }

  // create default 'admin' level connection to MySQL
  $myConn = conn(); # MUST precede formReq() function, which uses active connection to parse data
  $redirect = ADMIN_ADD . '?msg=1' ; # global var used for following formReq redirection on failure
  $FirstName = formReq( $_POST['FirstName'] ) ; # formReq calls dbIn() internally, to check form data
  $LastName = formReq( $_POST['LastName'] ) ;
  $AdminPW = formReq( $_POST['PWord1'] ) ;
  $Email = formReq( $_POST['Email'] ) ;
  $Privilege = formReq( $_POST['Privilege'] ) ;

  // sprintf() function allows us to filter data by type while inserting DB values
  // illegal data is neutralized, ie: numerics become zero
  $insertSQL = sprintf( "INSERT into " . PREFIX
                      . "Admin (FirstName,LastName,AdminPW,Email,Privilege,DateAdded) VALUES ('%s','%s',SHA('%s'),'%s','%s',NOW())",
                      $FirstName, $LastName, $AdminPW, $Email, $Privilege ) ;

  @mysql_query( $insertSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

  // feedback success or failure of insert
  if ( mysql_affected_rows( $myConn ) > 0 )
  { $msg= 'Administrator Added!' ; }
  else
  { $msg='RECORD NOT INSERTED!' ; }
  // Success? Place links on page to reset form, add another, exit
  echo '<div align="center"><h3>' . $msg . '</h3></div>' ;
  echo '<div align="center"><a href="' . ADMIN_ADD . '">Add Administrator</a></div>' ;
  echo '<div align="center"><a href="' . ADMIN_DASHBOARD . '">Exit To Admin</a></div>' ;
}
else
{ // show form - provide feedback
  if ( isset( $_GET['msg'] ) )
  { // feedback is provided - perhaps data was entered improperly
    switch ( $_GET['msg'] )
    {
      case 1:
        $feedback = 'A required form element was not provided' ;
        break ;
      case 2:
        $feedback = 'Email/Password violates requirements.' ;
        break ;
      default:
        $feedback = '' ;
    }
  }
  else
  { // no feedback
    $feedback = '' ;
  }
  if ( $feedback != '' )
  { $feedback = '<div align="center"><h3><font color="red">' . $feedback . '</font></h3></div>' ; }
?>

<!-- JavaScript include file holds all form validation functions -->
<script type="text/javascript" src="include/util.js"></script>
<script type="text/javascript">
  function checkForm( thisForm )
  { // check form data for valid info
    if ( !checkText( thisForm.FirstName, "Please Enter Administrator's First Name" ) ) { return false ; }
    if ( !checkText( thisForm.LastName, "Please Enter Administrator's Last Name" ) ) { return false ; }
    if ( !isEmail( thisForm.Email, "Please enter a valid Email Address" ) ) { return false ; }
    if ( !isAlphanumeric( thisForm.PWord1, "Only alphanumeric characters are allowed for passwords." ) )
    {
      thisForm.PWord2.value = "" ;
      return false ;
    }
    if ( !correctLength( thisForm.PWord1, 6, 20, "Password does not meet the following requirements:" ) )
    {
      thisForm.PWord2.value = "" ;
      return false ;
    }
    if ( thisForm.PWord1.value != thisForm.PWord2.value )
    { // match password fields
      alert( "Password fields do not match." ) ;
      thisForm.PWord1.value = "" ;
      thisForm.PWord2.value = "" ;
      thisForm.PWord1.focus() ;
      return false ;
    }
    // if all is passed, submit!
    return true ;
  }
</script>
<h3 align="center">Add New Administrator</h3>
<p align="center">Be sure to write down password!!</p>

<?php echo $feedback ; # feedback, if any, provided here ?>

<form action="<?php echo ADMIN_ADD; ?>" method="post" onsubmit="return checkForm(this);">
  <table align="center">
    <tr>
      <td align="right">First Name</td>
      <td><input type="text" name="FirstName"><font color="red"><strong>*</strong></font></td>
    </tr>
    <tr>
      <td align="right">Last Name</td>
      <td><input type="text" name="LastName"><font color="red"><strong>*</strong></font></td>
    </tr>
    <tr>
      <td align="right">Email</td>
      <td><input type="text" name="Email"><font color="red"><strong>*</strong></font> <em>(will be login)</em></td>
    </tr>
    <tr>
      <td align="right">Privilege:</td>
      <td>
        <select name="Privilege">
          <option value="admin">admin</option>
          <option value="superadmin">superadmin</option>
          <option value="developer">developer</option>
        </select>
      </td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><input type="password" name="PWord1"><font color="red"><strong>*</strong></font> <em>(6-20 alphanumeric chars)</em></td>
    </tr>
    <tr>
      <td align="right">Re-enter Password</td>
      <td><input type="password" name="PWord2"><font color="red"><strong>*</strong></font></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><input type="submit" value="Add-Min!"><em>(<font color="red"><strong>*</strong> required field</font>)</em></td>
    </tr>
  </table>
</form>
<div align="center"><a href="<?php echo ADMIN_DASHBOARD  ;?>">Exit To Admin Page</a></div>

<?php
}
include_once INCLUDE_PATH . 'footer_inc.php' ;
?>
