<?= view('Admin/Adminsidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "App Settings Update Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "App Settings Update Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>            
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">App Settings</h6>
            </div>

            <div class="card-body">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>App Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['app_name']; } ?>" name="app_name" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Description</label>
                    <input type="text" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['app_decp']; } ?>" name="app_decp" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Image</label>
                    <input type="file" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['app_logo']; } ?>" name="app_logo" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label>Fine Per day ₹</label>
                    <input type="number" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['fine']; } ?>" min="1" name="fine" required>
                </div>

                 <div class="form-group col-md-6">
                    <label>Staff book carry days</label>
                    <input type="number" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['fine_stf_days']; } ?>" name="fine_stf_days" required> 
                </div>
                 <div class="form-group col-md-6">
                    <label>Student book carry days</label>
                    <input type="number" class="form-control" value="<?php if(isset($appsetting)){ echo $appsetting['fine_std_days']; } ?>" name="fine_std_days" required> 
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
