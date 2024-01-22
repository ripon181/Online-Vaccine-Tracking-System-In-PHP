<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION['userdata'])){
        echo "<script> location.href='../index.php'; </script>";
        exit();
    }else if(isset($_SESSION['GenLuserdata'])){ 

        ?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

        <style type="text/css">
            .alert{
                padding: 35px;
                display: block;
                margin: 50px auto;
                font-size: 20px;
                width: 98%;
            }
            body{
			background-image: url("../dist/img/bg.png");
			
		}
        .card{
			margin-top: 50px;
			background: #3b765e52;
		}
        </style>

        <?php

        $id = $_SESSION['GenLid'];

        $conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

         $qry = $conn->query("SELECT * from `individual_list` where id = '$id'");
         if($qry->num_rows > 0){
             foreach($qry->fetch_assoc() as $k => $v){
                 $$k=$v;
             }
         }else{
            echo "<span class='alert alert-warning'>You have no vaccine process running... Please register first!</span>";
            echo "<a href='Dashboard.php' class='btn btn-secondary ms-3'>Go Back</a>";
            exit();
        }


$vaccine_qry = $conn->query("SELECT * FROM vaccine_list where id in (SELECT vaccine_id from vaccine_history_list where individual_id = '{$id}') ");
$result_vaccine = $vaccine_qry->fetch_all(MYSQLI_ASSOC);
$vacx_arr=array_column($result_vaccine,'name','id');

$location_qry = $conn->query("SELECT * FROM vaccination_location_list where id in (SELECT location_id from vaccine_history_list where individual_id = '{$id}')");
$result_location = $location_qry->fetch_all(MYSQLI_ASSOC);
$location_arr=array_column($result_location,'location','id');

$user_qry = $conn->query("SELECT *,concat(firstname,' ', lastname ) as name FROM users where id  in (SELECT user_id from vaccine_history_list where individual_id = '{$id}')");
if($user_qry->num_rows > 0){
$result_user = $user_qry->fetch_all(MYSQLI_ASSOC);
$user_arr=array_column($result_user,'name','id');
}

$Get_name = "SELECT concat(firstname,' ', lastname ) as name FROM individual_list where id = '$id'";
$Name = mysqli_fetch_assoc(mysqli_query($conn, $Get_name));
$name = $Name['name'];

?>

<div>
    <div class="col-md-6 d-inline">
        <h2 class="mt-5 p-3 d-inline-block text-dark">Parent Dashboard</h2>
    </div>
    <div class="col-md-6 d-inline-block">
        <a href="Dashboard.php" class="text-decoration-none btn btn-outline-info"> Dashboard </a>
        <a href="Logout.php" class="text-decoration-none btn btn-outline-danger"> Logout </a>
    </div>
</div>


<div class="card card-outline card-primary">
    <div class="card-header d-flex">
        <h5 class="card-title col-auto flex-grow-1">Manage Details and Vaccination History</h5>
        <div class="col-auto">

        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid" id="print_out">
            <div class="row">
                <div class="col-6">
                    <dl>
                        <dt class="text-light">Registration No:</dt>
                        <dd class="pl-4"><?php echo isset($tracking_code) ? $tracking_code : '' ?></dd>
                        <dt class="text-light">Indiviual Name:</dt>
                        <dd class="pl-4"><?php echo isset($name) ? $name : '' ?></dd>
                        <dt class="text-light">Gender:</dt>
                        <dd class="pl-4"><?php echo isset($gender) ? $gender : '' ?></dd>
                        <dt class="text-light">Vaccination Status:</dt>
                        <dd class="pl-4">
                            <?php if($status == 0): ?>
                                <span class="badge badge-primary rounded-pill">Not Vaccinated</span>
                            <?php elseif($status >= 1): ?>
                                <span class="badge badge-success rounded-pill">Vaccinated</span>
                            <?php else: ?>
                                <span class="badge badge-light text-dark rounded-pill">Pending</span>
                            <?php endif; ?>
                        </dd>
                    </dl>
                </div>
                <div class="col-6">
                    <dl>
                        <dt class="text-light">Date of Birth:</dt>
                        <dd class="pl-4"><?php echo isset($dob) ? date("M d, Y",strtotime($dob)) : '' ?></dd>
                        <dt class="text-light">Contact:</dt>
                        <dd class="pl-4"><?php echo isset($contact) ? $contact : '' ?></dd>
                        <dt class="text-light">Address:</dt>
                        <dd class="pl-4"><?php echo isset($address) ? $address : '' ?></dd>
                    </dl>
                </div>
            </div>
            <h4><b>Vaccination History</b></h4>
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="15%">
                    <col width="25%">
                    <col width="20%">
                    <col width="25%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr>
                        <th>DateTime</th>
                        <th>Vaccination Info</th>
                        <th>Vaccinated By</th>
                        <th>Remarks</th>
                        <th>Encoded by</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $qry = $conn->query("SELECT * FROM `vaccine_history_list` where individual_id = '{$id}' order by unix_timestamp(date_created) asc");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo date("M d, Y H:i",strtotime($row['date_created'])) ?></td>
                        <td>
                            <small><span class="text-light">Vaccine: </span> <?php echo isset($vacx_arr[$row['vaccine_id']]) ? $vacx_arr[$row['vaccine_id']] : 'N/A' ?></small><br>
                            <small><span class="text-light">Type: </span> <?php echo $row['vaccination_type'] ?></small><br>
                            <small><span class="text-light">Location: </span> <?php echo isset($location_arr[$row['location_id']]) ? $location_arr[$row['location_id']] : 'N/A' ?></small>
                        </td>
                        <td><?php echo $row['vaccinated_by'] ?></td>
                        <td><?php echo $row['remarks'] ?></td>
                        <td><?php echo isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : 'N/A' ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <=0): ?>
                        <tr>
                            <th colspan="5" class="text-center">No data listed yet</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(function(){
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
        $('#print').click(function(){
            start_loader()
            var _el = $('<div>')
            var _head = $('head').clone()
                _head.find('title').text("Vaccination Record Details - Print View")
            var p = $('#print_out').clone()
            p.find('.btn').remove()
            _el.append(_head)
            _el.append('<div class="d-flex justify-content-center">'+
                      '<div class="col-1 text-right">'+
                      '<img src="<?php echo validate_image($_settings->info('logo')) ?>" width="65px" height="65px" />'+
                      '</div>'+
                      '<div class="col-10">'+
                      '<h4 class="text-center"><?php echo $_settings->info('name') ?></h4>'+
                      '<h4 class="text-center">Individual/s Details and Vaccination History</h4>'+
                      '</div>'+
                      '<div class="col-1 text-right">'+
                      '</div>'+
                      '</div><hr/>')
            _el.append(p.html())
            var nw = window.open("","","width=1200,height=900,left=250,location=no,titlebar=yes")
                     nw.document.write(_el.html())
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                            nw.close()
                            end_loader()
                         }, 200);
                     }, 300);

        })
    })
</script>

<?php 

    }else{
        echo "<script> location.href='../index.php'; </script>";
        exit();
    }
}else{ 
    echo "<script> location.href='../index.php'; </script>";
    exit();
}

?>