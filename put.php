<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Token');

require_once 'oss/sdk.class.php';
$oss_sdk_service = new ALIOSS();
$oss_sdk_service->set_debug_mode(FALSE);

$headers = array();
$headers = getallheaders();

if ($headers['Token'] == '3f5cfad725974fbd3fe0f943c5fecfd32be4874e12ed2a608a3ef862c344610e'){

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata, true);

  if (isset($request["title"])) {
    put($oss_sdk_service, 'dbmy', 't/'.$request["id"], $postdata);
  } elseif (isset($request["version"])){
    put($oss_sdk_service, 'dbmy', 'etc/dbmy', $postdata);
  }
}

function put($obj, $bucket, $object, $content){
  $upload_file_options = array(
      'content' => $content,
      'length' => strlen($content),
      ALIOSS::OSS_HEADERS => array(),
  );
  $response = $obj->upload_file_by_content($bucket, $object, $upload_file_options); 
  if ($response->isOk()) {
    echo "ok";
  }
}

?>