<?php
$mysqli = new mysqli("localhost","root","","project");

// Check connection
if ($mysqli -> connect_errno) {
  die("Failed to connect to MySQL: " . $mysqli -> connect_error);
  
}

?>