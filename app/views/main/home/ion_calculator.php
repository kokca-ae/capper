<div class="aboutMain" style="background-image: url(/assets/img/back-aboutCompanyGrey.png);z-index: 999;padding-top: 0px;">
                <div class="container">
				
				<div class="col-md-10 col10" style="margin: 0 auto;">
                    <div class="IonCalc showEl hidden visible animated fadeInDown full-visible">
                        
<div class="containerBlock" style="">
    <div class="row" style="margin: 0px;">
    
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="text-align: center;">
<? $i=1;?>
<?php foreach ($this->ps_m as $row) :?>
<?
$rest[$i] = substr($row['format'], 2, 1);
/*if($i == "1"){ $row['currs'] = "USD";}
if($i == "2"){ $row['currs'] = "RUB";}
if($i == 3){ $style_hide = "display:none;";}else $style_hide = "";
if($i == 1){ $addClass = "calc_but_active";}else $addClass = "";*/

	
//$i=3;
$currs = $curs[strtolower($row['currs'])];

$IRS_min[$i] = $row['min_insert'];
$IRS_max[$i] = $row['max_insert'];

if($i == 1 OR $i == 2){ $step = 0.2;}else $step = 0.0001;
?>

<div class="btn-inliner typeCurr js-tilt __mPS2id _mPS2id-h col-md-2 col-lg-2 col-xs-6 col-sm-6 blockLeft calc_but <?=$addClass?>" 
data-check_calc="<?=$i?>" 
data-min="<?=$IRS_min[$i];?>" 
data-step="<?=$step;?>" 
data-max="<?=$IRS_max[$i];?>" 
data-format="<?=$rest[$i]?>" 
data-curse="<?= $currs ?>" 
data-current="<?= strtolower($row['currs']) ?>" 
role="button" 
data-tilt-perspective="300" 
data-tilt-speed="700" 
data-tilt-max="24" 
style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg); margin: 3px 0px; <?=$style_hide?>">
<span class="tyrr" id="check_<?=$i?>"> <i class="fa fa-<?= strtolower($row['currs']) ?>"></i></span> 
<?= strtoupper($row['currs']) ?>
</div>

<? $i++; ?>
<?php endforeach; ?>

<!-- ION CALC -->
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 blockLeft" style="/*padding: 20px 25px;*/">
<div class="calculator-block" style="color: #000 !important;">
<div style="margin-top:20px;margin-bottom:10px;">
<input type="text" id="range" value="" name="range" class="" readonly="">
</div>
<div class="col-sm-12 col-md-4 col-lg-4 devR blockLeft" style="">
<span><?=$this->getLanguageText('Investment'); ?>:</span> <span id="value"><?=$IRS_min[1]?></span> <span class="setCurrPlan"><i class="fa fa-rub"></i></span>
</div>

<!-- -->
<div class="col-sm-12 col-md-4 col-lg-4 devR blockLeft" style="">
<span><?=$this->getLanguageText('per hour'); ?>:</span> <span id="valueHour"><?=$IRS_min[1]/24?></span> <span class="setCurrPlan"><i class="fa fa-rub"></i></span>
</div>
<!-- -->

<div class="col-sm-12 col-md-4 col-lg-4 devR blockLeft" style="">
<span><?=$this->getLanguageText('Receive'); ?>:</span> <span id="sum1"><?=$IRS_max[1]?></span> <span class="setCurrPlan"><i class="fa fa-rub"></i></span>
</div>
</div>
</div>


<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 blockLeft" style="padding: 20px 12px;">
    
<!--<div class="row">-->
<div class="col-sm-12 col-md-12 col-lg-12">
<div class="row justify-content-center" style="margin: 0 auto;">

<div class="col-sm-12 col-md-6 col-lg-6 blockLeft" style="padding-bottom: 25px;">
<span class="txtCalcNew"><?=$this->getLanguageText('Enter amount'); ?></span><br>
<input type="text" class="form-control inputCalc" value="" placeholder="<?=$this->getLanguageText('calculate arrive'); ?>" id="sum_calc1" onkeyup="calc_am();">
<br>
<span class="txtCalcNew"><?=$this->getLanguageText('Min Deposit'); ?></span> <span id="min_in"></span> <i class="fa fa-usd"></i>
</div>

<div class="col-sm-12 col-md-6 col-lg-6 blockLeft" style="">
<span class="txtCalcNew"><?=$this->getLanguageText('Tariff'); ?></span><br>
	<div class=" iconCurrency headchoose">
												<select class="selectricBl" id="calcEPS">
													<?php $i = 1; ?>
													<?php foreach ($plans as $row) : $i++ ?>
													<option class="" data-perc="<?= $row['perc']/100 ?>" data-min="<?= $row['min_sum'] ?>"  data-earns="<?= $row['earns'] ?>" data-max="<?= $row['max_sum'] ?>" data-id="<?=$i;?>"><?= $row['name'] ?></option>
													<?php endforeach; ?>
                                                </select>
<span class="txtCalcNew"><?=$this->getLanguageText('Max Deposit'); ?></span> <span id="max_in"></span> <i class="fa fa-usd"></i>
	</div>
</div>

</div>
</div>
<!--</div>-->
  <link rel="stylesheet" href="/assets/css/ioncalc/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/ioncalc/ion.irs.css">
  <link rel="stylesheet" href="/assets/css/ioncalc/ion.rangeSlider.css">
  <link rel="stylesheet" href="/assets/css/ioncalc/ion.rangeSlider.skinFlat.css">
  <!--<script src="/assets/js/jquery-1.12.3.min.js" type="text/javascript"></script>-->
  <script src="/assets/js/ion.rangeSlider.js" type="text/javascript"></script>
<!-- ION CALC -->
<script>
var GodObj = {};

GodObj.symbols = Number(2);	
GodObj.percent = Number(<?= $PlanAllPerc[1]/100; ?>);
GodObj.mindep = Number(<?= $PlanMin[1]; ?>);	
GodObj.maxdep = Number(<?= $PlanMax[1]; ?>);
GodObj.earns = Number(24); // часы начислений plans
$(document).ready(function() {
	
            var value = $("#value").html();
			$("#sum_calc1").val(value);
			mon=Number(GodObj.percent*Number(value)).toFixed(2);
			$("#valueHour").html((mon/GodObj.earns).toFixed(GodObj.symbols));
			//console.log('mon_start: '+mon);
			$("#sum1").html(mon);
			$("#min_in").html(GodObj.mindep);
			$("#max_in").html(GodObj.maxdep);
			
	$('#calcEPS').change(function()
    {
		var perc = $(':selected', this).data('perc');
		var min_dep = $(':selected', this).data('min');
		var max_dep = $(':selected', this).data('max');
		var earns = $(':selected', this).data('earns');
		
		GodObj.percent = Number(perc);
		GodObj.mindep = Number(min_dep);
		GodObj.maxdep = Number(max_dep);
		GodObj.earns = Number(earns);
		
		$("#min_in").html(GodObj.mindep);
		$("#max_in").html(GodObj.maxdep);

		calc_am();
    });
			
	
	$('.calc_but').on('click', function() {
	let i = $(this).data('check_calc');
	let check_current = $(this).data('current');
	let check_curse = $(this).data('curse');
	let check_format = $(this).data('format');
	let check_min = $(this).data('min');
	let check_max = $(this).data('max');
	let check_step = $(this).data('step');
	
	$("#sum_calc1").val(check_min);
	
	//var cheked = $("#check_"+i).html();
	//var checkstr = '<i class="fa fa-check"></i>';
	/*
	if($(this).hasClass('calc_but_active')){
	console.log(0);
	}else{
		console.log(1);
	}*/
	//var type = error.querySelector('.success, .error').className;
	//$(".tyrr").html('<i class="fa fa-check"></i>');
	
	
	$('.calc_but_active').removeClass('calc_but_active');
	$(this).addClass('calc_but_active');
	
	
GodObj.current = check_current;
GodObj.max = check_max;
GodObj.min = check_min;
	
	//console.log('i ::'+i);
		
		
	var percent = Number(GodObj.percent);
	//console.log(percent);
		

			mins = check_min;
			curse = check_curse;
			current = check_current;
			format = check_format;
			maxs = check_max;
				
		//console.log(format);
		
		
		
	slider = $("#range").data("ionRangeSlider");
		
	slider.update({
        min: mins,
        max: maxs,
		step: check_step,
		from: mins,
    });
	
		var nowcalcat = Number($("#range").val());
		//console.log(nowcalcat);
	
	GodObj.symbols = Number(format);
	
	mon=Number(nowcalcat*percent).toFixed(GodObj.symbols);
	//console.log('mon: '+mon);
	$("#sum1").html(mon);
	$("#value").html(mins);
	$("#valueHour").html((mon/GodObj.earns).toFixed(GodObj.symbols));
	//$("#sum2").html(percent);
	$(".setCurrPlan").html('<i class="fa fa-'+check_current+'"></i>');
	//$("#cur_2").html('<i class="fa fa-'+check_current+'"></i>');
	//$("#sum_calc1").val(nowcalcat);
	
	
		
	});
$("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: <?=$IRS_min[1]?>,
            max: <?=$IRS_max[1]?>,
			from: 1,
            type: 'single',
            step: 0.1,
            prefix: "",
            grid: true,
			onChange: function (data) { 
			$("#value").html(data.from);
			if(data.from){
				
			var percent = Number(GodObj.percent);
			/*if(format == null){
				
			format=	2;
			}*/
			
		
		var nowcalcat = Number($("#range").val());
		//console.log(nowcalcat);
	
            mon=Number(nowcalcat*percent).toFixed(GodObj.symbols);
			//console.log('mon2: '+mon);
			$("#sum1").html(mon);
			$("#valueHour").html((mon/GodObj.earns).toFixed(GodObj.symbols));
			//$("#sum2").html(percent);
			//$("#cur_1").html('<i class="fa fa-'+check_current+'"></i>');
			//$("#cur_2").html('<i class="fa fa-'+check_current+'"></i>');
			
			$("#sum_calc1").val(nowcalcat);
	var re = /[^0-9\.]/gi;
	var sum_calc = $("#sum_calc1").val();
	sum_calc = sum_calc.replace(re, '');
	$("#sum_calc1").val(sum_calc);
			

			}
			}
        });
		
    });
	
function calc_am(){
	
	//slider = $("#range").data("ionRangeSlider");
	var re = /[^0-9\.]/gi;
	var now_sum_calc = $("#sum_calc1").val();
	new_sum_calc = now_sum_calc.replace(re, '');
	$("#sum_calc1").val(new_sum_calc);
	var now = Number($("#sum_calc1").val());
	//console.log('calc_am > '+now);
	
	if(GodObj.current == null){
		var currents = "rub";
		var mins = 1;
		var maxs = 650000;
	}else{
		var currents = GodObj.current;
	}
		var set = Number($("#range").val());
	if(set > GodObj.max || now > GodObj.max){
		$("#sum_calc1").val(GodObj.max);
	}
	//console.log('set: '+set+'; now: '+now);
	
	slider = $("#range").data("ionRangeSlider");
	slider.update({
        min: mins,
        max: maxs,
		//step: check_step,
		from: now,
    });
	$("#range").val(now);
	

	
	mon=Number(now*Number(GodObj.percent)).toFixed(GodObj.symbols);    
	$("#value").html(now);
	$("#valueHour").html((mon/GodObj.earns).toFixed(GodObj.symbols));
	$("#sum1").html(mon);
	$(".setCurrPlan").html('<i class="fa fa-'+currents+'"></i>');
	
	//console.log('now '+now);
	//console.log('symbols '+GodObj.symbols);
	//console.log('current '+currents);
		
}
</script>
		
    </div></div></div>
	
                        </div>
                    </div>
                </div>
            </div>



    