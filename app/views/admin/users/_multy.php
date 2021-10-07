<?php require($this->getLayout('a_header')); ?>


<div class="col-lg-9">

    <table class="table table-hover table-striped table-bordered">
        <tr>
            <td>Логин</td>
            <td>Email</td>
            <td>Дата регистрации</td>
            <td>IP login</td>
			<td>IP Reg</td>
        </tr>
        
<?php if ($MultySET) : ?>
        
    <?php foreach ($MultySET as $row) : ?>
        <?if($row['banned']>0){ $style="style='color: red';";}else{$style="style='';";}?>
        <tr>
            <td <?=$style?>>
                <a href="/panel/users/view/<?= $row['id'] ?>"><?= $row['user'] ?></a>
            </td>
            <td <?=$style?>>
                <?= $row['email'] ?>
            </td>
            <td <?=$style?>><?= date('d.m.Y H:i', $row['date_reg']) ?></td>
            <td <?=$style?>>
                <?= long2ip($row['ip']) ?>
            </td>
            <td <?=$style?>>
                <?= long2ip($row['ip_reg']) ?>
            </td>
        </tr>
        
    <?php endforeach ?>
        
<?php else : ?>
        
        <tr>
            <td colspan="6">
                Никто не улечен
            </td>
        </tr>
        
<?php endif ?>
        
    </table>


</div>


<?php require($this->getLayout('a_footer')); ?>