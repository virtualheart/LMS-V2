<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "New Book Added Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "New Book Add Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Updated Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Updated Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>

                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>            
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Add Book</h6>
                 <a href="<?=site_url('admin/ViewAllBooks')?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
            </div>

            <div class="card-body">
                <div class="row">
                
                <div class="form-group col-md-6">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bcode']; } elseif(isset($bcodeid)){ echo 'GACCA'.date('Y').str_pad(++$bcodeid, 5, '0', STR_PAD_LEFT); } ?>" name="bcode" readonly="true" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bno']; } ?>" name="bno" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['title']; } ?>" name="title" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['aname']; } ?>" name="aname" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['publication']; } ?>" name="publication" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Price</label>
                    <input type="number" class="form-control" value="<?php if(isset($Book)){ echo $Book['price']; } ?>" name="price" required>
                </div>

                 <div class="form-group col-md-6">
                    <label>Plan</label>
                    <!-- <input type="text" class="form-control" value="< ?php if(isset($Book)){ echo $Book['alamara']; } ?>" name="alamara" required> -->
                    <select class="itemName form-control" name="plan" required>
                        <option value=''>Select Plan</option>
                        <?php foreach ($Plans as $Plan): ?>
                            <option value="<?= $Plan['id'] ?>" <?php if (isset($Book) && $Book['plan_id'] == $Plan['id']) echo "selected" ?>>
                                <?= $Plan['category'] .' - '. $Plan['year'] .' - '. $Plan['billno']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Language</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['language']; } ?>" name=" " >
                </div>

                <div class="form-group col-md-6">
                    <label>Alamara</label>
                    <!-- <input type="text" class="form-control" value="< ?php if(isset($Book)){ echo $Book['alamara']; } ?>" name="alamara" required> -->
                    <select class="itemName form-control" name="alamara" required>
                        <option value=''>Select Alamara</option>
                        <?php foreach ($Alamaras as $Alamara): ?>
                            <option value="<?= $Alamara['id'] ?>" <?php if (isset($Book) && $Book['shelf_id'] == $Alamara['id']) echo "selected" ?>>
                                <?= $Alamara['alamara'] . ' - ' . $Alamara['rack'] . ' - ' . $Alamara['side']?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Year Of Publication</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['year_of_publication']; } ?>" name="year_of_publication" required> 
                </div>
                <div class="form-group col-md-6">
                    <label>Edition</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['edition']; } ?>" name="edition" required> 
                </div>
                <div class="form-group col-md-6">
                    <label>Remark</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['remark']; } ?>" name="remark" id="remark">
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


