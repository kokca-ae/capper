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
        
<?php if ($users) : ?>
        
    <?php foreach ($users as $row) : ?>
	<?$Remainder=$row['insert_sum']-$row['payment_sum'];?>
    <?
	if($Remainder<0){
	$style="style='color: red;'";
	}elseif($Remainder==0){
	$style="style=''";
	}else $style="style='color: #29dc29;'";
	?>
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
			<td <?=$style;?>> <?=$Remainder;?> <i class="fa fa-usd"></i></td></td>
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