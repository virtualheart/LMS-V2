<?= view('Admin/Adminsidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm"> 
            <?php if (session()->getFlashdata('msg') == "New Plan Added Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php elseif (session()->getFlashdata('msg') == "Plan Update Failed..") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>

               <?php session()->remove('msg'); ?>
            <?php endif; ?>   
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">New Plan</h6>
                 <a href="<?=site_url('admin/plan')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm mr-2"><i class="fas fa-arrow-left fa-sm text-white-50 "></i> Back</a>

            </div>

            <div class="card-body" style="padding-bottom: 1px;">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>Category</label>
                    <input type="text" class="form-control" value="<?php if(isset($planed)){ echo $planed['category']; } ?>" name="category" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Academy Year</label>
                        <select class="form-control" name="year" required>
                            <option value=''>Select Year</option>
                            <?php if(isset($planed)){ ?>
                                <option value='<?=$planed['year']?>' selected><?=$planed['year']; }?></option>

                            <?php
                                for($i = date('Y')-2 ; $i <= date('Y'); $i++){
								    $endYear = $i + 1;
								    echo "<option value='{$i}-{$endYear}'>{$i}-{$endYear}</option>";
                                }
                            ?>
                        </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Bill No.</label>
                    <input type="text" class="form-control" value="<?php if(isset($planed)){ echo $planed['billno']; } ?>" name="billno" >
                </div>

                <div class="form-group col-md-6">
                    <label>No. of Books</label>
                    <input type="number" class="form-control" value="<?php if(isset($planed)){ echo $planed['noofbooks']; } ?>" min="1" name="noofbooks" >
                </div>

                <div class="form-group col-md-6">
                    <label>Amount</label>
                    <input type="number" class="form-control" value="<?php if(isset($planed)){ echo $planed['amount']; } ?>" min="1" name="amount" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Remark</label>
                    <input type="text" class="form-control" value="<?php if(isset($planed)){ echo $planed['remark']; } ?>" maxlength="499" name="remark" >
                </div>

                <div class=" form-group card-footer col"style="margin-bottom: 0px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save">                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                </div>              
            </form>
        </div>
    </div>
</div>
</div>
