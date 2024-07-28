<?php 

require_once 'DB/db_connect.php';

$pdo = connectToDatabase();

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
    $pdo->exec($sql);
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
$pdo = null; 
