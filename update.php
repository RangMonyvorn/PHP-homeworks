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



// Fetch existing record
if (isset($_GET['id'])) {
    $id = ($_GET['id']);
    $sql = "SELECT * FROM newtable WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        echo "No record found with ID: $id";
        exit;
    }

}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "UPDATE newtable SET name=?, email=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $id);


    if ($stmt->execute()) {
        echo "Record updated successfully";
        $stmt->close();
        $conn->close();
        header("Location: get.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"],
        a.button {
            padding: 10px 15px;
            border: none;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        a.button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Record</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <label>New Password:</label>
        <input type="password" name="password"   value="<?php  echo htmlspecialchars($row['password'])   ?>" required>

        <div class="actions">
            <input type="submit" value="Update">
            <a href="get.php" class="button">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
