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

    $api = $receive->api;
    
    
    
    if($api == "searchQ1"){
        $numberOfItem = $receive->no_of_item;
        $start = $receive->start;
        $end = $receive->end;
        $order = $receive->order;
        
        
        // Check POST METHOD
    	if ($_SERVER["REQUEST_METHOD"] == 'POST')
    	{
    	    $sql_location = "SELECT * FROM `rent` where no BETWEEN '" . $start . "' and '" . $end . "' ORDER BY no '" . $order . "'  LIMIT '" . $numberOfItem . "'";
            
            if ($result = $conn->query($sql_location) === TRUE) 
            {
                if($result->num_rows == 0){
                $return[] = ["status" => "false", "msg" => "Invalid username or password given. Please try again"];
            }else {
                $row = $result->fetch_array();
                $return[] = [   "status" => "true", 
                                "msg" => "User Found", 
                                "name" => $row["username"],
                                "id" => $row["id"],
                                "pic" => "https://freedesignfile.com/upload/2015/08/Beautiful-natural-scenery-and-sun-vector-01.jpg",
                                "token" => token()
                            ];
            }
                
            }else{
            
            $return[] = ["Problem" => "Not POST Method"];
            $return[] = ["Hello" => "Its an API send a POST Requset"];
    
            }
            // JSON Encoding to send 
            echo json_encode($return);
    	}
        
    }
    
    
    
    if($api == "location"){
        
        $locationid = base64_encode(rand(10,100));
        $map_lat = $receive->lat;
        $map_long = $receive->long;
        $location_name = $receive->location_name;
    
        // Check POST METHOD
    	if ($_SERVER["REQUEST_METHOD"] == 'POST')
    	{
    	    $sql_location = "INSERT INTO `location`(`location_id`, `map_lat`, `map_long`, `name`, `created_date`) 
                                    VALUES ('" .$locationid. "','" .$map_lat. "','" .$map_long. "','" .$location_name. "',CURRENT_DATE)";
            
            if ($conn->query($sql_location) === TRUE) 
            {
                $return[] = ["status" => "true", "msg" => "Location Updated", "update" => "Location"];
                
            }else{
            
            $return[] = ["Problem" => "Not POST Method"];
            $return[] = ["Hello" => "Its an API send a POST Requset"];
    
            }
            // JSON Encoding to send 
            echo json_encode($return);
    	}
    }
    
    if($api == "apartment"){
        
        $apartid = base64_encode(rand(10,100));
        $type = $receive->type;
        $picture = $receive->picture;
        $size = $receive->size;
        $room_no = $receive->room_no;
        
        
        // Check POST METHOD
    	if ($_SERVER["REQUEST_METHOD"] == 'POST')
    	{
    	    $sql_aprt = "INSERT INTO `apartment`(`apart_id`, `type`, `picture`, `size`, `no_of_room`, `created_date`) 
                                           VALUES ('" .$apartid . "','" .$type . "','" .$picture . "','" .$size . "','" .$room_no . "', CURRENT_DATE)";
          
            if ($conn->query($sql_aprt) === TRUE) 
            {
                $return[] = ["status" => "true", "msg" => "Apartment Updated", "update" => "apartment"];
            }else{
            
            $return[] = ["Problem" => "Not POST Method"];
            $return[] = ["Hello" => "Its an API send a POST Requset"];
    
            }
            // JSON Encoding to send 
            echo json_encode($return);
    	}
    }
    
    // for insert value to rent
    if($api  == "insert"){
        $rent_id = base64_encode(rand(100,100000));
            
        // Data Receive 
        $title  = $receive->title;
        $details  = $receive->details;
        $apartid = $receive->apartid; 
        
        if($apartid == "new"){
            $apartid = base64_encode(rand(10,100));
            $type = $receive->type;
            $picture = $receive->picture;
            $size = $receive->size;
            $room_no = $receive->room_no;
            
        }
        
         $locationid = $receive->locationid; 
        if($locationid == 'null'){
            
            $locationid = base64_encode(rand(10,100));
            $map_lat = $receive->lat;
            $map_long = $receive->long;
            $location_name = $receive->location_name;
        
        }
        
        $nearby  = $receive->nearby;
        $is_booked  = $receive->is_booked;
        $is_booked_conf  = $receive->is_booked_conf;
        $amount  = $receive->amount;
        
        // Check POST METHOD
    	if ($_SERVER["REQUEST_METHOD"] == 'POST')
    	{   
            
            
            $sql_main = "INSERT INTO `rent`(`rent_id`, `title`, `details`, `apart_id`,
                                            `location_id`, `is_booked`, `nearby_place`, 
                                            `is_booked_conf`, `amount`, `created_date`, `created_time`) 
                                     VALUES ('" .$rent_id . "','" .$title . "','" .$details . "','" .$apartid . "',
                                             '" .$locationid . "','" .$is_booked . "','" .$nearby . "','" .$is_booked_conf . "',
                                             '" .$amount . "', CURRENT_DATE, CURRENT_TIME)";
                                             
            $sql_aprt = "INSERT INTO `apartment`(`apart_id`, `type`, `picture`, `size`, `no_of_room`, `created_date`) 
                                           VALUES ('" .$apartid . "','" .$type . "','" .$picture . "','" .$size . "','" .$room_no . "', CURRENT_DATE)";
          
            $sql_location = "INSERT INTO `location`(`location_id`, `map_lat`, `map_long`, `name`, `created_date`) 
                                    VALUES ('" .$locationid. "','" .$map_lat. "','" .$map_long. "','" .$location_name. "',CURRENT_DATE)";
                                    
                                    
            if ($conn->query($sql_main) === TRUE) 
            {       
                 if($receive->apartid == "new"){
                     if ($conn->query($sql_aprt) === TRUE) 
                        {
                             $return[] = ["status" => "true", "msg" => "Apartment Updated", "update" => "apartment"];
                        }
                 }
                 
                 if($receive->locationid == "new"){
                     if ($conn->query($sql_location) === TRUE) 
                        {
                             $return[] = ["status" => "true", "msg" => "Location Updated", "update" => "location"];
                        }
                 }
                 
                $return[] = ["status" => "true", "msg" => "Rent Data Insert", "update" => "rent"];
                 
               
            }else {
                $return[] = ["problem" => "[Dev -> Debug] Problem Found in SQL Store Procedure"];
            }

          
            // JSON Encoding to send 
            echo json_encode($return);
    	}else{
            $return[] = ["Problem" => "Not POST Method"];
            $return[] = ["Hello" => "Its an API send a POST Requset"];
    
            // JSON Encoding to send 
            echo json_encode($return);
        }
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
