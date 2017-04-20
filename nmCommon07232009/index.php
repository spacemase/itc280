<?php
/**
 * index.php is the main website page
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see header_inc.php
 * @see footer_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'Main Page!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
include_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">Welcome to our website!</h3>

<p>Put info about your website here!</p>

<?php include_once INCLUDE_PATH . 'footer_inc.php' ; ?>
