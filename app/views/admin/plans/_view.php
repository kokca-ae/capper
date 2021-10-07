<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/plans/view/<?= $plan['id'] ?>" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('edit_plan_form'); ?>">
        <input type="hidden" name="form" value="edit_plan_form">

        <div class="form-group">
            Название
            <input type="text" class="form-control" name="name" value="<?= $plan['name'] ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Минимальный депозит
            <input type="text" class="form-control" name="min_sum" value="<?= $plan['min_sum'] ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Максимальный депозит
            <input type="text" class="form-control" name="max_sum" value="<?= $plan['max_sum'] ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Общий процент
            <input type="text" class="form-control" name="perc" value="<?= $plan['perc'] ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Период начислений (в часах)
            <input type="text" class="form-control" name="term" value="<?= $plan['term'] / 60 / 60 ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Количество начислений
            <input type="text" class="form-control" name="earns" value="<?= $plan['earns'] ?>">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Возврат тела депозита (%)
            <input type="text" class="form-control" name="back" value="<?= $plan['back'] ?>">
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </form>
    
    <form method="post" action="/panel/plans/view/<?= $plan['id'] ?>" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('delete_plan_form'); ?>">
        <input type="hidden" name="form" value="delete_plan_form">
        <div class="form-group">
            <input type="submit" value="Удалить" class="btn btn-danger">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>