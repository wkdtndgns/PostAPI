
<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: http://localhost:3000");
include 'resources/properties.php';

$response=array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$data = json_decode(file_get_contents("php://input"),true);
$id=$data["id"];


$sql = "SELECT id, title, writer, writtenDate, views, context FROM post
    WHERE id='".$id."';
";

$result = $conn->query($sql);
$views=0;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $response[]=$row;
        $views = $row["views"];
    }
} else {
    echo "";
}

$views+=1;

$sql = "UPDATE post SET views= '".$views."'
    WHERE id='".$id."'
";
$conn->query($sql);


echo json_encode($response);
$conn->close();
?> 
