<?= view('Admin/Adminsidebar') ?>

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
                                                <a href="<?=site_url('admin/Activity/status');?>" class="text-primary">Total Books</a></div>
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
                                                <a href="<?=site_url('#');?>" class="text-success">Total Barrow</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$barrowBooks?></div>
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
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="<?=site_url('#');?>" class="text-info">Total Staff</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalStaff?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Total Students Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="<?=site_url('#');?>" class="text-warning">Total Students</a></div>
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
                
            </div>


