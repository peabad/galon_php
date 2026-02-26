<?php
include "../db.php";
 
 
$booking_id = $_GET['booking_id'];
 
 
$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
 
 
$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];
 
 
$balance = $booking['total_cost'] - $total_paid;
$message = "";
 
 
if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];
 
 
  if ($amount <= 0) {
    $message = "Invalid amount!";
  } else if ($amount > $balance) {
    $message = "Amount exceeds balance!";
  } else {
 
 
    // 1) Insert payment
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
      VALUES ($booking_id, $amount, '$method')");
 
 
    // 2) Recompute total paid (after insert)
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];
 
 
    // 3) Recompute new balance
    $new_balance = $booking['total_cost'] - $total_paid2;
 
 
    // 4) If fully paid, update booking status to PAID
    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }
 
 
    header("Location: bookings_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Process Payment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<?php include "../nav.php"; ?>
 
<div class="container">
 <div class="mx-auto card shadow mb-5 mt-5" style="width: 26rem;">
    <div class="card-body">
      <h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>
      
    <?php if ($message != ""): ?>
      <div class="alert alert-danger m-3" role="alert">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>

<p>Total Cost: ₱<?php echo number_format($booking['total_cost'],2); ?></p>
<p>Total Paid: ₱<?php echo number_format($total_paid,2); ?></p>
<p><b>Balance: ₱<?php echo number_format($balance,2); ?></b></p>

<hr>
 
 
<form method="post">
  <div class="card-body">
  <label class="form-label">Amount Paid</label><br>
  <input type="number" class="form-control" name="amount_paid" step="0.01"><br>
 
 
  <label>Method</label><br>
  <select class="form-select" name="method">
    <option value="CASH">CASH</option>
    <option value="GCASH">GCASH</option>
    <option value="CARD">CARD</option>
  </select><br><br>
 
 <div class="d-flex gap-2">
  <button type="submit" name="pay" class="btn btn-primary flex-grow-1" style="background-color: #53179C;">Save Payment</button>
  <a href="services-list.php" class="btn btn-secondary">Cancel</a>
</form>
 
 
</body>
</html>