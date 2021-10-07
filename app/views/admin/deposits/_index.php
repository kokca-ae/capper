<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Пользователь</td>
            <td>Депозит</td>
            <td>ЭПС</td>
            <td>Кол. начислений</td>
            <td>Период начислений</td>
            <td>Дата</td>
            <td>Статус</td>
        </tr>
        
<?php if ($deposits) : ?>
        
    <?php foreach ($deposits as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td>
                <?= round($row['sum'],2) ?> <?= $row['currs'] ?>
            </td>
            <td>
                <?= $row['payment_system'] ?>
            </td>
            <td>
                <?= $row['count_earn'] ?> из <?= $row['plan_earns'] ?>
            </td>
            <td><?= $row['plan_term'] / 60 / 60 / 24 / 30?> раз в месяц</td>
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
            <td><?= $this->statuses[$row['status']] ?></td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="8">
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