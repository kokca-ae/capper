<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/news" class="btn btn-info" data-pjax>К новостям</a>&nbsp;&nbsp;
        <a href="/panel/news/add" class="btn btn-primary" data-pjax>Написать новость</a>&nbsp;&nbsp;
    </center>
    <br>
	

<form method="post" action="" data-pjax="">  
        <input type="hidden" name="token" value="<?= $this->getToken('news_form_add'); ?>">
        <input type="hidden" name="form" value="news_form_add">
        Заголовок:
        <div class="form-group">
            <input type="text" class="form-control" name="title" value="" style="">
        </div>
        <div class="form-group">
            <textarea type="text" class="form-control" name="text" style="min-height: 155px;"></textarea>
        </div>
        <div class="form-group">
			<input type="submit" value="Опубликовать" class="col-lg-2 col-md-2 btn btn-primary">
        </div>
       
</form>



</div>

<?php require($this->getLayout('a_footer')); ?>