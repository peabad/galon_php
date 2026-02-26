<?php
include "../db.php";
 
$sql = "
SELECT p.*, b.booking_date, c.full_name
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
JOIN clients c ON b.client_id = c.client_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>

<div class="container mt-4">
<h2 class="text-center mb-5 mt-3 display-1">Payments</h2>
 <div class="card shadow mx-auto" style="max-width: 1200px;">
    <div class="card-body">
<div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table"style="color: #53179C !important;">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Client</th>
              <th scope="col">Booking ID</th>
              <th scope="col">Amount</th>
              <th scope="col">Method</th>
              <th scope="col">Date</th>
            </tr>
            </thead>
          <tbody>
  <?php while($p = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $p['payment_id']; ?></td>
      <td><?php echo $p['full_name']; ?></td>
      <td><?php echo $p['booking_id']; ?></td>
      <td>₱<?php echo number_format($p['amount_paid'],2); ?></td>
      <td><?php echo $p['method']; ?></td>
      <td><?php echo $p['payment_date']; ?></td>
    </tr>
  <?php } ?>
</table>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>