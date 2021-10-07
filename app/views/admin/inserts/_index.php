<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>ЭПС</td>
            <td>Пользователь</td>
            <td>Сумма пополнения</td>
            <td>Batch</td>
            <td>Дата</td>
        </tr>
        
<?php if ($inserts) : ?>
        
    <?php foreach ($inserts as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/ps/<?= $row['payment_system'] ?>"><?= $row['fullname'] ?></a>
            </td>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td>
                <?= sprintf($row['format'], $row['sum']) ?> <?= $row['currs'] ?>
            </td>
            <td><?= $row['oper_id'] ?></td>
            <td><?= date('d.m.Y H:i', $row['date_add']) ?></td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="6">
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