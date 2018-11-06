<?php
     include "_db/db.php";
    
    $target_dir = "upload_picture/";
    
    $filename = $_POST["name"];
    $target_file = $target_dir . $filename;
    $where = $_POST["where"];
    
    if($_POST["mobile"] != "null"){
        $id = $_POST["mobile"];
    } else {
        $id = "null";
    }
    
    if($_POST["aprt_id"] != "null"){
        $id = $_POST["aprt_id"];
    }else {
        $id = "null";
    }
    
   
   // user picture upload
    if($where === "user"){
        
        $sql = "UPDATE login SET picture= '" . $filename . "' where mobile_number = '" . $_POST["mobile"] . "'";

        if ($result = $conn->query($sql)) {
   
            upload("Upload Success to user profile");
            echo json_encode(array("message" => "Upload Success to rent profile"));
            
        } else {
            
            echo json_encode(array("message" => "Check peramiter. There was a problem."));
        
        }
        
    }
    
    
    // rent picture upload
    if($where === "aprt"){
         
        $sql_check = "SELECT * FROM apartment WHERE apart_id = '" .$id . "'";
        
         if ($result = $conn->query($sql_check)) 
         {
            if($result->num_rows == 0)
            {
                echo json_encode(array("message" => " ! No User Found"));
                
            } 
            else 
            {    
                
                $row = $result->fetch_array();
                
                if($row["picture"] == "")
                {
                    if(upload()){
                        $sql1 = "UPDATE apartment SET picture = '" . $filename . "' WHERE apart_id = '" .$id . "'";
                
                        if ($result = $conn->query($sql1)) 
                        {
                            
                            echo json_encode(array("message" => "Upload Success to rent profile"));
                            
                        }
                    } else{
                        echo json_encode(array("message" => "File exist or something else", "error_code" => 404));
                    }
                    
                } 
                else 
                {
                    if(upload()){
                        
                        $filename = $row["picture"] . "," . $filename;
                        
                        $sql2 = "UPDATE apartment SET picture = '" . $filename . "' WHERE apart_id = '" .$id . "'";
                
                        if ($result = $conn->query($sql2)) 
                        {
                          
                                echo json_encode(array("message" => "Upload Success to rent profile"));
                               
                            
                        }
                    }
                    else{
                        echo json_encode(array("message" => "File exist or something else", "error_code" => 404));
                    }
               
                }
            }
            
        } else {
            
            echo json_encode(array("message" => "Check peramiter. There was a problem."));
        
        }
        
    }
        
            

    function upload($msg){
          
          if (file_exists($_FILES["file"]["tmp_name"])) {
    
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $GLOBALS['target_file'])) {
            
                   return true;
                   
                } else {

                    return false;
               }
        
    
        } else {
            
            // echo json_encode(array("message" => "File Exist"));
            return false;
        }
    }
?>
