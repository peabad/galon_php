<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $service_name = $_POST['service_name'];
  $description = $_POST['description'];
  $hourly_rate = $_POST['hourly_rate'];
  $is_active = $_POST['is_active'];

  if ($service_name == "" || $hourly_rate == "") {
    $message = "Service name and hourly rate are required!";
  } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
    $message = "Hourly rate must be a number greater than 0.";
  } else {
    $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
            VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";
    mysqli_query($conn, $sql);
 
    header("Location: services-list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Service</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>
 
<h2 class="text-center mb-5 mt-3 display-1">Add Service</h2>
<div class="mx-auto card shadow mb-10" style="width: 26rem;">
<?php if ($message != ""): ?>
    <div class="alert alert-danger m-3" role="alert">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>
 
<form method="post">
    <div class="card-body">
  <label class="form-label">Service Name*</label><br>
  <input type="text" name="service_name" class="form-control"><br>
 
  <label class="form-label">Description</label><br>
  <textarea name="description" rows="4" cols="40" class="form-control"></textarea><br>
 
  <label class="form-label">Hourly Rate (₱)*</label><br>
  <input type="text" name="hourly_rate" class="form-control"><br>
 
  <label class="form-label">Active?</label><br>
  <select name="is_active" class="form-select">
    <option value="1">Yes</option>
    <option value="0">No</option>
  </select><br><br>
 <div class="mb-3 d-grid gap-2">
  <button type="submit" name="save" class="btn btn-primary btn-lg btn-block" style="background-color: #53179C !important;">Save Service</button>
</form>
 
</body>
</html>