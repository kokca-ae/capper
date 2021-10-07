<?php require_once($this->getLayout('header_cabinet')); ?>

					<div class="contentMain">
                        <div class="payMovePage payInPage">
						
						
							<div class="item col6 col12-sd col6-md col12-xs" style="margin: 0 auto;margin-bottom: 20px;">
								<div class="content">
										
						<div class="resultSum">
                        <div class="wrapInput iconCurrency">
                        <span style="font-size: 35px;line-height: 2;color: #ffffff;font-weight: 700;"><?=$this->getLanguageText('Deposit Confirmation');?></span>
                        </div>
						<label><?= date("d.m.Y H:i", $oper['date_add']); ?></label>
                        </div>
										
                                </div>
							</div>
                            
                            <div class="resultSum">
                                <span><?=$this->getLanguageText('Amount of investment:');?></span>
                                <span class="num" id="amSet"><?=$oper['sum'];?> <i class="fa fa-<?= strtolower($oper['currs']) ?>"></i></span>
                            </div>
							
						
						<?php if ($paysystem['active'] == 1 && $paysystem['active_insert'] == 1 && $oper['status'] == 0) : ?>
						<?php require(ROOT . "/app/views/account/insert/_form.php"); ?>
						<?php endif; ?>
							
                        </div>
                    </div>
           

<?php require_once($this->getLayout('footer_cabinet')); ?>