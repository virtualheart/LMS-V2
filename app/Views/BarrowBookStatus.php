
<div class="container-fluid">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Barrowed Books</h6>
                                </div>
                                <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="norTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th title="Book Number">B.No</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Publication</th>
                                            <th>Date</th>
                                            <th>Fine</th>
                                            <!-- <th>Reg No</th> -->
                                            <th title="Estimated time of arrival">ETA</th>
                                            <!-- <th>Alamara</th> -->
                                            <!-- <th>Rack</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th title="Book Number">Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Barrowed</th>
                                            <th>Fine</th>
                                            <!-- <th>Reg No</th> -->
                                            <th title="Estimated time of arrival">ETA</th>
                                            <!-- <th>Alamara</th> -->
                                            <!-- <th>Rack</th> -->
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
                                            <td><?=$books['request_date']; ?></td>
                                            <td><?=$books['fine']; ?></td>
                                            <!-- <td>< ?=$books['borrower_regno']; ?></td> -->
                                            <td><?=$books['return_date']; ?></td>
                                            <!-- <td>< ?=$books['alamara']; ?></td> -->
                                            <!-- <td>< ?=$books['rack']; ?></td>  -->
                                        </tr>         

                                    <?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>