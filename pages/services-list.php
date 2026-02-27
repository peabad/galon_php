<?php
include "../db.php";
 
 
/* ============================
   SOFT DELETE (Deactivate)
   ============================ */
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
 
 
  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");
 
 
  header("Location: services_list.php");
  exit;
}
 
 
/* ============================
   FETCH ALL SERVICES
   ============================ */
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id ASC");
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Services</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>
 
<div class="container mt-4">
  <h2 class="text-center mb-5 mt-3 display-1">Services</h2>
  <div class="card shadow mx-auto" style="max-width: 1200px;">
    <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table"style="color: #53179C !important;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <td><?php echo $row['service_id']; ?></td>
                        <td><?php echo $row['service_name']; ?></td>
                        <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
                        <td>
                            <?php
                            if ($row['is_active'] == 1) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                        <td>
        <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
 
 
        <?php if ($row['is_active'] == 1) { ?>
          <a href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
             onclick="return confirm('Deactivate this service?')" class="btn btn-sm btn-danger">
             Deactivate
          </a>
        <?php } ?>
      </td>
                    <?php } ?>
                    </tbody>
                </table>

                    <p>
                        <div class="text-end">
                    <a href="services-add.php" class="btn btn-primary btn-lg" style="background-color: #53179C !important;">+ Add Service</a>
                    </p>
                
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
 