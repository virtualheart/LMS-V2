<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">Student's List</h1>
            <a href="<?=site_url('admin/users/student/add/new')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Regno</th>
                                            <th>Name</th>
                                            <!-- <th>Email</th> -->
                                            <th>Contact</th>
                                            <th>Year of joining</th>
                                            <th>Department</th>
                                            <th>Swift</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Regno</th>
                                            <th>Name</th>
                                            <!-- <th>Email</th> -->
                                            <th>Contact</th>
                                            <th>Year of joining</th>
                                            <th>Department</th>
                                            <th>Swift</th>
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
                                            <!-- <td>< ?=$user['stemail']; ?></td> -->
                                            <td><?=$user['Contact']; ?></td>
                                            <td><?=$user['year']; ?></td>
                                            <td><?=$user['dname']; ?></td>
                                            <td><?=$user['shift']; ?></td> 
                                            <td><a class='btn btn-success' href='<?=site_url('admin/users/student/update/'.$user['st_id'])?>' ><i class='fa fa-edit'></i></a></td> 
                                        </tr>         

        							<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

    </div>