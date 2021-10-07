                </div>

<footer class="leftSide">
                <p class="copyRight"> Copyright © <?=date("Y",time())?> <?=NAME?> LTD</p>
            </footer>
				
            </div>
        </div>

<script>
var lango = {};
lango.now = '<?=$this->lang;?>';
console.log('lango.now: '+lango.now);

</script>

<script src="/assets/js/jquery.countdown.min.js"></script>
<script>
$(function () {
$('.flag.flag-'+lango.now).addClass('active');
$('#lang').html('<i class="flag flag_<?=$this->lang;?>"></i><?=strtoupper($this->lang);?>');
});
</script>



<script type="text/javascript">
// set choose class "active" for link menu left
$(function () {
    var location = window.location.href;
    var cur_url = '/' + location.split('/').pop();
 
    $('.listMenu li').each(function () {
        var link = $(this).find('a').attr('href');
		
		var rss = $(this).find('a');
		console.log("rss: "+rss);
 
        if (cur_url == link)
        {
            $(this).addClass('active');
			$(rss).addClass('active');
			console.log("this: "+this);
        }
    });
});
</script>


<!-- modals -->
<?php require_once($this->getLayout('modals_cab')); ?>
<!-- modals -->


	

</body>
</html>