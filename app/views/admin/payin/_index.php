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
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
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
            <td>Дата</td>
            <td>Действие</td>
        </tr>
		
        
<?php if ($payin) : ?>
        
    <?php foreach ($payin as $row) : ?>
        
        <tr>
			<td>
                #<?= $row['id'] ?>
            </td>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>" target="_blank"><?= $row['user'] ?></a>
            </td>
            <td>
			
			<form method="post" action="/panel/payin" data-pjax="">
			<input type="hidden" name="token" value="<?= $this->getToken('payin_accept'); ?>">
			
			<input type="hidden" name="form" value="payin_accept">
			<input type="hidden" name="id" value="<?= $row['id'] ?>">
			<input type="hidden" name="status" value="1">
			<input type="hidden" name="plan" value="<?= $row['plan'] ?>">
			
			<div class="form-group" style="padding:0px;margin:0px;">
				<input type="text" class="col-lg-5 col-md-5 typeN" name="sum" value="<?= $row['sum'] ?>" style="margin-right: 10px;">
				<input type="submit" value="Одобрить" class="col-lg-6 col-md-6 btn btn-primary">
			</div>
			
			</form>
			
            </td>
			
			<td style="text-align: center !important;"><i class="fa fa-<?= strtolower($row['currs']) ?>" style="line-height: 2;"></i></td>
           
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
            <td>
		
		<form method="post" action="/panel/payin" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('payin_accept'); ?>">
        <input type="hidden" name="form" value="payin_accept">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
		<input type="hidden" name="status" value="2">
		<input type="hidden" name="plan" value="<?= $row['plan'] ?>">
        <div class="form-group">
			<input type="submit" value="Отклонить" class="btn btn-primary">
        </div>
       
		</form>
			</td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="6" style="text-align:center;">
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