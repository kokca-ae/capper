<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/deposits/add" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('add_deposit_form'); ?>">
        <input type="hidden" name="form" value="add_deposit_form">

        <div class="form-group">
            ID пользователя
            <input type="text" class="form-control" name="usid">
        </div>
        
        <div class="form-group">
            Тарифный план
            <select name="plan" class="form-control">
                
            <?php foreach ($plans as $row) : ?>
                
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                
            <?php endforeach ?>
                
            </select>
        </div>
        
        <div class="form-group">
            Платёжная система
            <select name="ps" class="form-control">
                
            <?php foreach ($paysystems as $row) : ?>
                
                <option value="<?= $row['name'] ?>"><?= $row['fullname'] ?></option>
                
            <?php endforeach ?>
                
            </select>
        </div>
        
        <div class="form-group">
            Сумма депозита
            <input type="text" class="form-control" name="amount">
        </div>
        
        <div class="form-group">
            <input type="submit" value="добавить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>