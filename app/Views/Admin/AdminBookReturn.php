<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "New Book Added Successfully.") : ?>
                <div class="alert alert-success">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "New Book Add Failed.") : ?>
                <div class="alert alert-warning">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>            
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Return Book</h6>
            </div>

            <div class="card-body">
                <div class="row">

                <div class="form-group col-md-5">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bcode']; } ?>" name="bcode" autocomplete="off"required>
                </div>

                <div class="form-group col-md-5">
                    <label>Reg Number</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bcode']; } ?>" name="bcode" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Std/Staff Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bcode']; } ?>" name="bcode" readonly="true">
                </div>
                
                <div class="form-group col-md-5">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['bno']; } ?>" name="bno" readonly="true">
                </div>
                
                <div class="form-group col-md-5">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['title']; } ?>" name="title" readonly="true">
                </div>

                <div class="form-group col-md-5">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['aname']; } ?>" name="aname" readonly="true">
                </div>

                <div class="form-group col-md-5">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['publication']; } ?>" name="publication" readonly="true">
                </div>

                <div class="form-group col-md-5">
                    <label>Fine</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['price']; } ?>" name="price" readonly="true">
                </div>

                <div class="form-group col-md-5">
                    <label>Alamara</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['alamara']; } ?>" name="alamara" readonly="true">
                </div>

                <div class="form-group col-md-5">
                    <label>Rack</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['rack']; } ?>" name="rack" readonly="true"> 
                </div>
                
                <div class="form-group col-md-5">
                    <label>Request Date</label>
                    <input type="text" class="form-control" value="<?php if(isset($Book)){ echo $Book['rack']; } ?>" name="rack" readonly="true"> 
                </div>

                <div class="form-group col-md-5">
                    <label>Returned Date</label>
                    <input type="text" class="form-control" value="<?php echo date("d-m-Y"); ?>" name="rack" readonly="true"> 
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


