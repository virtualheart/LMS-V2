<?= view('Admin/Adminsidebar') ?>

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Plan List</h1>
            <?php if (session()->getFlashdata('msg') == "New Plan Added Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
            <?php elseif (session()->getFlashdata('msg') == "Plan Update Successfully.") : ?>
                <div class="alert alert-success alert-dismissible">
                    <div class="text-center"><?= session()->getFlashdata('msg') ?></div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>
             <?php endif; ?>
             <?php session()->remove('msg'); ?>

            <a href="<?=site_url('admin/plan/planning/new/add')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Plan Id</th>
                                            <th>Category</th>
                                            <th>Year</th>
                                            <th>Bill No.</th>
                                            <th title="Num Of Books">NOB</th>
                                            <th>Amount</th>
                                            <!-- <th>Balance</th> -->
                                            <th>Report</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Plan Id</th>
                                            <th>Category</th>
                                            <th>Year</th>
                                            <th>Bill No.</th>
                                            <th title="Num Of Books">NOB</th>
                                            <th>Amount</th>
                                            <!-- <th>Balance</th> -->
                                            <th>Report</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach ($plans as $plan): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td>P<?=$plan['id']; ?></td>
                                            <td><?=$plan['category']; ?></td>
                                            <td><?=$plan['year']; ?></td>
                                            <td><?=$plan['billno']; ?></td>
                                            <td><?=$plan['noofbooks']; ?></td>
                                            <td><?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $plan['amount']); ?></td>
                                            <!-- <td>< ?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $plan['balance']); ?></td>  -->
                                            <td><a class='btn btn-success' href="javascript:void(0);" onClick="popUpWindow('<?=site_url('admin/Plan/report/'.$plan['id'])?>');" title="Report">
                                            <i class='fa fa-file'></i></a></td>

                                            <td><a class='btn btn-info' href='<?=site_url('admin/Plan/planning/update/'.$plan['id'])?>' ><i class='fa fa-edit'></i></a></td>
                                        </tr>         

                                    <?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
<script type="text/javascript">

var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height){

    if(popUpWin){
        if(!popUpWin.closed) popUpWin.close();
    }
    
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+620+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>

</div>