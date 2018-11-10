
<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: http://localhost:3000");

$servername = "18.222.132.144:3306";
$username = "cafe";
$password = "test1234";
$dbname = "cafe";
$response=array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, title, writer, writtenDate, views FROM post";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $response[]=$row;
    }
} else {
    echo "0 results";
}

echo json_encode($response);
$conn->close();
?> 