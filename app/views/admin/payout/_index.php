<?php require($this->getLayout('a_header')); ?>

<style>
.typeN{
	margin-right: 0px;
    /* width: auto; */
    display: block;
    /* width: 100%; */
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    /*background-color: #fff;*/
    background-image: none;
    /*border: 1px solid #ccc;*/
    border-radius: 4px;
}
</style>

<div class="col-lg-9">

    <table class="col-lg-12 table table-hover table-striped table-bordered" style="margin-top: 20px;">
        <tr>
            <td>ID</td>
			<td>Пользователь</td>
            <td>Сумма</td>
			<td>Валюта</td>
			<td>Кошелек</td>
            <td>Дата</td>
            <td>Действие</td>
        </tr>
		
        
<?php if ($payout) : ?>
        
    <?php foreach ($payout as $row) : ?>
        
        <tr>
			<td>
                #<?= $row['id'] ?>
            </td>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>" target="_blank"><?= $row['user'] ?></a>
            </td>
			
			<td>
			
			<?= $row['sum'] ?>
			
            </td>
			
			<td style="text-align: center !important;"><?=$row['currs'] ?></td>
			
			<td><?= $row['purse'] ?></td>
           
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
			
			
			
            <td>
		
		<div class="form-group" style="padding:0px;margin:0px;">
		
		<div class="col-lg-5 col-md-5" style="margin-right: 3px;">
		<form method="post" action="/panel/payout" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('payout_form'); ?>">
        <input type="hidden" name="form" value="payout_form">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
		<input type="hidden" name="status" value="2">
        <div class="form-group">
			<input type="submit" value="Отклонить" class="btn btn-primary">
        </div>
		</form>
		</div>
		
		<div class="col-lg-5 col-md-5">
		<form method="post" action="/panel/payout" data-pjax="">
		<input type="hidden" name="token" value="<?= $this->getToken('payout_form'); ?>">
		<input type="hidden" name="form" value="payout_form">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
		<input type="hidden" name="status" value="1">
		<div class="form-group" style="padding:0px;margin:0px;">
			<input type="submit" value="Выплатил" class="btn btn-primary">
		</div>
		</form>
		</div>
		</div>
		
			</td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="7" style="text-align:center;">
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