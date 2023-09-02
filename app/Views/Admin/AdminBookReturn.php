<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Add Book</h1> -->
        <?= validation_list_errors() ?>

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "Book return Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Book return Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?>         

              <div id="NoBookAlert"></div>
              
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Return Book</h6>
            </div>

            <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="" name="bcode" autocomplete="off" onkeyup="getDetailReturn(this.value)" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Reg Number</label>
                    <input type="text" class="form-control" value="" name="regno" id="regno" readonly="true">
                </div>
                <div class="form-group col-md-6">
                    <label>Std/Staff Name</label>
                    <input type="text" class="form-control" value="" name="sname" id="sname" readonly="true">
                </div>
                
                <div class="form-group col-md-6">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="" name="bno" id="bno" readonly="true">
                </div>
                
                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" value="" name="title" id="title" readonly="true">
                </div>

                <div class="form-group col-md-6">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="" name="aname" id="aname" readonly="true">
                </div>

                <div class="form-group col-md-6">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="" name="publication" id="publication" readonly="true">
                </div>

                <div class="form-group col-md-6">
                    <label>Late Fine</label>
                    <input type="text" class="form-control" value="" name="fine" id="fine" readonly="true">
                </div>

                <div class="form-group col-md-6">
                    <label>Alamara</label>
                    <input type="text" class="form-control" value="" name="alamara" id="alamara" readonly="true">
                </div>

                <div class="form-group col-md-6">
                    <label>Rack</label>
                    <input type="text" class="form-control" value="" name="rack" id="rack" readonly="true"> 
                </div>
                
                <div class="form-group col-md-6">
                    <label>Request Date</label>
                    <input type="text" class="form-control" value="" name="request_date" id="request_date" readonly="true"> 
                </div>

                <div class="form-group col-md-6">
                    <label>Returned Date</label>
                    <input type="text" class="form-control" value="<?=date("d-m-Y"); ?>" readonly="true"> 
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