<?php 
   $host = "localhost";
   $username = "root";
   $password = "";
   $databasename = "leaningcreatetable";
   
   // Create connection
   $conn = new mysqli($host, $username, $password, $databasename);


    // Check connection
    $response = array();


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        // Fetch data from the database
        $sql = "SELECT * FROM newtable ORDER BY id ASC";
        $result = mysqli_query($conn , $sql);


        if($result){
            header('Content-type: JSON');
            $i= 0 ;
            while($row = mysqli_fetch_assoc($result)){
                $response [$i]['id'] = $row['id'];
                $response [$i]['name'] = $row['name'];
                $response [$i]['email'] = $row['email'];
                $response [$i]['password'] = $row['password'];

                $i++;

            }

            echo json_encode($response , JSON_PRETTY_PRINT);
        }
        // If no records found
        else {
            echo json_encode(array("message" => "No records found."));
        }
        $conn->close();

    }
   


?>
