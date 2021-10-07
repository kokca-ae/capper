<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="col-lg-12 table table-hover table-striped table-bordered" style="margin-top: 20px;">
        <tr>
            <td>Пользователь</td>
            <td>Инфо</td>
            <td>Дата</td>
            <td>Действие</td>
        </tr>
		
        
<?php if ($reviews) : ?>
        
    <?php foreach ($reviews as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>" target="_blank"><?= $row['user'] ?></a>
            </td>
            <td>
                <? if($row['type'] > 1){ ?>
				<a href="<?= $row['text'] ?>" target="_blank"><?= $row['text'] ?></a>
				<?}else{?>
				<?= $row['text'] ?>
				<?}?>
            </td>
           
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
            <td>
		<form method="post" action="/panel/reviews" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('reviews_form_accept'); ?>">
        <input type="hidden" name="form" value="reviews_form_accept">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
		<input type="hidden" name="status" value="1">
        <div class="form-group">
			<input type="submit" value="Утвердить" class="btn btn-primary">
        </div>
       
		</form>
		<form method="post" action="/panel/reviews" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('reviews_form_accept'); ?>">
        <input type="hidden" name="form" value="reviews_form_accept">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
		<input type="hidden" name="status" value="2">
        <div class="form-group">
			<input type="submit" value="Отклонить" class="btn btn-primary">
        </div>
       
		</form>
			</td>
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