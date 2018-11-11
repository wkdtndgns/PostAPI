
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
$title=$data["title"];
$writer=$data["writer"];
$context=$data["context"];


$query = "UPDATE post SET title= '".$title."', writer= '".$writer."', context= '".$context."'
    WHERE id='".$id."';
";

if(mysqli_query($conn, $query))
{
    $response=array(
        'status' => 200,
        'status_message' =>'Update Successfully.',
    );
}
else
{
    $response=array(
        'status' => 500,
        'status_message' =>'Update Failed.',
    );
}
echo json_encode($response);
$conn->close();
?> 
