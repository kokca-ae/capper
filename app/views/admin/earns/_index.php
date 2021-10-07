<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Тип</td>
            <td>Пользователь</td>
            <td>Сумма начисления</td>
            <td>Дата</td>
        </tr>
        
<?php if ($earns) : ?>
        
    <?php foreach ($earns as $row) : ?>
        
        <tr>
            <td>
                <?= $this->statuses[$row['type']] ?>
            </td>
            <td>
                <a href="/panel/users/view/<?= $row['user_id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td>
                <?= sprintf($row['format'], $row['sum']) ?> <?= $row['currs'] ?>
            </td>
            <td>
                <?= date('d.m.Y H:i', $row['date_add']) ?>
            </td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="4">
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