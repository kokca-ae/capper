<?php require_once($this->getLayout('header_home')); ?>


<section class="authorization register">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?= $_title[$this->lang]; ?></h1>
            </div>
            <div class="col-xs-12">
                <div class="login-form-wrapper">
							<div class="login-form-header ">
                                <p><?=$this->getLanguageText('register form'); ?></p>
                            </div>
                        <form method="post" name="mainform" class="login-form" action="/signup" data-pjax>
							<input type="hidden" name="token" value="<?= $this->getToken('signup_form'); ?>">
							<input type="hidden" name="form" value="signup_form">
                            <div class="form-inner">
                            
								<div class="form-row first">
                                <div class="form-row">
                                    <input type="text" name="email" value="" class="form-input" placeholder="<?=$this->getLanguageText('Email Address'); ?>">
                                </div>
								</div>
							
                                <div class="form-row">
                                    <input type="text" name="login" value="" placeholder="<?=$this->getLanguageText('Login'); ?>" class="form-input">
                                </div>
                                <div class="form-row">
                                    <input type="password" name="password" value="" placeholder="<?=$this->getLanguageText('Password'); ?>" class="form-input">
                                </div>
                                <div class="form-row">
                                    <input type="password" name="re_password" value="" placeholder="<?=$this->getLanguageText('Confirm Password'); ?>" class="form-input">
                                </div>
								
								<div class="form-row">
									<input type="text" class="form-input" disabled="" autocomplete="off" value="<?=$this->getLanguageText('Your upliner'); ?>: <?=$referer?>">
								</div>
								<div class="form-row">
                                <div class="checkbox">
                                    <input type="checkbox" id="term-check" name="rules" value="1" >
                                    <label for="term-check"> <?=$this->getLanguageText('I agree with <a href="/rules" target="_blank">Terms and conditions</a>'); ?></label>
                                </div>
								</div>
								</div>
                            
                            
                            <div class="form-row">
                                <input id="login-submit" type="submit" value="Register" class="authorization-btn">
                                <label for="login-submit"><?=$this->getLanguageText('Register'); ?></label>
                            </div>
                            <!--<div class="bottom-links">
                                <div class="checkbox">
                                    <input type="checkbox" id="term-check" name="agree" value="1" checked="checked">
                                    <label for="term-check"> I agree with <a href="?a=rules" target="_blank">Terms and conditions</a></label>
                                </div>
                            </div>-->
						<div class="bottom-links">
                        <p><?=$this->getLanguageText('Already have an account?'); ?> <a href="/login"><strong><?=$this->getLanguageText('Sign In'); ?></strong></a></p>
                    </div>
                        </form>
						

                </div>
            </div>
        </div>
    </div>
</section>


   

<?php require_once($this->getLayout('footer_home')); ?>