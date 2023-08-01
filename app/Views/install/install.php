<?php

use App\Models\SettingsModel;

$settingsModel = new SettingsModel();
$appName = $settingsModel->getAppName();

$database_dump_file = 'database.sql';

$errors = false;

?>

<link rel="stylesheet" href="<?=base_url();?>assets/install/css/styles.css" media="all">    
  
<!-- Scripts -->
<script>
	window.onload = (event) => {
		var card = document.getElementById('card');
		card.classList.add('show');
	};
</script>

 	<div id="wrapper">
		<div class="container">
			<div class="setup">
				<div id="card" class="card">
					<div class="card__body">
					    <?php switch ($step) { default: ?>
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
                                if(!extension_loaded('json')){
                                    $errors = true; 
                                }
                                if(!extension_loaded('mbstring')){
                                    $errors = true; 
                                }
                                if(is_writable($Basepath)){
                                    $errors = true; 
                                }
                                if(file_exists($installpath)){
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
        								<span><?php echo $appName; ?></span>
        							</h3>
        							<p class="card__fade">This php extensions Are must needed! If you server don't have this Ask you server provider to enable it. This are commonly used php extension in all Hosting's. For Further Info Contact us.</p>
        						</div>
        						<div class="card__fade">
        							<div class="notify-list">
        							     <?php  
                                            // Add or remove your script's requirements below
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
                                            if(!is_writeable($Basepath)){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>The don't have writeable permission !</span>
                                                </div>";
                                            }
                                            if(file_exists($installpath)){
                                                echo "<div class='notify notify--error'>
                                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                                <path fill='none' d='M0 0h24v24H0z'/>
                                                <path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                                </svg>
                                                <span class='notify__text'>The installation process is already complete !</span>
                                                </div>";
                                            }
                                        ?>
        							</div>
        							<div class="card__content__foot">
        								<p>Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?=$appName?></a> All rights reserved.</p>
        								<div class="text-right">
        								    <?php if($errors==true){ ?>
        								        <button type="button" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;" disabled>Next</button>
                                            <?php }else{ ?>
                                                <a href="<?=site_url('/api/test/1')?>" class="btn btn--primary btn--slide" style="min-width: 124px;">Next</a>
                                            <?php } ?>
        								</div>
        							</div>
        						</div>
    					    </div>					    
					    
					    <?php break; case "1": ?>
					    
                                
                                          <div class="card__image">
                    							<img src="<?=base_url();?>assets/install/images/database.png" alt="">
                    						</div>
                    						<div class="card__content">
                    							<div class="card__content__head">
                    								<h3 class="card__title">
                    									<span>Database</span>
                    								</h3>
                    							</div>
                    							<div class="card__fade">
                    							    <form action="index.php?step=1" method="POST">
                    							        <div class="notify notify--error" style="margin-bottom: 18px;">
                    										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    											<path fill="none" d="M0 0h24v24H0z"/>
                    											<path fill="currentColor" d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    										</svg>
                    										<span class="notify__text">Failed to connect to MySQL: <?php echo mysqli_connect_error(); ?></span>
                    									</div>
                									
                        								<input type="hidden" name="lcscs" id="lcscs" value="">
                                                
                                                        <div class="mb-16">
            												<label for="host" class="form-label">Database Host</label>
            												<input class="form-control" type="text" id="host" placeholder="enter your database host" name="host" value="localhost" required>
            											</div>
            											<div class="mb-16">
            												<label for="username" class="form-label">Database Username</label>
            												<input class="form-control" type="text" id="user" placeholder="enter your database username" name="user" required>
            											</div>
            											<div class="mb-16">
            												<label for="password" class="form-label">Database Password</label>
            												<input class="form-control" type="text" id="pass" placeholder="enter your database password" name="pass">
            											</div>
            											<div class="mb-16">
            												<label for="name" class="form-label">Database Name</label>
            												<input class="form-control" type="text" id="name" placeholder="enter your database name" name="name" required>
            											</div>
                        								<div class="card__content__foot">
                        									<div class="text-right">
                        										<button type="submit" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;">Import</button>
                        									</div>
                        								</div>
                        								<p style="margin-top: 10px;">Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?=$appName?></a> All rights reserved.</p>
                    								</form>
                    							</div>
                    						</div>

                                        <div class="card__image">
                							<img src="<?=base_url();?>assets/install/images/database.png" alt="">
                						</div>
                						<div class="card__content">
                							<div class="card__content__head">
                								<h3 class="card__title">
                									<span>Database</span>
                								</h3>
                							</div>
                							<div class="card__fade">
                							    <form action="index.php?step=2" method="POST">
                    								<div class="mb-48">
                    								    <div class="notify notify--success">
                    										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    											<path fill="none" d="M0 0h24v24H0z"/>
                    											<path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"/>
                    										</svg>
                    										<span class="notify__text">Database was successfully imported.</span>
                    									</div>
                    									<input type="hidden" name="dbscs" id="dbscs" value="true">
                    								</div>
                    								<div class="card__content__foot">
                    									<div class="text-right">
                    									    <button type="submit" class="btn btn--primary btn--slide" style="min-width: 124px;">Next</button>
                    									</div>
                    								</div>
                								</form>
                							</div>
                						</div>

                                    
                                        <div class="card__image">
                							<img src="<?=base_url();?>assets/install/images/database.png" alt="">
                						</div>
                						<div class="card__content">
                							<div class="card__content__head">
                								<h3 class="card__title">
                									<span>Database</span>
                								</h3>
                							</div>
                							<div class="card__fade">
                							    <form action="index.php?step=1" method="POST">
                    								<input type="hidden" name="lcscs" id="lcscs" value="">
                                            
                                                    <div class="mb-16">
        												<label for="host" class="form-label">Database Host</label>
        												<input class="form-control" type="text" id="host" placeholder="enter your database host" name="host" value="localhost" required>
        											</div>
        											<div class="mb-16">
        												<label for="username" class="form-label">Database Username</label>
        												<input class="form-control" type="text" id="user" placeholder="enter your database username" name="user" required>
        											</div>
        											<div class="mb-16">
        												<label for="password" class="form-label">Database Password</label>
        												<input class="form-control" type="text" id="pass" placeholder="enter your database password" name="pass">
        											</div>
        											<div class="mb-16">
        												<label for="name" class="form-label">Database Name</label>
        												<input class="form-control" type="text" id="name" placeholder="enter your database name" name="name" required>
        											</div>
                    								<div class="card__content__foot">
                    									<div class="text-right">
                    										<button type="submit" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;">Import</button>
                    									</div>
                    								</div>
                    								<p style="margin-top: 10px;">Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?=$appName?></a> All rights reserved.</p>
                								</form>
                							</div>
                						</div>
                                    

					    
					    <?php break; case "2": ?>
					    
    					    <?php if($_POST && isset($_POST["dbscs"])){
                                session_destroy();
                            ?>
                                <div class="card__image">
        							<img src="<?=base_url();?>assets/install/images/finish.png" alt="">
        						</div>
        						<div class="card__content">
        							<div class="card__content__head">
        								<h3 class="card__title">
        									<span>Finish</span>
        								</h3>
        							</div>
        							<div class="card__fade">
        								<div class="notify notify--success mb-40">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                                <path fill="none" d="M0 0h24v24H0z"/>
                                                <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"/>
                                            </svg>
                                            <span class="notify__text"><?php echo $appName; ?> is successfully installed.</span>
                                        </div>
                                        <p>You can now login using your username: <b style="color: #f44336c7;">admin</b> and default password: <b style="color: #f44336c7;">admin</b></p>
                                        <p>The first thing you should do is change your account details.</p>
                                        <div class="text-center mb-48">
                                            <a href="../index.php" class="btn btn--primary">Let's go</a>
                                        </div>
                                        <h3 class="card__title">Support</h3>
                                        <div class="card__foot">
                                            <p>We provide support through Email or Telegram. <br>
                                            <b>Email:</b> <a href="mailto:dhanajayan99@gmail.com" style="color: #2196f3;">dhanajayan99@gmail.com</a> <br>
                                            <b>Telegram:</b>  </p>
                                        </div>
        								<div class="card__content__foot text-center">
        									<p>Thank you for purchasing our products</p>
        								</div>
        							</div>
        						</div>
        
                            <?php } else { ?>
                            
                                <h2 style="color: #f44336c7;">Sorry, something went wrong.</h2>
                                
                            <?php } break; } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
