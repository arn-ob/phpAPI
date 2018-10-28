<?php
    date_default_timezone_set("Asia/Dhaka");
    
    $data = file_get_contents('php://input'); // put the contents of the file into a variable
    $receive = json_decode($data); // decode the JSON feed
    
    $jti = $receive->token;
    
    $PrenetTime = intval(date("hisa"));

    $createTime = intval(base64_decode($jti));

    $ExpireTime = (int)$createTime + (60 * 60);
    
    
     // Data Store for Send
     $return = array();
    
    if($PrenetTime < $ExpireTime){
         $return[] = ["status" => "true", "msg" => "Token Verified", "token" => token()];
    }else{
        $return[] = ["status" => "false", "msg" => "Token invalied"];
    }
    
    // $returns[] = ["createTime" => $createTime, "PrenetTime" => $PrenetTime, "ExpireTime" => $ExpireTime]; // debug porpose
    
    echo json_encode($return);

     // token Generator
    function token(){
        
        $time = date("hisa");
        $tokenId    = base64_encode($time);
        return $tokenId;
    }
?>
