        <!-- =================================== -->
        <?php require_once($this->getLayout('header_cabinet')); ?>
        <!-- =================================== -->
            

<div class="row">   
        <div class="col-md-12">
            <div class="card">
<!-- -->			
<div class="avpad"></div>
<!-- -->

                <div class="card-body">
                    <div class="px-3">
			<!-- -->	
          
			<!-- -->
<?php foreach ($plans as $row) : ?>
            <form method="post" action="/reinvest" class="bl-bg new-deposit" data-pjax>
            <input type="hidden" name="token" value="<?= $this->getToken('deposit_form'); ?>">
            <input type="hidden" name="form" value="deposit_form">
            <input type="hidden" name="io" value="<?= $this->usid;?>">
				<input name="plan" value="<?= $row['id'] ?>" type="hidden">

                            <div class="row justify-content-md-center">
							
                                <div class="col-md-6">
<!-- -->
<div class="form-body">
<div class="form-group" style="margin-bottom: 0;">
<div class="" style="background: #f9b30d;border-bottom: 3px solid #2d2d44;border-radius: 20px;width: 50%;">
	<div style="padding-top: 15px;text-align: center;font-weight: bold;color: #ffffff;text-shadow: 2px 1px 5px #161b25;text-transform: uppercase;"><?=$row['name']?></div>
<div style="padding: 7px 15px;text-align: center;font-weight: bold;font-size: 26px;color: #161b25;text-shadow: 2px 1px 5px #161b2561;"><?= round($row['perc'],0) ?><span style="font-size: 14px;font-weight: bold;">%</span></div>
    <div style="padding: 2px 0;text-align: center;font-weight: 700;color: #fff;text-shadow: 2px 1px 5px #161b25;"><?= round($row['perc']/$row['earns'],2) ?>% <?=$this->getLanguageText('at hour');?></div>
<div style="padding: 2px 0;text-align: center;margin-bottom: 10px;font-weight: 700;color: #fff;text-shadow: 2px 1px 5px #161b25;">min: <span id="calcMin"><?= round($row['min_sum'],0);  ?></span> <i id="t_min" class="fa fa-usd"></i> max: <span id="calcMax"><?= round($row['max_sum'],0);  ?></span> <i id="t_max" class="fa fa-usd"></i></div>

</div>
</div>
</div>
<!-- -->
								

<br>
								
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="eventInput1"><?=$this->getLanguageText('Set pay system');?></label>
                    <?php $i = 1 ?>
                    <select class="form-control areacolor select2-hidden-accessible" name="ps" id="calcEPS">
                    <option value="" style="display:none">Select system</option>
                      <?php foreach ($this->ps as $row) : $i++ ?>
                      <?$rest[$i] = substr($row['format'], 2, 1);?>
                      <?
                        if($row['fullname'] == "AdvCash (USD)"){ $row['fullname'] = "AdvCash";}
                          if($row['fullname'] == "Payeer (USD)"){ $row['fullname'] = "Payeer";}
                        ?>
                      <option id="ps_<?= $row['id'] ?>" class="" value="<?= $row['name'] ?>" data-currs="<?= $this->config['bal_' . $row['currs']] ?>" data-valuta="<?= strtolower($row['currs']) ?>" data-min="<?= $row['min_insert'] ?>" data-max="<?= $row['max_insert'] ?>" data-symbol="<?= $rest[$i]?>" data-yourbalance="<?= $this->user->balance['money_' . $row['name']]; ?>"> <?= $row['fullname']; ?> : <?= $this->user->balance['money_' . $row['name']]; ?></option>
                      <?php endforeach; ?>

                    </select>
                                        </div>

                    <div class="form-group">
                    <label for="timesheetinput3"><?=$this->getLanguageText('Deposit amount');?></label>
                    <div class="position-relative has-icon-left">
                    <input id="calcSUM" name="amount" class="form-control areacolor" type="text" value="" onchange="calc_rich()" onkeyup="calc_rich()" onfocusout="calc_rich()" onactivate="calc_rich()" ondeactivate="calc_rich()">
                    <!--<div class="form-control-position">
                      <i id="type_2" class="fa fa-usd"></i>
                    </div>-->
                    </div>
                    </div>

										
                            <div class="form-actions center">
                                <button type="submit" style="min-width: 200px;" class="btn btn-success"><i class="icon-note"></i> <?=$this->getLanguageText('Next');?></button>
                            </div>
                                    </div>
                                </div>
                            </div>


                        </form>
<?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- =================================== -->
<script>
var GodObj = {};

$(function () {
      $('#calcEPS').change(function()
    {
		var currs = $(':selected', this).data('currs');
		var valuta = $(':selected', this).data('valuta');
		var min_pay = $(':selected', this).data('min');
		var max_pay = $(':selected', this).data('max');
		var symbols = $(':selected', this).data('symbol');
		var yourbalance = $(':selected', this).data('yourbalance');
		
		console.log(currs+' :: '+valuta+' :: '+symbols);
		GodObj.currs = Number(currs);
		GodObj.valuta = valuta;
		GodObj.min_pay = Number(min_pay);
		GodObj.max_pay = Number(max_pay);
		GodObj.symbols = Number(symbols);
		GodObj.yourbalance = Number(yourbalance);
		
		$('#calcSUM').val(GodObj.yourbalance);
		var $amount = $("#calcSUM").val();
        //var zem = ($amount * GodObj.currs).toFixed(2);
		//$('#calcCURS').val(zem + ' $');
		
		
		var currs = $(':selected', this).data('currs');
		var valuta = $(':selected', this).data('valuta');
		var min_pay = $(':selected', this).data('min');
		var max_pay = $(':selected', this).data('max');
		var symbols = $(':selected', this).data('symbol');
		
		//alert(currs + valuta);
		console.log(min_pay+' :: '+max_pay);
		
		
$('#calcMin').html(GodObj.min_pay);
$('#calcMax').html(GodObj.max_pay);
//$('#type').val(GodObj.valuta);

$("#type").removeClass();
$("#type").addClass("fa fa-"+GodObj.valuta);
$("#type_2").removeClass();
$("#type_2").addClass("fa fa-"+GodObj.valuta);
$("#t_min").removeClass();
$("#t_min").addClass("fa fa-"+GodObj.valuta);
$("#t_max").removeClass();
$("#t_max").addClass("fa fa-"+GodObj.valuta);
		
		calc_rich();
    });

});

function calc_rich() {
var $amount = $("#calcSUM").val();
//var zem = ($amount * GodObj.currs).toFixed(2);
//$('#calcCURS').val(zem + ' $');
}


</script>

  
  <!--- --->
 
<!----------------------------->




<?php require_once($this->getLayout('footer_cabinet')); ?>