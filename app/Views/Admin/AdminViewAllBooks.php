<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">List Books</h1>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Price</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Update</th>
                                            <!-- <th>Delete</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Price</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Update</th>
                                            <!-- <th>Delete</th> -->
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>

							        <?php foreach ($books as $books): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$books['bno']; ?></td>
                                            <td><?=$books['title']; ?></td>
                                            <td><?=$books['aname']; ?></td>
                                            <td><?=$books['publication']; ?></td>
                                            <td><?=$books['price']; ?></td> 
                                            <td><?=$books['alamara']; ?></td>
                                            <td><?=$books['rack']; ?></td> 
                                            <td><a class='btn btn-success' href='<?=site_url("Admin/Book/book/Update/").$books['bid']; ?>' ><i class='fa fa-edit'></i></a></td> 
                                        </tr>         

        							<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

    </div>
