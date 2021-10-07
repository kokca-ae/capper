<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">

						<div class="backgroundInfo blockInLine">
                            <div class="cfix margO">
                                <div class="item col6 col12-xss">
                                    <div class="chargeTime darkCard table">
                                        <div class="tableCell">
                                            <span class="icon-36"></span>
                                            <span class="txt"><?=$this->getLanguageText('Referral commission');?></span>
                                            <span class="val"><?=$ref_commission?> <i class="fa fa-usd"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item col6 col12-xss">
                                    <div class="chargeTime darkCard table">
                                        <div class="tableCell">
                                            <span class="icon-36"></span>
                                            <span class="txt"><?=$this->getLanguageText('Your upliner');?>:</span>
											<span class="val"><?=$this->upliner;?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="blockInLine bannersPage">
                            <div class="tabs tabsBanners tabsCab">
                                <ul>
                                    <li><a href="#banner1">125 x 125 <br><?=$this->getLanguageText('Banner');?></a></li>
                                    <li><a href="#banner2">250 x 250 <br><?=$this->getLanguageText('Banner');?></a></li>
                                    <li><a href="#banner3">468 x 60 <br><?=$this->getLanguageText('Banner');?></a></li>
                                    <li><a href="#banner4">728 x 90 <br><?=$this->getLanguageText('Banner');?></a></li>
                                </ul>
								
                                <div id="banner1">
                                    <div class="banner" style="width:125px;height: 125px;background: url('/assets/banners/b1<?=$this->lang?>.gif');"></div>
                                    <div class="wrapInput">
                                        <input type="text" id="linkBanner1" class="linkBanner" value="<a href='<?=$this->ref_link;?>'><img src='<?=PROTOCOL; ?>://<?=HOST; ?>/assets/banners/b1<?=$this->lang?>.gif'></a>"
                                            readonly>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button class="gradientBttn doItBttn copyLinkBoard" data-clipboard-target="#linkBanner1"><?=$this->getLanguageText('Click to Copy');?></button>
                                    </div>
                                </div>

                                <div id="banner2">
                                    <div class="banner" style="width:250px;height: 250px;background: url('/assets/banners/b2<?=$this->lang?>.gif');"></div>
                                    <div class="wrapInput">
                                        <input type="text" id="linkBanner2" class="linkBanner" value="<a href='<?=$this->ref_link;?>'><img src='<?=PROTOCOL; ?>://<?=HOST; ?>/assets/banners/b2<?=$this->lang?>.gif'></a>"
                                            readonly>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button class="gradientBttn doItBttn copyLinkBoard" data-clipboard-target="#linkBanner2"><?=$this->getLanguageText('Click to Copy');?></button>
                                    </div>
                                </div>
								
                                <div id="banner3">
                                    <div class="banner" style="width:468px;height: 60px;background: url('/assets/banners/b3<?=$this->lang?>.gif');"></div>
                                    <div class="wrapInput">
                                        <input type="text" id="linkBanner3" class="linkBanner" value="<a href='<?=$this->ref_link;?>'><img src='<?=PROTOCOL; ?>://<?=HOST; ?>/assets/banners/b3<?=$this->lang?>.gif'></a>"
                                            readonly>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button class="gradientBttn doItBttn copyLinkBoard" data-clipboard-target="#linkBanner3"><?=$this->getLanguageText('Click to Copy');?></button>
                                    </div>
                                </div>
								
                                <div id="banner4">
                                    <div class="banner" style="width:728px;height: 90px;background: url('/assets/banners/b4<?=$this->lang?>.gif');"></div>
                                    <div class="wrapInput">
                                        <input type="text" id="linkBanner4" class="linkBanner" value="<a href='<?=$this->ref_link;?>'><img src='<?=PROTOCOL; ?>://<?=HOST; ?>/assets/banners/b4<?=$this->lang?>.gif'></a>"
                                            readonly>
                                    </div>
                                    <div class="bttnGradientBlock">
                                        <button class="gradientBttn doItBttn copyLinkBoard" data-clipboard-target="#linkBanner4"><?=$this->getLanguageText('Click to Copy');?></button>
                                    </div>
                                </div>
								
                            </div>
                        </div>
                    </div>

		
	
            <!-- Page Footer-->
<?php require_once($this->getLayout('footer_cabinet')); ?>