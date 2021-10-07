<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <center>
        <a href="/panel/users/view/<?= $user->data['id'] ?>" class="btn btn-info" data-pjax>Общие данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/referal" class="btn btn-primary" data-pjax>Реферальные данные</a>&nbsp;&nbsp;
        <a href="/panel/users/view/<?= $user->data['id'] ?>/wallets" class="btn btn-info" data-pjax>Реквизиты</a>
    </center>
    <br>
    
<?php if ($this->config['ref_lvls'] > 1) : ?>

    <center>
        <a href="/panel/users/view/<?= $user->data['id'] ?>/referal" class="btn btn-<?= ($lvl == 1) ? 'primary' : 'info' ?>" data-pjax>1 уровень</a>&nbsp;&nbsp;

        <?php for ($i = 2; $i <= $this->config['ref_lvls']; $i++) : ?>

        <a href="/panel/users/view/<?= $user->data['id'] ?>/referal/<?= $i; ?>" class="btn btn-<?= ($lvl == $i) ? 'primary' : 'info' ?>" data-pjax><?= $i; ?> уровень</a>&nbsp;&nbsp;

        <?php endfor; ?>

    </center>
    <br>
    
<?php endif; ?>

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td align="center">Реферер <?= $lvl ?> уровня</td>
            <td align="center">
                <a href="/panel/users/view/<?= $user->referal['referer' . $lvl . '_id'] ?>"><?= $user->referal['referer' . $lvl] ?></a>
            </td>
        </tr>
        <tr>
            <td align="center">Принёс рефереру <?= $lvl ?> уровня</td>
            <td align="center">
                <?= sprintf('%.2f', $user->referal['to_referer' . $lvl]) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Заработал на рефералах <?= $lvl ?> уровня</td>
            <td align="center">
                <?= sprintf('%.2f', $user->referal['from_referals' . $lvl]) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Всего рефералов <?= $lvl ?> уровня</td>
            <td align="center">
                <?= $user->referal['count_ref' . $lvl] ?>
            </td>
        </tr>
    </table>
    <br>
    
    <h3 class="text-center">Рефералы <?= $lvl ?> уровня</h3>
    
    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Пользователь</td>
            <td>Почта</td>
            <td>Зарегистрирован</td>
            <td>Реферальные</td>
        </tr>
        
    <?php if ($referals) : ?>

        <?php foreach ($referals as $row) : ?>

            <tr>
                <td><a href="/panel/users/view/<?= $row["id"]; ?>"><?= $row["user"]; ?></a></td>
                <td><?= $row["email"]; ?></td>
                <td><?= date('d.m.Y H:i:s', $row["date_reg"]); ?></td>
                <td><?= sprintf("%.2f", $row["to_referer" . $lvl]); ?> USD</td>
            </tr>

        <?php endforeach; ?>

    <?php else : ?>

        <tr>
            <td colspan=4>
                Записей нет
            </td>
        </tr>

    <?php endif; ?> 
        
    </table>
    
<?php if (isset($navigation['navigation'])) : ?>

    <div class="text-center">

    <?php echo $navigation['navigation']; ?>

    </div>

<?php endif; ?>

</div>

<?php require($this->getLayout('a_footer')); ?>