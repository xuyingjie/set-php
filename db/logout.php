<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Name, Token');
require("db_con.php");

$headers = array();
$headers = getallheaders();

$name = $headers['Name'];

$r = md5(time()*rand());

$query = "update users set token='$r' where name='$name'";
$result = mysqli_query($db, $query);

if ($result) {
  echo 1;
}

?>
