<?php require_once($this->getLayout('header_home')); ?>


<section class="title-block">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-title"><?=$_title[$this->lang];?></h1>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="page-buttons-block">
                    <div class="row">
                        
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" style="margin: 0 auto;float: none;">
<a class="btn-title-block blue" href="/login"><?=$this->getLanguageText('Sign In'); ?></a>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- -->
<section id="referral">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="title-h2"><?=$this->getLanguageText('Referral program – the best program'); ?></h2>
                <div class="referral-description">
                    <p><?=$this->getLanguageText('The referral program is an opportunity to get income without investment. Tell your friends about the advantages of the platform and register new users with a unique referral link. We are always glad to have active cooperation, and therefore we will pay bonuses for life for every deposit of investors you have invited. In your personal account you will find a referral link as well as promotional materials. Start earning now!'); ?></p>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="description-block">
                    <div class=" table-ref">
                        <div class="top">
                            <img src="/assets/img/referral/table-sport.png" alt="" class="">
                        </div>
                        
                        <div class="other partners">
                            
                            <span class="middle"><?=$this->getLanguageText('from level 1'); ?></span>
                            
                        </div>
<div class="other all">
                            <span class="big">+<?=$refPerc[1];?>%</span>
                            
                            
                        </div>
                        <div class="top">
                            <img src="/assets/img/referral/table-tv.png" alt="" class="">
                        </div>
                        <div class="other partners">
                            
                            <span class="middle"><?=$this->getLanguageText('from level 2'); ?></span>
                            
                        </div>
<div class="other all">
                            <span class="big">+<?=$refPerc[2];?>%</span>
                            
                            
                        </div>
                        
                        <div class="top">
                            <img src="/assets/img/referral/table-game.png" alt="" class="">
                        </div>

<div class="other partners">
                            
                            <span class="middle"><?=$this->getLanguageText('from level 3'); ?></span>
                            
                        </div>
                        <div class="other all">
                            <span class="big">+<?=$refPerc[3];?>%</span>
                            
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>


<?php require_once($this->getLayout('footer_home')); ?>