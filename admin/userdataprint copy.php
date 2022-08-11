<!-- Show these admin pages only when the admin is logged in -->
<?php include 'busdatabase.php';
require '../assets/partials/_admin-check.php';
?>


<!DOCTYPE html>
<html lang="en">


<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buses</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="print.css" media="print">
    <!-- Font Awesome -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>

    <?php
    include 'busdatabase.php';
    require '../assets/styles/admin.php';
    require '../assets/styles/admin-options.php';
    $page = "bus";
    ?>
    <style>
        .assets.styles.admin {
            display: none
        }

        #print-btn{
            border: white;
            
        }
        button{
            border: none;
        }
    </style>

</head>

<body>
    <!-- Requiring the admin header files -->
    <?php include 'busdatabase.php';
    '../assets/partials/_admin-header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Summury Report about buses</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bus number</th>
                            <th>bus assigned</th>
                            <th>Bus created</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;
                        $user_qry = "select *from buses";
                        $user_res = mysqli_query($con, $user_qry);
                        while ($user_data = mysqli_fetch_assoc($user_res)) { ?>
                            <tr>
                                <td><?php echo $user_data['id'];  ?></td>
                                <td><?php echo $user_data['bus_no'];  ?></td>
                                <td><?php echo $user_data['bus_assigned'];  ?></td>
                                <td><?php echo $user_data['bus_created'];  ?></td>
                            </tr>
                        <?php
                            $sn++;
                        }
                        ?>
                    </tbody>

                </table>
                <div class="text-center">
                    <button> <a href="busPrint.php" class="btn btn-primary" id="print-btn">Back</a> </button>
                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">print now</button>
                </div>

            </div>

        </div>


    </div>




    <!-- External JS -->
    <script src="../assets/scripts/admin_bus.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>