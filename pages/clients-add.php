<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address)
            VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients-list.php");
    exit;
  }
}
?>

<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Client</title></head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<body>
<?php include "../nav.php"; ?>
 
<h2 class="text-center mb-5 mt-3 display-1">Add Client</h2>
 
  <div class="mx-auto card shadow mb-10" style="width: 26rem;">
    <?php if ($message != ""): ?>
    <div class="alert alert-danger m-3" role="alert">
        <?php echo $message; ?>
    </div>
    <?php endif; ?>
    <form method="post">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Full Name*</label>
                <input type="text" name="full_name" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email*</label>
                <input type="text" name="email" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="mb-3 d-grid gap-2">
                <button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Save</button>
            </div>
        </div>
    </form>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>