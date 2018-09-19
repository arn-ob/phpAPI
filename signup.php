<?php
    include "_db/db.php";

    // Data Store for Send
    $return = array();

    // Connection Check
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check POST METHOD
	if ($_SERVER["REQUEST_METHOD"] == 'POST')
	{   
        $data = file_get_contents('php://input'); // put the contents of the file into a variable
        $receive = json_decode($data); // decode the JSON feed

        // Data Receive 
        $username  = $receive->username;
        $password  = $receive->password;
        $full_name  = $receive->full_name;
        $mobile  = $receive->mobile;

        if(check($username) && check($password) && check($full_name) && is_numeric($mobile)){

            $sql_check = "SELECT * FROM login where mobile_number = '" .$mobile . "' or username = '" .$username . "'";
            if ($result = $conn->query($sql_check)) {
                if($result->num_rows == 0){

                        // mysql Store Procedure
                        $sql_sp = "CALL `insert`('" .$username . "','" .$password . "','" .$full_name . "','" .$mobile . "')";
            
                        if ($conn->query($sql_sp) === TRUE) 
                        {
                            $return[] = ["status" => "true", "msg" => "Thank you for signup"];
                        }else {
                            $return[] = ["problem" => "[Dev -> Debug] Problem Found in SQL Store Procedure"];
                        }
                }else {
                    $return[] = ["status" => "false", "msg" => "User already exist with same mobile number or Username"];
                }
            }

        }else{
            $return[] = ["Problem" => "[Dev -> Debug] Check Entry"];
            $return[] = ["username" => $username ? $username : "Not Found" ];
            $return[] = ["mobile" => $mobile ? $mobile : "Not Found" ];
            $return[] = ["password" => $password ? $password : "Not Found" ];
            $return[] = ["full_name" => $full_name ? $full_name : "Not Found" ];
        }

        // JSON Encoding to send 
        echo json_encode($return);
	}else{
        $return[] = ["Problem" => "Not POST Method"];
        $return[] = ["Hello" => "Its an API send a POST Requset"];

        // JSON Encoding to send 
        echo json_encode($return);
    }

    function check($check){
        if(!empty($check)){
            return true;
        }
        else{
            return false;
        }
    }
    $conn->close();
?>