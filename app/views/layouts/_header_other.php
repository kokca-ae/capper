<!DOCTYPE html>
<html lang="en">
<!-- HEADER HOME \-->
<head>
    <meta charset="UTF-8">
	<meta name="author" content="Rich-99000000" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=NAME?></title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/selectric.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/modals.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">

    <script type="text/javascript" src="/assets/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="/assets/js/detect.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.selectric.js"></script>
    <script type="text/javascript" src="/assets/js/owl.carousel.js"></script>
    <script type="text/javascript" src="/assets/js/freewall.js"></script>
    <script type="text/javascript" src="/assets/js/viewportchecker.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.knob.js"></script>
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script type="text/javascript" src="/assets/js/script.js"></script>
</head>

<!-- BODY -->
	
    <body class="">
	
    <header class="siteHeader innerHeader" style="background-image:url(/assets/img/back-header-<?=$set_img_bg?>.png)">
            <div class="lineTop cfix">
                <div class="logo invisLink">
                    <a href="/"><?=NAME?></a>
                    <img src="/assets/img/logo.png" alt="Capper Club">
                </div>
                <div class="rightHeader">
                    <div class="headContacts cfix">
                        <a href="mailto:<?=$this->config['admin_email'];?>" class="mail"><span class="icon-8"></span><?=$this->config['admin_email'];?></a>
                        <div class="socialBlock">
                            <ul class="social">
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
                            <ul class="telegram">
                                <li>
                                    <a href="<?=TG?>" target="_blank"><span class="icon-9"></span><?=$this->getLanguageText('Telegram chat'); ?></a>
                                </li>
                                <li>
                                    <a href="<?=TG_C?>" target="_blank"><span class="icon-9"></span><?=$this->getLanguageText('Telegram channel'); ?></a>
                                </li>
                            </ul>
                        </div>
                        <ul class="langSite">
<li>
<form action="" method="post" class="input-has-value form_lang">
<button type="submit" class="ripple but_lang" style=""><div class="flag flag-ru" style="background-image: url(/assets/img/flag1.jpg);width: 27px;height: 27px;border-radius: 50%;background-size: cover;background-position: center;"></div></button>
<input type="hidden" name="language" value="ru">
</form>
</li>

<li>
<form action="" method="post" class="input-has-value form_lang">
<button type="submit" class="ripple but_lang" style=""><div class="flag flag-en" style="background-image: url(/assets/img/flag2.jpg);width: 27px;height: 27px;border-radius: 50%;background-size: cover;background-position: center;"></div></button>
<input type="hidden" name="language" value="en">
</form>
</li>
                        </ul>
                    </div>
                    <span class="menuBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="siteMenu">
                        <ul class="menu">
                            <li><a href="/" class="linkMenu active"><?=$this->getLanguageText('Home'); ?></a></li>
                            <li><a href="/about" class="linkMenu"><?=$this->getLanguageText('About us'); ?></a></li>
                            <li><a href="/faq" class="linkMenu">FAQ</a></li>
                            <li><a href="/reviews" class="linkMenu"><?=$this->getLanguageText('Reviews'); ?></a></li>
                            <!--<li><a href="/news" class="linkMenu"><?=$this->getLanguageText('News'); ?></a></li>-->
                            <li><a href="/rules" class="linkMenu"><?=$this->getLanguageText('Rules'); ?></a></li>
                            <li><a href="/contacts" class="linkMenu"><?=$this->getLanguageText('Support'); ?></a></li>
                        </ul>
                        <ul class="toCabinet">
						<?php if (!$this->usid) : ?>
                            <li><button class="loginCab cabMove openMod" data-modal="logReg" data-tab='#login'><?=$this->getLanguageText('Sign In'); ?></button></li>
                            <li><button class="regCab cabMove openMod" data-modal="logReg" data-tab='#reg'><?=$this->getLanguageText('Register'); ?></button></li>
						<?php else : ?>
                            <li><a href="/cabinet" class="loginCab cabMove" style="width: auto;padding: 0px 10px;"><?=$this->getLanguageText('Account'); ?></a></li>
							<li><a href="/exit" class="loginCab cabMove" style="width: auto;padding: 0px 10px;"><?=$this->getLanguageText('Logout'); ?></a></li>
						<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="innerHead <?if($butt_rev){ echo "reviewsHead"; }?>">
                <h1 class="mainTitle"><?=$_title[$this->lang];?></h1>
                <span class="subTitle"><?=$_desc_other[$this->lang];?></span>
				<?if(intval($butt_rev) == 1) : ?>
				<span style="cursor:pointer;" data-modal="review" class="btn btnTran"><?=$this->getLanguageText('Leave review'); ?></span>
                <?elseif(intval($butt_rev) == 2) : ?>
                <a style="cursor:pointer;" class="btn btnTran" href="/<?=STARTPAGELOGIN?>"><?=$this->getLanguageText('Go account'); ?></a>
                <?php endif; ?>
            </div>
        </header>
        
<!-- header -->
<div class="clearfix"></div>