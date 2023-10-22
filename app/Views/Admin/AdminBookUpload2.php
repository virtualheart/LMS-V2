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
                            <th title="Book Number">B.no</th>
                            <!-- <th>bcode</th> -->
                            <th>Title</th>
                            <th>Auther</th>
                            <th>Publication</th>
                            <th>Price</th>
                            <th>Language</th>
                            <th title="Year of publication">YOP</th>
                            <th>Edition</th>
                            <th>Plan Id</th>
                            <th>Shelf Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>

                        <tr>
                            <td><?=$record['bno']?></td>
                            <!-- <td>< ?=$record['bcode']?></td> -->
                            <td><?=$record['title']?></td>
                            <td><?=$record['aname']?></td>
                            <td><?=$record['publication']?></td>
                            <td><?=$record['price']?></td>
                            <td><?=$record['language']?></td>
                            <td><?=$record['year_of_publication']?></td>
                            <td><?=$record['edition']?></td>
                            <td>P<?=$record['plan_id']?></td>
                            <td>BR<?=$record['Shelf_id']?></td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>

            </table>
        </div>
        <div class="card-footer" style="margin-bottom: 0px;">
            <a href="<?=site_url('admin/Uploadbooks/booksimport')?>" class="btn btn-success btn-user float-right mb-3">Proceed to Import</a>
            <a href="<?=site_url('admin/Uploadbooks/importcancel')?>" class="btn btn-primary float-right mr-3 mb-3">Cancel</a>
        </div>
    </div>
</div>
