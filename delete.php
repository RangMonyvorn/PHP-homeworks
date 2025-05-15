<?php 
$host = "fdb1028.awardspace.net";
$username = "4633334_crudproject";
$password = "Monyvorn168@@";
$databasename = "4633334_crudproject";

$conn = new mysqli($host, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
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