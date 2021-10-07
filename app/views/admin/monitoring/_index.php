<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/monitoring">  
        <input type="hidden" name="token" value="<?= $this->getToken('page_edit_form'); ?>">
        <input type="hidden" name="form" value="page_edit_form">
       
        <div class="form-group">
            Контент
            <textarea class="form-control" name="content" rows="20"><?= $page['content'] ?></textarea>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>