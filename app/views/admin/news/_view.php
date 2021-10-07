<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/news" class="btn btn-primary" data-pjax>К новостям</a>&nbsp;&nbsp;
        <a href="/panel/news/add" class="btn btn-info" data-pjax>Написать новость</a>&nbsp;&nbsp;
    </center>
    <br>
	
<?php if ($news) : ?>
<?php foreach ($news as $row) : ?>
<form method="post" action="/panel/news/view/<?= $row['id'] ?>" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('news_form_edit'); ?>">
        <input type="hidden" name="form" value="news_form_edit">
		<input type="hidden" name="id" value="<?= $row['id'] ?>">
        Заголовок:
        <div class="form-group">
            <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>" style="">
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control" name="text" style="min-height: 155px;"><?= $row['text'] ?></textarea>
        </div>
        <div class="form-group">
			<input type="submit" value="Сохранить" class="col-lg-2 col-md-2 btn btn-primary">
        </div>
       
</form>
<?php endforeach ?>
<?php else : ?>
<div class="form-group">Новость не найдена</div>
<?php endif ?>


</div>

<?php require($this->getLayout('a_footer')); ?>