<?= view('Admin/Adminsidebar') ?>
    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "New Staff Added Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "New Staff Add Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>            
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Add Staff</h6>
            </div>

            <div class="card-body">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>Regno</label>
                    <input type="text" class="form-control" value="<?php if(isset($staff)){ echo $staff['regno']; } elseif(isset($userid)) echo "STF" . str_pad(++$userid, 4, '0', STR_PAD_LEFT); ?>" name="regno" readonly="true" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($staff)){ echo $staff['sname']; } ?>" name="name" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Contact</label>
                    <input type="number" class="form-control" value="<?php if(isset($staff)){ echo $staff['contact']; } ?>" min="1" name="contact" required>
                </div>

                <div class="form-group col-md-6">
                    <label>designation</label>
                    <select class="form-control" name="designid" required>
                        <option value="">Select designation</option>                       
                        <option value='1' <?php if(isset($staff) && $staff['designid']=='1') echo "selected" ?>>Professor</option>                        
                        <option value='2' <?php if(isset($staff) && $staff['designid']=='2') echo "selected" ?>>Assistant Professor</option>
                        <option value='3' <?php if(isset($staff) && $staff['designid']=='3') echo "selected" ?>>Lecturer</option>
                        <option value='4' <?php if(isset($student) && $staff['designid']=='4') echo "selected" ?>>Guest Lecture</option>
                    </select>   
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?php if(isset($staff)){ echo $staff['semail']; } ?>" name="mail" required> 
                </div>
                <div class="form-group col-md-6">
                    <label>Gender</label>
                    <br>
                        <input type="radio" id="male" name="gender" value="male" 
                        <?php if(isset($staff) && $staff['gender']=='male') echo "checked" ?> required>
                    <label for="male"> Male</label>
                        <input type="radio" id="female" name="gender" value="female" 
                        <?php if(isset($staff) && $staff['gender']=='female') echo "checked" ?> required>
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

