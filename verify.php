<?php

    $data = file_get_contents('php://input'); // put the contents of the file into a variable
    $receive = json_decode($data); // decode the JSON feed

    $iat  = $receive->token->iat;
    $jti = $receive->token->jti;

    $jti = intval(base64_decode($jti));

     // Data Store for Send
     $return = array();

    if($iat === $jti){
         $return[] = ["status" => "true", "msg" => "Token Verified"];
    }else{
        $return[] = ["status" => "false", "msg" => "Wrong Token"];
    }

    echo json_encode($return);
?>