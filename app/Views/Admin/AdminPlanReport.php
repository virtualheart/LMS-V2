    <br>
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Planning Detiles</h6>
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
                            <td>Category</td>
                            <td><?=$plan['category']?></td>
                        </tr>                        
                        <tr>
                            <td>Year</td>
                            <td><?=$plan['year']?></td>
                        </tr>                        
                        <tr>
                            <td>Bill No.</td>
                            <td><?=$plan['billno']?></td>
                        </tr>

                        <tr>
                            <td>No. of Books</td>
                            <td><?=$plan['noofbooks']?></td>
                        </tr>
                        <tr>
                            <td>Amounts</td>
                            <td><?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $plan['amount']); ?></td>
                        </tr>                        
                       
                        <tr>
                            <td>Balance</td>
                            <td><?=$plan['balance']?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="norTable1">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Commands</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Commands</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php $i=1; ?>

                                    <?php foreach ($remarks as $remark): ?>

                                        <tr>
                                            <td><?=$i; ?></td>
                                            <td><?=$remark['date']; ?></td>
                                            <td><?=$remark['command']; ?></td>
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
