<?php require_once($this->getLayout('header_other')); ?>

        <div class="contentPage contactsPage">
            <div class="contactsMain showEl" style="background-image:url(/assets/img/back-aboutMainGrey.png)">
                <div class="container">
                    <div class="list">
                        <div class="cfix">
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain5.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('Address'); ?></span>
                                        <p class="txt">
                                        41 Wigmore Street, Marylebone<br> London, W1U 1PR</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain6.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('Messedger WHATS.APP'); ?></span>
                                        <div class="txt">
                                            <div class="linkBlock">
                                                <a href="#" class="link phone">+44 7754655098</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain7.png)"></span>
                                        <span class="tit">E-mail</span>
                                        <div class="txt">
                                            <div class="linkBlock">
                                                <a href="mailto:<?=$this->config['admin_email'];?>" class="link mail"><?=$this->config['admin_email'];?></a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain8.png)"></span>
                                        <span class="tit">Telegram</span>
                                        <div class="txt">
                                            <div class="linkBlock">
                                                <span><?=$this->getLanguageText('Telegram chat'); ?>:</span>
                                                <a href="<?=TG?>" target="_blank" class="link telegram">@capperclub_group</a>
                                            </div>
                                            <div class="linkBlock">
                                                <span><?=$this->getLanguageText('Telegram channel'); ?>:</span>
                                                <a href="<?=TG_C?>" target="_blank" class="link telegram">@capperclub_news</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="backBlue base writeUs showEl">
                <div class="backBlock"></div>
                <div class="container">
                    <div class="titBlock centerTitle">
                        <span class="tit whiteTxt"><?=$this->getLanguageText('What happened?'); ?></span>
                        <span class="pre"><?=$this->getLanguageText('Simply send a request and we will answer within 24 hours.'); ?></span>
                    </div>
					<form method="post" action="/contacts" class="writeForm">
                        <input type="hidden" name="token" value="<?= $this->getToken('contact_form'); ?>" novalidate="novalidate">
                        <input type="hidden" name="form" value="contact_form">
                        <div class="cfix">
                            <div class="item col4">
                                <div class="inputBlock">
                                    <label>E-mail<span class="star">*</span>:</label>
                                    <div class="wrapInput">
                                        <input type="email" value="<?php if ($this->usid) echo $this->user->data['email'] ?>" <?php if ($this->usid) echo 'disabled' ?> placeholder="<?=$this->getLanguageText('Enter your email'); ?>" name="email">
                                    </div>
                                </div>
                            </div>
							
									
						<div class="item col8" style="padding: 65px 0px;">
						<div class="logRegCheck">
                                                <input type="checkbox" id="term-check" name="iamnotrobot" value="1">
                                                <label for="term-check"> <?=$this->getLanguageText('Confirm that you are not a robot'); ?></label>
                        </div>
						</div>
								
							
                            <div class="item col12">
                                <div class="inputBlock">
                                    <label><?=$this->getLanguageText('Message'); ?><span class="star">*</span>:</label>
                                    <div class="wrapInput">
                                        <textarea class="message" name="message" placeholder="<?=$this->getLanguageText('Briefly describe the issue'); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="legendForm">
                            <span class="star">*</span>
                            - <?=$this->getLanguageText('mandatory fields'); ?>
                        </span>
                        <button class="btn btnFull"><?=$this->getLanguageText('Send request'); ?></button>
                    </form>
                </div>
            </div>
            <div class="map showEl">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.8404057661664!2d-0.15128218395004808!3d51.516143879636594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ad3234e4d95%3A0x565fd52cd647eecc!2zNDEgV2lnbW9yZSBTdCwgTWFyeWxlYm9uZSwgTG9uZG9uIFcxVSAxUFIsINCS0LXQu9C40LrQvtCx0YDQuNGC0LDQvdC40Y8!5e0!3m2!1sru!2sru!4v1551734653744" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>


<!-- -->

<?php require_once($this->getLayout('footer_home')); ?>