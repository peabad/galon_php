<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id ASC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Clients</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body style="background-color: #EEE8F5 !important;">
<?php include "../nav.php"; ?>

<div class="container mt-4">
  <h2 class="text-center mb-5 mt-3 display-1">Clients List</h2>
  <div class="card shadow mx-auto" style="max-width: 1200px;">
    <div class="card-body">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="table"style="color: #53179C !important;">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $row['client_id']; ?></td>
                  <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                  <td><?php echo htmlspecialchars($row['email']); ?></td>
                  <td><?php echo htmlspecialchars($row['phone']); ?></td>
                  <td><?php echo htmlspecialchars($row['address']); ?></td>
                  <td>
                    <a href="clients-edit.php?id=<?php echo $row['client_id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="text-end">
          <a href="clients-add.php" class="btn btn-primary btn-lg" style="background-color: #53179C !important;">+ Add New Client</a>
        </div>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center">
          No clients found. <a href="clients-add.php" class="alert-link">Add your first client</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>