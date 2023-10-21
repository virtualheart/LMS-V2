<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url('assets/install/css/styles.css');?>" media="all">    
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
    <!-- define('ENVIRONMENT', 'development'); -->
    <div id="wrapper">
        <div class="container">
            <div class="setup">
                <div id="card" class="card">
                    <div class="card__body"> 
                        <div class="card__image">
                            <img src="<?= base_url('assets/install/images/verified_success.png'); ?>" alt="">
                        </div>
                        <div class="card__content">
                            <div class="card__content__head">
                                <h3 class="card__title">
                                    <span>Settings</span>
                                </h3>
                            </div>
                            <div class="card__fade">
                                <?php if (session()->getFlashdata('msg') && session()->get('error'))  : ?>
                                    <div class='notify notify--error'>
                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'>
                                            <path fill='none' d='M0 0h24v24H0z'/><path fill='currentColor' d='M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z'/>
                                        </svg>
                                        <span class='notify__text'><?=session()->getFlashdata('msg'); ?></span>
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
                                        <label for="appname" class="form-label">Application Name</label>
                                        <input class="form-control" type="text" id="appname" placeholder="Enter your Application Name" name="appname" value="LMS" required>
                                    </div>
                                    <div class="mb-16">
                                        <label for="department" class="form-label">Department</label>
                                        <input class="form-control" type="text" id="department" name="department" placeholder="Enter your Department Name" value="" required>
                                    </div>
                                    <div class="mb-16">
                                        <label for="username" class="form-label">Fine</label>
                                        <input class="form-control" type="number" id="fine" placeholder="Enter Fine amount each day" name="fine" required min="0">
                                    </div>
                                    <div class="mb-16">
                                        <label for="fine_stf_days" class="form-label">Staff Book carry days</label>
                                        <input class="form-control" type="number" id="fine_stf_days" placeholder="Enter Days" name="fine_stf_days" min="1">
                                    </div>
                                    <div class="mb-16">
                                        <label for="fine_std_days" class="form-label">Student Book carry days</label>
                                        <input class="form-control" type="number" id="fine_std_days" placeholder="Enter Days" name="fine_std_days" required min="1">
                                    </div>

                                    <div class="card__content__foot">
                                        <div class="text-right">
                                            <button type="submit" id="next" class="btn btn--primary btn--slide" style="min-width: 124px;">Next</button>
                                        </div>
                                    </div>
                                        <p>Copyright © <?php echo date('Y'); ?> <a target="_blank" href="https://github.com/virtualheart/LMS-V2"><?="LMS-V2"?></a> All rights reserved.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
