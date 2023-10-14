    <br>
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Student Report</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Detiles</th>
                            </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <td>Reg. No.</td>
                            <td><?=$student['regno']?></td>
                        </tr>                        
                        <tr>
                            <td>Student Name</td>
                            <td><?=$student['sname']?></td>
                        </tr>                        
                        <tr>
                            <td>Department Name & shift</td>
                            <td><?=$student['dname'].' - '.$student['shift']?></td>
                        </tr>

                        <tr>
                            <td>Contact</td>
                            <td><?=$student['Contact']?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?=$student['stemail']?></td>
                        </tr>                        
                       
                        <tr>
                            <td>year Of Joining</td>
                            <td><?=$student['year']?></td>
                        </tr>
                        <tr>
                            <td>Remark</td>
                            <td>
                                <form method="POST">
                                    <input type="text" name="remark" class="form-control" value="<?=$student['remark']?>">
                                    <input type="submit" value="save" class="btn btn-primary btn-md d-print-none">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="norTable1">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Borrowed Date</th>
                                            <th>Fine</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <th>Borrowed Date</th>
                                            <th>Fine</th>
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
                                        </tr>         

                                    <?php $i++; endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                                
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
        </div>
        <button class="btn btn-success d-print-none" onClick="window.print()">Print</button>
    </div>
