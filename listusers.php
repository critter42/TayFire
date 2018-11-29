<h1>List of Users</h1>
<?php
$servername = "localhost";
$username = "TayFire";
$password = "T4yF1r3!";
$dbname = "TayFire";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT User_ID, fname, lname FROM User";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["User_ID"]. ": Name: " . $row["fname"]. " " . $row["lname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
