var GodObj = {};
GodObj.symbols = 2;

function calc_am(){
var checkCurr = $('#currs').html(); //
var perplan = $('#perPlan').html();
var per = Number(perplan);
var z = (per-100)/100;
var amount = Number($("#amount_n").val());
var prof = z*amount+amount;

		if(GodObj.symbols == 2){
		var format = (parseInt(prof * 100)) / 100;
		$('#percent_n').html(format+' '+checkCurr);
		}else{
		var prof = (z*amount+amount).toFixed(8);
		$('#percent_n').html(prof+' '+checkCurr);
		}

//$('#percent_n').html(prof+' '+checkCurr); //

//console.log('z: '+z);
//console.log('prof: '+prof);
console.log('GodObj.symbols END => '+GodObj.symbols);
}

function start_home_info(a,b,c,d,e,f){
$('#name').html(a);
$('#name2').html(a);

var curr_start = '<i class="fa fa-'+b+'"></i>';

$('#min').html(c);
$('#max').html(d);
$('#min2').html(e);
$('#max2').html(f);
$('#amount_n').val(c); // in calc stock val

var percent_n = (Number($('#perPlan').html())-100)/100;
var nc = Number(c);
var prof = percent_n*nc+nc;
//console.log('percent_n: '+percent_n);
//console.log('prof: '+prof);

$('#percent_n').html(prof+' '+curr_start); // in calc stock sum+percent

$('#currs').html(curr_start);
$('#currs2').html(curr_start);
$('#currs_max').html(curr_start);
$('#currs_min').html(curr_start);
$('#currs_max2').html(curr_start);
$('#currs_min2').html(curr_start);
}

$('.payCalc').on('click', function(e) {
var data = $(this).data();
var curr = $(this).data('currs');
GodObj.symbols = $(this).data('symbol');
$('#currs').html(curr); //
for (var key in data){
  
    //console.log(key + ': ' + data[key]);
	$('#'+key).html(data[key]);
}
$("#amount_n").val($(this).data('min'));
$('#currs_max').html(curr);
$('#currs_min').html(curr);

//GodObj.id = $(this).data('id');
//console.log("GodObj.id: "+GodObj.id);
console.log("GodObj.symbols: "+GodObj.symbols);
calc_am();
});

$('.payMinMax').on('click', function(e) {
var data = $(this).data();
var curr = $(this).data('currs2');
//$('#currs').html(curr); //

console.log('this => '+this);

for (var key in data){
  
    //console.log(key + ': ' + data[key]);
	$('#'+key).html(data[key]);
}
//$("#amount_n").val($(this).data('min'));
$('#currs_max2').html(curr);
$('#currs_min2').html(curr);

});