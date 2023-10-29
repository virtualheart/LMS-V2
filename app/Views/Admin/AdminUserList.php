<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">Staff's List</h1>
            <a href="<?=site_url('admin/users/staff/add/new')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Regno</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Contact</th>
                                            <!-- <th>Gender</th> -->
                                            <th>Report</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Regno</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                            <th>Contact</th>
                                            <!-- <th>Gender</th> -->
                                            <th>Report</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>

							        <?php foreach ($users as $user): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$user['regno']; ?></td>
                                            <td><?=$user['sname']; ?></td>
                                            <td><?=$user['semail']; ?></td>
                                            <td><?=$user['designation']; ?></td>
                                            <td><?=$user['contact']; ?></td>
                                            <!-- <td>< ?=$user['gender']; ?></td>  -->
                                            <td><a class='btn btn-success' href="javascript:void(0);" onClick="popUpWindow('<?=site_url('admin/report/staff/'.$user['sid'])?>');" title="Report">
                                            <i class='fa fa-file'></i></a></td>
                                            <td><a class='btn btn-info' href='<?=site_url('admin/users/staff/update/'.$user['sid'])?>' ><i class='fa fa-edit'></i></a></td> 
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
    
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+800+',height='+620+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>
    </div>