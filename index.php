<?php
include "db.php";
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body class="bg-light">
    <?php include "nav.php";?>

    <!-- <section id="home" class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h1 class="display-4">Dashboard</h1>
                <ul>
                <li>Total Clients: <?php echo $clients; ?></li>
                <li>Total Services: <?php echo $services; ?></li>
                <li>Total Bookings: <?php echo $bookings; ?></li>
                <li>Total Revenue: <?php echo number_format($revenue, 2); ?></li>
                </ul>
            </div>
            <div class="col-md-6 text-center">
                <img src="images/grad1.jfif" class="img-fluid border border-light rounded" style="max-width:350px;" alt="Profile">
            </div>
        </div>
    </div>
    </section> -->

    <section id="projects" class="hero section-padding bg-light">
    <div class="container">
        <h2 class="text-center mb-5 mt-3 display-1 lead">Dashboard ata</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Clients</h5>
                        <p><?php echo $clients; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Services</h5>
                        <p><?php echo $services; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Bookings</h5>
                        <p><?php echo $bookings; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card">  
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <p><?php echo "₱".number_format($revenue, 2); ?></p>
                    </div>
                </div>
            </div>
            <p class ="text-center mt-4">
            <button class="btn btn-primary" style ="text-decoration: none;" onclick="window.location.href='/ASSES/clients_add.php'">Add Client</button> |
            <button class="btn btn-success" style ="text-decoration: none;" onclick="window.location.href='/ASSES/bookings_create.php'">Create Booking</button>
            </p> 
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>