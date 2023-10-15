<?= view('Admin/Adminsidebar') ?>

<div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">General Setting</h6>
            </div>

            <ul class="nav nav-tabs ml-2" role="tablist" id="list-tab">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="list-Department-list" data-toggle="tab" href="#list-Department" role="tab" aria-controls="home">Class</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="list-designation-list" data-toggle="tab" href="#list-designation" role="tab" aria-controls="designation">Designation</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="list-berrow-list" data-toggle="tab" href="#list-berrow" role="tab" aria-controls="berrow">Berrow</a>
                </li>
            </ul>

            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="list-Department" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <!-- Left Column - Form -->
                            <div class="col-md-6">
                                <form method="POST" >

                                <div class="card-body">
                                <div class="form-group">
                                    <label>Class</label>
                                    <input type="text" class="form-control" name="class_name" required>
                                </div>
                                <div class="form-group text-right" style="top:30px;">
                                    <label></label>
                                    <input type="submit" class="btn btn-primary btn-md " name="save" value="Save" style="margin-left:5px">                  
                                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                                    <br><br>
                                </div>
                            </div>
                        </form>
                            </div>
                            <div class="col-md-6 mt-2">
                                <table class="table table-bordered">
                                <thead>
                                    <th>S.No</th>
                                    <th>Class Id</th>
                                    <th>Class</th>
                                    <!-- <th>Update</th>      -->
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php $i=1; foreach ($departments as $department): ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>C<?=$department['did'] ?></td>
                                        <td><?=$department['dname'] ?></td>
                                        <!-- <td><a href='#' class='btn btn-success'><span class='fa fa-edit'></span></a></td> -->
                                        <td><center><a href='#' class='btn btn-danger'> <span class='fa fa-trash'></span></a></td>
                                    </tr> 
                                    <?php endforeach; ?>
                                    </tr> 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list-designation" role="tabpanel" aria-labelledby="designation-tab">
                        <div class="row">
                            <!-- Left Column - Form -->
                            <div class="col-md-6">
                            <form method="POST" >

                                <div class="card-body">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control" name="designation_name" required>
                                </div>
                                <div class="form-group text-right" style="top:30px;">
                                    <label></label>
                                    <input type="submit" class="btn btn-primary btn-md " name="savedesign" value="Save" style="margin-left:5px">                  
                                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                                    <br><br>
                                </div>
                            </div>
                        </form>
                            </div>
                            <div class="col-md-6 mt-2">
                                <table class="table table-bordered">
                                <thead>
                                    <th>S.No</th>
                                    <th>Designation List</th>
                                    <!-- <th>Update</th>      -->
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($designations as $designation): ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?= $designation['designation'] ?></td>
                                        <!-- <td><a href='#' class='btn btn-success'><span class='fa fa-edit'></span></a></td> -->
                                        <td><center><a href='#' class='btn btn-danger'> <span class='fa fa-trash'></span></a></td>
                                    </tr> 
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-berrow" role="tabpanel" aria-labelledby="berrow-tab">
                        <div class="row">
                            <!-- Left Column - Form -->
                            <div class="col-md-6">
                                <form method="POST">

                                <div class="card-body">

                                <div class="form-group">
                                    <label>Berrow No.</label>
                                    <input type="text" class="form-control" name="berrowno" required>
                                </div>
                                <div class="form-group">
                                    <label>Rack No.</label>
                                    <input type="text" class="form-control" name="rackno" required>
                                </div>
                                <div class="form-group">
                                    <label>Side</label>
                                    <select class="itemName form-control" name="side" required>
                                        <option value="Front">Front</option>
                                        <option value="Back">Back</option>
                                    </select>
                                </div>

                                <div class="form-group text-right" style="top:30px;">
                                    <label></label>
                                    <input type="submit" class="btn btn-primary btn-md " name="savebro" value="Save" style="margin-left:5px">                  
                                    <input type="button" class="btn btn-danger btn-md" value="Clear" data-toggle="modal" data-target="#clearModal">
                                    <input type="reset" class="btn btn-danger btn-md d-none" id="resetButton">
                                    <br><br>
                                </div>
                            </div>
                        </form>
                            </div>
                            <div class="col-md-6 mt-2">
                                <table class="table table-bordered">
                                <thead>
                                    <th>S.No.</th>
                                    <th>Rack Id</th>
                                    <th>Berrow No.</th>
                                    <th>Rack No.</th>
                                    <th>Side</th>
                                    <!-- <th>Update</th>      -->
                                    <th>Delete</th>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($berrows as $berrow): ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>BR<?= $berrow['id'] ?></td>
                                        <td><?= $berrow['alamara'] ?></td>
                                        <td><?= $berrow['rack'] ?></td>
                                        <td><?= $berrow['side'] ?></td>
                                        <!-- <td><a href='#' class='btn btn-success'><span class='fa fa-edit'></span></a></td> -->
                                        <td><center><a href='#' class='btn btn-danger'> <span class='fa fa-trash'></span></a></td>
                                    </tr> 
                                    <?php endforeach; ?>
                                    </tr> 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    </form>
</div>
