
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

$sql = "SELECT p.id, title, writer, writtenDate, views, count(r.id) as reviewCount FROM post p
         LEFT JOIN review r 
         ON p.id=r.postId 
         GROUP BY p.id  
        ORDER BY id DESC;";

$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $response[]=$row;
        }
    } else {
        $response=array(
            'status' => 204,
            'status_message' =>"No data",
        );
    }
    echo json_encode($response);

$conn->close();
?> 
