<?php
$host = "localhost";
$username = "root";
$password = "";
$databasename = "leaningcreatetable";

// Create connection
$conn = new mysqli($host, $username, $password, $databasename);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM newtable ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .container {
            max-width: 1300px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .action-link {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }
        .delete {
            background-color: #e74c3c;
            color: white;
        }
        .delete:hover {
            background-color: #c0392b;
        }
        .update {
            background-color: #27ae60;
            color: white;
        }
        .update:hover {
            background-color: #1e8449;
        }
        .create-button {
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }
        .create-button a {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }
        .create-button a:hover {
            background-color: #1c638d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 14px 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        h2{
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;


        }
        p{
            font-family:'Times New Roman', Times, serif;
            font-size: 10px;
            color: #2c3e50;
            margin-bottom: 30px;
            letter-spacing: 2px;


        }
        .api{
            background-color: #2980b9;
            color: white;
            padding: 5px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="create-button">
        <a href="post.php">➕ Create New Table</a>
    </div>

    <h2>📋 Show Data from Database</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
                echo "<td>
                        <a class='action-link delete' href='delete.php?id=" . htmlspecialchars($row["id"]) . "'>Delete</a>
                        <a class='action-link update' href='update.php?id=" . htmlspecialchars($row["id"]) . "'>Update</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='no-data'>No records found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>
   
<br><br>
    <p>Click the link below to watching  API:</p>
    <a href="createapi.php" class="api"> API</a><br><br>
</body>
</html>
