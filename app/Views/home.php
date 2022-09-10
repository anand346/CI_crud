
<script>
    $(document).on('click',".edit",function(e){
        // e.preventDefault();
        var els = $(this).parent().siblings();
        var id = $(this).parent().siblings()[0].value;
        $.ajax({
            url : "<?php echo base_url() ?>"+"/getSingleUser/"+id,
            method : "GET",
            success : function(data){
                var data = JSON.parse(data);
                $(".updateId").val(data['id']);
                $(".updateUsername").val(data['username']);
                $(".updatePassword").val(data['password']);
            }
        })
    })
    $(document).on('click',".delete",function(e){
        // e.preventDefault();
        var el = $(this).parent().parent();
        el.hide();
        var id = $(this).parent().siblings()[0].value;
        $.ajax({
            url : "<?php echo base_url() ?>"+"/deleteUser/"+id,
            method : "POST",
            success : function(data){
                console.log(data);
            }
        })
    })

</script>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
                    <?php
                        if(session()->getFlashdata('success')){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-dismiss="alert">&times;</button>
                        <?php echo session()->getFlashdata('success') ?>
                    </div>
                    <?php } ?>
					<div class="col-sm-6">
						<h2>Manage <b>Employees</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
                    <?php
                        if(isset($users)){
                            foreach ($users as $user) {
                    ?>
					<tr>
                        <input type="hidden" id="userId" name="id" value = "<?php echo $user['id']; ?>" >
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td>
						<td><?php echo $user['username']; ?></td>
						<td><?php echo $user['password']; ?></td>
						<td>
							<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr>
                    <?php } } ?>
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action = "<?php echo base_url(); ?>/saveUser" method = "POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" name="phone" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" name="submit" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action = "<?php echo base_url() ?>/updateUser" method = "POST">
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
                    <input type="hidden" name="updateId" class = "updateId" >					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control updateUsername" name = "username" required>
					</div>
					<div class="form-group">
						<label>password</label>
						<input type="text" class="form-control updatePassword" name = "password"  required>
                    </div>			
				</div>
				<div class="modal-footer">
					<input type="button" name = "submit" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

