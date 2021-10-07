<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>ЭПС</td>
            <td>Валюта</td>
            <td>Статус</td>
        </tr>
        
<?php if ($ps) : ?>
        
    <?php foreach ($ps as $row) : ?>
        
        <tr>
            <td>
                <a href="/panel/ps/<?= $row['name'] ?>"><?= $row['fullname'] ?></a>
            </td>
            <td>
                <?= $row['currs'] ?>
            </td>
            <td>
                <?= $this->statuses[$row['active']] ?>
            </td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="3">
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