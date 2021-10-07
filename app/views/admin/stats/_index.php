<?php require($this->getLayout('a_header')); ?>

<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td align="center">Всего пользователей</td>
            <td align="center">
                <?= $stats['all_users'] ?> 
            </td>
        </tr>
        
    <?php foreach ($ps as $row) : ?>
        
        <tr>
            <td align="center">Всего на счетах <?= $row['fullname'] ?></td>
            <td align="center">
                <?= sprintf($row['format'], $stats['balance']['money_' . $row['name']]) ?> <?= $row['currs'] ?> ( <?=number_format(($stats['balance']['money_' . $row['name']]*$this->config['bal_'.$row["currs"]]), '2', '.', ',')?> $ )
            </td>
        </tr>
                
    <?php endforeach ?>
                
        <tr>
            <td align="center">Всего активных депозитов</td>
            <td align="center">
                <?= $stats['on_deposits'] ?>
            </td>
        </tr>
        <tr>
            <td align="center">Всего пополнено</td>
            <td align="center">
                <?= sprintf('%.2f', $stats['insert_sum']) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Всего реинвестировано</td>
            <td align="center">
                <?= sprintf('%.2f', $stats['reinsert_sum']) ?> USD
            </td>
        </tr>
        <tr>
            <td align="center">Всего выплачено</td>
            <td align="center">
                <?= sprintf('%.2f', $stats['payment_sum']) ?> USD
            </td>
        </tr>
    </table>
	
</div>

<?php require($this->getLayout('a_footer')); ?>