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
	<link rel="stylesheet" href="/assets/css/stock/crypto-fa.css">

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
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js'></script>
    <script type="text/javascript" src="/assets/js/script.js"></script>
</head>






<!-- BODY -->
<body>
    <div class="wrapper">
        <header class="siteHeader mainHeader" style="background-image:url(/assets/img/back-header-main.png)">
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
                            <li><button class="loginCab cabMove openMod" data-modal="logReg" id="asLogin" data-tab='#login'><?=$this->getLanguageText('Sign In'); ?></button></li>
                            <li><button class="regCab cabMove openMod" data-modal="logReg" data-tab='#reg'><?=$this->getLanguageText('Register'); ?></button></li>
						<?php else : ?>
                           <li><a href="/cabinet" class="loginCab cabMove" style="width: auto;padding: 0px 10px;"><?=$this->getLanguageText('Account'); ?></a></li>
                           <li><a href="/exit" class="loginCab cabMove" style="width: auto;padding: 0px 10px;"><?=$this->getLanguageText('Logout'); ?></a></li>
						<?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grettingMain cfix">
                <div class="infoGrettingMain">
                    <div class="circleLogo" style="background-image:url(/assets/img/circle-logo.png)">
                        <div class="item">
                            <span class="icon" style="background-image:url(/assets/img/icon-gretting1.png)"></span>
                            <span class="val"><?= $stats['days_work']?></span>
                            <span class="desr"><?=$this->getLanguageText('Running Days'); ?></span>
                        </div>
                        <div class="item">
                            <span class="icon" style="background-image:url(/assets/img/icon-gretting2.png)"></span>
                            <span class="val"><?= $stats['users_count'];?></span>
                            <span class="desr"><?=$this->getLanguageText('Total Account');?></span>
                        </div>
                        <div class="item">
                            <span class="icon" style="background-image:url(/assets/img/icon-gretting3.png)"></span>
                            <span class="val"><?= sprintf('%.2f', $stats['total_insert']);?>$</span>
                            <span class="desr"><?=$this->getLanguageText('Total Deposit');?></span>
                        </div>
                    </div>
                </div>
                <div class="textGretting">
                    <h1 class="cap"><?=NAME?></h1>
                    <span class="desr"><?=$this->getLanguageText('Sports investment Fund');?></span>
                    <p class="text"><?=$this->getLanguageText('The professionalism of the team and experience have allowed us to create a technological and reliable tool for investors!');?></p>
                    <span style="cursor:pointer;" data-modal="logReg" data-tab='#reg' class="btn btnTran"><?=$this->getLanguageText('Join now');?></span>
                </div>
            </div>
            <svg class="svgGraf" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 741 450">
                <defs>
                </defs>
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="77" y1="11" x2="10" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="171" y1="11" x2="77" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="238" y1="11" x2="171" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="292" y1="11" x2="238" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="367" y1="11" x2="292" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="466" y1="11" x2="367" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="512" y1="11" x2="466" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="588" y1="11" x2="511" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="645" y1="11" x2="588" y2="11" />
                <line fill="none" stroke="#ff3bbf" stroke-width="4" stroke-miterlimit="10" x1="731" y1="11" x2="645" y2="11" />
                <g>
                    <circle fill="#ff3bbf" cx="10.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="77.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="171.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="238.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="292.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="367.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="466.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="510.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="588.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="645.5" cy="10.5" r="10.5" />
                    <circle fill="#ff3bbf" cx="730.5" cy="10.5" r="10.5" />
                </g>
                <path id="graph-measurement" fill="none" stroke="#ff3bbf" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="" />
            </svg>
        </header>