<?php

require_once 'controller/eventController.php';

$filtered_data = eventIndex();


// calculate total price
$totalPrice = 0;

foreach ($filtered_data as $row) {
  $totalPrice += $row['participation_fee'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Filtered Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Events Managment</h1>
        <div class="mb-4">
            <p class="text-muted">Events Managment</p>
            <button type="button" class="btn btn-primary" onclick="fetchEvents()">Fetch Events</button>
        </div>
        
        <form method="GET" class="d-flex gap-2 align-items-end">
            <div class="mb-3">
                <label for="employee-name" class="form-label">Employee Name:</label>
                <input type="text" id="employee-name" name="employee_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="event-name" class="form-label">Event Name:</label>
                <input type="text" id="event-name" name="event-name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="start-date" class="form-label">Start Date:</label>
                <input type="date" id="start-date" name="start_date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="end-date" class="form-label">End Date:</label>
                <input type="date" id="end-date" name="end-date" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            

        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Participation ID</th>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Event Name</th>
                    <th>Participation Fee</th>
                    <th>Event Date</th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach ($filtered_data as $row): ?>
                    <tr>
                        <td><?php echo $row['participation_id']; ?></td>
                        <td><?php echo $row['employee_name']; ?></td>
                        <td><?php echo $row['employee_mail']; ?></td>
                        <td><?php echo $row['event_name']; ?></td>
                        <td><?php echo $row['participation_fee']; ?></td>
                        <td><?php echo $row['event_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th colspan="4">Total Price</th>
                    <td><?php echo number_format($totalPrice, 2); ?></td>  
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>


<script>

// function fetch events
async function fetchEvents() {
    try {
        
        const response = await fetch('/api/fetch-events.php');

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        else {
            //location.reload();
        }


    } catch (error) {
         console.error('Error fetching data:', error);
  }
}

</script>