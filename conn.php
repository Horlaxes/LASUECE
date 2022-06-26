<?php 

//$host = "localhost";
//$user = "root";
//$pass = "";
//$db   = "cee_db";

$host = "us-cdbr-east-05.cleardb.net";
$user = "b96474351ff8a0";
$pass = "f7cb9599";
$db   = "heroku_f6af4f46115895d";

$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  die("Cannot connect to DB.");
}

//mysql://b96474351ff8a0:f7cb9599@us-cdbr-east-05.cleardb.net/heroku_f6af4f46115895d?reconnect=true