<?= view('Admin/Adminsidebar') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Students</h1>
    </div>

   <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-warning alert-dismissible">
            <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
        </div>
        <?php session()->remove('msg'); ?>
    <?php endif; ?>   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload a File</h6>
            <a href="<?=site_url('admin/users/students')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm mr-2"><i class="fas fa-arrow-left fa-sm text-white-50 "></i> Back</a>

        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <p>Please Upload Excel in Given Format <a href="<?=base_url('assets/sample/sample_student.xlsx')?>" target="_blank">Sample xlsx Format</a></p>
                    </div>
                    <div class="col-sm-12 mb-sm-0">
                        <label for="fileInput">
                            <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input type="file" class="form-control form-control-user" id="fileInput" name="file"     accept=".xlsx, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/csv" required>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="margin-bottom: 0px;">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Student</button>
            </div>
        </form>
    </div>
</div>
