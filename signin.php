<?php
    include "_db/db.php";

    $data = file_get_contents('php://input'); // put the contents of the file into a variable
    $receive = json_decode($data); // decode the JSON feed
    

    // Data Store for Send
    $return = array();

    // Connection Check
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check POST METHOD
	if ($_SERVER["REQUEST_METHOD"] == 'POST')
	{   
        // Data Receive 
        $username  = $receive->username;
        $password  = $receive->password;

        // sql
        $sql_invt = "SELECT * FROM login where username = '" .$username . "' and password = '" .$password . "'";

        
        if ($result = $conn->query($sql_invt)) {
            
            if($result->num_rows == 0){
               
                $return[] = ["status" => false, "msg" => "Invalid username or password given. Please try again"];
           
            }else {
                
                 $row = $result->fetch_array();
                 if($row["is_verified"] == "false"){
                     
                    $return[] = [  "status" => false,
                                    "error_code" => "NOT_VERIFIED",
                                    "sms_code" => $row["sms"]
                                 ];
                 }
                 if($row["is_verified"] == "true"){
                    
                    $return[] = [   "status" => true, 
                                    "msg" => "User Found", 
                                    "user_profile" => [
                                        "name" => $row["username"],
                                        "id" => $row["id"],
                                        "email" => $row["email"],
                                        "pic" => "uploads/".$row["picture"],
                                        "token" => token()
                                        ]
                                ];
                }    
            }
        } 
        
        // send api respose    
        echo json_encode($return);
    
	}else{
        
        $return[] = ["Problem" => "Not POST Method"];
        $return[] = ["Hello" => "Its an API send a POST Requset"];

        // JSON Encoding to send 
        echo json_encode($return);
    }

    // token Generator
    function token(){
        
        $time = date("hisa");
        $tokenId    = base64_encode($time);
        
        // $issuedAt   = intval($time);
        // $expire     = $issuedAt + 60 * 60;            // Adding 60 seconds
        /*
        * Create the token as an array
        */
        // $data = [
        //     'iat'  => $issuedAt,         // Issued at: time when the token was generated
        //    'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
        //    'exp'  => $expire           // Expire
        // ];
        
        return $tokenId;
    }
?>
