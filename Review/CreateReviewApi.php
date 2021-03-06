
<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: http://localhost:3024");
include '../resources/properties.php';

$response=array();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$data = json_decode(file_get_contents("php://input"),true);

$postId=$data["id"];
$context=$data["context"];

$postId =preg_replace('/[^0-9]/', '', $postId);
$context =mysqli_real_escape_string($conn,$context);

$query="INSERT INTO review SET postId='".$postId."', context='".$context."';";
 
 if(mysqli_query($conn, $query))
 {
     $response=array(
         'status' => 200,
         'status_message' =>'Create Successfully.',
     );
 }
 else
 {
     $response=array(
         'status' => 500,
         'status_message' =>'Create Failed.',
     );
 }

 echo json_encode($response);
 
$conn->close();
?> 
