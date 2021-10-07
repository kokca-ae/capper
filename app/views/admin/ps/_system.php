<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">
    <center>
        <a href="/panel/ps/<?= $name ?>" class="btn btn-info" data-pjax>Общие настройки</a>&nbsp;&nbsp;
        <a href="/panel/ps/<?= $name ?>/system" class="btn btn-primary" data-pjax>Системные настройки</a>
    </center>
    <br>

    <form method="post" action="/panel/ps/<?= $name ?>/system" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('system_edit_ps_form'); ?>">
        <input type="hidden" name="form" value="system_edit_ps_form">
        
    <?php foreach ($ps->fields as $k => $field) : ?>

        <div class="form-group">
            <?= $k ?> 
            <input type="<?= $field['type'] ?>" class="form-control" name="<?= $k ?>" value="<?php if (isset($ps->payconfig[$k])) echo $ps->payconfig[$k] ?>">
            <div class="clearfix"></div>
        </div>
        
    <?php endforeach ?>
        
        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>