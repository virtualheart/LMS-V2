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
                            <td>Regno</td>
                            <td><?=$student['regno']?></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        <button class="btn btn-success" onClick="window.print()">Print</button>
    </div>
