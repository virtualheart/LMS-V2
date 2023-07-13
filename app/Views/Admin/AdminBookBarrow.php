<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Barrow Book</h1> -->

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
                 <h6 class="m-0 font-weight-bold text-primary">Barrow Book</h6>
            </div>

            <div class="card-body">
                <div class="row">

                <div class="form-group col-md-5">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="GACCS20200002" name="bcode" required autocomplete="off" onkeyup="getDetailBarrow(this.value)">
                </div>

                <div class="form-group col-md-5">
                    <label>Reg Number</label>
                    <input type="text" class="form-control" value="" name="regno" id="regno" onkeyup="getUserDetile(this.value)">
                </div>
                
                <div class="form-group col-md-5">
                    <label>Std/Staff Name</label>
                    <input type="text" class="form-control" value="" name="sname" id="sname" readonly="true">

                </div>


                <div class="form-group col-md-5">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="" name="bno" id="bno" readonly="true">
                </div>
                
                <div class="form-group col-md-5">
                    <label>Title</label>
                    <input type="text" class="form-control" value="" name="title" id="title" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="" name="aname" id="aname" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="" name="publication" id="publication" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Price</label>
                    <input type="text" class="form-control" value="" name="price" id="price" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Alamara</label>
                    <input type="text" class="form-control" value="" name="alamara" id="alamara" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Rack</label>
                    <input type="text" class="form-control" value="" name="rack" id="rack" readonly="true"> 
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


