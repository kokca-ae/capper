        <!-- =================================== -->
        <?php require_once($this->getLayout('header_cabinet')); ?>
        <!-- =================================== -->
    
<style type="text/css">
  
.input-group {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
}

.input-group-addon {
    border: 1px solid rgba(153, 153, 153, 0.2);
}

.form-group {
    position: relative;
}

</style>

<div class="row">
        <div class="col-12">
            <div class="card">
<!-- -->			
<div class="avpad"></div>
<!-- -->
                <div class="card-body">
                    <div class="card-block">
<div class="col-xs-12">


<div class="table-responsive" style="text-align: center;">
  <table id="recent-orders" class="table table-hover table-xl mb-0">
    <tbody class="tablebody">
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Start date');?></td>
        <td class="border-top-0"><?= date("d.m.Y H:i", $deposit['date_add']); ?></td>
      </tr>
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Tariff plan');?></td>
        <td class="border-top-0"><?= $deposit['plan_name'] ?></td>
      </tr>
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Amount');?></td>
        <td class="border-top-0"><?= sprintf($deposit['format'], $deposit['sum']) ?> <i class="fa fa-<?= strtolower($deposit['currs']) ?>"></i></td>
      </tr>
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Accrued');?></td>
        <td class="border-top-0"><?= intval($deposit['sum_earn'] * 100) / 100; ?> <i class="fa fa-<?= strtolower($deposit['currs']) ?>"></i> of <?= sprintf($deposit['format'], $deposit['plan_perc'] / 100 * $deposit['sum']); ?> <i class="fa fa-<?= strtolower($deposit['currs']) ?>"></i></td>
      </tr>
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Accrual');?></td>
        <td class="border-top-0"><?= $deposit['count_earn'] ?> of <?= $deposit['plan_earns'] ?></td>
      </tr>
      <tr role="row" class="odd">
        <td class="border-top-0"><?=$this->getLanguageText('Status');?></td>
        <td class="border-top-0"><?= $this->statuses[$deposit['status']]; ?></td>
      </tr>

    </tbody>
</table>

<div class="dataTables_info"  role="status"></div>
<?php if (isset($navigation['navigation'])) : ?>
    <div class="text-center"><?php echo $navigation['navigation']; ?></div>
<?php endif; ?>
</div>

</div>
</div>
</div>
</div>
</div>
</div>


<?php require_once($this->getLayout('footer_cabinet')); ?>
<!-- -->