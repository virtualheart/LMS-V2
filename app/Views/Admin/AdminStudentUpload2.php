<?= view('Admin/Adminsidebar') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Books</h1>
    </div>
<script type="text/javascript">
    alert("Data was not imported. Please verify and process")
</script>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Preview Uploaded Data</h6>
        </div>
        <div class="card-body">
            <!-- Display the preview data here in a table -->
            <table class="table" id="norTable">
                   <thead>
                        <tr>
                            <th title="Register Number">Reg.no</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Class Id</th>
                            <th title="Year of joining">YOJ</th>
                            <th>shift</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>

                        <tr>
                            <td><?=$record['regno']?></td>
                            <td><?=$record['sname']?></td>
                            <td><?=$record['gender']?></td>
                            <td><?=$record['stemail']?></td>
                            <td><?=$record['Contact']?></td>
                            <td>C<?=$record['did']?></td>
                            <td><?=$record['year']?></td>
                            <td><?=$record['shift']?></td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>

            </table>
        </div>
        <div class="card-footer" style="margin-bottom: 0px;">
            <a href="<?=site_url('admin/Uploadstudents/booksimport')?>" class="btn btn-success btn-user float-right mb-3">Proceed to Import</a>
            <a href="<?=site_url('admin/Uploadstudents/importcancel')?>" class="btn btn-primary float-right mr-3 mb-3">Cancel</a>
        </div>
    </div>
</div>
