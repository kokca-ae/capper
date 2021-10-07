<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">

						<div class="backgroundInfo blockInLine">
                            <div class="cfix margO">
                                <div class="item col6 col12-xss">
                                    <div class="chargeTime darkCard table">
                                        <div class="tableCell">
                                            <span class="icon-36"></span>
                                            <span class="txt"><?=$this->getLanguageText('Referrals count');?> / <?=$this->getLanguageText('Active referrals');?></span>
                                            <span class="val"><?=$ref_count?> / <?=$activeRef?></span>
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
							
<div class="item col4 col4-lg col4-md col4-xs">
<a href="/referals/1" class="bttnGradient bttnSearch" style="width: 100% !important;display: inline-block;line-height: 3;">1 <?=$this->getLanguageText('level');?></a>
</div>
<div class="item col4 col4-lg col4-md col4-xs">
<a href="/referals/2" class="bttnGradient bttnSearch" style="width: 100% !important;display: inline-block;line-height: 3;">2 <?=$this->getLanguageText('level');?></a>
</div>
<div class="item col4 col4-lg col4-md col4-xs">
<a href="/referals/3" class="bttnGradient bttnSearch" style="width: 100% !important;display: inline-block;line-height: 3;">3 <?=$this->getLanguageText('level');?></a>
</div>
							
		
                            </div>	
                        </div>
						
						<div class="investInfo blockInLine">
                            <div class="cfix margO">
							
							<div class="item col12 col12-lg col12-md col12-xs">
                                    <div class="allInvested lightCard">
                                        
							<div class="content" style="text-align:center;padding-bottom: 20px;">
							
									<div>
									<span style="font-size: 35px;line-height: 2;color: #ffffff;font-weight: 700;"><?=$this->getLanguageText('Referral commission');?></span>
									</div>
									<span style="font-size: 24px;line-height: 28px;color: #b2b3ef;text-align: center;letter-spacing: 0.025em;margin-top: 77px;"><?=$ref_commission?> <i class="fa fa-usd"></i></span>
							</div>
									
									<table width="300" celspacing="0" cellpadding="0" border="0" class="depTable table full">
									<tbody>
									<tr class="tbody-head">
									<td class="inheader" style="text-align:center;color:#fff;"><?=$this->getLanguageText('Registered');?></td>
									<td class="inheader param" style="color:#fff;">
									<div class="iconLeft">
										<span class="text"><?=$this->getLanguageText('Login');?> / Email</span>
									</div>
									</td>
									<td class="inheader" style="text-align:center;color:#fff;"><?=$this->getLanguageText('Your income');?></td>
									</tr>
									<?php if ($referals) : ?>
									<?php foreach ($referals as $row) : ?>
								    <tr role="row" class="tRow">
									<td class="tCell middle param">
										<div class="iconLeft">
										<span class="text"><?= date("d.m.Y H:i", $row['date_reg']); ?></span>
										</div>
									</td>
									<td class="tCell middle param">
										<div class="iconLeft">
										<span class="text"><?= $row["user"]; ?> / <?= $row["email"]; ?></span>
										</div>
									</td>
									<td class="tCell middle param">
										<div class="iconLeft">
										<span class="text">+<?= intval($row["to_referer".$lvl]*100)/100?> <i class="fa fa-usd"></i></span>
										</div>
									</td>
									</tr>
									<?php endforeach; ?>
									<?php else : ?>
									<tr role="row" class="tRow">
									<td colspan="3" class="tCell middle param" style="text-align: center;">
									<div class="iconLeft">
									<span class="text"><?=$this->getLanguageText('You have no referrals');?> <?= $lvl; ?> <?=$this->getLanguageText('level');?></span>
									</div>
									</td>
									</tr>
									<?php endif; ?>                  
                                    </tbody>
									</table>
										
                                    </div>
                            </div>
                                
							
								
                            </div>
                        </div>

                       
                    </div>

		
		
		
		
	
            <!-- Page Footer-->
<?php require_once($this->getLayout('footer_cabinet')); ?>