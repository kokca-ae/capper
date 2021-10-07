<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/ps/add" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('add_ps_form'); ?>">
        <input type="hidden" name="form" value="add_ps_form">
        
        <div class="form-group">
            Платёжная система
            <select name="ps" class="form-control">
                
            <?php foreach ($pss as $row) : ?>
                
                <option value="<?= $row->name ?>"><?= $row->fullname ?> (<?= $row->url ?>)</option>
                
            <?php endforeach ?>
                
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" value="добавить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>