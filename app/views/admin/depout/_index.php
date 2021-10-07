<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

<!--<form method="post" action="/panel/depout" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('perc_form'); ?>">
        <input type="hidden" name="form" value="perc_form">
        Выдать процент (формат 0.00 Пример: 7.32)
        <div class="form-group">
            
            <input type="text" class="col-lg-6 col-md-6 form-control" name="plan_perc" value="" style="width: auto;margin-right: 5px;">
			<input type="submit" value="Утвердить" class="col-lg-2 col-md-2 btn btn-primary">
        </div>
       
</form>-->

    <table class="col-lg-12 table table-hover table-striped table-bordered" style="margin-top: 20px;">
        <tr>
            <td>Пользователь</td>
            <td>Депозит</td>
            <td>Дата</td>
            <td>Статус</td>
        </tr>
		
        
<?php if ($depout) : ?>
        
    <?php foreach ($depout as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td>
                <?= round($row['sum'],2) ?> <?= $row['currs'] ?>
            </td>
           
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
            <td><?= $this->statuses[$row['status']] ?></td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="4" style="text-align:center;">
                Записей нет
            </td>
        </tr>
        
<?php endif ?>
        
    </table>
    
<?php if (isset($navigation['navigation'])) : ?>

    <div class="text-center">

        <?php echo $navigation['navigation']; ?>

    </div>

<?php endif; ?>
    
</div>

<?php require($this->getLayout('a_footer')); ?>