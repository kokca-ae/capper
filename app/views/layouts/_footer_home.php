
<footer class="siteFooter">
            <div class="container">
                <div class="cfix">
                    <div class="leftFooter">
                        <p class="tradeMark"><?=NAME?><span class="icon-16"></span> </p>
                        <p class="address">
                            
							41 Wigmore Street, Marylebone<br> London, W1U 1PR
                        </p>
                    </div>
                    <div class="centerFooter">
                        <div class="logo invisLink">
                            <a href="/"><?=NAME?></a>
                            <img src="/assets/img/logo-image.png" alt="Capper Club">
                            <span class="txtLogo"><?=NAME?></span>
                        </div>
                        <span class="fond"><?=$this->getLanguageText('Sports investment Fund');?> </span>
                        <ul class="social cfix">
                            <li>
                                <a href="<?=FB?>" target="_blank"><span class="icon-10"></span></a>
                            </li>
                            <li>
                                <a href="<?=YT?>" target="_blank"><span class="icon-11"></span></a>
                            </li>
                            <li>
                                <a href="<?=VK?>" target="_blank"><span class="icon-12"></span></a>
                            </li>
                        </ul>
                        <p class="copyRight">
                            Copyright © <?=date("Y",time());?> <?=NAME?> LTD. <?=$this->getLanguageText('All rights reserved'); ?>.
                        </p>
                    </div>
                    <div class="rightFooter">
                        <ul class="telegram">
                            <li>
                                    <a href="<?=TG?>" target="_blank"><span class="icon-9"></span><?=$this->getLanguageText('Telegram chat'); ?></a>
                                </li>
                                <li>
                                    <a href="<?=TG_C?>" target="_blank"><span class="icon-9"></span><?=$this->getLanguageText('Telegram channel'); ?></a>
                            </li>
                        </ul>
                        <a href="mailto:<?=$this->config['admin_email'];?>" class="mail"><span class="icon-8"></span><?=$this->config['admin_email'];?></a>
                    </div>
                </div>

                <div class="downFooter">
                    <ul class="menuList">
                        <li><a href="/" class="linkMenu"><?=$this->getLanguageText('Home'); ?></a></li>
                        <li><a href="/about" class="linkMenu"><?=$this->getLanguageText('About us'); ?></a></li>
                        <li><a href="/faq" class="linkMenu">FAQ</a></li>
                        <li><a href="/reviews" class="linkMenu"><?=$this->getLanguageText('Reviews'); ?></a></li>
                        <!--<li><a href="/news" class="linkMenu"><?=$this->getLanguageText('News'); ?></a></li>-->
                        <li><a href="/rules" class="linkMenu"><?=$this->getLanguageText('Rules'); ?></a></li>
                        <li><a href="/contacts" class="linkMenu"><?=$this->getLanguageText('Support'); ?></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>



<!-- modals -->
<?php require_once($this->getLayout('modals')); ?>
<!-- modals -->
<script>
var lango = {};
lango.now = '<?=$this->lang;?>';
console.log('lango.now: '+lango.now);

$(function () {
$('.flag.flag-'+lango.now).addClass('active');
});
</script>



</body>

</html>