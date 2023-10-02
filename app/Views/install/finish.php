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
                                <img src="<?= base_url('assets/install/images/finish.png'); ?>" alt="">
                            <?php } else { ?>
                                <img src="<?= base_url('assets/install/images/server_success.png'); ?>" alt="">
                            <?php } ?>
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
                                            <span class="notify__text"><?="LMS-V2" ?> is successfully installed.</span>
                                        </div>
                                        <p>You can now login using your username: <b style="color: #f44336c7;">admin</b> and default password: <b style="color: #f44336c7;">admin</b></p>
                                        <p>The first thing you should do is change your account details.</p>
                                        <div class="text-center mb-48">
                                            <a href="<?=site_url()?>" class="btn btn--primary">Let's go</a>
                                        </div>
                                        <h3 class="card__title">Support</h3>
                                        <div class="card__foot">
                                            <p>We provide support through Email or github. <br>
                                            <b>Email:</b> <a href="mailto:dhanajayan99@gmail.com" style="color: #2196f3;">dhanajayan99@gmail.com</a> <br>
                                            <b>github:</b> <a href="https://github.com/virtualheart/LMS-V2" style="color: #2196f3;">@virtualheart</a> </p>
                                        </div>
        								<div class="card__content__foot text-center">
        									<p>Thank you for Using our products</p>
        								</div>
        							</div>
        						</div>