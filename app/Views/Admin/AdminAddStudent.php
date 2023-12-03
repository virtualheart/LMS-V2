<?= view('Admin/Adminsidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "New Student Added Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php elseif (session()->getFlashdata('msg') == "New Student Add Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php endif; ?>   
            <?php session()->remove('msg'); ?>
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Add Student</h6>
               <a href="<?=site_url('admin/users/students')?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
            </div>

            <div class="card-body" style="padding-bottom: 1px;">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>Regno</label>
                    <input type="text" class="form-control" value="<?php if(isset($student)){ echo $student['regno']; } ?>" name="regno" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($student)){ echo $student['sname']; } ?>" name="name" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Contact</label>
                    <input type="number" class="form-control" value="<?php if(isset($student)){ echo $student['Contact']; } ?>" min="1" name="contact" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Year of joining</label>
                        <select class="form-control" name="year" required>
                            <option value=''>Select Year</option>
                            <?php if(isset($student)){ ?>
                                <option value='<?=$student['year']?>' selected><?=$student['year']; }?></option>
                            ?>

                            <?php
                                for($i = date('Y')-5 ; $i <= date('Y'); $i++){
                                    echo "<option value='{$i}'>$i</option>";
                            }
                            ?>
                        </select>
                </div>
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
                    <label>shift</label>
                    <select class="form-control" name="shift" required>                                      
                        <option value="">Select Shift</option>                       
                        <option value='I' <?php if(isset($student) && $student['shift']=='I') echo "selected" ?>>I</option>                        
                        <option value='II' <?php if(isset($student) && $student['shift']=='II') echo "selected" ?>>II</option>
                    </select>   
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?php if(isset($student)){ echo $student['stemail']; } ?>" name="mail" required> 
                </div>
                <div class="form-group col-md-6">
                    <label>Gender</label>
                    <br>
                        <input type="radio" id="male" name="gender" value="male" 
                        <?php if(isset($student) && $student['gender']=='male') echo "checked" ?> required>
                    <label for="male"> Male</label>
                        <input type="radio" id="female" name="gender" value="female" 
                        <?php if(isset($student) && $student['gender']=='female') echo "checked" ?> required>
                    <label for="female"> Female</label>
                </div>
                <div class=" form-group card-footer col"style="margin-bottom: 0px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                </div>              
            </form>
        </div>
    </div>
</div>
</div>

