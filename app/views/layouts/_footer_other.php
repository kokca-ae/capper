	<section class="massMedia">
        <div class="containerBlock">
            <div class="clearfix"></div>
        </div>
    </section>
	
	<section class="footerMenu">
        <div class="containerBlock">
            <ul>
                <li><a href="/"><?=$this->getLanguageText('Home'); ?></a></li>
                <li><a href="/#InformationForInvestors"><?=$this->getLanguageText('Information for investors'); ?></a></li>
                    <li><a href="/#About"><?=$this->getLanguageText('About us'); ?></a></li>
                    <li><a href="/contacts" ><?=$this->getLanguageText('Support'); ?></a></li>
                    <li><a href="/rules" ><?=$this->getLanguageText('Rules'); ?></a></li>
                    <li><a href="/faq" ><?=$this->getLanguageText('FAQ'); ?></a></li>
					<?php if (!$this->usid) : ?>
                    <li><a href="/login"><?=$this->getLanguageText('Sign In'); ?></a></li>
					<li><a href="/signup"><?=$this->getLanguageText('Register'); ?></a></li>
					<?php else : ?>
                    <li><a href="/cabinet"><?=$this->getLanguageText('Account'); ?></a></li>
					<li><a href="/exit"><?=$this->getLanguageText('Logout'); ?></a></li>
					<?php endif; ?>
            </ul>
        </div>
    </section>
<!-- footer (RICH-99000000 COMMENT's) \-->
<footer>
    <div class="containerBlock">
        <a href="/" class="logo"><img src="/assets/img/logo_main.svg"></a>
        <p>Copyright © <?=date("Y",time())?> <a href="https://beta.companieshouse.gov.uk/company/11646797" target="_blank"><?=NAME?></a><br><a href="/rules" target="_blank"><?=$this->getLanguageText('Terms & Policy'); ?></a></p>
    </div>
</footer>

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