<?= view('Admin/Adminsidebar') ?>

	<div class="container-fluid">
    	<h1 class="h3 mb-4 text-gray-800">Status Books</h1>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Barcode No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Barcode No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Alamara</th>
                                            <th>Rack</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>

							        <?php foreach ($books as $books): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$books['bcode']; ?></td>
                                            <td><?=$books['bno']; ?></td>
                                            <td><?=$books['title']; ?></td>
                                            <td><?=$books['aname']; ?></td>
                                            <td><?=$books['publication']; ?></td>
                                            <td><?=$books['alamara']; ?></td>
                                            <td><?=$books['rack']; ?></td>
    
                                            <?php if($books['status'] == 1){ ?>
                                                <td><a class='btn btn-success' href='<?=site_url("/admin/Activity/barrow/").$books["bcode"]?>'><i class='fa fa-check'></i></a></td> 
                                            <?php } else { ?>
                                                <td><a class='btn btn-danger' href='<?=site_url("#").$books['bid']; ?>' title="Book Unavaliable, click to Request the Holder." ><i class='fa fa-ban'></i></a></td> 
                                            <?php } ?> 
    
                                        </tr>         

        							<?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

    </div>
