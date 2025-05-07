<?php 
$host = "localhost"; 
$username = "root";
$password = ""; 
$databasename = "leaningcreatetable"; 

$conn = new mysqli($host, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
}
else {
    echo "Connected successfully";

}

  
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM newtable WHERE id = $id";
    if($conn->query($sql) === TRUE){
        echo "record deleted successfully";
        header("Location: get.php");
        exit();
    }
    else {
        echo "Error Delete recod" . $conn->error;
    }
}
else {
    header("Location: get.php");
    exit();
}




?>