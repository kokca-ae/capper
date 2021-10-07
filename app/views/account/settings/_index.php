<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">
                        <div class="settingsPage">
                            <div class="cfix margO">
                                
								
								<div class="item col6 col12-sd col6-md col12-xs">
                                    <div class="bigCard personal">
                                        <div class="chapterSettings">
                                            <div class="titleCard">
                                                <span class="icon-44"></span>
                                                <span class="txt"><?=$this->getLanguageText('Personal <br>info'); ?></span>
                                            </div>
                                            <div class="content">
                                                <div class="inputBlock">
                                                    <label>E-mail:</label>
                                                    <div class="wrapInput">
                                                        <input type="text" value="<?= $this->user->data['email'] ?>" class="lightInput" disabled>
                                                    </div>
                                                </div>
                                                <div class="inputBlock">
                                                    <label><?=$this->getLanguageText('Account Name:'); ?></label>
                                                    <div class="wrapInput">
                                                        <input type="text" value="<?= $this->user->data['user'] ?>" class="lightInput" disabled>
                                                    </div>
                                                </div>
												<!-- geo -->
                                                
                                            </div>
                                        </div>
                                    </div>
									
									<div class="bigCard securityCard">
									<form action="/settings" method="POST" data-pjax>
									<input type="hidden" name="token" value="<?= $this->getToken('autorefback'); ?>">
									<input type="hidden" name="form" value="autorefback">
                                        <div class="chapterSettings">
                                            <div class="titleCard">
                                                <span class="icon-31"></span>
                                                <span class="txt"><?=$this->getLanguageText('Auto <br>Refback'); ?></span>
                                            </div>
											
											<?php foreach ($this->autorefback as $row) : ?>
                                            <div class="content">
                                                <div class="inputBlock">
                                                    <label><?=$this->getLanguageText('Percent');?> Auto Refback [10-100]:</label>
                                                    <div class="wrapInput">
                                                        <input name="perc" size="3" maxlength="3" type="text" value="<?php if ($row['refback_percent']) echo $row['refback_percent']; ?>" class="lightInput">
                                                    </div>
                                                </div>
                                                <div class="logRegCheck" style="margin-top: 30px;">
                                                <input type="checkbox" name="refback" value="<?=$row['refback']?>" id="onoff" <?php if ($row['refback']>0) echo "checked"; ?>>
                                                <label for="onoff" style="color: white;"><?=$this->getLanguageText('Enable / Disable');?></label>
                                            </div>
                                            </div>
											<?php endforeach; ?>
											
                                        </div>
                                        <div class="bttnGradientBlock">
                                            <button type="submit" class="gradientBttn doItBttn"><?=$this->getLanguageText('Save'); ?></button>
                                        </div>
									</form>
                                    </div>
                                </div>
								
								
                                <div class="item col6 col12-sd col6-md col12-xs">
								
									<form action="/settings" method="POST" data-pjax>
                                    <div class="bigCard securityCard">
									<input type="hidden" name="token" value="<?= $this->getToken('change_pass_form'); ?>">
									<input type="hidden" name="form" value="change_pass_form">
                                        <div class="chapterSettings">
                                            <div class="titleCard">
                                                <span class="icon-31"></span>
                                                <span class="txt"><?=$this->getLanguageText('Change <br>password'); ?></span>
                                            </div>
                                            <div class="content">
                                                <div class="inputBlock">
                                                    <label><?=$this->getLanguageText('You Password');?>:</label>
                                                    <div class="wrapInput">
                                                        <input name="old" type="password" class="lightInput">
                                                    </div>
                                                </div>
                                                <div class="inputBlock">
                                                    <label><?=$this->getLanguageText('New Password');?>:</label>
                                                    <div class="wrapInput">
                                                        <input name="new" type="password" class="lightInput">
                                                    </div>
                                                </div>
                                                <div class="inputBlock">
                                                    <label><?=$this->getLanguageText('Confirm Password');?>:</label>
                                                    <div class="wrapInput">
                                                        <input name="re_new" type="password" class="lightInput">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bttnGradientBlock">
                                            <button type="submit" class="gradientBttn doItBttn"><?=$this->getLanguageText('Save'); ?></button>
                                        </div>
                                    </div>
									</form>
                                </div>
								
								
								<!-- -->
								
								<!-- -->
								
                            </div>
                        </div>
                    </div>
<script>
$("input[name='refback']").click(function(){
    //Some code
	var v = $(this).val();
	if(v == 1){
		var v = 0;
	}else{
		var v = 1;
	}
	$(this).val(v);
	console.log('v > '+v);
});
</script>
            <!-- Page Footer-->
            



<?php require_once($this->getLayout('footer_cabinet')); ?>