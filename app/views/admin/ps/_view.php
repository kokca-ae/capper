<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">
    <center>
        <a href="/panel/ps/<?= $ps['name'] ?>" class="btn btn-primary" data-pjax>Общие настройки</a>&nbsp;&nbsp;
        <a href="/panel/ps/<?= $ps['name'] ?>/system" class="btn btn-info" data-pjax>Системные настройки</a>
    </center>
    <br>

    <form method="post" action="/panel/ps/<?= $ps['name'] ?>" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('edit_ps_form'); ?>">
        <input type="hidden" name="form" value="edit_ps_form">

        <div class="form-group">
            Валюта 
            <input type="text" class="form-control" value="<?= $ps['currs'] ?>" disabled>
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Название
            <input type="text" class="form-control" name="fullname" value="<?= $ps['fullname'] ?>">
        </div>
        
        <div class="form-group">
            Минимальное пополнение
            <input type="text" class="form-control" name="min_insert" value="<?= $ps['min_insert'] ?>">
        </div>
        
        <div class="form-group">
            Максимальное пополнение
            <input type="text" class="form-control" name="max_insert" value="<?= $ps['max_insert'] ?>">
        </div>
        
        <div class="form-group">
            Минимальная выплата
            <input type="text" class="form-control" name="min_payment" value="<?= $ps['min_payment'] ?>">
        </div>
        
        <div class="form-group">
            Максимальная выплата
            <input type="text" class="form-control" name="max_payment" value="<?= $ps['max_payment'] ?>">
        </div>
        
        <div class="form-group">
            Режим пополнений
            <select class="form-control" name="active_insert">
                <option value="0" <?php if (!$ps['active_insert']) echo 'selected' ?>>Отключено</option>
                <option value="1" <?php if ($ps['active_insert']) echo 'selected' ?>>Через мерчант</option>
            </select>
        </div>
        
        <div class="form-group">
            Режим выплат
            <select class="form-control" name="active_payment">
                <option value="0" <?php if (!$ps['active_payment']) echo 'selected' ?>>Отключено</option>
                <option value="1" <?php if ($ps['active_payment']) echo 'selected' ?>>Автоматически</option>
            </select>
        </div>
        
        <div class="form-group">
            Состояние
            <select class="form-control" name="active">
                <option value="0" <?php if (!$ps['active']) echo 'selected' ?>>Отключена</option>
                <option value="1" <?php if ($ps['active']) echo 'selected' ?>>Доступна</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>