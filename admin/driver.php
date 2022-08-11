<!-- Show these admin pages only when the admin is logged in -->
<?php  require '../assets/partials/_admin-check.php';   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
        <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <?php 
        require '../assets/styles/admin.php';
        require '../assets/styles/admin-options.php';
        $page="driver";
    ?>
</head>
<body>
    <!-- Requiring the admin header files -->
    <?php require '../assets/partials/_admin-header.php';?>

    <!-- Add, Edit and Delete Customers -->
    <?php
        /*
            1. Check if an admin is logged in
            2. Check if the request method is POST
        */
        if($loggedIn && $_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(isset($_POST["submit"]))
            {
                /*
                    ADDING Customers
                 Check if the $_POST key 'submit' exists
                */
                // Should be validated client-side
                $name = $_POST["name"];
                $number = $_POST["number"];
                $city = $_POST["city"];
            
        
        
                $customer_exists = exist_customers($conn,$name,$number,$city);
                $customer_added = false;
        
                if(!$customer_exists)
                {
                    // Route is unique, proceed
                    $sql = "INSERT INTO `driver` (`name`, `number`, `city`,`customer_created`) VALUES ('$name', '$number','$city', current_timestamp());";
                    $result = mysqli_query($conn, $sql);
                    // Gives back the Auto Increment id
                    $autoInc_id = mysqli_insert_id($conn);
                    // If the id exists then, 
                    // if($autoInc_id)
                    // {
                    //     $code = rand(1,99999);
                    //     // Generates the unique userid
                    //     $customer_id = "CUST-".$code.$autoInc_id;
                        
                    //     $query = "UPDATE `customers` SET `customer_id` = '$customer_id' WHERE `customers`.`id` = $autoInc_id;";
                    //     $queryResult = mysqli_query($conn, $query);

                    //     if(!$queryResult)
                    //         echo "Not Working";
                    // }

                    if($result)
                        $customer_added = true;
                }
    
                if($customer_added)
                {
                    // Show success alert
                    echo '<div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successful!</strong> Customer Added
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else{
                    // Show error alert
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Customer already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
            if(isset($_POST["edit"]))
            {
                // EDIT ROUTES
                $name = strtoupper($_POST["busno"]);
                $number = strtoupper($_POST["number"]);
                $city = strtoupper($_POST["city"]);
                $driver_id  = $_POST["driver_id "];
                $id_if_bus_exists = exist_buses($conn, $name,$number,$city);
                
                if(!$id_if_bus_exists || $driver_id  == $id_if_bus_exists)
                {
                    $updateSql = "UPDATE `driver` SET `name`,`number`,`city` = '$name','$number','$city' WHERE `driver`.`driver_id` = $driver_id;";
    
                    $updateResult = mysqli_query($conn, $updateSql);
                    $rowsAffected = mysqli_affected_rows($conn);
                    
                    $messageStatus = "danger";
                    $messageInfo = "";
                    $messageHeading = "Error!";

                    if(!$rowsAffected)
                    {
                        $messageInfo = "No Edits Administered!";
                    }
    
                    elseif($updateResult)
                    {
                        // Show success alert
                        $messageStatus = "success";
                        $messageHeading = "Successfull!";
                        $messageInfo = "Bus details Edited";
                    }
                    else{
                        // Show error alert
                        $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                    }
                    
                    // MESSAGE
                    echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                    <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                else 
                {
                    // If bus details already exists
                    echo '<div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Bus details already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }

            }
            if(isset($_POST["delete"]))
            {
                // DELETE BUS
                $driver_id = $_POST["driver_id"];
                $name = get_from_table($conn, "driver", "driver_id", $driver_id, "name");
                // Delete the bus with id => id
                $deleteSql = "DELETE FROM `driver` WHERE `driver`.`driver_id` = $driver_id";

                $deleteResult = mysqli_query($conn, $deleteSql);
                $rowsAffected = mysqli_affected_rows($conn);
                $messageStatus = "danger";
                $messageInfo = "";
                $messageHeading = "Error!";

                if(!$rowsAffected)
                {
                    $messageInfo = "Record Doesnt Exist";
                }

                elseif($deleteResult)
                {   
                    // echo $num;
                    // Show success alert
                    $messageStatus = "success";
                    $messageInfo = "Bus Details deleted";
                    $messageHeading = "Successfull!";

                    // Delete Bus from Seat table
                    $sql = "DELETE from seats WHERE bus_no='$bus_no'";
                    mysqli_query($conn,$sql);
                }
                else{
                    // Show error alert
                    $messageInfo = "Your request could not be processed due to technical Issues from our part. We regret the inconvenience caused";
                }
                // Message
                echo '<div class="my-0 alert alert-'.$messageStatus.' alert-dismissible fade show" role="alert">
                <strong>'.$messageHeading.'</strong> '.$messageInfo.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        ?>
        <?php
            $resultSql = "SELECT * FROM `driver` ORDER BY customer_created DESC";
                            
            $resultSqlResult = mysqli_query($conn, $resultSql);

            if(!mysqli_num_rows($resultSqlResult)){ ?>
                <!-- Customers are not present -->
                <div class="container mt-4">
                    <div id="noCustomers" class="alert alert-dark " role="alert">
                        <h1 class="alert-heading">No Customers Found!!</h1>
                        <p class="fw-light">Be the first person to add one!</p>
                        <hr>
                        <div id="addCustomerAlert" class="alert alert-success" role="alert">
                                Click on <button id="add-button" class="button btn-sm"type="button"data-bs-toggle="modal" data-bs-target="#addModal">ADD <i class="fas fa-plus"></i></button> to add a customer!
                        </div>
                    </div>
                </div>
            <?php }
            else { ?>   
            <!-- If Customers are present -->
            <section id="customer">
                <div id="head">
                    <h4>Driver Status</h4>
                </div>
                <div id="customer-results">
                    <div>
                        <button id="add-button" class="button btn-sm"type="button"data-bs-toggle="modal" data-bs-target="#addModal">Add Driver Details <i class="fas fa-plus"></i></button>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Number</th>
                            <th>City</th>
                            
                        </thead>
                        <?php
                            $ser_no = 0;
                            while($row = mysqli_fetch_assoc($resultSqlResult))
                            {   
                                $ser_no++;
                                // echo "<pre>";
                                // var_export($row);
                                // echo "</pre>";

                                $driver_id = $row["driver_id"];
                                $name = $row["name"]; 
                                $number = $row["number"]; 
                                $city = $row["city"]; 
                        ?>
                        <tr>
                            <td>
                                <?php
                                    echo $name;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $number;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $city;
                                ?>
                            </td>
                            <td>
                            <!-- <button class="button edit-button " data-link="<?php echo $_SERVER['REQUEST_URI']; ?>" data-id="<?php 
                                                echo $name;?>" name="<?php 
                                                echo $customer_name;?>" data-phone="<?php 
                                                echo $customer_phone;?>"
                                                >Edit</button>
                                            <button class="button delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-name="<?php 
                                                echo $name;?>">Delete</button>
                            </td> -->
                        </tr>
                    <?php 
                        }
                    ?>
                    </table>
                </div>
            </section>
            <?php } ?>   
        </div>
    </main>
    <!-- All Modals Here -->
    <!-- Add Route Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add A Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addCustomerForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">name</label>
                                <input type="text" class="form-control" id="cfirstname" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">number</label>
                                <input type="text" class="form-control" id="clastname" name="number">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">city</label>
                                <input type="tel" class="form-control" id="cphone" name="city">
                            </div>
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- Add Anything -->
                    </div>
                    </div>
                </div>
        </div>
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center pb-4">
                    Are you sure?
                </h2>
                <p>
                    Do you really want to delete these customer details? <strong>This process cannot be undone.</strong>
                </p>
                <!-- Needed to pass id -->
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="delete-form"  method="POST">
                    <input name="delete-name" type="hidden" name="name">
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="delete-form" name="delete" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
    <!-- External JS -->
    <script src="../assets/scripts/admin_customer.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>