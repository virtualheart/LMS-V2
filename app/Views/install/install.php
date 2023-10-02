<?php
$errors=false;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url();?>assets/install/css/styles.css" media="all">    
    <title>LMS-V2 installcation</title>
    <!-- Scripts -->
<script>
    window.onload = (event) => {
        var card = document.getElementById('card');
        card.classList.add('show');
    };
</script>
</head>
<body>

    <div id="wrapper">
        <div class="container">
            <div class="setup">
                <div id="card" class="card">
                    <div class="card__body">
                            <?php  
                                if(phpversion() < "7.4"){
                                    $errors = true;
                                }
                                if(!extension_loaded('mysqli')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('curl')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('pdo')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('intl')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('gd')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('json')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('mbstring')){
                                    $errors = true; 
                                }
                                if(!is_writable(getcwd())){
                                    $errors = true; 
                                }
                                if(file_exists(getcwd().'/.env')){
                                    $errors = true; 
                                }
                                if (!function_exists('exec')) {
                                    $errors = true;
                                }
                                if (!exec('composer --version')) {
                                    $errors = true; 
                                } 
                                if (!extension_loaded('openssl')) {
                                    $errors = true;
                                }


                            ?>
                            
                            <div class="card__image">
                                <?php if($errors==true){?>
                                    <img src="<?=base_url();?>assets/install/images/server_error.png" alt="">
                                <?php } else { ?>
                                    <img src="<?=base_url();?>assets/install/images/server_success.png" alt="">
                                <?php } ?>
                            </div>
                            <div class="card__content">
                                <div class="card__content__head">
                                    <h3 class="card__title">
                                        <span><?php echo "LMS-V2"; ?></span>
                                    </h3>
                                    <p class="card__fade">This php extensions Are must needed! If you server don't have this Ask you server provider to enable it. This are commonly used php extension in all Hosting's. For Further Info Contact us.</p>
                                </div>
                                <div class="card__fade">
                                    <div class="notify-list">
                                         <?php  
                                            // Add or remove your script's requirements below
                                            if(file_exists(getcwd().'/.env')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>The installation process is already complete !</span>
                                                </div>";
                                            }
                                            
                                            if(!is_writeable(getcwd())){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>The file's don't have writeable permission !</span>
                                                </div>";

                                            }
                                            if(phpversion() < "7.1"){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>Current PHP version is ".phpversion()."! minimum PHP 7.2 or higher required.</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg> 
                                                <span class='notify__text'>You are running PHP version ".phpversion()."</span>
                                                </div>";
                                            }
                                            if(!extension_loaded('mysqli')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>MySQLi PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>MySQLi PHP extension available</span>
                                                </div>";
                                            } 
                                            if(!extension_loaded('curl')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>Curl PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>Curl PHP extension available</span>
                                                </div>";
                                            }
                                            if(!extension_loaded('pdo')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>PDO PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>PDO PHP extension available</span>
                                                </div>";
                                            }
                                            if(!extension_loaded('json')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>JSON PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>JSON PHP extension available</span>
                                                </div>";
                                            }
                                            if(!extension_loaded('mbstring')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>mbstring PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>mbstring PHP extension available</span>
                                                </div>";
                                            }

                                            if(!function_exists('exec')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>exec PHP function missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>exec PHP function available</span>
                                                </div>";
                                            } 

                                            if (!exec('composer --version')) {
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>PHP composer missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>PHP composer available</span>
                                                </div>";
                                            }

                                            if(!extension_loaded('openssl')){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>openssl PHP extension missing!</span>
                                                </div>";
                                            } else {
                                                echo "<div class='notify notify--success'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                                </svg>
                                                <span class='notify__text'>openssl PHP extension available</span>
                                                </div>";
                                            } 

                                        ?>
                                    </div>
                                    <div class="card__content__foot">
                                        <p>Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?="LMS-V2"?></a> All rights reserved.</p>
                                        <div class="text-right">
                                            <?php if($errors==true){ ?>
                                                <button type="button" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;" disabled>Next</button>
                                            <?php }else{ ?>
                                                <a href="<?=site_url('/install/step1')?>" class="btn btn--primary btn--slide" style="min-width: 124px;">Next</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
</body>
</html>