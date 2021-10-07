<?php require_once($this->getLayout('header_home')); ?>


<section class="authorization login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?= $_title[$this->lang]; ?></h1>
            </div>
            <div class="col-xs-12">
                <div class="login-form-wrapper">
                    <div class="login-form-header ">
                                                    <p><?=$this->getLanguageText('authorization form'); ?></p>
                                            </div>
					
					<form method="post" class="login-form" novalidate="novalidate" action="/login" data-pjax>  
                            <input type="hidden" name="token" value="<?= $this->getToken('login_form'); ?>">
                            <input type="hidden" name="form" value="login_form">
                        <div class="form-inner">
                                                        <div class="form-row first">
                                <input type="text" name="login" value="" placeholder="<?=$this->getLanguageText('Please enter your E-mail/User name'); ?>" class="form-input valid" autofocus="autofocus" aria-invalid="false">
                            </div>
                            <div class="form-row">
                                <input type="password" name="password" value="" class="form-input valid" placeholder="<?=$this->getLanguageText('Please enter your password'); ?>" aria-invalid="false">
                            </div>
                                                    </div>
                        <div class="form-row">
                            <input id="login-submit" type="submit" value="<?=$this->getLanguageText('Sign In'); ?>" class="authorization-btn">
                            <label for="login-submit"><?=$this->getLanguageText('Sign In'); ?></label>
                        </div>
                    </form>
                    <div class="bottom-links">
                        <p><?=$this->getLanguageText('Do not have an account?'); ?> <a href="/signup"><strong><?=$this->getLanguageText('Sign Up'); ?></strong></a></p>
                        <p><?=$this->getLanguageText('Forgot password?'); ?> <a href="/recovery"><strong><?=$this->getLanguageText('Restore'); ?></strong></a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php require_once($this->getLayout('footer_home')); ?>