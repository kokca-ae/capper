<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">
                        <div class="pursesPage">
						
		<form action="/wallets" method="POST">
        <input type="hidden" name="token" value="<?= $this->getToken('set_wallet_form'); ?>">
        <input type="hidden" name="form" value="set_wallet_form">
						
                            <div class="bigCard" style="background-image:url(img/back-purses-card.png)">
                                <div class="table">
                                    <div class="tableCell">


		
<?$arrayPurse = array(1=>'41',2=>'43',3=>'42');?>
<?$i=1;?>
<?php foreach ($this->ps as $row) : ?>
<?/*if($row['name'] == "py"){ $s="display:none;";}else $s ="";?>
<?if($row['name'] == "pyusd"){ $row['fullname']="Payeer";}else $row['fullname'] = $row['fullname'];*/?>

                                        <div class="purse" style="">
                                            <div class="inputBlock">
                                                <label><?=$row['fullname']?>:</label>
                                                <div class="wrapInput">
                                                    <input type="text" name="purse_<?= $row['name']; ?>" value="<?php if ($this->user->wallets[$row['name']]) echo $this->user->wallets[$row['name']]; ?>" class="lightInput">
													<input type="hidden" name="ps_<?= $row['name']; ?>" value="<?= $row['name']; ?>">
                                                    <span class="iconPurse"><i class="fa fa-<?=strtolower($row['currs']);?>"></i></span>
                                                </div>
                                            </div>
                                        </div>
<?$i++;?>
<?php endforeach; ?>
										
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="bttnGradientBlock">
                                <button class="gradientBttn doItBttn"><?=$this->getLanguageText('Save'); ?></button>
                            </div>
							
		</form>
							
                        </div>
                    </div>

            



<?php require_once($this->getLayout('footer_cabinet')); ?>