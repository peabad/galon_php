
  <?php
  include "../db.php";
  
  $clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
  $services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");
  $message = "";
  if (isset($_POST['create'])) {
    $client_id = $_POST['client_id'];
    $service_id = $_POST['service_id'];
    $booking_date = $_POST['booking_date'];
    $hours = $_POST['hours'];
  
    $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
    $rate = $s['hourly_rate'];
  
    $total = $rate * $hours;
  
    mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
      VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");
  
    header("Location: bookings-list.php");
    exit;
  }
  ?>
  <!doctype html>
  <html>
  <head><meta charset="utf-8"><title>Create Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
  <body style="background-color: #EEE8F5 !important;">
  <?php include "../nav.php"; ?>
  
  <h2 class="text-center mb-5 mt-3 display-1">Create Booking</h2>

  <div class="mx-auto card shadow mb-10" style="width: 26rem;">
      <?php if ($message != ""): ?>
      <div class="alert alert-danger m-3" role="alert">
          <?php echo $message; ?>
      </div>
      <?php endif; ?>

  
  <form method="post">
    <div class="card-body">
      <div class="mb-3">
      <label class="form-label">Client</label><br>
      <select class="form-select" name="client_id">
        <?php while($c = mysqli_fetch_assoc($clients)) { ?>
          <option value="<?php echo $c['client_id']; ?>"><?php echo $c['full_name']; ?></option>
        <?php } ?>
      </select>
      </div>
      <div class="mb-3">
      <label class="form-label">Service</label><br>
      <select class="form-select" name="service_id">
        <?php while($s = mysqli_fetch_assoc($services)) { ?>
          <option value="<?php echo $s['service_id']; ?>">
            <?php echo $s['service_name']; ?> (₱<?php echo number_format($s['hourly_rate'],2); ?>/hr)
          </option>
        <?php } ?>
      </select><br>
    
      <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" name="booking_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
      </div>
    
      <div class="mb-3">
      <label class="form-label">Hours</label><br>
      <input type="number" class="form-control" name="hours" min="1" value="1"><br><br>
      </div>

      <div class="mb-3 d-flex gap-2">
      <button type="submit" name="create" class="btn btn-primary flex-grow-1" style="background-color: #53179C !important;">Create Booking</button>
      <a href="bookings-list.php" class="btn btn-secondary">Cancel</a>
    </div>
    </div>
  </form>
  </body>
  </html>
  