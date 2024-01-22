
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Vaccine</h3>
		<div class="card-tools">
			<button class="btn btn-flat btn-primary" data-toggle="modal" data-target="#CreateNewModal"><span class="fas fa-plus"></span> Create New </button>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">

        	<?php  

        		$qry1 = $conn->query("SELECT distinct(Category) from vaccine_list order by name asc");
						while($Cat = $qry1->fetch_assoc()){

							$Category = $Cat['Category'];

							echo "<h2 class='mt-2 mb-3'><u>".$Category."</u></h2>";

        	?>

			<table class="table table-bordered table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php

					$i = 1;
						$qry2 = $conn->query("SELECT * from vaccine_list where Category = '$Category' order by name asc");
						while($row = $qry2->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td class="text-center">
                                <?php if($row['status'] == 1): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<br/>

			<?php } ?>

		</div>
		</div>
	</div>
</div>


<!-- Create New Modal -->
<div class="modal fade" id="CreateNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalLongTitle">+ Create New Vaccine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
        	<label class="text-light">Name</label>
        	<input class="form-control" type="text" name="Name" required><br/>
        	<label class="text-light">Category</label>
        	<input class="form-control" type="text" name="Category" required><br/>
        	<label class="text-light">Status</label>
        	<select class="form-control" name="Status" required>
        		<option value="1">Active</option>
        		<option value="0">Inactive</option>
        	</select>
        	<input type="submit" class="btn btn-primary mt-4" name="Create" value="Create">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php 

	if(isset($_POST['Create'])){

		$Name = $_POST['Name'];
		$Category = $_POST['Category'];
		$Status = $_POST['Status'];

		$run_qry = "INSERT INTO vaccine_list(name, status, Category, date_created) VALUES ('$Name', '$Status', '$Category', current_timestamp())";
		if(mysqli_query($conn, $run_qry)){
			echo "<script> alert('Successfully Created New Vaccine Details'); </script>";
			echo "<script> location.href='http://localhost/vaccinated/admin/?page=maintenance/vaccine'; </script>";
		}
	}

?>


<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Vaccine permanently?","delete_category",[$(this).attr('data-id')])
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Vaccine","maintenance/manage_vaccine.php?id="+$(this).attr('data-id'),"mid-large")
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_category($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_vaccine",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
