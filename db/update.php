<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Name, Token');
$headers = array();
$headers = getallheaders();
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
if ($headers['Token'] && isset($request['title'])) {
    require ("db_con.php");
    $name = $headers['Name'];
    $token = $headers['Token'];
    $query = "select * from users where name='$name' and token='$token'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result)) {
        $id = mysqli_real_escape_string($db, $request['id']);
        $title = mysqli_real_escape_string($db, $request['title']);
        $text = mysqli_real_escape_string($db, $request['text']);
        $result = mysqli_query($db, "update dbmy set title='$title',text='$text' where id=$id");
        if ($result) {
            echo 1;
        }
    }
}
?>
