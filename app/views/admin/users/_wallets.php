<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/users/view/<?= $user->data['id'] ?>" class="btn btn-info" data-pjax>Общие данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/referal" class="btn btn-info" data-pjax>Реферальные данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/wallets" class="btn btn-primary" data-pjax>Реквизиты</a>
    </center>
    <br>

<?php foreach ($ps as $row) : ?>
    
    <?php if ($row['active_payment'] == 0) continue; ?>

    <div class="col-lg-6">
        <br>
        <form action="/panel/users/view/<?= $user->data['id'] ?>/wallets" method="post" class="my_accont" data-pjax>
            <input type="hidden" name="token" value="<?= $this->getToken('set_wallet_form'); ?>">
            <input type="hidden" name="form" value="set_wallet_form">
            <input type="hidden" name="ps" value="<?= $row['name']; ?>">
            <div class="form-group">
                <?= $row['fullname']; ?> аккаунт:
                <input type="text" class="form-control" name="purse" value="<?php if ($user->wallets[$row['name']]) echo $user->wallets[$row['name']]; ?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Сохранить" class="btn btn-primary">
            </div>
        </form>
    </div>

<?php endforeach ?>

</div>

<?php require($this->getLayout('a_footer')); ?>