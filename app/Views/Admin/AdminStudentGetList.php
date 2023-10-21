<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">

        <form method="POST" id="bookForm">

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Class Wise</h6>
                 <div class="">
                     <a href="<?=site_url('admin/users/student/add/new')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
                     <a href="<?=site_url('admin/Uploadstudents')?>" class="btn-lg float-right btn btn-sm btn-success shadow-sm mr-2"><i class="fas fa-upload fa-sm text-white-50"></i> Upoad</a>
                 </div>
            </div>

            <div class="card-body"style="padding-bottom: 1px;">
                <div class="row">

                <div class="form-group col-md-6 mb-5 mt-2">
                    <label>Department</label>
                    <select class="itemName form-control" name="dname" required>
                        <option value=''>Select Department</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['did'] ?>" <?php if (isset($student) && $student['did'] == $department['did']) echo "selected" ?>>
                                <?= $department['dname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6 mb-5 mt-2">
                    <label>Year of joining</label>
                        <select class="form-control" name="year" required>
                            <option value=''>Select Year</option>
                            <?php
                                for($i = date('Y')-5 ; $i <= date('Y'); $i++){
                                    echo "<option value='{$i}'>$i</option>";
                            }
                            ?>
                        </select>
                </div>

                
                <div class=" form-group card-footer col"style="margin-bottom: 0px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="View" >                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                </div>              
            </form>
        </div>
    </div>
</div>
</div>


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
