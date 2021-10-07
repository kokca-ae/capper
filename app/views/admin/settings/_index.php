<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/settings" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('global_settings_form'); ?>">
        <input type="hidden" name="form" value="global_settings_form">
        
        <div class="form-group">
            Email администратора
            <input type="text" class="form-control" name="admin_email" value="<?= $this->config['admin_email'] ?>">
        </div>
        
        <div class="form-group">
            Дата старта (UNIX) <a href="https://time.is/ru/Unix_time_converter" target="_blank">конвертер</a>
            <input type="text" class="form-control" name="date_start" value="<?= $this->config['date_start'] ?>">
        </div>

        <div class="form-group">
            Scam Mode
			<select class="form-control" name="scam_mode">
                <option value="1" <?php if ($this->config['scam_mode'] == 1) echo 'selected' ?>>Нет</option>
                <option value="2" <?php if ($this->config['scam_mode'] == 2) echo 'selected' ?>>Мимо кошелька</option>
            </select>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="bal_auto" <?php if ($this->config['bal_auto']) echo 'checked' ?>>
                Автоматически обновлять курс с api.coinmarketcap.com
            </label>
        </div>
		
		<div class="form-group">
            Курс USD
            <input type="text" class="form-control" name="bal_USD" value="<?= $this->config['bal_USD'] ?>" disabled>
        </div>
        
        <div class="form-group">
            Курс RUB
            <input type="text" class="form-control" name="bal_RUB" value="<?= $this->config['bal_RUB'] ?>">
        </div>
        
        <div class="form-group">
            Курс BTC
            <input type="text" class="form-control" name="bal_BTC" value="<?= $this->config['bal_BTC'] ?>">
        </div>
        
        <div class="form-group">
            Курс LTC
            <input type="text" class="form-control" name="bal_LTC" value="<?= $this->config['bal_LTC'] ?>">
        </div>
        
        <div class="form-group">
            Курс ETH
            <input type="text" class="form-control" name="bal_ETH" value="<?= $this->config['bal_ETH'] ?>">
        </div>
        
        <div class="form-group">
            Курс DASH
            <input type="text" class="form-control" name="bal_DASH" value="<?= $this->config['bal_DASH'] ?>">
        </div>
		
        <div class="form-group">
            Курс DOGE
            <input type="text" class="form-control" name="bal_DOGE" value="<?= $this->config['bal_DOGE'] ?>">
        </div>
        
        <div class="form-group">
            Уровень вложености реферальной программы
            <select class="form-control" name="ref_lvls">
                <option value="1" <?php if ($this->config['ref_lvls'] == 1) echo 'selected' ?>>1 уровень</option>
                <option value="2" <?php if ($this->config['ref_lvls'] == 2) echo 'selected' ?>>2 уровень</option>
                <option value="3" <?php if ($this->config['ref_lvls'] == 3) echo 'selected' ?>>3 уровень</option>
                <option value="4" <?php if ($this->config['ref_lvls'] == 4) echo 'selected' ?>>4 уровень</option>
                <option value="5" <?php if ($this->config['ref_lvls'] == 5) echo 'selected' ?>>5 уровень</option>
            </select>
        </div>

        <div class="form-group">
            Тип реферальной ссылки
			<select class="form-control" name="ref_type">
                <option value="1" <?php if ($this->config['ref_type'] == 1) echo 'selected' ?>>id</option>
                <option value="2" <?php if ($this->config['ref_type'] == 2) echo 'selected' ?>>login</option>
            </select>
        </div>
		
				
        <div class="form-group">
            Адрес реферальной ссылки
			<select class="form-control" name="ref_link">
                <option value="ref" <?php if ($this->config['ref_link'] == "ref") echo 'selected' ?>>/ref/</option>
                <option value="r" <?php if ($this->config['ref_link'] == "r") echo 'selected' ?>>/r/</option>
				<option value="go" <?php if ($this->config['ref_link'] == "go") echo 'selected' ?>>/go/</option>
            </select>
        </div>
        
        <div class="form-group">
            Реф. бонус 1 уровня
            <input type="text" class="form-control" name="ref1" value="<?= $this->config['ref1'] ?>">
        </div>
        
        <div class="form-group">
            Реф. бонус 2 уровня
            <input type="text" class="form-control" name="ref2" value="<?= $this->config['ref2'] ?>">
        </div>
        
        <div class="form-group">
            Реф. бонус 3 уровня
            <input type="text" class="form-control" name="ref3" value="<?= $this->config['ref3'] ?>">
        </div>
        
        <div class="form-group">
            Реф. бонус 4 уровня
            <input type="text" class="form-control" name="ref4" value="<?= $this->config['ref4'] ?>">
        </div>
        
        <div class="form-group">
            Реф. бонус 5 уровня
            <input type="text" class="form-control" name="ref5" value="<?= $this->config['ref5'] ?>">
        </div>
        
        

        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>