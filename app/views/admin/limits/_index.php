<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">
    <form method="post" action="/panel/limits" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('limits_form'); ?>">
        <input type="hidden" name="form" value="limits_form">
        
        <div class="form-group">
            Текущий лимит
            <input type="text" class="form-control" name="limit_now" value="<?= $Limit[0]['limit_now'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/USD
            <input type="text" class="form-control" name="currs_usd" value="<?= $Limit[0]['currs_usd'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/RUB
            <input type="text" class="form-control" name="currs_rub" value="<?= $Limit[0]['currs_rub'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/BTC
            <input type="text" class="form-control" name="currs_btc" value="<?= $Limit[0]['currs_btc'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/LTC
            <input type="text" class="form-control" name="currs_ltc" value="<?= $Limit[0]['currs_ltc'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/ETH
            <input type="text" class="form-control" name="currs_eth" value="<?= $Limit[0]['currs_eth'] ?>">
        </div>
        
        <div class="form-group">
            Курс USD/DOGE
            <input type="text" class="form-control" name="currs_doge" value="<?= $Limit[0]['currs_doge'] ?>">
        </div>
		
        <div class="form-group">
            Курс USD/DASH
            <input type="text" class="form-control" name="currs_dash" value="<?= $Limit[0]['currs_dash'] ?>">
        </div>
        

        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>