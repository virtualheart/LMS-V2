<?php 
use App\Models\SettingsModel;
use App\Models\RequestModel;

$settingsModel = new SettingsModel();
$appLogo = $settingsModel->getAppLogo();

$session = session();

$uri = uri_string();

$requestModel = new RequestModel();

$data['req'] = $requestModel->getBookRequest(session()->get('id'),session()->get('role'));

?>

<!--  
    show 
    active
-->
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('student/Dashboard'); ?>">
                <div class="sidebar-brand-icon">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <img src="<?= base_url("$appLogo");?>" width="30%" height="30%">
                </div>
                <!-- <div class="sidebar-brand-text mx-3">SB<sup>Admin</sup></div> -->
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($uri=="student/Dashboard") echo "active"; ?>">
                <a class="nav-link" href="<?= site_url('student/Dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Activity
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php if($uri=="books/status" || $uri=="#") echo "active"; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseactivity"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-book"></i>
                    <span>Books</span>
                </a>
                <div id="collapseactivity" class="collapse <?php if($uri=="#" || $uri=="#") echo "show"; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Book Entry:</h6> -->
                        <a class="collapse-item <?php if($uri=="books/status") echo "active"; ?>" href="<?=site_url('books/status') ?>">Books Status</a>
                        <a class="collapse-item <?php if($uri=="#") echo "active"; ?>" href="#" >Barrow Book List</a>
                        <a class="collapse-item <?php if($uri=="#") echo "active"; ?>" href="#">Return Book History</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php if($uri=="student/ListRequest" || $uri=="student/ListRequest/history") echo "active"; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRequest"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-paper-plane"></i>
                    <span>Book Request</span>
                </a>
                <div id="collapseRequest" class="collapse <?php if($uri== "student/ListRequest" || $uri=="student/ListRequest/history") echo "show"; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if($uri=="student/ListRequest") echo "active"; ?>" href="<?= site_url('student/ListRequest')?>">Request List</a>
                        <a class="collapse-item <?php if($uri=="student/ListRequest/history") echo "active"; ?>" href="<?= site_url('student/ListRequest/history')?>">Request List History</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Settings
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?php if($uri=="Student/Profile") echo "active"; ?>">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fa fa-cogs"></i>
                    <span>Settings</span>
                </a>
                <div id="collapsePages" class="collapse <?php if($uri=="Student/Profile") echo "show"; ?>" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <a class="collapse-item" href="#">Settings</a> -->
                        <a class="collapse-item <?php if($uri=="Student/Profile") echo "active"; ?>" href="<?=site_url('Student/Profile')?>">Profile</a>
                 </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?=count($data['req'])?></span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <?php foreach ($data['req'] as $requests) { ?> 
                                

                                <a class="dropdown-item d-flex align-items-center" href="<?=site_url('student/ListRequest')?>">
                                    <!-- <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div> -->
                                    <div class="font-weight-bold">
                                        <div class="d-inline-block text-truncate"><?=$requests->messagee;?></div>
                                        <div class="small text-gray-500">Date : <?=$requests->rec_date;?></div>
                                    </div>
                                </a>

                               <?php } ?>
                                <?php if (count($data['req'])<=0) { ?>
                                    <!-- <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div> -->
                                    <div class="font-weight-bold">
                                        <div class="text-truncate text-center">No messgae</div>
                                        <!-- <div class="small text-gray-500">Date : </div> -->
                                    </div>
                                <?php } ?>

                                <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a> -->
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$session->get('name')?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php if ($session->get('image')){ echo base_url().$session->get('image'); } else { echo base_url()."/assets/logo.png"; } ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?=site_url('Student/Profile')?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
<!--                                 <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
 -->                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->

