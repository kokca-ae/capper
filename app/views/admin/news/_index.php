<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/news" class="btn btn-primary" data-pjax>К новостям</a>&nbsp;&nbsp;
        <a href="/panel/news/add" class="btn btn-info" data-pjax>Написать новость</a>&nbsp;&nbsp;
    </center>
    <br>
	
    <table class="col-lg-12 table table-hover table-striped table-bordered" style="margin-top: 20px;">
        <tr>
            <td>Заголовок</td>
            <td>Текст</td>
            <td>Дата</td>
            <td>Действие</td>
        </tr>
		
        
<?php if ($news) : ?>
    <?php foreach ($news as $row) : ?>
        
        <tr>
            <td><?= $row['title'] ?></td>
            <td><?= $row['text'] ?></td>
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
            <td>
		
		<form method="post" action="/panel/news/view/<?= $row['id'] ?>" data-pjax="">  
        <div class="form-group">
		<input type="submit" value="Изменить" class="btn btn-primary">
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