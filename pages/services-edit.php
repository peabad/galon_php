<?php
include "../db.php";
$id = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);

if (isset($_POST['update'])) {
  $name = $_POST['service_name'];
  $desc = $_POST['description'];
  $rate = $_POST['hourly_rate'];
  $active = $_POST['is_active'];

  mysqli_query($conn, "UPDATE services
    SET service_name='$name', description='$desc', hourly_rate='$rate', is_active='$active'
    WHERE service_id=$id");

  header("Location: services-list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Service</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>

<div class="container">
  <h2 class="text-center mb-5 mt-3 display-1">Edit Service</h2>

  <div class="mx-auto card shadow mb-5" style="width: 26rem;">
    <form method="post">
      <div class="card-body">
        <div class="mb-3">
          <label>Service Name</label><br>
          <input type="text" name="service_name" class="form-control" value="<?php echo htmlspecialchars($service['service_name']); ?>">
        </div>
        <div class="mb-3">
          <label>Description</label><br>
          <textarea name="description" rows="4" cols="40" class="form-control"><?php echo htmlspecialchars($service['description']); ?></textarea>
        </div>
        <div class="mb-3">
          <label>Hourly Rate</label><br>
          <input type="text" name="hourly_rate" class="form-control" value="<?php echo htmlspecialchars($service['hourly_rate']); ?>">
        </div>
        <div class="mb-3"> 
          <label>Active</label><br>
          <select class="form-select" name="is_active">
            <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Yes</option>
            <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>No</option>
          </select>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" name="update" class="btn btn-primary flex-grow-1" style="background-color: #53179C;">Update</button>
          <a href="services-list.php" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>