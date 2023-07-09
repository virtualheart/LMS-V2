        <div class="col-md-4 offset-md-4" style="margin-top:30px">
                <form method="post">
                    <div class="box1">

                        <center><img src="<?php echo base_url(); ?>/assets/logo.png" align="logo" width="70px" ></center>

                        <h3 class="page-header text-info text-center">Login</h3>
                        <div class="form-group">
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('msg') ?>
                        </div>
                            <?php session()->remove('msg'); ?>
                    <?php endif;?>
                            <label>User Name</label>
                            <input type="text" class="form-control" name="regno" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                        <div class="input-group">
                            
                            <input type="password" class="form-control" name="password" id="apass" placeholder="Password">
                            <span class="input-group-btn">
                                <button class="btn btn-default reveal" type="button" onclick="showpwd()"><i class="fa fa-eye"></i></button>
                            </span>
                            <!-- <input type="checkbox" class="form-check-label">Show Password -->

                        </div>
                        </div>
                        <br>

                        <div class="form-group pull-right">
                            <input type="submit" class="btn btn-success" value="Login" id="log" name="login">
                            <input type="reset" class="btn btn-danger" value="Clear">
                        </div>                      
                    </div>              
                </form>
            </div>
    </body> 
</html>

<script type="text/javascript">
function showpwd() {
  var x = document.getElementById("apass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>