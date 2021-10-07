<!doctype html>
<html class="cabinet" lang="en">
<!-- HEADER CABINET \-->


<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?= NAME; ?></title>

    <link rel='shortcut icon' href='/favicon.ico' type='image/x-icon'>
    <link rel='icon' href='/favicon.ico' type='image/x-icon'>
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

    <script type='text/javascript' src='/assets/js/jquery-1.11.1.js'></script>
    <script type='text/javascript' src='/assets/js/jquery-ui.js'></script>
    <script type='text/javascript' src='/assets/js/detect.min.js'></script>
    <script type='text/javascript' src='/assets/js/jquery.selectric.js'></script>
    <script type='text/javascript' src='/assets/js/owl.carousel.js'></script>
    <script type='text/javascript' src='/assets/js/clipboard.min.js'></script>
    <script type='text/javascript' src='/assets/js/jquery.knob.js'></script>
    <script type='text/javascript' src='/assets/js/modal.js'></script>
    <script type='text/javascript' src='/assets/js/script.js'></script>
</head>

<body class="">
    <div class="lk cfix">
        <header>
            <div class="rightSide headTop">
                <a href="mailto:<?=$this->config['admin_email'];?>" class="mail"><span class="icon-8"></span><?=$this->config['admin_email'];?></a>
                <div class="socialBlock">
                    <ul class="social">
                        <li>
                            <a href="<?=FB?>"><span class="icon-10"></span></a>
                        </li>
                        <li>
                            <a href="<?=YT?>"><span class="icon-11"></span></a>
                        </li>
                        <li>
                            <a href="<?=VK?>"><span class="icon-12"></span></a>
                        </li>
                    </ul>
                    <ul class="telegram">
                        <li>
                            <a href="<?=TG?>"><span class="icon-9"></span><span><?=$this->getLanguageText('Telegram chat'); ?></span></a>
                        </li>
                        <li>
                            <a href="<?=TG_C?>"><span class="icon-9"></span><span><?=$this->getLanguageText('Telegram channel'); ?></span></a>
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
            <div class="leftSide">
                <div class="cfix">
                    <div class="logo invisLink">
                        <a href="/"><?=NAME?></a>
                        <img src="/assets/img/logo.png" alt="Capper Club">
                    </div>
                    <div class="burger"><span></span><span></span><span></span><span></span></div>
                </div>
                <div class="leftMenu">
				<?php require_once($this->getLayout('user_left_menu')); ?>
                </div>
            </div>
            <div class="rightSide welcomeCab cfix">
                <div class="accPhoto" style="background-image: url(/assets/img/accPhoto.png)"></div>
                <div class="welcomeText">
                    <span><?=$this->getLanguageText('Welcome'); ?> </span>
                    <span class="name"><?= $this->user->data['user'] ?></span>
                </div>
                <div class="ref">
                    <span><?=$this->getLanguageText('Your referral link'); ?>: </span>
                    <span class="name" id="yourlink"><?=$this->ref_link;?></span>
					<span class="doItBttn copyLinkBoard" data-clipboard-target="#yourlink" style="background: #b605c8;color: #fff;border-radius: 4px;padding: 0px 5px;font-weight: 700;cursor: pointer;"><?=$this->getLanguageText('Click to Copy');?></span>
                </div>
            </div>
			<div class="rightSide cfix">
                <div class="infoAccMoves cfix">
                    <div class="infoAcc">
                        <div class="lastIp">
                            <span><?=$this->getLanguageText('Last <br>login with IP:'); ?></span>
                            <span class="data"><?= long2ip($this->user->data['ip']) ?></span>
                        </div>
                        <div class="lastDate">
                            <span><?=$this->getLanguageText('Last <br>login date:'); ?></span>
                            <span class="data"><?= date("d.m.Y H:i",$this->user->data['date_login']) ?></span>
                        </div>
                        <div class="regIp">
                            <span><?=$this->getLanguageText('Registration <br>with IP:'); ?></span>
                            <span class="data"><?= long2ip($this->user->data['ip_reg']) ?></span>
                        </div>
                        <div class="regDate">
                            <span><?=$this->getLanguageText('Registration <br>date:'); ?></span>
                            <span class="data"><?= date("d.m.Y H:i",$this->user->data['date_reg']) ?></span>
                        </div>
                        <!--<div class="invitedNum">
                            <span>Приглашенных <br>партнеров: <span class="num">137</span></span>
                        </div>-->
                    </div>
                    <div class="balanceMoves cfix">
                        <div class="balance">
                            <span><?=$this->getLanguageText('Your Balance:'); ?></span>
                            <span class="num">
							<?= $this->userBal ?> <i class="fa fa-usd"></i>
							<!--<div class="inputBlock">
                                                <label><?=$this->getLanguageText('Amount of investment:');?></label>
                                                <div class="wrapInput iconCurrency">
                                                    <input id="amountIn" type="text" name="amount" value="7000">
                                                    <span id="setCurr" class="icon"><i class="fa fa-rub"></i></span>
                                                </div>
                            </div>-->
							</span>
							
                        </div>
						<div class="item col6 col6-lg col6-md col6-xs">
                                            <div class="wrapInput iconCurrency headchoose">
                                                <select class="selectricBl">
													<?php $i = 1; ?>
													<?php foreach ($this->ps as $row) : $i++ ?>
													<?$rest[$i] = substr($row['format'], 2, 1);?>
													<option class=""  
														data-currs="<?= $this->config['bal_' . $row['currs']] ?>" 
														data-valuta="<?= strtolower($row['currs']) ?>"
													value="<?= $row['name'] ?>">
													
													<?= $row['fullname'] ?> <?= $this->sotTrash($this->user->balance['money_'.$row['name']],substr($row['format'], 2, 1));?> <?=$row['currs'] ?>
													
													</option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
						</div>
<style>
.headchoose .selectric{
    background: #484180 !important;
    box-shadow: none !important;
    border: none!important;
    color: #fff !important;
    padding: 2px !important;
}
</style>						
                        <!--
                        <div class="movesPay">
                            <a href="#" class="payIn"><span class="icon-28"></span><span>Пополнить <br>баланс</span></a>
                            <a href="#" class="payOut"><span class="icon-29"></span><span>Вывести <br>средства</span></a>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </header>
        <div class="rightSide">
            <div class="cabContent">
                <div class="cabTitle">
                    <span><?=$_title[$this->lang]?></span>
                </div>
                <div class="content cfix">
				
<?/*?>
				

            <div class="header-left">
                <a href="javascript:void(0)" class="sidebar-toggle"><i class="fa fa-navicon"></i></a>
                <div class="main-menu">
                        <ul>
                            <li><a href="/"><?=$this->getLanguageText('Home');?></a></li>
                            <li><a href="/about"><?=$this->getLanguageText('About us');?> </a></li>

                            <li><a href="/partnership"><?=$this->getLanguageText('Affliate');?> </a></li>
                            <li class="logo-first"><a href="/" class=""></a></li>
                            
                            <li><a href="/how"><?=$this->getLanguageText('Get started');?> </a></li>
                            <li><a href="/faq">FAQ</a></li>
                            <li><a href="/contacts"><?=$this->getLanguageText('Support');?></a></li>
                        </ul>
                </div>
            </div>
            <div class="header-right">
                <div class="select-language">
                    <div class="language-href"><a href="javascript:void(0);" id="lang">EN</a></div>
                    <div class="language-tab">
<ul class="language-list">
<li>
<form action="" method="post" class="" style="background: white;width: 100%;padding: 0px !important;margin: 0px !important;">
<button type="submit" class="" style="width: 100%;background: white;border: none;"><i class="flag flag_en"></i><div style="margin-top: -5px;">EN</div></button>
<input type="hidden" name="language" value="en">
</form>
</li>

<li>
<form action="" method="post" class="" style="">
<button type="submit" class="" style="width: 100%;background: white;border: none;"><i class="flag flag_ru"></i><div style="margin-top: -5px;">RU</div></button>
<input type="hidden" name="language" value="ru">
</form>
</li>
</ul>
                    </div>
                </div>
                                <p class="server-time">Server time: <span class="tk_countdown_time"><?=date("H:i:s",time());?></span></p>
                <a class="log-out-link" href="/exit"><i class="fa fa-power-off" aria-hidden="true"></i> <?=$this->getLanguageText('Logout'); ?></a>
                <div class="mobile">
                    <a class="mobileMenu"><i class="fa fa-navicon"></i> </a>
                    <div class="popupMenu">
                        <div class="popupContainer">
                            <a class="popupCloseButton"></a>
                            <div class="popup-top-menu">
                        <ul>
                            <li><a href="/"><?=$this->getLanguageText('Home');?></a></li>
                            <li><a href="/about"><?=$this->getLanguageText('About us');?> </a></li>

                            <li><a href="/partnership"><?=$this->getLanguageText('Affliate');?> </a></li>
                            <li class="logo-first"><a href="/" class=""></a></li>
                            
                            <li><a href="/how"><?=$this->getLanguageText('Get started');?> </a></li>
                            <li><a href="/faq">FAQ</a></li>
                            <li><a href="/contacts"><?=$this->getLanguageText('Support');?></a></li>
                        </ul>
                            </div>
                            <div class="popup-center-menu">
                                    <ul>
									<?php if (!$this->usid) : ?>
                                    <li><a href="/login"><?=$this->getLanguageText('Log In');?></a></li>
                                    <li><a href="/signup"><?=$this->getLanguageText('Sign Up');?></a></li>
									<?php else : ?>
									<li><a href="/<?=STARTPAGELOGIN?>"><?=$this->getLanguageText('Account');?></a></li>
                                    <li><a href="/exit"><?=$this->getLanguageText('Logout');?></a></li>
									<?php endif; ?>
                                    </ul>
                            </div>
                            <div class="popup-bottom-menu">
                                <div class="menu-social">
                                        <a target="_blank" href="<?=FB?>"><i class="fa fa-facebook"></i></a>
                                        <a target="_blank" href="<?=TG?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                        <a target="_blank" href="<?=TW?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        <a target="_blank" href="<?=VK?>"><i class="fa fa-vk" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<div class="sub-header">
            <div class="sub-header-left">
                <p class="username"><?= $this->user->data['user'] ?></p>
                <div class="referral_home_item_bottom">
                    <button class="btn-refferal js-inputcopybtn_ref"><?=$this->getLanguageText('Click to Copy');?></button>
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <input type="text" class="referral_home_input js-copyinput" value="<?= PROTOCOL . '://' . HOST . '/ref/' . $this->usid ?>" readonly="">
                </div>
            </div>
            <div class="sub-header-right">
                <div class="select_box" id="currency_cabinet">
                    <div class="select-block select-currency">
                        <p class="select-block-title"><?=$this->getLanguageText('Your Balance'); ?></p>
                        <div class="select-href currency-href">
						<a class="selected all"><?=$this->userBal;?> <i class='fa fa-usd'></i></a>
						</div>
                        <div class="select-tab currency-tab">
                            <ul class="select-list currency-list">
							<?$i = 1;?>
							<?php foreach ($this->ps as $row) :?>
							<?if ($row['name'] == "pyusd" || $row['name'] == "py"){$row['fullname']="Payeer";}else{ $row['fullname'] = $row['fullname'];}?>
							<li class="currency-list-item"><a class="currency-balance" data-currency="select_<?=$row['name']?>"> <?=$this->balanceCurr[$i]?> <i class='fa fa-<?= strtolower($row['currs']) ?>'></i></a></li>
							<?$i++;?>
							<?php endforeach?>
							<li class="currency-list-item"><a class="currency-balance" data-currency="all"> <?=$this->userBal;?> <i class='fa fa-usd'></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <a href="/insert" class="btn-title-block"><?=$this->getLanguageText('Make Deposit');?></a>
                <a href="/payment" class="btn-title-block blue"><?=$this->getLanguageText('Withdrawal');?></a>
            </div>
</div>

<?php require_once($this->getLayout('user_left_menu')); ?>

	

    <!--    
					<?$i=1;?>
                    <?php foreach ($this->ps as $row) : $i++ ?>
                    <?$rest[$i] = substr($row['format'], 2, 1);?>
                    <?
                      if($row['fullname'] == "AdvCash (USD)"){ $row['fullname'] = "AdvCash";}
                        if($row['fullname'] == "Payeer (USD)"){ $row['fullname'] = "Payeer";}
                      ?>
                    <option id="ps_head_<?= $row['id'] ?>" class="" value="<?= $row['name'] ?>" data-currs2="<?= $this->config['bal_' . $row['currs']] ?>" data-valuta2="<?= strtolower($row['currs']) ?>" data-balance2="<?= $this->user->balance['money_' . $row['name']]; ?>" data-symbol2="<?= $rest[$i]?>"> <?= $row['fullname']; ?> </option>
                    <?php endforeach; ?>
-->
<?*/?>
<!--
<script>
var GodObj2 = {};

$(function () {
      $('#hhcnange').change(function()
    {
		var currs2 = $(':selected', this).data('currs2');
		var valuta2 = $(':selected', this).data('valuta2');
		var balance2 = $(':selected', this).data('balance2');
		
		console.log(currs2+' :: '+valuta2+' :: '+balance2);
		GodObj2.currs = Number(currs2);
		GodObj2.valuta = valuta2;
		GodObj2.balance = balance2;
		
        //var zem = ($amount * GodObj.currs).toFixed(2);
		//$('#calcCURS').val(zem + ' $');
		
		
		var currs2 = $(':selected', this).data('currs2');
		var valuta2 = $(':selected', this).data('valuta2');
		var balance2 = $(':selected', this).data('balance2');
		
		//alert(currs + valuta);
		
		
$('#currs_change').addClass("head_currs_view");
$('#currs_balance').addClass("head_currs_view");
$('#currs_course').addClass("head_currs_view");

$("#currs_balance").html(GodObj2.balance);
$("#currs_change").html("<i class='fa fa-"+GodObj2.valuta+"'></i>");
$("#currs_course").html("course: 1 <i class='fa fa-"+GodObj2.valuta+"'></i> = "+GodObj2.currs+" <i class='fa fa-usd'></i>");
		
		//calc_rich();
    });

});


</script>
 
<div id="currs_balance" class="head_currs"></div>
<div id="currs_change" class="head_currs" style="margin-left:4px;"></div>
<div id="currs_course" class="head_currs" style="margin-left:4px;"></div>
</div>

<li class="menu-contact org"><a href="/exit">Log Out</a></li>

					
-->

					
					<!-- MENU account /-->