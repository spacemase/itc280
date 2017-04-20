<?php
ini_set('session.save_path','/home/classes/mjense11/sessions');
session_start(); //must be declared before using any session data
$_SESSION['test'] = "If you can read this, sessions are working!"; //create test session
print $_SESSION['test'] . "<br>";
print "Session ID is: ". session_id()."<br>";
?>

