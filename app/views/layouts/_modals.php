<?$referer = (isset($_SESSION["ref"])) ? $_SESSION["ref"] : "None"; // описал все на HomeController (с проверкой там же)?>  
	<div class="modalsScroll" style="margin-top: 0px;">
        <div class="modals table">
            <div class="middle tCell">
                <div class="siteMod blockMod" id="logReg">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="logRegTabs tabs">
                            <ul class="tabList cfix">
                                <li class="invisLink">
                                    <div class="iconLeft">
                                        <span class="icon-30"></span>
                                        <span class="data"><?=$this->getLanguageText('Log In'); ?></span>
                                    </div>
                                    <a href="#login"></a>
                                </li>
                                <li class="invisLink">
                                    <div class="iconLeft">
                                        <span class="icon-31"></span>
                                        <span class="data"><?=$this->getLanguageText('Sign Up'); ?></span>
                                    </div>
                                    <a href="#reg"></a>
                                </li>
                            </ul>
							
                            <div class="tabContent modContent" id="login" style="background-image: url(/assets/img/modal_back.png); display:none;">
                                <form method="post" action="/">
                            <input type="hidden" name="token" value="<?= $this->getToken('login_form'); ?>">
                            <input type="hidden" name="form" value="login_form">

                                    <div class="row">
                                        <div class="item col6">
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Login'); ?><span>*</span>:</label>
                                                <input type="text" name="login">
                                            </div>
                                        </div>
                                        <div class="item col6">
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Password'); ?><span>*</span>:</label>
                                                <input type="password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="left">
                                            <div class="logRegCheck">
                                                <input type="checkbox" id="logRegCheck" name="iamnotrobot" value="1">
                                                <label for="logRegCheck"><?=$this->getLanguageText('I am not Robot'); ?></label>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <span data-modal="forgot" class="linkType1 modallink"><?=$this->getLanguageText('Forgot password?'); ?></span>
                                        </div>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button type="submit" class="gradientBttn"><?=$this->getLanguageText('Log In'); ?></button>
                                    </div>
                                </form>
                            </div>
							
							<!-- log / reg -->
							
                            <div class="tabContent modContent" id="reg" style="background-image: url(/assets/img/modal_back.png)">
                                <form method="post" action="/">
							<input type="hidden" name="token" value="<?= $this->getToken('signup_form'); ?>">
							<input type="hidden" name="form" value="signup_form">
                                    <div class="row">
                                        <div class="item col6">
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Login'); ?><span>*</span>:</label>
                                                <input name="login" type="text">
                                            </div>
                                            <div class="inBlock">
                                                <label>E-mail<span>*</span>:</label>
                                                <input name="email" type="email">
                                            </div>
                                            <div class="inBlock">

                                            <div class="logRegCheck">
                                                <input type="checkbox" id="RegCheck" name="rules" value="1">
                                                <label for="RegCheck"><?=$this->getLanguageText('I agree with <a href="/rules" target="_blank">Terms and conditions</a>'); ?></label>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="item col6">
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Password'); ?><span>*</span>:</label>
                                                <input name="password" type="password">
                                            </div>
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Confirm Password'); ?><span>*</span>:</label>
                                                <input name="re_password" type="password">
                                            </div>
                                            <div class="inBlock">
                                                <label><?=$this->getLanguageText('Your upliner'); ?>:</label>
                                                <input type="text" disabled="" autocomplete="off" value="<?=$referer?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button type="submit" class="gradientBttn"><?=$this->getLanguageText('Get Started'); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="siteMod blockMod" id="review">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent paddLg" style="background-image: url(/assets/img/modal_back.png)">
                            <span class="caption"><?=$this->getLanguageText('Leave review'); ?></span>
                            <span class="subtitle"><?=$this->getLanguageText('Leave feedback about our cooperation!'); ?></span>
							
							<form method="post" action="/reviews">
							<input type="hidden" name="token" value="<?= $this->getToken('review_form'); ?>">
							<input type="hidden" name="form" value="review_form">
							<input type="hidden" id="type_review" name="type" value="1">
                                <div class="row">
                                    <div class="item col6">
                                        <div class="inBlock">
                                            <label><?=$this->getLanguageText('Login'); ?><span>*</span>:</label>
                                            <input type="text" name="user" value="<?php if ($this->usid) echo $this->user->data['user'] ?>" <?php if ($this->usid) echo 'disabled' ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
										<div class="left">
                                            <div class="logRegCheck">
                                                <input type="checkbox" id="thatisvideo">
                                                <label for="thatisvideo"><?=$this->getLanguageText('this video'); ?>?</label>
                                            </div>
                                        </div>
								</div>
								
								<div class="row" data-type="1" id="typeRev_1" style="">
                                    <div class="item col12">
                                        <div class="inBlock">
                                            <label><?=$this->getLanguageText('Your feedback'); ?><span>*</span>:</label>
                                            <textarea name="message"></textarea>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row" data-type="2" id="typeRev_2" style="display:none;">
                                    <div class="item col12">
                                        <div class="inBlock">
                                            <label><?=$this->getLanguageText('YouTube link'); ?><span>*</span>:</label>
                                            <input type="text" name="link">
                                        </div>
                                    </div>
                                </div>
								
                                <div class="bttnGradientBlock">
                                    <button type="submit" class="gradientBttn"><?=$this->getLanguageText('Send request'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				
				
				
				<div class="siteMod blockMod" id="forgot">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent" style="background-image: url(/assets/img/modal_back.png)">
                            <span class="title"><?=$this->getLanguageText('Password recovery');?></span>
                            <form method="post" action="/">
							<input type="hidden" name="token" value="<?= $this->getToken('recovery_form'); ?>">
                            <input type="hidden" name="form" value="recovery_form">
                                <div class="row">
                                    <div class="item col12">
                                        <div class="inBlock">
                                            <label>E-mail<span>*</span>:</label>
                                            <input type="email" name="email">
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                        <div class="left">
                                            <div class="logRegCheck">
                                                <input type="checkbox" id="forgotCheck" name="iamnotrobot" value="1">
                                                <label for="forgotCheck"><?=$this->getLanguageText('I am not Robot'); ?></label>
                                            </div>
                                        </div>
                                        <div class="right">
                                            <span data-modal="logReg" data-tab='#reg' class="linkType1 modallink"><?=$this->getLanguageText('Sign Up');?></span> / <span data-modal="logReg" data-tab='#login' class="linkType1 modallink"><?=$this->getLanguageText('Remember your password?');?></span>
                                        </div>
                                    </div>
                                <div class="bttnGradientBlock">
                                    <button type="submit" class="gradientBttn"><?=$this->getLanguageText('Send request');?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				
				<div class="cabMod message blockMod init-modal" id="modal_type_2" style="display: none;">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack" style="background-image: url(/assets/img/modal_back2.png)">
                            <span class="img" style="background-image: url(/assets/img/message_img2.png)"></span>
                            <span class="title"><?=$this->getLanguageText('Success');?></span>
                            <div class="text">
                                <span><?php if ($this->error) echo $this->error; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="cabMod message blockMod init-modal" id="modal_type_3">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack" style="background-image: url(/assets/img/modal_back2.png)">
                            <span class="img" style="background-image: url(/assets/img/message_img.png)"></span>
                            <span class="title"><?=$this->getLanguageText('Error');?></span>
                            <div class="text">
                                <span><?php if ($this->error) echo $this->error; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="cabMod message blockMod init-modal" id="modal_type_4">
                    <div class="in">
                        <span class="icon-32 close"></span>
                        <div class="modContent darkBack" style="background-image: url(/assets/img/modal_back2.png)">
                            <span class="img" style="background-image: url(/assets/img/message_img.png)"></span>
                            <span class="title"><?=$this->getLanguageText('Redirection');?></span>
                            <div class="text">
                                <span><?=$this->getLanguageText('Welcome');?>, <?=$this->login_hi?>.</span>
                                <span><?=$this->getLanguageText('There is a redirect to the account...');?></span>
                            </div>
                        </div>
						<? if(intval($this->typeReq) == 4){ echo '<meta http-equiv="refresh" content="1;URL=/cabinet" />'; } ?>
                    </div>
                </div>
				
                <div id="overlay"></div>
            </div>
        </div>
    </div>
	
<script>
$(function() {
	
	var typeReq = '<?=$this->typeReq;?>';
	if(typeReq>0){
		$('#overlay').css('display', 'block');
		$('#modal_type_'+typeReq).addClass('open');
		$('#modal_type_'+typeReq).css('display', 'block');
		$('.modalsScroll').addClass('open');
	}
	
});

$("#thatisvideo").click(function(){
    //Some code
	var v = $('#type_review').val();

	if(v == 1){
		var v = 1;
		var v_new = 2;
		$('#typeRev_'+v).css('display','none');
		$('#typeRev_'+v_new).css('display','block');
		$('#type_review').val(v_new);
	}else{
		var v = 2;
		var v_new = 1;
		$('#typeRev_'+v).css('display','none');
		$('#typeRev_'+v_new).css('display','block');
		$('#type_review').val(v_new);
	}
	//console.log('v > '+v);
	//console.log('v_new > '+v_new);
});
</script>