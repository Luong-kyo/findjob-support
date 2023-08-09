<?php 

// Replace with your MySQL server settings
$connect = new mysqli("localhost","root","","heqd");

// Check connect
if ($connect -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
};

// echo "Connected successfully!";