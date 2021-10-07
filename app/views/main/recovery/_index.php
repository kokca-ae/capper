<?php require_once($this->getLayout('header_home')); ?>

<section class="authorization restore">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?= $this->getLanguageText('Restore password'); ?></h1>
            </div>
            <div class="col-xs-12">
                <div class="login-form-wrapper">
                    <div class="login-form-header success">
                        <p><?= $this->getLanguageText('Forgot password?'); ?></p>
                    </div>
											
                    <form method="post" class="login-form" name="forgotform" novalidate="novalidate" action="/recovery">
                            <input type="hidden" name="token" value="<?= $this->getToken('recovery_form'); ?>">
                            <input type="hidden" name="form" value="recovery_form">
                        <div class="form-inner">
                                <div class="form-row first">
                                    <input type="text" name="email" value="" placeholder="<?=$this->getLanguageText('Enter your E-mail'); ?>" class="form-input" autofocus="autofocus">
                                </div>
						
								<div class="form-row">
                                <div class="checkbox">
                                    <input type="checkbox" id="term-check" name="iamnotrobot" value="1">
                                    <label for="term-check"> <?=$this->getLanguageText('Confirm that you are not a robot'); ?></label>
                                </div>
								</div>
						
                                <div class="form-row">
                                    <input id="login-submit" type="submit" value="<?=$this->getLanguageText('Recovery'); ?>" class="authorization-btn">
                                    <label for="login-submit"><?=$this->getLanguageText('Recovery'); ?></label>
                                </div>
                            

                        </div>

                    </form>
                    <div class="bottom-links">
                        <p><?=$this->getLanguageText('Remember your password?'); ?> <a href="/login"><strong><?=$this->getLanguageText('Sign In'); ?></strong></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
	
    
<?php require_once($this->getLayout('footer_home')); ?>