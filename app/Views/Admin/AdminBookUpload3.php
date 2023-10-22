<?= view('Admin/Adminsidebar') ?>

<div class="container-fluid">

            <div class="alert alert-success alert-dismissible">
                <div class="text-center">
                    Data Insert successfully
                </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
            </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Import Data</h6>
        </div>
        <div class="card-body">
            <p>Imports Data count: <?= $count; ?></p>
        </div>
        <div class="card-footer" style="margin-bottom: 0px;">
            <a href="<?=site_url('admin/Uploadbooks')?>" class="btn btn-primary float-right mr-3 mb-3">Back to Upload</a>
        </div>
    </div>
</div>
