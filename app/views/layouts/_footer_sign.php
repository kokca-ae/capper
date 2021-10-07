<div class="copyrights text-center">
        <p>Copyright © <?=date("Y",time())?> <a href="https://beta.companieshouse.gov.uk/company/11646797" target="_blank"><?=NAME?></a><br><a href="/rules" target="_blank"><?=$this->getLanguageText('Terms & Policy'); ?></a></p>
    </div>
</div>
<!-- JavaScript files-->

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>

<!-- Main File-->
<script src="/assets/js/front.js"></script>

<!--Start of Zendesk Chat Script-->

<!--End of Zendesk Chat Script-->

</body></html>	
<!-- -->



    <!-- sweet Alert -->
    <script src="https://unpkg.com/sweetalert2@7.15.1/dist/sweetalert2.all.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.css" rel="stylesheet" type="text/css">
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
</body></html>