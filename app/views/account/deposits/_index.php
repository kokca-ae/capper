<?php require_once($this->getLayout('header_cabinet')); ?>


<div class="contentMain">
                        <div class="depositsPage">
                            <div class="tabs tabsDeposits tabsCab">
                                <ul>
                                    <li><a href="#actual"><?=$this->getLanguageText('Current <br>deposits');?></a></li>
                                    <li><a href="#expired"><?=$this->getLanguageText('Expired <br>deposits');?></a></li>
                                </ul>
                                <div id="actual">
								
								
                                
                                
								<?php if ($deposits_active) : ?>
								<?$i=1;?>
                                <?php foreach ($deposits_active as $row) : ?>
								<?
								// -------------------------
								// таймер депа 
								// -------------------------
								$depTime = $this->timer($row['date_upd']);
								//print_r($depTime);
								// -------------------------
								// сколько % от депа вывел
								// -------------------------
								$depPer = $this->percentEarns($row['sum_earn'],$row['sum'],$row['plan_perc']);
								//---
								?>
								<!--<td><?=$arrStatus[$this->lang][$row['status']]?></td>-->
                                    <div class="deposit">
                                        <div class="table">
                                            <div class="tableCell">
                                                <div class="sumDeposit">
                                                    <span class="icon"><i class="fa fa-<?= strtolower($row['currs']) ?>"></i></span>
                                                    <span><?=$this->getLanguageText('Deposit amount:');?></span>
                                                    <span class="num"><?= $row['sum'];?> <?= $row['currs']; ?></span>
													<span class="icon-52 viewDEP" data-id="<?=$row['id']?>" 
																		  data-accrued="<?= $row['sum_earn']; ?> <i class='fa fa-<?= strtolower($row['currs']) ?>'></i>"
																		  data-charges="<?= sprintf($row['format'], $row['plan_perc'] / 100 * $row['sum']); ?> <i class='fa fa-<?= strtolower($row['currs']) ?>'></i>"
																		  data-amount="<?= $row['sum']; ?> <?= $row['currs']; ?>" 
																		  data-earns="<?= $row['plan_earns']; ?>" 
																		  data-name="<?= $row['plan_name']; ?>" 
																		  data-curr="<?= $row['currs']; ?>" 
																		  data-status="<?= $arrStatus[$this->lang][$row['status']]; ?>" 
																		  data-percent="<?if(!empty($row['plan_perc'])){ echo $row['plan_perc']." %"; }else{ echo "-- %"; }?>" 
																		  data-accrual="<?= $row['count_earn']; ?>" 
																		  data-date="<?= date("d.m.Y H:i", $row['date_add']); ?>" 
																		  data-dateupd="<?= date("d.m.Y H:i", $row['date_upd']); ?>" 
																		  data-datedel="<?= date("d.m.Y H:i", $row['date_del']); ?>" 
																		  data-peraccrual="<?=$depPer['percent']?> %" 
																		  data-target="#deposit"
													style="cursor: pointer; right: 13px;left: auto;top: 50%;"></span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <div class="lightCard dateOpen">
                                                    <span class="icon-21"></span>
                                                    <span><?=$this->getLanguageText('Opening date:');?></span>
                                                    <span class="date"><?= date("d.m.Y H:i", $row['date_add']); ?></span>
                                                </div>
                                                <div class="lightCard dateClose">
                                                    <span class="icon-21"></span>
                                                    <span><?=$this->getLanguageText('Closing date:');?></span>
                                                    <span class="date"><?= date("d.m.Y H:i", $row['date_del']); ?></span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <div class="lightCard termDeposit">
                                                    <span class=" icon-27"></span>
                                                    <span><?=$this->getLanguageText('Time of deposit:');?></span>
                                                    <span class="term"><?=floor($row['plan_earns'] / 24);?> <?=$this->getLanguageText('days');?></span>
                                                </div>
                                                <div class="lightCard termDeposit">
                                                    <span class=" icon-27"></span>
                                                    <span><?=$this->getLanguageText('Accruals after:');?></span>
                                                    <span class="term">
													<span class="tk_countdown_time" data-element="<?=$i;?>" data-days="<?=$depTime['days']?>"><?= $depTime['h']; ?>:<?= $depTime['i']; ?>:<?= $depTime['s']; ?></span>
													</span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <input type="text" class="dial" data-min="0" data-max="100" value="<?= $depPer['percent']; ?>">
                                            </div>
                                        </div>
                                    </div>
									<?$i++;?>
                                <?php endforeach; ?>
                                <?php else : ?>
								<div class="deposit">
                                <div class="table">
								<div class="tableCell" style="width: 100%;">
                                                <div class="sumDeposit">
                                                    <span class="icon-32"></span>
                                                    <span class="num" style="text-align: left !important;font-weight: 400;"><?=$this->getLanguageText('Sorry');?></span>
                                                    <span class="num" style="text-align: left;"><?=$this->getLanguageText('You have no deposits at the moment');?></span>
                                                </div>
                                </div>
								</div>
								</div>
								<?php endif; ?>
                                    
                                </div>
                                <div id="expired">
								
                                <?php if ($deposits_complete) : ?>
                                <?php foreach ($deposits_complete as $row) : ?>
                                    <div class="deposit">
                                        <div class="table">
                                            <div class="tableCell">
                                                <div class="sumDeposit">
                                                    <span class="icon"><i class="fa fa-<?= strtolower($row['currs']) ?>"></i></span>
                                                    <span><?=$this->getLanguageText('Deposit amount:');?>:</span>
                                                    <span class="num"><?= $row['sum'];?> <?= $row['currs']; ?></span>
													<span class="icon-52 viewDEP" data-id="<?=$row['id']?>" 
																		  data-accrued="<?= $row['sum_earn']; ?> <i class='fa fa-<?= strtolower($row['currs']) ?>'></i>"
																		  data-charges="<?= sprintf($row['format'], $row['plan_perc'] / 100 * $row['sum']); ?> <i class='fa fa-<?= strtolower($row['currs']) ?>'></i>"
																		  data-amount="<?= $row['sum']; ?> <?= $row['currs']; ?>" 
																		  data-earns="<?= $row['plan_earns']; ?>" 
																		  data-name="<?= $row['plan_name']; ?>" 
																		  data-curr="<?= $row['currs']; ?>" 
																		  data-status="<?= $arrStatus[$this->lang][$row['status']]; ?>" 
																		  data-percent="<?if(!empty($row['plan_perc'])){ echo $row['plan_perc']." %"; }else{ echo "-- %"; }?>" 
																		  data-accrual="<?= $row['count_earn']; ?>" 
																		  data-date="<?= date("d.m.Y H:i", $row['date_add']); ?>" 
																		  data-dateupd="<?= date("d.m.Y H:i", $row['date_upd']); ?>" 
																		  data-datedel="<?= date("d.m.Y H:i", $row['date_del']); ?>" 
																		  data-peraccrual="100 %" 
																		  data-target="#deposit"
													style="cursor: pointer; right: 13px;left: auto;top: 50%;"></span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <div class="lightCard dateOpen">
                                                    <span class="icon-21"></span>
                                                    <span><?=$this->getLanguageText('Opening date:');?></span>
                                                    <span class="date"><?= date("d.m.Y H:i", $row['date_add']); ?></span>
                                                </div>
                                                <div class="lightCard dateClose">
                                                    <span class="icon-21"></span>
                                                    <span><?=$this->getLanguageText('Closing date:');?></span>
                                                    <span class="date"><?= date("d.m.Y H:i", $row['date_del']); ?></span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <div class="lightCard termDeposit">
                                                    <span class=" icon-27"></span>
                                                    <span><?=$this->getLanguageText('Time of deposit:');?></span>
                                                    <span class="term"><?=floor($row['plan_earns'] / 24);?> <?=$this->getLanguageText('days');?></span>
                                                </div>
                                                <div class="lightCard termDeposit">
                                                    <span class=" icon-27"></span>
                                                    <span><?=$this->getLanguageText('Accruals after:');?></span>
                                                    <span class="term">00:00:00</span>
                                                </div>
                                            </div>
                                            <div class="tableCell">
                                                <input type="text" class="dial" data-min="0" data-max="100" value="100">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php else : ?>
								<div class="deposit">
                                <div class="table">
								<div class="tableCell" style="width: 100%;">
                                                <div class="sumDeposit">
                                                    <span class="icon-32"></span>
                                                    <span class="num" style="text-align: left !important;font-weight: 400;"><?=$this->getLanguageText('Sorry');?></span>
                                                    <span class="num" style="text-align: left;"><?=$this->getLanguageText('Do you not have completed deposits at the moment');?></span>
                                                </div>
                                </div>
								</div>
								</div>
								<?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
					
<script>
$(function() {
	
$('.viewDEP').on('click', function(e) {
var data = $(this).data();

for (var key in data){
  
    //console.log(key + ': ' + data[key]);
	$('#d_'+key).html(data[key]);
}


		$('#overlay').css('display', 'block');
		$('#deposit').addClass('open');
		$('#deposit').css('display', 'block');
		$('.modalsScroll').addClass('open');
});
	
});
</script>
					
					
					

		




<?php require_once($this->getLayout('footer_cabinet')); ?>