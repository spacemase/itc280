<?php
/**
 * rte_test.php is a test page for the RTE (rich text editor)
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see rte_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
$PageTitle = 'RTE Test Page!' ;
require_once '/home/a5001834/public_html/inc_itc280/config_inc.php' ;
include_once INCLUDE_PATH . 'header_inc.php' ;
?>

<h3 align="center">rte_test.php</h3>
<p>A test page to demonstrate the rich text editor (RTE).</p>

<p align="center">Here is some text above the first edit area. This first version only calls the function and provides the minimum, the ID number of the RTE: <b>rteINC(1);</b></p>
<div align="center"><?php include_once INCLUDE_PATH . 'rte_inc.php'; rteINC(1);?></div>
<p align="center">Here is some text between the first and second edit areas. This version passes in the ID number, the width in percent, height and toolbar, which in this case is 'Default': <b>rteINC(2,'50%','300','Default');</b></p>
<div align="center"><?php include_once INCLUDE_PATH . 'rte_inc.php'; rteINC(2,'50%','300','Default');?></div>
<p align="center">Here is some text between the second and third edit areas. This version passes in the ID, width in pixels, height in pixels, Toolbar (Basic) and TRUE, which indicates to place a border around the editable area, before it is selected: 
<b>rteINC(3,'300','400','Basic',TRUE);</b></p>
<div align="center"><?php include_once INCLUDE_PATH . 'rte_inc.php'; rteINC(3,'300','400','Basic',TRUE);?></div>
<p align="center">Here is some text after the last edit area</p>

<?php
include_once INCLUDE_PATH . 'footer_inc.php' ;
?>
