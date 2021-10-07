<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">
                        <div class="payMovePage payInPage">
						
						<form method="post" action="">
						<input type="hidden" name="token" value="<?= $this->getToken('insert_form'); ?>">
						<input type="hidden" name="form" value="insert_form">
						<input type="hidden" name="io" value="<?= $this->usid;?>">
						
                            <div class="cfix margO">
                                <div class="item col6 col12-sd col6-md col12-xs">
                                    <div class="bigCard choiceSum">
                                        <div class="titleCard">
                                            <span class="icon-34"></span>
                                            <span class="txt"><?=$this->getLanguageText('Payment <br>system:');?></span>
                                        </div>
                                        <div class="content">
										
											<div class="inputBlock">
                                            <label><?=$this->getLanguageText('Select payment system');?>:</label>
                                            <div class="wrapInput iconCurrency">
                                                <select class="selectricBl" name="ps" id="calcEPS">
													<?php $i = 1; ?>
													<?php foreach ($this->ps as $row) : $i++ ?>
													<?$rest[$i] = substr($row['format'], 2, 1);?>
													<option class="" value="<?= $row['name'] ?>" data-currs="<?= $this->config['bal_' . $row['currs']] ?>" data-valuta="<?= strtolower($row['currs']) ?>" data-min="<?= $row['min_insert'] ?>" data-max="<?= $row['max_insert'] ?>" data-symbol="<?= $rest[$i]?>"> <?= $row['fullname']; ?></option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
											</div>
                                            <div class="inputBlock">
                                            <div class="wrapInput iconCurrency">
                                                <select class="selectricBl" name="plan">
													<?php $i = 1; ?>
													<?php foreach ($plans as $row) : $i++ ?>
													<?$rest[$i] = substr($row['format'], 2, 1);?>
													<option class="" value="<?= $row['id'] ?>"> <?= $row['name']; ?> (<?= $row['perc']; ?>%)</option>
													<?php endforeach; ?>
                                                </select>
                                            </div>
											</div>
                                            
                                        </div>
                                    </div>
                                </div>
								
                                <div class="item col6 col12-sd col6-md col12-xs">
                                    <div class="bigCard choiceSum">
                                        <div class="titleCard">
                                            <span class="icon-7"></span>
                                            <span class="txt"><?=$this->getLanguageText('Enter <br>amount:');?></span>
                                        </div>
                                        <div class="content">
										
                                            <div class="inputBlock">
                                                <label><?=$this->getLanguageText('Amount of investment:');?></label>
                                                <div class="wrapInput iconCurrency">
                                                    <input id="amountIn" type="text" name="amount" value="7000">
                                                    <span id="setCurr" class="icon"><i class="fa fa-rub"></i></span>
                                                </div>
                                            </div>
                                            <!--<div class="choicingInputs choiceCurrency cfix">
                                                <div class="boxInput">
                                                    <input type="radio" name="choiceCurrency" id="rubCur" data-curr="41" data-min="7000" data-ps="wmr" checked>
                                                    <label for="rubCur">Rub</label>
                                                </div>
                                                <div class="boxInput">
                                                    <input type="radio" name="choiceCurrency" id="usdCur" data-curr="43" data-min="100" data-ps="wmz">
                                                    <label for="usdCur">Usd</label>
                                                </div>
												<div class="boxInput">
                                                    <input type="radio" name="choiceCurrency" id="eurCur" data-curr="42" data-min="100" data-ps="wme">
                                                    <label for="eurCur">Eur</label>
                                                </div>
                                            </div>-->
                                            <div class="logRegCheck" style="margin-top: 30px;">
                                                <input type="checkbox" name="from_balance" value="0" id="fromBal">
                                                <label for="fromBal" style="color: white;"><?=$this->getLanguageText('Reinvest');?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="resultSum">
                                <span><?=$this->getLanguageText('Will be invested:');?></span>
                                <span class="num" id="amSet">7000 <i class="fa fa-rub"></i></span>
                            </div>
                            <div class="bttnGradientBlock">
                                <button class="gradientBttn doItBttn"><?=$this->getLanguageText('make a deposit')?></button>
                            </div>
							
						</form>
							
                        </div>
                    </div>
<!-- -->
<script>
var GodObj = {};

GodObj.curr = 41; // stock on RUB
GodObj.valuta = 'rub'; // stock on RUB

$('#calcEPS').change(function()
    {
		var currs = $(':selected', this).data('currs');
		var valuta = $(':selected', this).data('valuta');
		var min_pay = $(':selected', this).data('min');
		var max_pay = $(':selected', this).data('max');
		var symbols = $(':selected', this).data('symbol');
		
		//alert(currs + valuta);
		console.log(currs+' :: '+valuta+' :: '+symbols);
		GodObj.currs = Number(currs);
		GodObj.valuta = valuta;
		GodObj.min_pay = Number(min_pay);
		GodObj.max_pay = Number(max_pay);
		GodObj.symbols = Number(symbols);
		
		$('#amountIn').val(GodObj.min_pay);
		var $amount = $("#amountIn").val();
        //var zem = ($amount * GodObj.currs).toFixed(2);
		//$('#calcCURS').val(zem + ' $');
		
		
		//alert(currs + valuta);
		
		
//$('#calcMin').val(GodObj.min_pay);
//$('#calcMax').val(GodObj.max_pay);
//$('#type').val(GodObj.valuta);

//$("#type").removeClass();
$("#setCurr").html("<i class='fa fa-"+GodObj.valuta+"'></i>");
$('#amSet').html($amount+' <i class="fa fa-'+GodObj.valuta+'"></i>');
		
		//calc_rich();
    });

$("input[name='choiceCurrency']").click(function(){
    //Some code
	let id = $(this).attr('id');
	let curr = $(this).data('curr');
	
	GodObj.curr = curr;
	
	let min = $(this).data('min');
	let ps = $(this).data('ps');
	console.log('id > '+id);
	console.log('curr > '+curr);
	console.log('GodObj.curr > '+GodObj.curr);
	console.log('min > '+min);
	$('#setCurr').removeClass();
	$('#setCurr').addClass('icon-'+GodObj.curr);
	$('#amountIn').val(min);
	//$('#ps_in').val(ps);
	$('#amSet').html(min+'<span class="iconCurrency icon-'+GodObj.curr+'"></span>');

});

$('#amountIn').keyup(function(){
	//Some code
	var amount = $(this).val();
	$('#amSet').html(amount+' <i class="fa fa-'+GodObj.valuta+'"></i>');
	
});

$("input[name='from_balance']").click(function(){
    //Some code
	var v = $(this).val();
	if(v == 1){
		var v = 0;
	}else{
		var v = 1;
	}
	$(this).val(v);
	console.log('v > '+v);
});
</script>
					
<?
require_once($this->getLayout('news')); // подгрузка новостей
?>

<?php require_once($this->getLayout('footer_cabinet')); ?>