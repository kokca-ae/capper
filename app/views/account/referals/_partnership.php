        <!-- =================================== -->
        <?php require_once($this->getLayout('header_cabinet')); ?>
        <!-- =================================== -->

<div class="content-inner" style="padding-bottom: 59px;">
                <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom"><?=$_title[$this->lang]; ?></h2>
        </div>
    </header>
    <!-- Dashboard Header Section    -->
    <section class="dashboard-header pb-4">
        <div class="container-fluid">
            <div class="row">
                <!-- Statistics -->
                <div class="statistics col-lg-12 col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-violet"><i class="fa fa-user-plus"></i></div>
                                <div class="text"><strong><?= $upliner ?></strong><br>
                                    <small><?=$this->getLanguageText('Your upliner');?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-red"><i class="fa fa-users"></i></div>
                                <div class="text"><strong><?= $this->user->referal['count_ref1']+ $this->user->referal['count_ref2']+ $this->user->referal['count_ref3']?></strong><br>
                                    <small><?=$this->getLanguageText('Referrals count');?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="statistic d-flex align-items-center bg-white has-shadow">
                                <div class="icon bg-green"><i class="fa fa-dollar"></i></div>
                                <div class="text"><strong>$<?= sprintf("%.2f", ($this->user->referal['from_referals1']+$this->user->referal['from_referals2']+$this->user->referal['from_referals3'])); ?></strong><br>
                                    <small><?=$this->getLanguageText('Referral commission');?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Line Chart            -->
            </div>
        </div>
    </section>
	

    

	
    <section class="pb-0 pt-0">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4"><?=$this->getLanguageText('Referrals statistic');?></h3>
                </div>
                <div class="card-body">
                        <div id="historyTransaction_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

<div class="row justify-content-left" style="padding-bottom: 25px;">
    <div class="col-3"><a href="/referals" class="btn btn-primary btn-block" data-pjax=""><?=$this->getLanguageText('Ref link and banners');?></a></div>
</div>
						
						</div>
						
						
<div class="row"><div class="col-sm-12"><table id="historyTransaction" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="historyTransaction_info">
                            <thead>
                            <tr role="row">
							<th class="sorting_desc" tabindex="0" rowspan="1" colspan="1" style="width: 130px;">ID</th>
							<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 235px;"><?=$this->getLanguageText('Login');?></th>
							<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 184px;">Email</th>
							<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 184px;"><?=$this->getLanguageText('Your income');?></th>
							<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 277px;"><?=$this->getLanguageText('Registered');?></th></tr>
                            </thead>
                            <tbody>

								
								<?php if ($referals) : ?>
                                      <?php foreach ($referals as $row) : ?>
                                <tr role="row" class="even">
                                    <td class="sorting_1">
                                        <span>#<?= $row["id"]; ?></span>
                                    </td>
									<td><span><?= $row["user"]; ?></span></td>
									<td><span><?= $row["email"]; ?></span></td>
                                    <td>
                                        <div class="pmIco smallIco"></div>
                                        <span class="text-success">
                                            +<?= $row["to_referer".$lvl]?> <i class="fa fa-usd"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-info"><?= date("d.m.Y H:i", $row['date_reg']); ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                      <tr><td colspan="5"><div class="text-center color-red"><?=$this->getLanguageText('You have no referrals');?></div></td></tr>
								<?php endif; ?>
								</tbody>
                        </table>
						</div>
						</div>
						
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="dataTables_paginate paging_simple_numbers" id="historyTransaction_paginate">
<?php if (isset($navigation['navigation'])) : ?>
    <div class="text-center"><?php echo $navigation['navigation']; ?></div>
<?php endif; ?>
</div>
</div>
</div>
						
            </div>
            <div class="w-100 mb-4 px-5 text-center text-muted"><small><?=$this->getLanguageText('You will get 7% referral bonus on each deposit placed by your referrals.');?><br></small></div>
        </div>
    </section>

        
	
    
	
            <!-- Page Footer-->
<?php require_once($this->getLayout('footer_cabinet')); ?>
	<?/*
  

<div  class="table-responsive">
  <table id="recent-orders" class="table table-hover table-xl mb-0">
    <thead class="tablehead">
      <tr>
        <th class="border-top-0" >#</th>
        <th class="border-top-0" ><?=$this->getLanguageText('User');?></th>
        <th class="border-top-0" >Email</th>
        <th class="border-top-0" ><?=$this->getLanguageText('Registered');?></th>
        <th class="border-top-0" ><?=$this->getLanguageText('Your income');?></th>
      </tr>
    </thead>
    <tbody class="tablebody">                                            
    <?php if ($referals) : ?>
        <?php $id = 0; ?>
        <?php foreach ($referals as $row) : ?>
          <?php $id++?>
            <tr role="row" class="odd">
                <td><?= $id; ?></td>
                <td><?= $row["user"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= date('d.m.Y H:i:s', $row["date_reg"]); ?></td>
                <td><?= $row["to_referer".$lvl]?> <i class="fa fa-usd"></i></td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr><td colspan="5"><div class="text-center color-red"><?=$this->getLanguageText('You have no referrals');?> <?= $lvl; ?> <?=$this->getLanguageText("level's");?></div></td></tr>
    <?php endif; ?>
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


<?php require_once($this->getLayout('footer_cabinet')); */?>