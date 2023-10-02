    <br>
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Add Student</h6>
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
                                <input type="text" name="remark" class="form-control" value="<?=$student['remark']?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" value="deactivite" class="btn btn-info btn-md">
                                <input type="submit" class="btn btn-primary btn-md">
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
        </div>
        <button class="btn btn-success" onClick="window.print()">Print</button>
    </div>
