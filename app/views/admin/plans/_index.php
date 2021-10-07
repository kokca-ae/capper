<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Название</td>
            <td>Мин. депозит</td>
            <td>Макс. депозит</td>
            <td>Процент</td>
        </tr>
        
<?php if ($plans) : ?>
        
    <?php foreach ($plans as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/plans/view/<?= $row['id'] ?>"><?= $row['name'] ?></a>
            </td>
            <td>
                <?= $row['min_sum'] ?> USD
            </td>
            <td>
                <?= $row['max_sum'] ?> USD
            </td>
            <td>
                <?= $row['perc'] ?> %
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