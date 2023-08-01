<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Profile</h1> -->

    		<div class="form-group col-md-5">
    			<form method="POST" id="bookForm">		
             	<div class="card shadow mb-4">
                 	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     	<h6 class="m-0 font-weight-bold text-primary">Profile</h6>
               	  </div>
               	  <div class="card-body">
                <div class="form-group">
                	
                   <?php if (session()->getFlashdata('msg') == "Profile Update Successfully.") : ?>
    						<div class="alert alert-success alert-dismissible">
        						<?= session()->getFlashdata('msg') ?>
                      			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
    						</div>
	    					<?php session()->remove('msg'); ?>
						<?php elseif (session()->getFlashdata('msg') == "Profile Update Failed.") : ?>
    						<div class="alert alert-warning alert-dismissible">
        						<?= session()->getFlashdata('msg') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
    						</div>
        					<?php session()->remove('msg'); ?>
						<?php endif; ?>
	
                    <label>Username</label>
					<input type="text" class="form-control"placeholder='user' value="<?=$profile['aname']?>" name="aname" readonly='yes'>
				</div>

                <div class="form-group">
					<label>Password</label>
					<input type="password" placeholder="*****" class="form-control"  name="apass" id="apass" value="">					
				</div>

                <div class="form-group ">
				<label>Confirm Password</label>
				<input type="password" placeholder="*****" class="form-control"  name="capass" id="capass" value="">
				</div>

                <div class="form-group">
					<label>mail</label>
					<input type="text" placeholder="admin@gmail.com" class="form-control"  name="amail" value="<?=$profile['a_mail']?>" required>
				</div>

                <div class=" form-group col-md-5"style="position:relative;top:30px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" id="save" value="Save" style="margin-left:5px" >                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                </div>              
    			</form>

				</div>
    		</div>
		</div>
	</div>
<br>
<br>
<br>

<!-- Clear Modal -->
<div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clear Confirmation</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to clear the form?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" id="confirmClearButton">Clear</button>
            </div>
        </div>
    </div>
</div>
