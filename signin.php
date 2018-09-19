<?php
    include "_db/db.php";

    $data = file_get_contents('php://input'); // put the contents of the file into a variable
    $receive = json_decode($data); // decode the JSON feed

    // Data Receive 
    $username  = $receive->username;
    $password  = $receive->password;

    // Data Store for Send
    $return = array();

    // Connection Check
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    print(token());
    // Check POST METHOD
	if ($_SERVER["REQUEST_METHOD"] == 'POST')
	{   
        $sql_invt = "SELECT * FROM login where username = '" .$username . "' and password = '" .$password . "'";
        if ($result = $conn->query($sql_invt)) {
            if($result->num_rows == 0){
                $return[] = ["status" => "false", "msg" => "Invalid username or password given. Please try again"];
            }else {
                $row = $result->fetch_array();
                $return[] = ["status" => "True", 
                                "msg" => "User Found", 
                                "name" => $row["username"],
                                ""
                            ];
            }
        } 
        echo json_encode($return);
    }

    function token(){
        
        $time = date("hisa");
        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = intval($time);
        $notBefore  = $issuedAt + 10;             //Adding 10 seconds
        $expire     = $notBefore + 60;            // Adding 60 seconds

        /*
        * Create the token as an array
        */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the signer user
                'userId'   => "dasd", // userid from the users table
                'userName' => "213sad", // User name
            ]
        ];
        return json_encode($data);

    }
?>