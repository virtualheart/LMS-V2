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
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "New Student Add Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>            
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Add Student</h6>
            </div>

            <div class="card-body">
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
                        <option value='1' <?php if(isset($student) && $student['did']=='1') echo "selected" ?>>BCA</option>
                        <option value='2' <?php if(isset($student) && $student['did']=='2') echo "selected" ?>>MCA</option>
                        
                    </select>   
                </div>
                <div class="form-group col-md-6">
                    <label>Swift</label>
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
                        <input type="radio" id="male" name="gender" value="boy" 
                        <?php if(isset($student) && $student['gender']=='boy') echo "checked" ?> required>
                    <label for="male"> Male</label>
                        <input type="radio" id="female" name="gender" value="girl" 
                        <?php if(isset($student) && $student['gender']=='girl') echo "checked" ?> required>
                    <label for="female"> Female</label>
                </div>
                <div class=" form-group col-md-6"style="position:relative;top:30px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                    <br>
                    <br>
                </div>              
            </form>
        </div>
    </div>
</div>
</div>
