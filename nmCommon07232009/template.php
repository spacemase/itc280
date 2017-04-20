<?php
/**
 * template.php is a generic blank page to use as a model for most site pages
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
$PageTitle = 'PHP Template Page!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
require_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">inside template.php</h3>

<p>When you need to create a new page,
save a copy of this file, rename it, and begin
working here, in the 'guts' (identity) area of the page!</p>

<?php require_once INCLUDE_PATH . 'footer_inc.php' ; ?>
