<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === "admin" && $password === "admin") {
 
        $_SESSION['username'] = "ADMIN";
        header("Location: index.php");
        exit();
 
    } else {
        $error = "Invalid username or password!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #EEE8F5 !important;">

<div class="mx-auto card shadow mb-10" style="width: 26rem;">
<div class="card-body"> 
<h2>Login Form</h2> <br>
 


<form method="POST">
    
    <label class="form-label">Username:</label><br>
    <input type="text" name="username" required class="form-control"><br><br>

    <label class="form-label">Password:</label><br>
    <input type="password" name="password" required class="form-control"><br><br>
    
    <?php if ($error != ""): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>
    
    <div class="mb-3 d-grid gap-2">
    <button type="submit" name="save" class="btn btn-primary btn-lg btn-block" style="background-color: #53179C !important;">Login</button>
    
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>