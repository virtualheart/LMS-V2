<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Borrow Book</h1> -->
    <?= validation_list_errors() ?>

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "Book Borrowed.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Book Borrowed Failed.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Please verify if the book is borrowed or unavailable in the library.") : ?>
                <div class="alert alert-warning alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php endif; ?> 
            <?php session()->remove('msg'); ?>
                <!--  -->
              <div id="NoBookAlert"></div>

                   <!--  -->
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Borrow Book</h6>
            </div>

            <div class="card-body" style="padding-bottom: 1px;">
                <div class="row">

                <div class="form-group col-md-6">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="<?=$BooksData['bcode']?>" name="bcode" autocomplete="off" readonly="yes" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Reg Number</label>
                    <input type="text" class="form-control" value="" name="regno" id="regno" autocomplete="off" onkeyup="getUserDetile(this.value)" oninput="this.value = this.value.toUpperCase()" autofocus required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Std/Staff Name</label>
                    <input type="text" class="form-control" value="" name="sname" id="sname" required readonly="true" required>

                </div>


                <div class="form-group col-md-6">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="<?=$BooksData['bno']?>" name="bno" id="bno" readonly="true" required>
                </div>
                
                <div class="form-group col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?=$BooksData['title']?>" name="title" id="title" readonly="true" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="<?=$BooksData['aname']?>" name="aname" id="aname" readonly="true">
                </div>
                <div class="form-group col-md-6">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="<?=$BooksData['publication']?>" name="publication" id="publication" readonly="true">
                </div>
                <div class="form-group col-md-6">
                    <label>Price</label>
                    <input type="text" class="form-control" value="<?=$BooksData['price']?>" name="price" id="price" readonly="true">
                </div>
                <div class="form-group col-md-6">
                    <label>Request Date</label>
                    <input type="text" class="form-control" value="<?=date("d-m-Y");?>" name="reqdate" readonly="true" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Remark</label>
                    <input type="text" class="form-control" name="remark" maxlength="499" id="remark">
                </div>
                <div class=" form-group card-footer col"style="margin-bottom: 0px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" id="save" >                  
                    <input type="button" class="btn btn-danger btn-md" value="Back" >
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
