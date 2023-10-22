        <div class="col-md-4 offset-md-4" style="margin-top:30px">
                <form method="post">
                    <div class="box1">

                        <center><img src="<?php echo base_url('/assets/logo.png'); ?>" align="logo" width="70px" ></center>

                            <h3 class="page-header text-info text-center">Forget Password</h3>

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
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group pull-right">
                            <input type="submit" class="btn btn-success" value="send" id="log" name="send">
                            <input type="reset" class="btn btn-danger" value="Clear">
                            <br>
                        </div>
                            <a href="./Staff" class="btn btn-primary btn-block"><!-- <i class="fab fa-users fa-fw"></i> -->Switch to Staff Login</a>
                    </div>              
                </form>
            </div>
        </div>


