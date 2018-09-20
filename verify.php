<?php

    $data = file_get_contents('php://input'); // put the contents of the file into a variable
    $receive = json_decode($data); // decode the JSON feed

    $iat  = $receive->token->iat;
    $jti = $receive->token->jti;

    $jti = intval(base64_decode($jti));

     // Data Store for Send
     $return = array();

    if($iat === $jti){
         $return[] = ["status" => "true", "msg" => "Token Verified", "token" => token()];
    }else{
        $return[] = ["status" => "false", "msg" => "Token invalied"];
    }

    echo json_encode($return);

     function token(){
        
        $time = date("hisa");
        $tokenId    = base64_encode($time);
        $issuedAt   = intval($time);
        $expire     = $issuedAt + 60 * 60;            // Adding 60 seconds
        /*
        * Create the token as an array
        */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'exp'  => $expire           // Expire
        ];
        return $data;
        
    }
?>