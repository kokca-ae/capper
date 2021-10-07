<?php require_once($this->getLayout('header_cabinet')); ?>

					<div class="contentMain">
                        <div class="operationsPage">
                            <div class="bigCard filterBlock">
                                <form method="post">
									<input type="hidden" name="token" value="<?= $this->getToken('search_history_form'); ?>">
									<input type="hidden" name="form" value="search_history_form">
								<div class="cfix">
									
                                    <div class="item">
                                        <div class="inputBlock">
                                            <label><?=$this->getLanguageText('Type of operation');?>:</label>
                                            <div class="wrapInput">
                                                <select class="selectricBl" name="type">
                                                    <option value="0"><?=$arrType[$this->lang][0]?></option>
                                                    <option value="1"><?=$arrType[$this->lang][1]?></option>
                                                    <option value="2"><?=$arrType[$this->lang][2]?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="inputBlock">
                                            <label><?=$this->getLanguageText('Status');?>:</label>
                                            <div class="wrapInput">
                                                <select class="selectricBl" name="status">
                                                    <option value="3"><?=$this->getLanguageText('All');?></option>
                                                    <option value="0"><?=$arrStatus[$this->lang][0]?></option>
													<option value="1"><?=$arrStatus[$this->lang][1]?></option>
                                                    <option value="2"><?=$arrStatus[$this->lang][2]?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <button class="bttnGradient bttnSearch"><?=$this->getLanguageText('Search');?></button>
                                    </div>
                                    <div class="item">
                                        <div class="inputBlock">
                                            <label><?=$this->getLanguageText('Volume');?>:</label>
                                            <div class="wrapInput">
                                                <select class="selectricBl" name="volume">
                                                    <option value="5">5</option>
                                                    <option value="30">30</option>
                                                    <option value="50">50</option>
													<option value="999"><?=$this->getLanguageText('All');?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
									
                                </div>
								</form>
                            </div>
                            <div class="bigCard operationsCard">
                                <div class="table standartTable">
								
								<?php if ($data_history) : ?>
                                    <div class="tHead">
                                        <div class="tableCell">
                                            <span>ID</span>
                                        </div>
                                        <div class="tableCell">
                                            <span><?=$this->getLanguageText('Date');?></span>
                                        </div>
                                        <div class="tableCell">
                                            <span><?=$this->getLanguageText('Amount');?></span>
                                        </div>
                                        <div class="tableCell">
                                            <span><?=$this->getLanguageText('Operation');?></span>
                                        </div>
                                        <!--<div class="tableCell">
                                            <span>Счет</span>
                                        </div>-->
                                        <div class="tableCell">
                                            <span><?=$this->getLanguageText('Status');?></span>
                                        </div>
                                        <div class="tableCell">
                                            <span><?=$this->getLanguageText('Comment');?></span>
                                        </div>
                                    </div>
									<?php else : ?>
									<div class="tHead">
                                        <div class="tableCell" style="text-align:center;padding-left: 10%;">
                                            <span><?=$this->getLanguageText('Sorry');?></span>
                                        </div>
										<div class="tableCell">
                                            <span></span>
                                        </div>
									</div>
									<?php endif; ?>
									
                                    <div class="tBody">
									
									<?php if ($data_history) : ?>
									<?php foreach ($data_history as $row) : ?>
                                        <div class="tRow">
                                            <div class="tableCell">
                                                <span class="mobTitle">ID</span>
                                                <span class="idOp"><?=$row['id']?></span>
                                            </div>
                                            <div class="tableCell">
                                                <span class="mobTitle"><?=$this->getLanguageText('Opening date:');?></span>
                                                <span class="date"><?= date("d.m.Y H:i", $row['date_add']); ?></span>
                                            </div>
                                            <div class="tableCell">
                                                <span class="mobTitle"><?=$this->getLanguageText('Amount');?></span>
                                                <span class="sum">
												<?php if ($type_info == 1) : // начисления?>
												<?php if ($row['type'] == 3) : ?>
												-
												<?php else : ?>
												+
												<?php endif ?>
												<?php endif ?>
												<?=$row['sum']?> <?=$row['currs']?>
												
												
												</span>
                                            </div>
                                            <div class="tableCell">
                                                <span class="mobTitle"><?=$this->getLanguageText('Operation');?></span>
                                                <span class="nameOp"><?=$arrType[$this->lang][$type_info]?></span>
                                            </div>
                                            <!--<div class="tableCell">
                                                <span class="mobTitle">Счет</span>
                                                <span class="balance">2500.00 USD</span>
                                            </div>-->
                                            <div class="tableCell">
                                                <span class="mobTitle"><?=$this->getLanguageText('Status');?></span>
                                                <span class="status <?=$classButInfo[$row['status']]?>"><?=$arrStatus[$this->lang][$row['status']]?></span>
                                            </div>
                                            <div class="tableCell">
                                                <span class="mobTitle"><?=$this->getLanguageText('Comment');?></span>
                                                <div class="commentBlock">
                                                    <span class="icon-49"></span>
                                                    <div class="comment">
                                                        <span class="title"><?=$this->getLanguageText('Comment');?>:</span>
                                                        <p>
									<?php if ($type_info == 1) : // начисления?>					
										<?php if ($row['type'] == 1) : ?>
										<?=$arrComment[$this->lang][$row['type']]?> <?= $row['info']; ?>
										<?php elseif ($row['type'] == 2) : ?>
										<?=$arrComment[$this->lang][$row['type']]?> № <?= $row['info']; ?>
										<?php elseif ($row['type'] == 3) : ?>
										<?=$arrComment[$this->lang][$row['type']]?> <?=$this->getLanguageText('Referral');?> <?= $row['info']; ?>
										<?php elseif ($row['type'] == 4) : ?>
										<?=$arrComment[$this->lang][$row['type']]?> <?=$this->getLanguageText('Referral');?> <?= $row['info']; ?>
										<?php endif ?>
									<?php elseif ($type_info == 0) : // пополнение?>
										<?=$arrType[$this->lang][$type_info]?> +<?= $row['sum'];?> <i class="fa fa-<?= strtolower($row['currs']) ?>"></i>
									<?php else : // выплата?>
										<?=$arrType[$this->lang][$type_info]?> -<?= $row['sum'];?> <i class="fa fa-<?= strtolower($row['currs']) ?>"></i>
									<?php endif ?>
														
                                                            
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									<?php endforeach; ?>
									<?php else : ?>
									<div class="tRow">
                                            <div class="tableCell" style="text-align:center;padding-left: 10%;">
											<span class="nameOp">
											<?=$this->getLanguageText("You don't currently have a story of this type");?>
											</span>
                                            </div>
                                    </div>
									<?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



<?php require_once($this->getLayout('footer_cabinet')); ?>