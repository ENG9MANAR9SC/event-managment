<?php

require_once 'DB/db_connect.php';


function eventIndex() {

    $pdo = connectToDatabase();

    // Check for filter parameters
    $employee_name = isset($_GET['employee_name']) ? $_GET['employee_name'] : '';
    $event_name = isset($_GET['event_name']) ? $_GET['event_name'] : '';
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

    // Build the WHERE clause based on filters
    $where_clause = "";
    $params = array();
    if (!empty($employee_name)) {
        $where_clause .= " AND employee_name LIKE :employee_name";
        $params[':employee_name'] = '%' . $employee_name . '%';
    }
    if (!empty($event_name)) {
        $where_clause .= " AND event_name LIKE :event_name";
        $params[':event_name'] = '%' . $event_name . '%';
    }
    if (!empty($start_date)) {
        $where_clause .= " AND event_date >= :start_date";
        $params[':start_date'] = $start_date;
    }
    if (!empty($end_date)) {
        $where_clause .= " AND event_date <= :end_date";
        $params[':end_date'] = $end_date;
    }

    // Build the SQL query
    $sql = "SELECT * FROM participations WHERE 1 = 1 " . $where_clause;

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $filtered_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null ; // close connection 

    return $filtered_data;
     
}