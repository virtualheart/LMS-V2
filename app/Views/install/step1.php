<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/install/css/styles.css'); ?>" media="all">    
    <title>LMS-V2 Installation</title>
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
                        <div class="card__image">
                            <?php if (session()->get('error')) { ?>
                                <img src="<?= base_url('assets/install/images/database.png'); ?>" alt="">
                            <?php } else { ?>
                                <img src="<?= base_url('assets/install/images/server_success.png'); ?>" alt="">
                            <?php } ?>
                        </div>
                        <div class="card__content">
                            <div class="card__content__head">
                                <h3 class="card__title">
                                    <span>Database</span>
                                </h3>
                            </div>
                            <div class="card__fade">
                                <?php if (session()->getFlashdata('msg') && session()->get('error'))  : ?>
                                    <div class='notify notify--error'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                            <path fill='none' d='M0 0h24v24H0z'/><path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                        </svg>
                                        <span class='notify__text'><?= session()->getFlashdata('msg'); ?></span>
                                    </div>
                                <?php elseif (session()->getFlashdata('msg')) : ?>
                                <div class='notify notify--success'>
                                    <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                        <path fill='none' d='M0 0h24v24H0z'/>
                                        <path fill='currentColor' d='M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z'/>
                                    </svg>
                                    <span class='notify__text'><?= session()->getFlashdata('msg'); ?></span>
                                </div>                                            
                                <?php endif; ?>
                                <form action="" method="POST">
                                    <div class="mb-16">
                                        <label for="host" class="form-label">Database Host</label>
                                        <input class="form-control" type="text" id="host" placeholder="Enter your database host" name="host" value="localhost" required>
                                    </div>
                                    <div class="mb-16">
                                        <label for="host" class="form-label">Database Port</label>
                                        <input class="form-control" type="number" id="port" name="port" placeholder="Enter your database port" value="3306" min="0" max="65535" required>
                                    </div>
                                    <div class="mb-16">
                                        <label for="username" class="form-label">Database Username</label>
                                        <input class="form-control" type="text" id="username" placeholder="Enter your database username" name="user" required>
                                    </div>
                                    <div class="mb-16">
                                        <label for="password" class="form-label">Database Password</label>
                                        <input class="form-control" type="text" id="password" placeholder="Enter your database password" name="pass">
                                    </div>
                                    <div class="mb-16">
                                        <label for="name" class="form-label">Database Name</label>
                                        <input class="form-control" type="text" id="name" placeholder="Enter your database name" name="name" required>
                                    </div>
                                    <div class="mb-16">
                                        <input class="form" type="checkbox" placeholder="Enter your database name" name="create" id="create" value="create">
                                        <label for="create" class="form-label">Database create</label>
                                    </div>
                                    <div class="card__content__foot">
                                        <div class="text-right">
                                            <?php if(!session()->get('errors')){ ?>
                                                <button type="submit" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;">Import</button>
                                            <?php }else{ ?>
                                                <button type="submit" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;">Import</button>
                                            <?php } ?>

                                        </div>
                                    </div>
                                        <p>Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?="LMS-V2"?></a> All rights reserved.</p>
                                </form>
                                <?php session()->remove('error') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
