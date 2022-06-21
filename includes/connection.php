<?php 
session_start();
$user="root";
$password="root";
$database="mobile";
$server="localhost";

$connection=mysqli_connect($server,$user,$password,$database);

if(!$connection)
die("Failed to connect");