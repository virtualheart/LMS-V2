<?= view('Admin/Adminsidebar') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Backup LMS</h1>
    </div>

   <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-success alert-dismissible">
            <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
        </div>
    <?php session()->remove('msg'); ?>
    <?php endif; ?>   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Database Backup</h6>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <p>The Downloaded SQL file current stage of LMS full database.</p>
                    </div>
                    <div class="col-sm-12 mb-sm-0">
                        <label for="fileInput" style="font-weight: bold;">
                            <span style="color:red;font-weight: bold;">*</span>Avaliable file's</label>
                                <table>
                                    <?php 
                                        $controllers = get_filenames(WRITEPATH . 'backups/');
                                        foreach($controllers as $file){
                                            if(is_string($file)){
                                                echo '<tr><td>'.$file.'</td></tr>';
                                            }
                                        }
                                    ?>
                                </table>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="margin-bottom: 0px;">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Backup</button>
            </div>
        </form>
    </div>
</div>
