<?php require_once($this->getLayout('header_home')); ?>

<?php if ($this->panel) : ?>
<!-- ADMIN \-->
<div class="color-switch">
	<p style="padding: 13px;margin-bottom:  0px;padding-bottom: 0px;">Admin panel</p>
    <div class="color_box" style="padding: 10px;">
        <a class="btn btn-primary mx-0 js-tilt" href="/panel" role="button" data-tilt-perspective="300" data-tilt-speed="700" data-tilt-max="24" style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);"><span>go Panel <i class="fa fa-gear fa-spin"></i></span></a>
    </div>
</div> 
<!-- ADMIN /-->
<?php endif; ?>

<style>
.color-switch {
    position: fixed;
    top: 156px;
    z-index: 999;
    background: #fff;
    border-radius: 0px 20px 20px 0px;
}
</style>



<div class="contentPage">
            <div class="aboutMain" style="background-image:url(/assets/img/back-aboutMainGrey.png)">
                <div class="container">
                    <div class="list">
                        <div class="cfix">
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain1.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('Accruals every hour');?></span>
                                        <span class="txt"><?=$this->getLanguageText('Get dividends at least every hour.');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain2.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('Guarantees and security');?></span>
                                        <span class="txt"><?=$this->getLanguageText('All Investments are protected by an official contract, the risks are less than 1%.');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain3.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('Innovative tools');?></span>
                                        <span class="txt"><?=$this->getLanguageText('A new investment instrument that has proven its effectiveness abroad. Insider trading, match fixing, and quality predictions.');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="table">
                                    <div class="in">
                                        <span class="icon" style="background-image:url(/assets/img/icon-aboutMain4.png)"></span>
                                        <span class="tit"><?=$this->getLanguageText('High Yield');?></span>
                                        <span class="txt"><?=$this->getLanguageText('The average rate is 2 times higher than in private funds.');?></span>
                                        <span class="txt note"><?=$this->getLanguageText('Maximum yield up to 450% per month!');?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="textBl ">
                        <b><?=$this->getLanguageText('The professionalism of the team and the accumulated experience have allowed us to create a technological and reliable tool for investors, providing a stable income and guaranteeing the declared amount of dividends.');?></b>
                        <p><?=$this->getLanguageText('In March 2019, we launched our first investment product, which quickly showed financial efficiency, and opened a Fund for new partners.');?></p>
						<span class="tit"><?=$this->getLanguageText('Affliate programm');?> <?=$refPerc[1]?>-<?=$refPerc[2]?>-<?=$refPerc[3]?>%</span>
						<span class="tit"><?=$this->getLanguageText('Join our team and win with us!');?></span>
                        
                        <div class="btnLIne">
                            <span style="cursor:pointer;" data-modal="logReg" data-tab='#reg' class="btn btnFull"><?=$this->getLanguageText('Join now');?></span>
                        </div>
                    </div>
                </div>
            </div>

			
            <div class="returnCash backBlue">
                <div class="backBlock"></div>
                <div class="container ">
				
<div class="row">
<?$i=1;?>
<?php foreach ($plans as $row) : ?>
<?$vipstyle = (intval($i)>=4) ? "vipplan" : "";?>
<div class="col-sm-6 col-md-6 col-lg-3 blockLeft" style="padding-bottom: 25px;">
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft blockCard" style="">
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="planTitle <?=$vipstyle?>" style="text-align:center;"><div class="<?=$vipstyle?>"><?= $row['name']; ?></div><span class="<?=$vipstyle?>"><?= $row['perc']; ?>%</span></div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Min Amount'); ?></div>
</div>
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;">
<?= sprintf("%.2f", $row['min_sum']); ?> 
<span class=""><i class="fa fa-usd"></i></span>
</div>
</div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Max Amount'); ?></div>
</div>
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;">
<?= sprintf("%.2f", $row['max_sum']); ?>
<span class=""><i class="fa fa-usd"></i></span>
</div>
</div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Net income'); ?>:</div>
</div>
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?= $row['perc']-100; ?>%</div>
</div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('for'); ?> <?=$row['earns'];?> <?=$this->getLanguageText('hours'); ?></div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Accrual every hour'); ?></div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding: 0; padding-bottom: 10px;">
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Deposit'); ?>:</div>
</div>
<div class="col-sm-12 col-md-6 col-lg-6 blockLeft">
<div class="txtCalcNew" style="text-align:center;"><?=$this->getLanguageText('Included'); ?></div>
</div>
</div>
<!-- -->
<div class="col-sm-12 col-md-12 col-lg-12 blockLeft" style="padding-bottom: 10px;">
<div class="txtCalcNew" style="text-align:center;"><?= round($row['perc']/$row['earns'],1); ?>% <?=$this->getLanguageText('per hour'); ?></div>
</div>

</div>
</div>
<?$i++?>
<?php endforeach ?>
</div>
				
                    <div class="titBlock">
                        <span class="tit whiteTxt"><?=$this->getLanguageText('calculate arrive');?></span>
                        <span class="pre"><?=$this->getLanguageText('Join our team and win with us!');?></span>

                    </div>
                </div>
            </div>
			
			<!-- ion -->
<?
$path = ROOT . '/app/views/main/home/ion_calculator.php';
        if (file_exists($path)) {
            require($path);
        }
?>
			<!-- -->
			
            <div class="aboutCompany" style="background-image:url(/assets/img/back-aboutCompanyGrey.png)">
                <div class="container">
                    <div class="cfix showEl">
                        <div class="item">
                            <div class="titBlock">
                                <span class="tit blueTxt"><?=$this->getLanguageText('About us');?></span>
                            </div>
                            <div class="content blueTxt">
                                <p class="txtBlock">
                                    <b><?=$this->getLanguageText('It has long been found that the rates you can earn, experienced players consistently make a profit on the rates.');?></b>
                                </p>
                                <p class="txtBlock">
                                    <?=$this->getLanguageText('Our team of experts is engaged in bets 5-10 years, we have professional fork, forecasters, insiders, and also we are engaged in the organization of contractual matches.');?>
                                </p>
                                <p class="txtBlock">
                                    <?=$this->getLanguageText('In each of the areas of our work experienced professionals allow us to increase our capital, and for this we have created this company that would ordinary people could also earn on this, we have a large flow of information, we organize insider and contractual games, regestriruem accounts in bookmakers, fighting with limits on the offices, we work you earn, it s briefly about us.');?>
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="licensyBlock">
                                <div class="nameBlock blueTxt">
                                    <span class="name">Capper Club LTD</span>
                                    <p class="address">
                                        41 Wigmore Street, Marylebone<br> London, W1U 1PR
                                    </p>
                                </div>
                                <div class="licensy">
                                    <a href="https://beta.companieshouse.gov.uk/company/11768290" target="_blank">
									<div class="licensyImage" style="background-image: url(/assets/img/licensy.jpg)"></div>
                                    <span class="numLicensy">Company № <?=NCOMPANY?></span>
                                    <button class="checkLicensy btn btnFull"><?=$this->getLanguageText('Check registration');?></button>
									</a>
                                </div>

                                <div id='globus'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="successSteps showEl" style="background-image:url(/assets/img/back-steps.png)">
                <div class="container">
                    <div class="content">
                        <div class="stepsBlock">
                            <div class="circleStep">
                                <div class="in">
                                    <span class="tit"><?=$this->getLanguageText('6 steps to success!');?></span>
                                    <p class="txt">
                                        <?=$this->getLanguageText('Win and earn with us!');?>
                                    </p>
                                </div>
                            </div>
                            <div class="steps cfix">
                                <div class="item">
                                    <div class="step">
                                        <div class="num"><span>1</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Registration');?></span>
                                        <p class="txt">
                                            <?=$this->getLanguageText('Simple and convenient registration.');?>
                                        </p>
                                    </div>
                                    <div class="step">
                                        <div class="num"><span>2</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Personal data in the office');?></span>
                                        <p class="txt">
                                            <?=$this->getLanguageText('Comfort personal account');?>
                                        </p>
                                    </div>
                                    <div class="step">
                                        <div class="num"><span>3</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Investing in your account');?></span>
                                        <p class="txt">
                                            <?=$this->getLanguageText('Quick and profitable investments from the comfort of home.');?>
                                        </p>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="step">
                                        <div class="num"><span>4</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Working out of deposits');?></span>
                                        <p class="txt">
                                           <?=$this->getLanguageText('Your deposits are processed according to the tariff plan.');?>
                                        </p>
                                    </div>
                                    <div class="step">
                                        <div class="num"><span>5</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Gain profit');?></span>
                                        <p class="txt">
                                            <?=$this->getLanguageText('You will make a profit every hour while the Deposit is working.');?>
                                        </p>
                                    </div>
                                    <div class="step">
                                        <div class="num"><span>6</span></div>
                                        <span class="tit"><?=$this->getLanguageText('Withdrawal of funds');?></span>
                                        <p class="txt">
                                            <?=$this->getLanguageText('Instant withdrawals 24/7');?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payInOut grayBlPixel showEl">
                <div class="container">
                    <div class="cfix margO">
                        <div class="item col6">
                            <div class="titBlock blueTxt">
                                <span class="tit"><?=$this->getLanguageText('Last');?> <br><?=$this->getLanguageText('Deposits');?></span>
                            </div>
                            <div class="content">
                                <div class="cfix margO">
<?php if ($last_inserts) : ?>
<?php foreach ($last_inserts as $row) : ?>
<div class="item col4">
<div class="card">
<img src="/assets/img/svg/paytable/<?= $row['payment_system'] ?>.svg" alt="<?= $row['currs'] ?>" class="icon" style="width: 60px;opacity: 0.25;">
<span class="name"><?= $row['user'] ?></span>
<span class="sum">+<?=$this->HomeSumFormat($row['sum'],substr($row['format'], 2, 1));?> <span class="cur"><i class="fa fa-<?=strtolower($row['currs']);?>"></i></span> </span>
</div>
</div>
<?php endforeach ?>
<?php else: ?>
<div class="item col12">
<div class="card" style="padding: 15px;text-align: center;">                                       
<span class="name"><?=$this->getLanguageText('At the moment there are no deposits'); ?></span>
</div>
</div>
<?php endif ?>
									
                                </div>
                            </div>
                        </div>
                        <div class="item col6">
                            <div class="titBlock blueTxt">
                                <span class="tit"><?=$this->getLanguageText('Last');?> <br><?=$this->getLanguageText('Withdrawals');?></span>
                            </div>
                            <div class="content">
                                <div class="cfix margO">
								
<?php if ($last_payments) : ?>
<?php foreach ($last_payments as $row) : ?>
<div class="item col4">
<div class="card">
<img src="/assets/img/svg/paytable/<?= $row['payment_system'] ?>.svg" alt="<?= $row['currs'] ?>" class="icon" style="width: 60px;opacity: 0.25;">
<span class="name"><?= $row['user'] ?></span>
<span class="sum">-<?=$this->HomeSumFormat($row['sum'],substr($row['format'], 2, 1));?> <span class="cur"><i class="fa fa-<?=strtolower($row['currs']);?>"></i></span> </span>
</div>
</div>
<?php endforeach ?>
<?php else: ?>
<div class="item col12">
<div class="card" style="padding: 15px;text-align: center;">                                       
<span class="name"><?=$this->getLanguageText('At the moment there are no withdrawals'); ?></span>
</div>
</div>
<?php endif ?>
									
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="payTake">
                        <div class="tit"><?=$this->getLanguageText('We accept'); ?>:</div>
                        <div class="cardPay" style="background-image:url(/assets/img/pay-card-white.png)"></div>
                    </div>-->

<!-- -->
<div class="aboutMain" style="/* background-image: url(/assets/img/back-aboutCompanyGrey.png); */z-index: 999;padding-bottom: 6em; padding-top: 4em;">
                <div class="container">
				
				<div class="col-md-10 col10" style="margin: 0 auto;">
                
                    <div class="IonCalc showEl hidden visible animated fadeInDown full-visible">

                    <div class=" col12 col-md-12">
                            <div class="titBlock blueTxt">
                                <span class="tit"><?=$this->getLanguageText('We accept'); ?>:</span>
                            </div>
                    

<div class="containerBlock" style="">
    <div class="row" style="margin: 0px;">
    <?php foreach ($this->ps_m as $row) :?>
    <img src="/assets/img/accept/<?= $row['name']; ?>.png" class="imgfluid">
    <?php endforeach; ?>
</div>
	
                        </div>
                    </div>
                </div>
            </div>



    			<!-- -->
			
            
            
            
            
        </div>
<!-- -->
                </div>
            </div>
            <div class="reviewsMain showEl" style="background-image:url(/assets/img/back-reviewsMain.png)">
                <div class="container">
                    <div class="titBlock blueTxt">
                        <span class="tit"><?=$this->getLanguageText('Project feedback');?></span>
                        <span class="pre"><?=$this->getLanguageText('Grateful investors have to say about us!');?></span>
                    </div>
                    <div class="content">
                        <div class="tabs">
                            <div class="tabHead">
                                <ul>
                                    <li><a href="#rev" class="btn"><?=$this->getLanguageText('Text'); ?></a></li>
                                    <li><a href="#video" class="btn"><?=$this->getLanguageText('Video'); ?></a></li>
                                </ul>
                            </div>
                            <div class="tabCont">
							
							
                                <div id="rev" class="tabItem">
                                    <div class="carouselRev owl-carousel">
								<?php if ($text_reviews) : ?>
								<?php foreach ($text_reviews as $row) : ?>
                                        <div class="item">
                                            <div class="review">
                                                <div class="photo" style="background-image:url(/assets/img/rev-home.png)"></div>
                                                <span class="name"><?=$row["user"]?></span>
                                                <span class="date"><?=date("d.m.Y H:i", $row["date_add"])?></span>
                                                <p class="txtRev">
                                                    <?=$row["text"]?>
                                                </p>
                                            </div>
                                        </div>
								<?php endforeach ?>
								<?php else: ?>
										<div class="item">
                                            <div class="review">
                                                <div class="photo" style="background-image:url(/assets/img/rev-home.png)"></div>
                                                <span class="name"><?=$this->getLanguageText('Sorry'); ?></span>
                                                <p class="txtRev">
                                                    <?=$this->getLanguageText('No feedback yet'); ?>
                                                </p>
                                            </div>
                                        </div>
								<?php endif ?>
                                    </div>
                                </div>
								
								
                                <div id="video" class="tabItem">
                                    <div class="carouselRev owl-carousel">
								<?php if ($video_reviews) : ?>
								<?php foreach ($video_reviews as $row) : ?>
                                        <div class="item">
                                            <div class="review textBlock">
                                                <div class="photo" style="background-image:url(/assets/img/rev-home.png)"></div>
                                                <span class="name"><?=$row["user"]?></span>
                                                <span class="date"><?=date("d.m.Y H:i", $row["date_add"])?></span>
                                                <div class="videoBlock">
                                                    <iframe src="<?=$row["text"]?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
								<?php endforeach ?>
								<?php else: ?>
                                        <div class="item">
                                            <div class="review">
                                                <div class="photo" style="background-image:url(/assets/img/rev-home.png)"></div>
                                                <span class="name"><?=$this->getLanguageText('Sorry'); ?></span>
                                                <p class="txtRev">
                                                    <?=$this->getLanguageText('No feedback yet'); ?>
                                                </p>
                                            </div>
                                        </div>
								<?php endif ?>
										
                                    </div>
                                </div>
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php require_once($this->getLayout('footer_home')); ?>