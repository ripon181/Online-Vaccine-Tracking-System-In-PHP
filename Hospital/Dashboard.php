<?php
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['userdata'])) {
        echo "<script> location.href='../index.php'; </script>";
        exit();
    } else if (isset($_SESSION['GenLuserdata'])) {
?>

<style type="text/css">
    body {
        background-image: url("../dist/img/bg.png");

    }

    .badge {
        display: inline-block;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 10px;
    }

    .badge-red {
        background-color: #ff0000;
        color: #fff;
    }

    .badge-yellow {
        background-color: #ffff00;
        color: #000;
    }

    .badge-green {
        background-color: #00ff00;
        color: #000;
    }
</style>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<div class="card">
  <div class="card-body">
    <div>
    <h2 class="text-light text-center">Hospital Dashboard</h2>
        <div class="d-inline d-flex justify-content-center">
            <a href="chat.php" class="btn btn-warning">Chat now</a>
            <a href="Logout.php" class="text-decoration-none btn btn-danger"> Logout </a>
        </div>
        <div class="d-inline-block text-end d-flex justify-content-center">
           
        </div>
    </div>
    </div>
</div>
    <div class="container">
        <div class="row dataTable">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Registration No</th>
                        <th>Vaccine Type</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM individual_list";
                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['tracking_code'] . "</td>";
                                echo "<td>" . $row['Vaccine_type'] . "</td>";
                                echo "<td>" . $row['firstname'] . "</td>";
                                echo "<td>" . $row['middlename'] . "</td>";
                                echo "<td>" . $row['lastname'] . "</td>";
                                echo "<td>" . $row['gender'] . "</td>";
                                echo "<td>" . $row['dob'] . "</td>";
                                echo "<td>" . $row['contact'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>";
                                if ($row['status'] == 0) {
                                    echo "<span class='badge badge-red'>Pending</span>";
                                } elseif ($row['status'] == 1) {
                                    echo "<span class='badge badge-yellow'>Partially Vaccinated</span>";
                                } elseif ($row['status'] == 999) {
                                    echo "<span class='badge badge-green'>Fully Vaccinated</span>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>No data found.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>Error executing the query: " . mysqli_error($conn) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer style="text-align: center;padding: 10px;">
    <p>Developed by Sakib</p>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<style type="text/css">
    .badge-yellow {
        background-color: #0000ff; /* Blue color */
        color: #fff;
    }
    .dataTable{
        position: relative;
        top:150px;
    }
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #00000036;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    margin: 0 auto;
    top: 50px;
    width: 46%;
}
footer {
  position: absolute;
  bottom: 0;
  width: 100%;   
  background-color: #00000036;    
  color: #fff; 
  font-weight: 700;
}
</style>
<?php

    } else {
        echo "<script> location.href='../index.php'; </script>";
        exit();
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
    exit();
}

?>
