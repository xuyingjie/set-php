<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Name, Token');
require ("db_con.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);
if (isset($request['title'])) {
    $result = mysqli_query($db, "select distinct title from dbmy order by title");
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} elseif (isset($request['name'])) {
    $name = $request['name'];
    $query = "select * from dbmy where title='$name' order by id desc";
    $result = mysqli_query($db, $query);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} elseif (isset($request['search'])) {
    $search = $request['search'];
    $query = "select * from dbmy where title like (\"%" . $search . "%\") or text like (\"%" . $search . "%\") order by id desc";
    $result = mysqli_query($db, $query);
    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} elseif (isset($request['id'])) {
    $id = $request['id'];
    $result = mysqli_query($db, "select * from dbmy where id=$id");
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}
?>
