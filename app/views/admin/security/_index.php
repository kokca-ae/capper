<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/security" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('change_key_form'); ?>">
        <input type="hidden" name="form" value="change_key_form">
        
        <div class="form-group">
            Актуальный ключ
            <input type="password" class="form-control" name="old">
        </div>
        
        <div class="form-group">
            Новый ключ
            <input type="password" class="form-control" name="new">
        </div>
        
        <div class="form-group">
            Повторите новый ключ
            <input type="password" class="form-control" name="re_new">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Сменить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>