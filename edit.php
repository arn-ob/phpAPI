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
        $user_name  = $receive->user_name;
        $full_name  = $receive->full_name;
        $email =      $receive->email;
        $address =      $receive->address;
        $mobile_number = $receive->mobile_number;
        
        
        // sql
        $sql_invt = "UPDATE login SET username= '" . $user_name . "' , full_name = '" . $full_name . "', email = '" . $email . "', address = '" . $address . "' WHERE mobile_number = '" . $mobile_number . "'";

        
        if ($conn->query($sql_invt) === TRUE) {
                
            $return[] = [  
                            "status" => true
                        ];
          
        }else{
            
            $return[] = [
                            "status" => false
                        ];
        } 
        
        // send api respose    
        echo json_encode($return);
    
	}else{
        
        $return[] = ["Problem" => "Not POST Method"];
        $return[] = ["Hello" => "Its an API send a POST Requset"];

        // JSON Encoding to send 
        echo json_encode($return);
    }
?>
