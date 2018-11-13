
<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: http://localhost:3000");
include '../resources/properties.php';

$response=array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$data = json_decode(file_get_contents("php://input"),true);
$id=$data["id"];

$sql = "SELECT id,context FROM review WHERE postId='".$id."' ORDER BY id DESC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $response[]=$row;
    }
} else {
    $response=array(
        'status' => 204,
        'status_message' => "Find Failed.",
    );
}

echo json_encode($response);
$conn->close();
?> 
