<?= view('Student/Sidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Barrow Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "Profile Update Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Profile Update Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?> 
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
            </div>

            <div class="card-body">
                <div class="row">

                <div class="form-group col-md-5">
                    <label>Reg No</label>
                    <input type="text" class="form-control" value="<?=$profile['regno']?>" name="regno" readonly
                    ="yes" autocomplete="off">
                </div>

                <div class="form-group col-md-5">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?=$profile['sname']?>" name="sname" id="sname" readonly="true">
                </div>

 <!--                <div class="form-group col-md-5">
                    <label>year of joining</label>
                    <input type="text" class="form-control" value="" name="yoj" id="yoj" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Department & shift</label>
                    <input type="text" class="form-control" value="" name="dept" id="dept" readonly="true">
                </div> -->

                <div class="form-group col-md-5">
                    <label>Password</label>
                    <input type="password" class="form-control"  placeholder="*****" name="apass" id="apass" >
                </div>
                
                <div class="form-group col-md-5">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="*****" name="capass" id="capass" >
                </div>

                <div class="form-group col-md-5">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?=$profile['semail']?>" placeholder="studnet@gmail.com" name="mail" id="mail" >
                </div>
                
                <div class="form-group col-md-5">
                    <label>Contact No</label>
                    <input type="number" class="form-control" value="<?=$profile['contact']?>" placeholder="9876543210" name="contactno" maxlength="10" pattern="[1-9]{1}[0-9]{9}">
                </div>
                
                <div class=" form-group col-md-5"style="position:relative;top:30px;">
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
