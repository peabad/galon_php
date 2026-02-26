<?php
include "../db.php";
 
$message = "";

if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty = $_POST['qty_used'];
 
  $toolRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT quantity_available FROM tools WHERE tool_id=$tool_id"));
 
  if ($qty > $toolRow['quantity_available']) {
    $message = "Not enough available tools!";
  } else {
    mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
      VALUES ($booking_id, $tool_id, $qty)");
 
    mysqli_query($conn, "UPDATE tools SET quantity_available = quantity_available - $qty WHERE tool_id=$tool_id");
 
    $message = "Tool assigned successfully!";
  }
}
 
$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
$bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id ASC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tools</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<body>
<?php include "../nav.php"; ?>
 
<div class="container mt-4 mb-4">
  <div class="card shadow mx-auto" style="max-width: 1200px;">
    <div class="card-body">
<h2>Tools / Inventory</h2>
<p style="color:green;"><?php echo $message; ?></p>
 
<h5>Available Tools</h5>
<div class="table-responsive">
  <table class="table table-striped table-hover">
  <thead class="table"style="color: #53179C !important;">
  <tr>
    <th scope="col">Name</th>
    <th scope="col">Total</th>
    <th scope="col">Available</th>
  </tr>

  <?php while($t = mysqli_fetch_assoc($tools)) { ?>
    <tr>
      <td><?php echo $t['tool_name']; ?></td>
      <td><?php echo $t['quantity_total']; ?></td>
      <td><?php echo $t['quantity_available']; ?></td>
    </tr>
  <?php } ?>
</table>
 
<hr>
 
<h5>Assign Tool to Booking</h5>
<form method="post">
  <div class="card-body">
    
  <label class="form-label">Booking ID</label><br>
  <select class="form-select" name="booking_id">
    <?php while($b = mysqli_fetch_assoc($bookings)) { ?>
      <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
    <?php } ?>
  </select><br><br>
 
  <label class="form-label">Tool</label><br>
  <select class="form-select" name="tool_id">
    <?php
      $tools2 = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
      while($t2 = mysqli_fetch_assoc($tools2)) {
    ?>
      <option value="<?php echo $t2['tool_id']; ?>">
        <?php echo $t2['tool_name']; ?> (Avail: <?php echo $t2['quantity_available']; ?>)
      </option>
    <?php } ?>
  </select><br><br>
 
  <label>Qty Used</label><br>
  <input type="number" class ="form-control" name="qty_used" min="1" value="1"><br><br>
  <div class="text-end">
  <button  class="btn btn-primary btn-lg" style="background-color: #53179C !important;" type="submit" name="assign">‎ ‎ASSIGN ‎  ‎</button>

</form>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>