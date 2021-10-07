<?php require_once($this->getLayout('header_other')); ?>

<div class="contentPage ratesPage">
            <div class="ratesList showEl hidden visible animated fadeInDown">
            <?php if ($news_take) : ?>
            <?php foreach ($news_take as $row) : ?>
                <div class="rateItem">
                    <div class="container">
                        <div class="textBlock">
                            <div class="textWrapp">
                                <!--<div class="videoBlock rightVideo">
                                    <span class="playIcon"></span>
                                </div>-->
                                <h2 class="firstCap"><?=$row['title'];?></h2>
                                <div class="ratesData">
                                    <div class="item">
                                        <span class="icon" style="background-image: url(/assets/img/calend-m.png)"></span>
                                        <span class="title"><?=$this->getLanguageText('Date');?>:</span>
                                        <span class="cont"><?= date("d.m.Y H:i", $row['date_add']); ?></span>
                                    </div>
                                    <!--<div class="item">
                                        <span class="icon" style="background-image: url(/assets/img/diagr-m.png)"></span>
                                        <span class="title">Доходность:</span>
                                        <span class="cont">14.7% в месяц</span>
                                    </div>-->
                                </div>
                                
                            </div>
                            <div class="textWrapp">
                                <p><?=$row['text'];?></p>
                            </div>
                            <!--<div class="textWrapp progressBlock">
                                <div class="left">
                                    <span class="secCap">Давно выяснено, что при оценке дизайна читаемый текст мешает сосредоточиться.</span>
                                    <div class="progressBlocks">
                                        <div class="progressItem">
                                            <span>Текст диаграммы<span class="data">89%</span></span>
                                            <div class="progressWrapp">
                                                <div class="progressIn color1" style="width: 89%;"></div>
                                            </div>
                                        </div>
                                        <div class="progressItem">
                                            <span>Текст диаграммы<span class="data">89%</span></span>
                                            <div class="progressWrapp">
                                                <div class="progressIn color2" style="width: 89%;"></div>
                                            </div>
                                        </div>
                                        <div class="progressItem">
                                            <span>Текст диаграммы<span class="data">89%</span></span>
                                            <div class="progressWrapp">
                                                <div class="progressIn color3" style="width: 89%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right">
                                    <p>Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах:</p>
                                    <ul>
                                        <li>многие программы электронной вёрстки </li>
                                        <li>редакторы HTML используют Lorem Ipsum </li>
                                        <li>в качестве текста по умолчанию</li>
                                        <li>так что поиск по ключевым словам "lorem ipsum" </li>
                                        <li>сразу показывает как много веб-страниц</li>
                                    </ul>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
				<?php endforeach ?>
				<?php else : ?>
				<div class="rateItem">
                    <div class="container">
                        <div class="textBlock">
						
							<div class="textWrapp">
                                <h2 class="firstCap"><?=$this->getLanguageText('Sorry');?></h2>
                            </div>
							
                            <div class="textWrapp">
                                <p><?=$this->getLanguageText('No news at the moment');?></p>
                            </div>
                        </div>
                    </div>
                </div>
				<?php endif; ?>
				
<?php if (isset($navigation['navigation'])) : ?>
    <div class="text-center"><?php echo $navigation['navigation']; ?></div>
<?php endif; ?>
                
            </div>
        </div>

					
					



<?php require_once($this->getLayout('footer_home')); ?>