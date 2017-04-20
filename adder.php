<!-- TROUBLESHOOTING ASSIGNMENT (Updated 04/13/2008) -->
<!-- This assignment will be to troubleshoot a PHP page, called "adder.php".  Before errors were added to it, the page was designed to add 2 numbers via form field input, and produce the correct answer. -->
<!-- The adder PHP code contains several errors.  Your task for this assignment is to troubleshoot this page, and get it back to full functionality.  When you are done troubleshooting the page, it should work and be able to add numbers several times in a row, without fail, and without redirecting the user to an incorrect page.  To see how the corrected page works, please see the homework page. -->
<!-- Here is the flawed code: -->

<?php
//adder.php
if( isset( $_POST['num1'] ) )
{
  $num1 = $_POST['num1'] ;
  $num2 = $_POST['num2'] ;
  $myTotal = $num1 + $num2 ;
  print '<h2 align="center">You added <font color="blue">' . $num1 . '</font> and ' ;
  print '<font color="blue">' . $num2 . '</font> and the answer is <font color="red">' . $myTotal . '</font>!' ;
  unset( $_POST['num1'] ) ;
  unset( $_POST['num2'] ) ;
  print '<br /><a href=' . $_SERVER['PHP_SELF'] . '>Reset page</a>' ;
}
else
{
?>
<html>
<body>
  <h1 align="center">Adder.php</h1>
  <form action="<? print $_SERVER['PHP_SELF']; ?>" method="post">
    Enter the first number:<input type="text" name="num1"><br />
    Enter the second number:<input type="text" name="num2"><br />
    <input type="submit" value="Add Em!!" />
  </form>
</body>
</html>
<?php
}
?>

<!-- If you are able to fully troubleshoot the page, link it to your construction page, indicating the assignment number.  If you are NOT able to achieve full functionality, link a word doc detailing all the errors you found (they must be functional errors, no XHTML compliancy issues, etc.) on your construction page instead.  The number of errors you find in this case will allot you partial credit for the assignment.  HINT: There should be ten errors.  Troubleshoot in the order they are presented to you by PHP error when you attempt to run the page.  Note each one, and you will then know you got them all!  HINT HINT: Not all errors will display an error message.  Test to be sure FULL functionality is achieved! -->
