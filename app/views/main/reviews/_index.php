<?php require_once($this->getLayout('header_other')); ?>

<div class="contentPage reviewsPage">
            <div class="reviewsBlock showEl">
                <div class="container">
                    <div class="tabs">
                        <div class="tabHead">
                            <ul>
                                <li><a href="#rev" class="btn"><?=$this->getLanguageText('Text'); ?></a></li>
                                <li><a href="#video" class="btn"><?=$this->getLanguageText('Video'); ?></a></li>
                            </ul>
                        </div>
                        <div class="tabCont">
						
							<!-- text -->
                            <div id="rev" class="tabItem">
                                <div class="revWall">
								
								<?php if ($text_reviews) : ?>
								<?php foreach ($text_reviews as $row) : ?>
                                    <div class="revItem">
                                        <div class="revHead">
                                            <span class="icon"></span>
                                            <span class="name"><?=$row["user"]?></span>
                                            <span class="date"><?=date("d.m.Y H:i:s", $row["date_add"])?></span>
                                        </div>
                                        <div class="revCont textBlock">
                                            <p><?=$row["text"]?></p>
                                        </div>
                                    </div>
								<?php endforeach ?>
								<?php else: ?>
                                    <div class="revItem">
                                        <div class="revHead">
                                            <span class="icon"></span>
                                            <span class="date"><?=$this->getLanguageText('Sorry'); ?></span>
											<span class="name"><?=$this->getLanguageText('No feedback yet'); ?></span>
                                        </div>
                                        <div class="revCont textBlock"></div>
                                    </div>
								<?php endif ?>

									
									
                                </div>
                                <!--<a href="#" class="btn btnTran">Показать ещё</a>-->
                            </div>
							<!-- /text -->
							
							<!-- video -->
                            <div id="video" class="tabItem">
                                <div class="revWall">
								
								<?php if ($video_reviews) : ?>
								<?php foreach ($video_reviews as $row) : ?>
                                    <div class="revItem">
                                        <div class="revHead">
                                            <span class="icon"></span>
                                            <span class="name"><?=$row["user"]?></span>
                                            <span class="date"><?=date("d.m.Y H:i:s", $row["date_add"])?></span>
                                        </div>
                                        <div class="revCont textBlock">
                                            <!--<div class="videoBlock">
                                                <span class="playIcon"></span>
                                            </div>-->
											<iframe width="495" height="300" src="<?=$row["text"]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
								<?php endforeach ?>
								<?php else: ?>
                                    <div class="revItem">
                                        <div class="revHead">
                                            <span class="icon"></span>
                                            <span class="date"><?=$this->getLanguageText('Sorry'); ?></span>
											<span class="name"><?=$this->getLanguageText('No feedback yet'); ?></span>
                                        </div>
                                    </div>
									<div class="revCont textBlock"></div>
								<?php endif ?>
                                    
                                </div>
                                <!--<a href="#" class="btn btnTran">Показать ещё</a>-->
                            </div>
							<!-- /video -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php require_once($this->getLayout('footer_home')); ?>