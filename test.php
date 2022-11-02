<?php 
// PHP program to add days to $Date 
  
// Declare a date 
$date = "2019-05-10"; 
  
// Add days to date and display it 
echo date('Y-m-d', strtotime($date. ' + 3 years')); 
  
?> 