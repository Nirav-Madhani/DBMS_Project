<?php
/*error_reporting(0);
$connect = mysqli_connect("localhost","root","") or die('Connection failed!');//127.0.0.1
echo 'Connected!';
mysqli_select_db("mysql") or die('Error'.mysqli_error())  ;
echo '<br>Connected to database.';*/

$mysqli = new mysqli("localhost","root");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Return name of current default database
/*if ($result = $mysqli -> query("SELECT DATABASE()")) {
  $row = $result -> fetch_row();
  echo "Default database is " . $row[0];
  $result -> close();
}*/

// Change db to "test" db
$mysqli -> select_db("test");

/* Return name of current default database
if ($result = $mysqli -> query("SELECT DATABASE()")) {
  $row = $result -> fetch_row();
  echo "Default database is " . $row[0];
  foreach($row as $k){
      echo $k.'<br>';
  }
  $result -> close();
}*/



?>