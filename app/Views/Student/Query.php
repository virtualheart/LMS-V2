<?= view('Student/Sidebar') ?>

    <div class="container-fluid">
        <!-- <h1 class="h3 mb-4 text-gray-800">Barrow Book</h1> -->

        <form method="POST" id="bookForm">
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <?php session()->remove('msg'); ?>
            <?php endif; ?> 
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Raise a Query</h6>
            </div>

            <div class="card-body" style="padding-bottom: 1px;">

                <div class="form-group col">
                    <label>Raise a Query</label>
                    <textarea type="text" class="form-control" value="" name="query" id="query" ></textarea>
                </div>
                
                <div class=" form-group card-footer col" style="margin-bottom: 0px;">
                    <label></label>
                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" >                  
                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                </div>              
            </form>
        </div>
    </div>

        <table class="table table-bordered" id="norTablewop">
            <thead>
                <th>Query Id</th>
                <th>Query</th>
                <th>Resolved</th>
            </thead>
            <tfoot>
                <th>Query Id</th>
                <th>Query</th>
                <th>Resolved</th>
            </tfoot>
            <tbody>
                <?php $i=1; ?>

                <?php foreach ($querys as $query): ?>

                <tr>
                    
                <td><?=$query['query_id']?></td>
                <td><?=$query['query']?></td>
                <td><?php if($query['is_resolved'] === '1')
                            echo 'Resolved';
                        else
                            echo 'Pending';
                 ?></td>
                </tr>
                
                <?php $i++; endforeach; ?>

            </tbody>
        </table>
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
