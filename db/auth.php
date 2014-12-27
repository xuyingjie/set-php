<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Name, Token');

$headers = array();
$headers = getallheaders();

if ($headers['Token']) {

  require("db_con.php");

  $name = $headers['Name'];
  $token = $headers['Token'];
  $query = "select * from users where name='$name' and token='$token'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result)) {
      echo 1;
  }
}

?>
