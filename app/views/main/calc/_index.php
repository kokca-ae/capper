<?php /*require($this->getLayout('header'));*/ ?>

<div class="podlojkaFFF" style="background: none;">
            <div class="col-md-12" style="background: #17a6f2;">
                <div class="special-heading textalignleft default blue_heading" style="padding-bottom: 0px;">
                    <h2 class="fancy default"><span><?= $_title[LANG] ?></span></h2>
                </div>
				
               <div class="col-md-6">
                                                <select name="plan" id="calcPS">
<option value="" style="display:none">Тарифный план</option>
<?php foreach ($plans as $row) : ?>
<option data-per="<?= $row['perc'] ?>" data-min="<?= sprintf("%.2f", $row['min_sum']); ?>" data-max="<?= sprintf("%.2f", $row['max_sum']); ?>"><?= $row['name'] ?></option>
<?php endforeach ?>
                                                    
                                                </select>
               </div>

               <div class="col-md-6">
               <input name="amount" placeholder="Введите сумму" type="text" onchange="calc_rich()" onkeyup="calc_rich()" onfocusout="calc_rich()" onactivate="calc_rich()" ondeactivate="calc_rich()" id="sumCalc">
               </div>
			   
               <div class="col-md-6">
               <input id="minCalc" placeholder="Минимальная сумма" type="text" disabled>
               </div>
			   
               <div class="col-md-6">
               <input id="allCalc" placeholder="Доходность" type="text" disabled>
               </div>
			   
			   <div class="col-md-6">
               <input id="maxCalc" placeholder="Максимальная сумма" type="text" disabled>
               </div>
			   
			   
			   <div class="col-md-6">
               <button name="calculate" type="button" class="btn btn btn-primary btn-block fufon">Расчитать</button>
               </div>
			   
			   <div class="col-md-12" style="padding-bottom: 40px;"></div>
			   
            </div> 
</div>

<script>
var Obj1 = {};
$(function () {
      $('#calcPS').change(function()
    {
		//var currs = $(':selected', this).data('currs');
		//var valuta = $(':selected', this).data('valuta');
		var min = $(':selected', this).data('min');
		var max = $(':selected', this).data('max');
		var per = $(':selected', this).data('per');
		//alert(currs + valuta);
		console.log(min+' :: '+max+' :: '+per);
		
		Obj1.min = Number(min);
		Obj1.max = Number(max);
		Obj1.per = Number(per);
		
		calc_rich();
    });

});

function calc_rich() {
var $amount = $("#sumCalc").val();
var $all = ($amount * (Obj1.per/100)).toFixed(2);
//$('#calcCURS').val( ($amount * GodObj.currs).toFixed(6) );
$('#allCalc').val('Итоговая сумма возврата ' + $all + '$');
$('#minCalc').val('Минимальная сумма вклада ' + Obj1.min + '$');
$('#maxCalc').val('Минимальная сумма вклада ' + Obj1.max + '$');
}
</script>



<?php /*require($this->getLayout('footer'));*/ ?>