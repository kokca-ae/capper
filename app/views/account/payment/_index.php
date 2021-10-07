<?php require_once($this->getLayout('header_cabinet')); ?>

<div class="contentMain">
                        <div class="payMovePage payInPage">
						
						<form method="post" action="">
						<input type="hidden" name="token" value="<?= $this->getToken('payment_form'); ?>">
						<input type="hidden" name="form" value="payment_form">
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
													<?php foreach ($this->ps as $row) : ?>
													<?$rest = substr($row['format'], 2, 1);?>
													<option class="" value="<?= $row['name'] ?>" data-currs="<?= $this->config['bal_' . $row['currs']] ?>" data-valuta="<?= strtolower($row['currs']) ?>" data-bal="<?= $this->sotTrash($this->user->balance['money_' . $row['name']],$rest); ?>" data-symbol="<?= $rest?>"> <?= $row['fullname']; ?> <?= $this->sotTrash($this->user->balance['money_' . $row['name']],$rest); ?></option>
													<?php $i++; ?>
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
                                                <label><?=$this->getLanguageText('Amount of payment:');?></label>
                                                <div class="wrapInput iconCurrency">
                                                    <input id="amountOut" type="text" name="amount" value="<?= $this->user->balance['money_py'] ?>">
                                                    <span id="setCurr" class="icon"><i class="fa fa-rub"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="resultSum">
                                <span><?=$this->getLanguageText('Will be paid:');?></span>
                                <span class="num" id="amSet"><?= $this->user->balance['money_py'] ?> <i class="fa fa-rub"></i></span>
                            </div>
                            <div class="bttnGradientBlock">
                                <button class="gradientBttn doItBttn"><?=$this->getLanguageText('make a payment')?></button>
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
		var bal = $(':selected', this).data('bal');
		var symbols = $(':selected', this).data('symbol');
		
		//alert(currs + valuta);
		console.log(currs+' :: '+valuta+' :: '+symbols);
		GodObj.currs = Number(currs);
		GodObj.valuta = valuta;
		GodObj.bal = Number(bal);
		GodObj.symbols = Number(symbols);
		
		$('#amountOut').val(GodObj.bal);
		var $amount = $("#amountOut").val();
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
	$('#amountOut').val(min);
	$('#ps_out').val(ps);
	$('#amSet').html(min+'<span class="iconCurrency icon-'+GodObj.curr+'"></span>');

});

$('#amountOut').keyup(function(){
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