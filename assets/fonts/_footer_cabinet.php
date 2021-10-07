<script>
var lango = {};
lango.now = '<?=$this->lang;?>';
console.log('lango.now: '+lango.now);
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
		<script src="/assets/js/all.min.js"></script>
		<script src="/assets/js/jquery.countdown.min.js"></script>
<script>
$(function () {
$('#lang').html('<i class="flag flag_<?=$this->lang;?>"></i><?=strtoupper($this->lang);?>');
});
</script>



<script type="text/javascript">
// set choose class "active" for link menu left
$(function () {
    var location = window.location.href;
    var cur_url = '/' + location.split('/').pop();
 
    $('.sidebar-cabinet-menu li').each(function () {
        var link = $(this).find('a').attr('href');
		
		var rss = $(this).find('a');
		//console.log("rss: "+rss);
 
        if (cur_url == link)
        {
            $(this).addClass('active');
			$(rss).addClass('active');
			//console.log("this: "+this);
        }
    });
});
</script>
    <!-- sweet Alert -->
    <script src="https://unpkg.com/sweetalert2@7.15.1/dist/sweetalert2.all.js"></script>
    <link href="/assets/css/sweet.css" rel="stylesheet" type="text/css">
    <!-- sweet Alert -->

<div id="result" style="display: none;z-index:-1;">
<?php if ($this->error) echo $this->error; ?>
</div>


<script>
    var error = document.querySelector('#result');
    if (error.querySelector('.success, .error') != null) {
        
        //var type = error.querySelector('.success, .error');
        //var type = result.classList.item(1);
        var type = error.querySelector('.success, .error').className;
        
        console.log(type);
        
        //$('#error').css("opacity","1").css("z-index","100000");
        
 swal({
 position: 'center',
 type: type,
 title: '<?php if ($this->error) echo $this->error; ?>',
 showConfirmButton: false,
 timer: 3500
})
        
        //error.style.opacity = 1;
        //error.style.zIndex = 1000;
        setTimeout(function(){
            error.style.opacity = 0;
        }, 5000);
        setTimeout(function(){
            error.style.zIndex = -1;
        }, 5500);
    }
</script>



</body>
</html>