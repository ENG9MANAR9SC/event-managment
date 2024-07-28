<?php

require_once '../DB/db_connect.php';


$pdo = connectToDatabase();

header("Content-Type:application/json");



$events = json_decode(file_get_contents('../externalData/data.json'), true);

if(empty($events))
{
	response(200,"event Not Found",NULL);
}
else
{
	// store data
	try { 	
			$sql = "INSERT IGNORE INTO participations (participation_id, employee_name, employee_mail, event_id, event_name, participation_fee, event_date)
					VALUES (:participation_id, :employee_name, :employee_mail, :event_id, :event_name, :participation_fee, :event_date)";
			
				// Prepare the statement
				$stmt = $pdo->prepare($sql);

				// Iterate through the JSON data and insert each record
				foreach ($events as $event) {
					$stmt->bindParam(':participation_id' , $event['participation_id']);
					$stmt->bindParam(':employee_name'    , $event['employee_name']);
					$stmt->bindParam(':employee_mail'    , $event['employee_mail']);
					$stmt->bindParam(':event_id'         , $event['event_id']);
					$stmt->bindParam(':event_name'       , $event['event_name']);
					$stmt->bindParam(':participation_fee', $event['participation_fee']);
					$stmt->bindParam(':event_date'       , $event['event_date']);

					$stmt->execute();
				}
		}

	catch(PDOException $e) {

			echo "Error: " . $e->getMessage();
		}
 }

response(200,"event Found",$event);
	
	
function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}
