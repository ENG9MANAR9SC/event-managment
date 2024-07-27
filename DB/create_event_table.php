<?php 

// TODO move to .env
// $host = $_ENV["DB_HOST"];
// $database = $_ENV["DB_DATABASE"];
// $username = $_ENV["DB_USERNAME"];
// $password = $_ENV["DB_PASSWORD"];

$host     = 'localhost';
$username = 'root'; 
$password = ''; 
$database = 'event_management';

// Connect to our the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully!";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// Create the table
$sql = "CREATE TABLE IF NOT EXISTS participations (
        participation_id INT PRIMARY KEY,
        employee_name VARCHAR(255) NOT NULL,
        employee_mail VARCHAR(255) NOT NULL,
        event_id INT NOT NULL,
        event_name VARCHAR(255) NOT NULL,
        participation_fee DECIMAL(10,2) NOT NULL,
        event_date DATE NOT NULL
)";

try {
    $conn->exec($sql);
    echo "Table created successfully.";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}



// Sample data for testing
// $data = array(
//     "participation_id" => 1,
//     "employee_name" => "Reto Fanzen",
//     "employee_mail" => "reto.fanzen@no-reply.rexx-systems.com",
//     "event_id" => 1,
//     "event_name" => "PHP 7 crash course",
//     "participation_fee" => 0,
//     "event_date" => "2019-09-04"
// );

// Prepare the SQL statement
//$sql = "INSERT INTO participations (participation_id, employee_name, employee_mail, event_id, event_name, participation_fee, event_date) VALUES (:participation_id, :employee_name, :employee_mail, :event_id, :event_name, :participation_fee, :event_date)";

// try {
//     $stmt = $conn->prepare($sql);
//     $stmt->execute($data);
//     echo "Data inserted successfully.";
// } catch(PDOException $e) {
//     echo "Error inserting data: " . $e->getMessage();
// }

// Close the connection
$conn = null; 
