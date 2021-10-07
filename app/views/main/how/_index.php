<?php require_once($this->getLayout('header_home')); ?>

<section class="title-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?=$_title[$this->lang];?></h1>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="page-buttons-block">
                    <div class="row">
                        
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="margin: 0 auto;float: none;">
<a class="btn-title-block blue" href="/login"><?=$this->getLanguageText('Sign In'); ?></a>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="get-started" id="get-started">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-4">
                <div class="tablet"></div>
            </div>
            <div class="col-lg-7 col-md-8">
                <div class="polygon-wrapper">
                    <div class="polygon-wrapper-next">
                        <div class="polygon polygon-1 active" data-tab="first"><span>1</span></div>
                        <div class="polygon polygon-2" data-tab="second"><span>2</span></div>
                        <div class="polygon polygon-3" data-tab="third"><span>3</span></div>
                        <div class="polygon polygon-4" data-tab="fourth"><span>4</span></div>
                        <div class="polygon polygon-5" data-tab="fifth"><span>5</span></div>
                        <div class="polygon polygon-6" data-tab="sixth"><span>6</span></div>
                    </div>
                    <div class="get-started-content" id="first" style="display: block;">
                        <h2 class="title"><?=$this->getLanguageText('Create an account'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('To start working with project  is easy. It’ll take only a couple of minutes to sign up on our website. Click Sign up at the top of the screen or follow the link below.'); ?></p>
                        <a href="/signup" class="btn-title-block"><?=$this->getLanguageText('Sign Up'); ?></a>
                    </div>
                    <div class="get-started-content" id="second" style="display: none;">
                        <h2 class="title"><?=$this->getLanguageText('Fill in the form'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('Enter all the necessary information on the registration page. Check that the data are correct, and then click on Sign up.'); ?></p>
                    </div>
                    <div class="get-started-content" id="third" style="display: none;">
                        <h2 class="title"><?=$this->getLanguageText('Settings in your account'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('Go to your account settings to personalize your account. There you can change your password or set your payment details.'); ?> </p>
                    </div>
                    <div class="get-started-content" id="fourth" style="display: none;">
                        <h2 class="title"><?=$this->getLanguageText('Make deposits'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('To invest click on "Create a deposit" in your account. Select the investment plan you are interested in and enter the amount of the deposit.'); ?></p>
                    </div>
                    <div class="get-started-content" id="fifth" style="display: none;">
                        <h2 class="title"><?=$this->getLanguageText('Make a profit'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('At the end of the term of your deposit, the amount of earnings calculated according to the chosen plan will be credited to your personal account. Congratulations on your first income on our platform!'); ?></p>
                    </div>
                    <div class="get-started-content" id="sixth" style="display: none;">
                        <h2 class="title"><?=$this->getLanguageText('Withdrawal funds'); ?></h2>
                        <p class="content"><?=$this->getLanguageText('To withdraw the earned money click on "Withdraw" in your account. If you want to increase your income you can create a deposit directly from the balance in your account.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- -->

<?php require_once($this->getLayout('footer_home')); ?>