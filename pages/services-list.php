<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id ASC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Services</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
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
                        <td><?php echo $row['is_active'] ? "Yes" : "No"; ?></td>
                        <td><a href="services-edit.php?id=<?php echo $row['service_id']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
 