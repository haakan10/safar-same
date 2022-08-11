<!-- Show these admin pages only when the admin is logged in -->
<?php require '../assets/partials/_admin-check.php';   ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .routes {
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 10px;
            background-color: green;
            border: none;
            color: white;

        }

        .routes:hover {
            background-color: blue;
            width: 410px;
            height: 70px;
            shadow: 2px black solid
        }

        .Buses {
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 10px;
            background-color: green;
            border: none;
            color: white;

        }

        .Buses a {
            color: white;
            text-decoration: none;
        }

        .Buses:hover {
            background-color: blue;
            width: 410px;
            height: 70px;
            shadow: 2px black solid;
            color: white
        }

        .buses a:hover {
            color: white
        }

        .Customers {
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 10px;
            background-color: green;
            border: none;
            color: white;

        }

        .Customers:hover {
            background-color: blue;
            width: 410px;
            height: 70px;
            shadow: 2px black solid
        }

        .Booking {
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            margin: 10px;
            background-color: green;
            border: none;
            color: white;

        }

        .Booking:hover {
            background-color: blue;
            width: 410px;
            height: 70px;
            shadow: 2px black solid
        }

        #reportPart {
            display: flex;

        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- External CSS -->
    <?php
    require '../assets/styles/admin.php';
    require '../assets/styles/signup.php';
    $page = "signup";
    ?>
</head>

<body>
    <!-- Requiring the admin header files -->
    <?php require '../assets/partials/_admin-header.php'; ?>

    <!-- Signup Status -->
    <!-- <?php
            if (isset($_GET['signup'])) {
                if ($_GET['signup']) {
                    // Show success alert
                    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Successful!</strong> Account created successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } elseif ($_GET['user_exists'])
                    // Show error alert
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Username already exists
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            ?>
            <!-- <section id="add-admin">
                <div> -->


    <div id="signupForm">
        <h2>Report Summury</h2>
        <button class="Buses"><a href="busPrint.PHP">Buses</a></button>
        <button class="Buses"><a href="routesPrint.PHP">Routes</a></button>
        <button class="Customers"><a href="customerPrint.PHP">Costomer</a></button>
        <button class="Booking"><a href="BookingPrint.php">booking</a></button>




    </div>










    <script src="../assets/scripts/admin_signup.js">
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>