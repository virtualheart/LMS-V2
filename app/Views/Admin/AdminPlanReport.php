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
                            <td>Remark</td>
                            <td><?=$plan['remark']?></td>
                        </tr>
                       
                        <!-- <tr>
                            <td>Balance</td>
                            <td>
                                <input type="number" class="form-control" name="balance" value="< ?=preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,",  $plan['balance']); ?>"></td>
                        </tr> -->
                        <tr class="d-print-none">
                            <td colspan="2">
                                <div class="form-group" >
                                    <form method="POST">
                                        <select class="form-control" name="plan_status">
                                            <option value="<?=$plan['plan_status']?>"><?=$plan['plan_status']?></option>';
                                            <option value="Request processing">Request processing</option>
                                            <option value="Waiting for Appeal">Waiting for Appeal</option>
                                            <option value="Verification">Verification</option>
                                            <option value="Ordering">Ordering</option>
                                            <option value="Reporting">Reporting</option>
                                            <option value="Receiving orders">Receiving orders</option>
                                            <option value="Complect">Complect</option>
                                        </select>
                                        
                                        <label for="commands">Commands</label>
                                        <input type="text" class="form-control" name="commands">
                                        <input type="submit" class="btn btn-primary mt-2" value="save" name="save">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="norTable">
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
