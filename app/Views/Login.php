        <div class="col-md-4 offset-md-4" style="margin-top:30px">
                <form method="post">
                    <div class="box1">

                        <center><img src="<?php echo base_url(); ?>/assets/logo.png" align="logo" width="70px" ></center>

                        <?php if(uri_string()=="Login/student") {?>
                            <h3 class="page-header text-info text-center">Student Login</h3>
                        <?php }else{ ?>
                            <h3 class="page-header text-info text-center">Staff Login</h3>
                        <?php } ?>

                        <div class="form-group">
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                            <?php session()->remove('msg'); ?>
                    <?php endif;?>
                            <label>Regester No</label>
                            <input type="text" class="form-control" name="regno" placeholder="Reg No" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                        <div class="input-group">
                            
                            <input type="password" class="form-control" name="password" id="apass" placeholder="Password" required>
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button" onclick="showpwd()"><i class="fa fa-eye"></i></button>
                            </span>
                            <!-- <input type="checkbox" class="form-check-label">Show Password -->

                        </div>
                        </div>

                        <div class="form-group pull-right">
                            <input type="submit" class="btn btn-success" value="Login" id="log" name="login">
                            <input type="reset" class="btn btn-danger" value="Clear">
                        <br>
                        <br>
                        </div>
                        <?php if(uri_string()=="Login/student") {?>
                            <a href="./Staff" class="btn btn-primary btn-block"><!-- <i class="fab fa-users fa-fw"></i> -->Switch to Staff Login</a>
                        <?php }else{ ?>
                            <a href="./student" class="btn btn-primary btn-block"><!-- <i class="fab fa-users fa-fw"></i> -->Switch to Student Login</a>
                        <?php } ?>
                    </div>              
                </form>

            </div>
        </div>


