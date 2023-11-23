<?= view('Admin/Adminsidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "SMTP Settings Update Successfully..") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "SMTP Settings Update Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php endif; ?>
            <?php session()->remove('msg'); ?>

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">SMTP Setting</h6>
            </div>

            <div class="card-body">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>Host</label>
                    <input type="text" class="form-control" value="<?php if(isset($smtpsetting)){ echo $smtpsetting['smtp_host']; } ?>" name="smtp_host" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Port</label>
                    <input type="number" class="form-control" value="<?php if(isset($smtpsetting)){ echo $smtpsetting['smtp_port']; } ?>" min="0" max="65353" name="smtp_port" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" value="<?php if(isset($smtpsetting)){ echo $smtpsetting['smtp_user']; } ?>" min="1" name="smtp_user" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" value="<?php if(isset($smtpsetting)){ echo $smtpsetting['smtp_pass']; } ?>" min="1" name="smtp_pass" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Server Type</label>
                    <select class="form-control" name="smtp_sec_type" required>
                        <option value="">Select Server Type</option>                       
                        <option value='ssl' <?php if(isset($smtpsetting) && $smtpsetting['smtp_sec_type']=='ssl') echo "selected" ?>>SSL</option>                        
                        <option value='tls' <?php if(isset($smtpsetting) && $smtpsetting['smtp_sec_type']=='tls') echo "selected" ?>>TLS</option>
                    </select>   
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
