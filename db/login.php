<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Name, Token');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);

if(isset($request['name'])&&isset($request['passwd'])){

  require("db_con.php");

  $name = $request['name'];
  $passwd = $request['passwd'];

  $query = "select * from users where name='$name' and passwd=sha1('$passwd')";
  $result = mysqli_query($db, $query);

  if(mysqli_num_rows($result)){
    $token = md5(time()*rand());

    $query = "update users set token='$token' where name='$name'";
    $result = mysqli_query($db, $query);

    if($result){
      $arr = array();
      $arr['token'] = $token;
      echo json_encode($arr);
    }
  }

}

?>
