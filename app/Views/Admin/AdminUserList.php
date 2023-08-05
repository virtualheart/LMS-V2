<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">User's List</h1>
            <a href="<?=site_url('')?>" class="btn-lg float-right btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
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
                                            <th>Gender</th>
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
                                            <th>Gender</th>
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
                                            <td><?=$user['gender']; ?></td> 
                                            <td><a class='btn btn-success' href='#' ><i class='fa fa-edit'></i></a></td> 
                                        </tr>         

        							<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

    </div>