<?= view('Admin/Adminsidebar') ?>

<div class="container-fluid">


                        <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Borrowed Books</h6>
                                </div>
                                <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Message</th>
                                            <th>Requester</th>
                                            <!-- <th>Reciver</th> -->
                                            <th>Request Date</th>
                                            <th>User Seen</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Message</th>
                                            <th>Requester</th>
                                            <!-- <th>Reciver</th> -->
                                            <th>Request Date</th>
                                            <th>User Seen</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>
                                    <?php foreach ($requestlists as $requestlist): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$requestlist->messagee; ?></td>
                                            <td><?=$requestlist->regno; ?></td>
                                            <!-- <td>< ?=$requestlist->sname; ?></td> -->
                                            <td><?=$requestlist->rec_date; ?></td>
                                            <td><?php if($requestlist->is_seen==1){
                                                echo "Seen"; 
                                            } else{
                                                echo "Unseen";
                                            }
                                             ?></td>
                                        </tr>         

                                    <?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>