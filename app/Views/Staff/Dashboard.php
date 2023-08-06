<?= view('Staff/Staffsidebar') ?>

		<div class="container-fluid">
    		<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                                    <!-- Content Row -->
                    <div class="row">
                        <!-- Total Books Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">

                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalBooks ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barrow Books Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Barrow Books</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=sizeof($books)?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Staff Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Due Fine</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalFine?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Total Students Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Students</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalStudents?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Barrowed Books</h6>
                                </div>
                                <div class="card-body">

                                <div class="card shadow mb-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
                                            <!-- <th>Alamara</th> -->
                                            <!-- <th>Rack</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Book No</th>
                                            <th>Title</th>
                                            <th>Author Name</th>
                                            <th>Publication</th>
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
    </div>

       