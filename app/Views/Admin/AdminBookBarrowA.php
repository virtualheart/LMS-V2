<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<!-- <h1 class="h3 mb-4 text-gray-800">Barrow Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg') == "Book Barrowed.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php elseif (session()->getFlashdata('msg') == "Book Barrowed Failed.") : ?>
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
                <?php session()->remove('msg'); ?>
            <?php endif; ?> 
                <!--  -->
              <div id="NoBookAlert"></div>

                   <!--  -->
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Barrow Book</h6>
            </div>

            <div class="card-body">
                <div class="row">

                <div class="form-group col-md-5">
                    <label>Barcode No</label>
                    <input type="text" class="form-control" value="<?=$BooksData['bcode']?>" name="bcode" autocomplete="off" readonly="yes">
                </div>

                <div class="form-group col-md-5">
                    <label>Reg Number</label>
                    <input type="text" class="form-control" value="" name="regno" id="regno" onkeyup="getUserDetile(this.value)" required>
                </div>
                
                <div class="form-group col-md-5">
                    <label>Std/Staff Name</label>
                    <input type="text" class="form-control" value="" name="sname" id="sname" required readonly="true">

                </div>


                <div class="form-group col-md-5">
                    <label>Book No</label>
                    <input type="text" class="form-control" value="<?=$BooksData['bno']?>" name="bno" id="bno" readonly="true">
                </div>
                
                <div class="form-group col-md-5">
                    <label>Title</label>
                    <input type="text" class="form-control" value="<?=$BooksData['title']?>" name="title" id="title" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Author Name</label>
                    <input type="text" class="form-control" value="<?=$BooksData['aname']?>" name="aname" id="aname" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Publication</label>
                    <input type="text" class="form-control" value="<?=$BooksData['publication']?>" name="publication" id="publication" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Price</label>
                    <input type="text" class="form-control" value="<?=$BooksData['price']?>" name="price" id="price" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>Request Date</label>
                    <input type="text" class="form-control" value="<?=date("d-m-Y");?>" name="reqdate" readonly="true">
                </div>
                <div class="form-group col-md-5">
                    <label>ETA Return Date</label>
                    <input type="text" class="form-control" value="<?=date("d-m-Y",strtotime("+15 days"))?>" name="retdate" id="retdate" readonly="true"> 
                </div>
                <div class=" form-group col-md-5"style="position:relative;top:30px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" id="save" style="margin-left:5px">                  
                    <input type="button" class="btn btn-danger btn-md" value="Back" >
                    <br>
                    <br>
                </div>              
            </form>
        </div>
    </div>
</div>
</div>


