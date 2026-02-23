<?php
include "../db.php";
 
$id = $_GET['id'];
 
// Added mysqli_real_escape_string for security
$id = mysqli_real_escape_string($conn, $id);
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);
 
// Check if client exists
if (!$client) {
    header("Location: clients-list.php");
    exit;
}
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    // Added mysqli_real_escape_string to prevent SQL injection
    $full_name = mysqli_real_escape_string($conn, $full_name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);
    
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
    
    if (mysqli_query($conn, $sql)) {
      header("Location: clients-list.php");
      exit;
    } else {
      $message = "Error: " . mysqli_error($conn);
    }
  }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Client</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
  <h2 class="text-center mb-5 mt-3 display-1">Edit Client</h2>
  
  <div class="mx-auto card shadow mb-5" style="width: 26rem;">
    <?php if ($message != ""): ?>
      <div class="alert alert-danger m-3" role="alert">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
    
    <form method="post">
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Full Name*</label>
          <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($client['full_name']); ?>" required>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Email*</label>
          <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($client['email']); ?>" required>
        </div>
        
        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($client['phone']); ?>">
        </div>
        
        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($client['address']); ?>">
        </div>
        
        <div class="d-flex gap-2">
          <button type="submit" name="update" class="btn btn-primary flex-grow-1">Update Client</button>
          <a href="clients-list.php" class="btn btn-secondary">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>