<?php
include "../db.php";
 
$sql = "
SELECT b.*, c.full_name AS client_name, s.service_name
FROM bookings b
JOIN clients c ON b.client_id = c.client_id
JOIN services s ON b.service_id = s.service_id
ORDER BY b.booking_id ASC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Bookings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>

<div class="container mt-4">
    <h2 class="text-center mb-5 mt-3 display-1">Bookings</h2>
    <div class="card shadow mx-auto" style="max-width: 1200px;">
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped table-hover">
    <thead class="table"style="color: #53179C !important;">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Client</th>
        <th scope="col">Service</th>
        <th scope="col">Date</th>
        <th scope="col">Hours</th>
        <th scope="col">Total</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php while($b = mysqli_fetch_assoc($result)) { ?>
        <tr>
        <td><?php echo $b['booking_id']; ?></td>
        <td><?php echo $b['client_name']; ?></td>
        <td><?php echo $b['service_name']; ?></td>
        <td><?php echo $b['booking_date']; ?></td>
        <td><?php echo $b['hours']; ?></td>
        <td>₱<?php echo number_format($b['total_cost'],2); ?></td>
        <td><?php echo $b['status']; ?></td>
        <td>
            <a href="payment_process.php?booking_id=<?php echo $b['booking_id']; ?>" class="btn btn-sm btn-success">Process Payment</a>
        </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    <div class="text-end">
    <a href="bookings-create.php" class="btn btn-primary btn-lg" style="background-color: #53179C !important;">+ Create Booking</a>
    
    </div>
    </div>
</div>
</body>
</html>