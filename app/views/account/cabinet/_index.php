<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">
                        <div class="backgroundInfo blockInLine">
                            <div class="cfix margO">
                                <div class="item col6 col12-xss">
                                    <div class="chargeTime darkCard table">
                                        <div class="tableCell">
                                            <span class="icon-36"></span>
                                            <span class="txt"><?=$this->getLanguageText('Referrals count');?></span>
                                            <span class="val"><?=$ref_count?></span>
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
                        <div class="investInfo blockInLine">
                            <div class="cfix margO">
                                <div class="item col4 col12-lg col4-md col12-xs">
                                    <div class="allInvested lightCard">
                                        <span class="txt"><?=$this->getLanguageText('Total <br>invested');?></span>
                                        <span class="val">
										<?= intval($this->user->balance['insert_sum']*100)/100 ?> <i class="fa fa-usd"></i>
										</span>
                                    </div>
                                </div>
                                <div class="item col4 col12-lg col4-md col12-xs">
                                    <div class="allPayOut lightCard">
                                        <span class="txt"><?=$this->getLanguageText('Total <br>paid');?></span>
                                        <span class="val">
										<?= intval($this->user->balance['payment_sum']*100)/100 ?> <i class="fa fa-usd"></i>
										</span>
                                    </div>
                                </div>
                                <div class="item col4 col12-lg col4-md col12-xs">
                                    <div class="partnersEarned lightCard">
                                        <span class="txt"><?=$this->getLanguageText('Referral <br>commission:');?></span>
                                        <span class="val"><?=intval($this->ref_commission*100)/100?> <i class="fa fa-usd"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					

<?
require_once($this->getLayout('news')); // подгрузка новостей
?>


<?php require_once($this->getLayout('footer_cabinet')); ?>