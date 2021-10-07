<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/users/view/<?= $user->data['id'] ?>" class="btn btn-primary" data-pjax>Общие данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/referal" class="btn btn-info" data-pjax>Реферальные данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/wallets" class="btn btn-info" data-pjax>Реквизиты</a>
    </center>
    <br>

    <table class="table table-hover table-striped table-bordered">
	
        <tr>
            <td align="center">ID</td>
            <td align="center">
                <?= $user->data['id'] ?> 
            </td>
        </tr>
        <tr>
            <td align="center">Логин</td>
            <td align="center">
                <?= $user->data['user'] ?> 
            </td>
        </tr>
        <tr>
            <td align="center">Email</td>
            <td align="center">
                <?= $user->data['email'] ?> 
            </td>
        </tr>
        <tr>
            <td align="center">Дата регистрации</td>
            <td align="center">
                <?= date('d.m.Y H:i', $user->data['date_reg']) ?>
            </td>
        </tr>
        <tr>
            <td align="center">Последний логин</td>
            <td align="center">
                <?= date('d.m.Y H:i', $user->data['date_login']) ?>
            </td>
        </tr>
        <tr>
            <td align="center">Последний IP</td>
            <td align="center">
                <?= long2ip($user->data['ip']) ?>
            </td>
        </tr>
        <tr>
            <td align="center">Забанен</td>
            <td align="center">
                <?= ($user->data['banned']) ? 'Да' : 'Нет' ?> 
            </td>
        </tr>
        <tr><td align="center">Баланс</td><td align="center">~ <?=$userBalView;?> <i class="fa fa-usd"></i></td></td></tr>
		<tr><td align="center">Ввел-Вывел=Остаток</td><td align="center" <?=$style;?>> <?=$userRemainderView;?> <i class="fa fa-usd"></td></td></tr>
    <?php foreach ($ps as $row) : ?>
        
        <tr>
            <td align="center">На счету</td>
            <td align="center">
                <?= sprintf($row['format'], $user->balance['money_' . $row['name']]) ?> <?= $row['currs'] ?>
            </td>
        </tr>
        
    <?php endforeach ?>
        
        <tr>
            <td align="center">Всего пополнил</td>
            <td align="center">
                <?= sprintf('%.2f', $user->balance['insert_sum']) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Всего реинвестировал</td>
            <td align="center">
                <?= sprintf('%.2f', $user->balance['reinsert_sum']) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Всего вывел</td>
            <td align="center">
                <?= sprintf('%.2f', $user->balance['payment_sum']) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <form class="form" action="/panel/users/view/<?= $user->data['id'] ?>" method="POST" data-pjax style="display:inline-block">
                    <input type="hidden" name="token" value="<?=$this->getToken('user_login_form'); ?>">
                    <input type="hidden" name="form" value="user_login_form">
                    <div class="form__row">
                        <input type="submit" value="Войти как пользователь" class="btn btn-primary">
                    </div>
                </form>
                <form class="form" action="/panel/users/view/<?= $user->data['id'] ?>" method="POST" data-pjax style="display:inline-block">
                    <input type="hidden" name="token" value="<?=$this->getToken('user_ban_form'); ?>">
                    <input type="hidden" name="form" value="user_ban_form">
                    <div class="form__row">
                        <input type="submit" value="Бан / Разбан" class="btn btn-danger">
                    </div>
                </form>
            </td>
        </tr>
    </table>

</div>

<?php require($this->getLayout('a_footer')); ?>