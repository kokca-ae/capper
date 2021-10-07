<?php require($this->getLayout('a_header')); ?>


<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Логин</td>
            <td>Email</td>
            <td>Дата регистрации</td>
            <td>IP</td>
			<td>Баланс</td>
        </tr>
        
<?php if ($SetUser) : ?>
        
    <?php foreach ($SetUser as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/users/view/<?= $row['id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td>
                <?= $row['email'] ?>
            </td>
            <td><?= date('d.m.Y H:i', $row['date_reg']) ?></td>
            <td>
                <?= long2ip($row['ip']) ?>
            </td>
			<td>~ <?=$userBalView;?> <i class="fa fa-usd"></i></td></td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="6">
                Никто не найден
            </td>
        </tr>
        
<?php endif ?>
        
    </table>

    <form method="post" action="/panel/users/search" data-pjax>  
        <input type="hidden" name="token" value="<?= $this->getToken('search_form'); ?>">
        <input type="hidden" name="form" value="search_form">
        
        <div class="form-group">
            По ID
            <input type="text" class="form-control" name="search_id" value="">
        </div>
        
        <div class="form-group">
            По логину
            <input type="text" class="form-control" name="search_login" value="">
        </div>
        
        <div class="form-group">
            По емейлу
            <input type="text" class="form-control" name="search_email" value="">
        </div>
        

        <div class="form-group">
            <input type="submit" value="Искать" class="btn btn-primary">
        </div>
    </form>

</div>


<?php require($this->getLayout('a_footer')); ?>