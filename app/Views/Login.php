    <!-- <div id="particles-js"></div> -->
        <div class="col-md-4 offset-md-4">
                <form method="post">
                    <div class="box1">

                        <center><img src="<?php echo base_url('/assets/logo.png'); ?>" align="logo" class="mt-5" width="70px" ></center>

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
                    <?php endif;?>
                    <?php session()->remove('msg'); ?>
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
                            <a href="./forgetpassword" class="float-right mt-2">Forget Password</a>
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
        <a href="<?=site_url('about')?>" 
           style="position: fixed; bottom: 30px; right: 30px; box-shadow: 2px 2px 24px #444; border-radius: 25px; display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background-color: #0072C6; cursor: pointer;" 
           target="_blank"
           title="About Me">
            <i class="fa fa-info" style="color: white;"></i>
        </a>
<!-- <style>

canvas {
    display: block;
    vertical-align: bottom;
}

/* ---- particles.js container ---- */
#particles-js {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #232741;
    background-repeat: no-repeat;
    background-size: 20%;
    background-position: 50% 50%;
}

/* ---- stats.js ---- */
.count-particles {
    background: #000022;
    position: absolute;
    top: 48px;
    left: 0;
    width: 80px;
    color: #13E8E9;
    font-size: .8em;
    text-align: left;
    text-indent: 4px;
    line-height: 14px;
    padding-bottom: 2px;
    font-family: Helvetica, Arial, sans-serif;
    font-weight: bold;
}

.js-count-particles {
    font-size: 1.1em;
}

#stats,
.count-particles {
    -webkit-user-select: none;
    margin-top: 5px;
    margin-left: 5px;
}

#stats {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
}

.count-particles {
    border-radius: 0 0 3px 3px;
}
</style>

<script src="< ?=base_url('assets/js/particles.min.js')?>"></script> 

<script type="text/javascript">
    particlesJS("particles-js", {
   "particles": {
      "number": {
         "value": 160,
         "density": {
            "enable": true,
            "value_area": 800
         }
      },
      "color": {
         "value": "#ffffff"
      },
      "shape": {
         "type": "circle",
         "stroke": {
            "width": 0,
            "color": "#000000"
         },
         "polygon": {
            "nb_sides": 5
         },
      },
      "opacity": {
         "value": 1,
         "random": true,
         "anim": {
            "enable": true,
            "speed": 1,
            "opacity_min": 0,
            "sync": false
         }
      },
      "size": {
         "value": 3,
         "random": true,
         "anim": {
            "enable": false,
            "speed": 4,
            "size_min": 0.3,
            "sync": false
         }
      },
      "line_linked": {
         "enable": false,
         "distance": 150,
         "color": "#ffffff",
         "opacity": 0.4,
         "width": 1
      },
      "move": {
         "enable": true,
         "speed": 1,
         "direction": "none",
         "random": true,
         "straight": false,
         "out_mode": "out",
         "bounce": false,
         "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 600
         }
      }
   },
   "interactivity": {
      "detect_on": "canvas",
      "events": {
         "onhover": {
            "enable": true,
            "mode": "bubble"
         },
         "onclick": {
            "enable": true,
            "mode": "repulse"
         },
         "resize": true
      },
      "modes": {
         "grab": {
            "distance": 400,
            "line_linked": {
               "opacity": 1
            }
         },
         "bubble": {
            "distance": 250,
            "size": 0,
            "duration": 2,
            "opacity": 0,
            "speed": 3
         },
         "repulse": {
            "distance": 400,
            "duration": 0.4
         },
         "push": {
            "particles_nb": 4
         },
         "remove": {
            "particles_nb": 2
         }
      }
   },
   "retina_detect": true
});
</script> -->