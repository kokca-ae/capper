<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-12">

    <div class="col-lg-6 col-lg-offset-3">
        <form action="/panel/login" method="post">
            <input type="hidden" name="form" value="admin_login_form">
            <input type="hidden" name="token" value="<?=$this->getToken('admin_login_form'); ?>">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Ключ">
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Войти</button>
            </div>
        </form>
    </div>
    
</div>

<?php require($this->getLayout('a_footer')); ?>