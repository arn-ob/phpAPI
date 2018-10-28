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
    
    
    if ($_SERVER["REQUEST_METHOD"] == 'POST')
	{   
         $mobile  = $receive->mobile;
         $sms = $receive->sms_code;
         
          $sql = "SELECT * FROM login where mobile_number = '" . $mobile . "' and sms = '" .$sms . "'";

        
        if ($result = $conn->query($sql)) 
        {
            
            if($result->num_rows == 0){
               
                    $return[] = ["status" => false, "msg" => "NOT_VERIFIED", "error_code"=> 404];
           
            } else {
                
                        $row = $result->fetch_array();
                        
                        // if already verified
                        if($row["is_verified"] == "true"){
                            
                             $return[] = ["status" => true, "msg" => "ALREADY_VERIFIED"];
                        
                            
                        } else {
                            
                            // if new verification
                            $sqls = "UPDATE login SET is_verified='true' WHERE mobile_number = '" . $mobile . "'";
                            
                            if ($result = $conn->query($sqls)) {
                                $return[] = ["status" => true, "msg" => "USER_VERIFIED"];
                            }
                        }
            }
            
            echo json_encode($return);
        }
        
	  
    }
