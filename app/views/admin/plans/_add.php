<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <form method="post" action="/panel/plans/add" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('add_plan_form'); ?>">
        <input type="hidden" name="form" value="add_plan_form">

        <div class="form-group">
            Название
            <input type="text" class="form-control" name="name">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Минимальный депозит
            <input type="text" class="form-control" name="min_sum">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Максимальный депозит
            <input type="text" class="form-control" name="max_sum">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Общий процент
            <input type="text" class="form-control" name="perc">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Период начислений (в часах)
            <input type="text" class="form-control" name="term">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Количество начислений
            <input type="text" class="form-control" name="earns">
            <div class="clearfix"></div>
        </div>
        
        <div class="form-group">
            Возврат тела депозита (%)
            <input type="text" class="form-control" name="back">
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <input type="submit" value="добавить" class="btn btn-primary">
        </div>
    </form>

</div>

<?php require($this->getLayout('a_footer')); ?>